{{-- Scripts del panel de administración --}}
<script>
// ============================================================
// HELPERS
// ============================================================
const API = '/api';
const PLACEHOLDER_SVG = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='120' height='72'><rect width='100%25' height='100%25' fill='%23e6eefb' rx='6' ry='6'/><text x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%234a6e9a' font-family='Arial,Helvetica,sans-serif' font-size='12'>Sin imagen</text></svg>";

async function apiFetch(url, opts = {}) {
    const headers = {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
        'X-Requested-With': 'XMLHttpRequest'
    };
    if (!(opts.body instanceof FormData)) {
        headers['Content-Type'] = 'application/json';
    }
    const defaults = {
        credentials: 'same-origin',
        headers: { ...headers, ...(opts.headers || {}) }
    };
    const res = await fetch(API + url, { ...defaults, ...opts });
    const contentType = res.headers.get('content-type') || '';
    const text = await res.text();
    let data = null;
    if (contentType.includes('application/json') || contentType.includes('text/json')) {
        try {
            data = JSON.parse(text);
        } catch (e) {
            data = text;
        }
    } else {
        data = text;
    }
    if (!res.ok) {
        let msg = typeof data === 'object' && data !== null
            ? (data.message || data.error || JSON.stringify(data))
            : data || `HTTP ${res.status}`;
        if (typeof msg === 'string' && /<!doctype|<html|<body|<_doc|<_Doc/i.test(msg)) {
            msg = `Error interno del servidor (${res.status})`;
        }
        throw new Error(msg);
    }
    return data;
}

function fmtEur(n) {
    n = parseFloat(n) || 0;
    if (Math.abs(n) >= 1000) return '€' + (n / 1000).toFixed(1) + 'k';
    return '€' + n.toFixed(0);
}

// Estado en memoria para el panel de reparaciones (los coches vienen de la API)
let cochesRep = [];
let coches2   = [];
let piezas    = [];
let usuarios  = [];
let proveedores = [];
let mecanicos = []; // lista de mecánicos en memoria

// ============================================================
// CONFIGURACIÓN DE PANELES
// ============================================================
const panelTitles = {
    gestion   : 'Gestión · Estadísticas del taller',
    usuarios  : 'Usuarios · Gestión de cuentas',
    reparacion: 'Reparación · Vehículos en taller',
    vehiculos2: 'Vehículos de 2ª mano',
    piezas    : 'Piezas y recambios',
};

function showPanel(id) {
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    const panel = document.getElementById('panel-' + id);
    if (panel) panel.classList.add('active');

    const title = document.getElementById('panel-title');
    if (title) { title.textContent = panelTitles[id] || id; title.style.color = 'black'; }

    const ta = document.getElementById('topbarActions');
    const acts = {
        usuarios  : `<button class="btn btn-primary btn-sm" onclick="showModal('nuevo-usuario')">+ Nuevo usuario</button>`,
        vehiculos2: `<button class="btn btn-primary btn-sm" onclick="showModal('agregar-veh')">+ Agregar vehículo</button>`,
        piezas    : `<button class="btn btn-primary btn-sm" onclick="showModal('nueva-pieza')">+ Nueva pieza</button>`,
    };
    if (ta) ta.innerHTML = acts[id] || '';
}

// ============================================================
// CHARTS
// ============================================================
function renderLineChart(svgId, data, labels, color) {
    const svg = document.getElementById(svgId);
    if (!svg || !data?.length || !labels?.length) return;
    const vb = svg.viewBox.baseVal;
    const W = vb.width, H = vb.height;
    const P = { t: 16, r: 14, b: 30, l: 34 };
    const cW = W - P.l - P.r, cH = H - P.t - P.b;
    const count = Math.min(data.length, labels.length);
    if (count === 0) { svg.innerHTML = ''; return; }

    const maxV = Math.max(...data.slice(0, count), 1);
    const axisMax = Math.ceil(maxV * 1.1);
    const step = axisMax / 4;

    let h = '';
    [0, 1, 2, 3, 4].forEach(i => {
        const f = i / 4;
        const y = P.t + cH * (1 - f);
        const value = Math.round(step * i);
        const label = axisMax >= 1000 ? `${Math.round(value / 1000)}k` : value;
        h += `<line x1="${P.l}" y1="${y.toFixed(1)}" x2="${W - P.r}" y2="${y.toFixed(1)}" stroke="#1a3050" stroke-width="1"/>`;
        h += `<text x="${P.l - 6}" y="${(y + 4).toFixed(1)}" text-anchor="end" font-size="9" fill="#4a6e9a">${label}</text>`;
    });

    const points = [];
    for (let i = 0; i < count; i++) {
        const value = Number(data[i]) || 0;
        const x = P.l + (count === 1 ? cW / 2 : (cW * i) / (count - 1));
        const y = P.t + cH * (1 - (value / axisMax));
        points.push({ x, y, value });
    }

    const path = points.map((pt, idx) => `${idx === 0 ? 'M' : 'L'}${pt.x.toFixed(1)} ${pt.y.toFixed(1)}`).join(' ');
    const area = `${path} L ${points[count - 1].x.toFixed(1)} ${P.t + cH} L ${points[0].x.toFixed(1)} ${P.t + cH} Z`;
    h += `<path d="${area}" fill="${color}" opacity="0.12"/>`;
    h += `<path d="${path}" fill="none" stroke="${color}" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"/>`;

    points.forEach(pt => {
        h += `<circle cx="${pt.x.toFixed(1)}" cy="${pt.y.toFixed(1)}" r="3.5" fill="${color}" stroke="#0f172a" stroke-width="1.5"/>`;
    });

    points.forEach((pt, i) => {
        h += `<text x="${pt.x.toFixed(1)}" y="${H - P.b + 16}" text-anchor="middle" font-size="9" fill="#4a6e9a">${labels[i]}</text>`;
    });

    svg.innerHTML = h;
}

function switchChart(group, periodo, btn) {
    btn.closest('.card').querySelectorAll('.chart-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    btn.closest('.card').querySelectorAll('.chart-section').forEach(s => s.classList.remove('active'));
    document.getElementById(group + '-' + periodo).classList.add('active');
}

// ============================================================
// PANEL GESTIÓN — Dashboard desde API
// ============================================================
async function loadDashboard() {
    try {
        const res = await apiFetch('/dashboard/metricas');
        if (res.status !== 'success') return;

        const t = res.tarjetas;
        const g = res.graficas;

        document.getElementById('kpi-facturado').textContent  = t.facturado_anio.valor_formateado;
        document.getElementById('kpi-gastos').textContent     = t.gastos_anio.valor_formateado;
        document.getElementById('kpi-gastos-sub').textContent = t.gastos_anio.porcentaje_de_ingresos + ' de ingresos';
        document.getElementById('kpi-coches-anio').textContent= t.coches_atendidos.total;
        document.getElementById('kpi-margen').textContent     = t.margen_bruto.valor_formateado;

        const Y = g.etiquetas_anios || [];
        const M = g.etiquetas_meses;

        renderLineChart('chart-gastos-anual', g.gastos_por_anio || [], Y, '#2878f0');
        renderLineChart('chart-coches-anual', g.coches_por_anio || [], Y, '#22c55e');
        renderLineChart('chart-gastos-mensual', g.gastos_por_mes || [], M, '#2878f0');
        renderLineChart('chart-coches-mensual', g.coches_por_mes || [], M, '#22c55e');

    } catch (e) {
        console.error('Dashboard error:', e);
    }
}

// ============================================================
// USUARIOS
// ============================================================
const roleClass = { 'admin': 'role-admin', 'administrador': 'role-admin', 'mecanico': 'role-mec', 'cliente': 'role-cli' };

async function loadUsuarios() {
    try {
        const res = await apiFetch('/usuario');
        usuarios = res.data || [];
        renderUsuarios();

        const mres = await apiFetch('/usuarios/metricas/roles');
        if (mres.status === 'success') {
            const d = mres.data;
            document.getElementById('kpi-usuarios-total').textContent = d.total_usuarios;
            document.getElementById('kpi-clientes').textContent       = d.total_clientes;
            document.getElementById('kpi-mecanicos').textContent      = d.total_mecanicos;
            document.getElementById('kpi-admins').textContent         = d.total_administradores;
        }
    } catch (e) { console.error('loadUsuarios:', e); }
}

function renderUsuarios() {
    const tb = document.getElementById('usuariosBody');
    if (!tb) return;
    if (!usuarios.length) {
        tb.innerHTML = '<tr><td colspan="6" style="text-align:center;color:#4a6e9a;padding:20px">Sin usuarios</td></tr>';
        return;
    }
    tb.innerHTML = usuarios.map(u => `
        <tr>
            <td style="color:#4a6e9a;font-size:11px">${u.dni ?? '—'}</td>
            <td style="font-weight:600;color:#deeeff">${u.nombre}</td>
            <td>${u.email}</td>
            <td>${u.telefono ?? '—'}</td>
            <td><span class="role-badge ${roleClass[u.rol] || 'role-cli'}">${u.rol === 'admin' || u.rol === 'administrador' ? 'Administrador' : u.rol}</span></td>
            <td><div style="display:flex;gap:6px">
                <button class="btn btn-sm" onclick="editUsuario(${u.id_usuario ?? u.id})">✏️ Editar</button>
                <button class="btn btn-sm btn-danger" onclick="confirmDeleteUsuario(${u.id_usuario ?? u.id})">✕</button>
            </div></td>
        </tr>`).join('');
}

function editUsuario(id) {
    const u = usuarios.find(x => (x.id_usuario ?? x.id) == id);
    if (!u) return;
    document.getElementById('modal-title').textContent = 'Editar — ' + u.nombre;
    document.getElementById('modal-body').innerHTML = `
        <div class="mfg">
            <div><label class="mlabel">Nombre</label><input class="minput" id="eu-n" value="${u.nombre}"></div>
            <div><label class="mlabel">Teléfono</label><input class="minput" id="eu-t" value="${u.telefono ?? ''}"></div>
            <div class="mfg-full"><label class="mlabel">Email</label><input class="minput" id="eu-e" value="${u.email}"></div>
            <div><label class="mlabel">Rol</label>
                <select class="minput" id="eu-r">
                    <option ${u.rol === 'admin' || u.rol === 'administrador' ? 'selected' : ''} value="admin">Administrador</option>
                    <option ${u.rol === 'mecanico'      ? 'selected' : ''} value="mecanico">Mecánico</option>
                    <option ${u.rol === 'cliente'       ? 'selected' : ''} value="cliente">Cliente</option>
                </select>
            </div>
            <div><label class="mlabel">Nueva contraseña (vacío = sin cambio)</label><input class="minput" type="password" id="eu-p" placeholder="••••••••"></div>
        </div>`;
    const btn = document.getElementById('modal-confirm');
    btn.textContent = 'Guardar cambios';
    btn.onclick = async () => {
        const body = {
            nombre   : document.getElementById('eu-n').value,
            telefono : document.getElementById('eu-t').value,
            email    : document.getElementById('eu-e').value,
            rol      : document.getElementById('eu-r').value,
        };
        const pwd = document.getElementById('eu-p').value;
        if (pwd) body.contraseña = pwd;
        try {
            await apiFetch(`/usuarios/${id}`, { method: 'PUT', body: JSON.stringify(body) });
            await loadUsuarios();
            hideModal();
        } catch(e) { alert('Error al guardar: ' + e.message); }
        btn.textContent = 'Confirmar';
    };
    openModal();
}

function confirmDeleteUsuario(id) {
    const u = usuarios.find(x => (x.id_usuario ?? x.id) == id);
    document.getElementById('modal-title').textContent = 'Eliminar usuario';
    document.getElementById('modal-body').innerHTML = `<p style="color:#b5cfe8;font-size:14px;margin:4px 0">¿Eliminar a <strong style="color:#deeeff">${u.nombre}</strong>?<br>Esta acción no se puede deshacer.</p>`;
    const btn = document.getElementById('modal-confirm');
    btn.className = 'btn btn-danger';
    btn.textContent = 'Eliminar';
    btn.onclick = async () => {
        try {
            await apiFetch(`/usuarios/${id}`, { method: 'DELETE' });
            await loadUsuarios();
            hideModal();
        } catch(e) { alert('Error al eliminar: ' + e.message); }
        btn.className = 'btn btn-primary';
        btn.textContent = 'Confirmar';
    };
    openModal();
}

// ============================================================
// PANEL REPARACIONES
// ============================================================
const estadoLabels = {
    en_reparacion  : { label: '🔧 En reparación',    cls: 's-reparando' },
    pendiente_pago : { label: '💳 Pend. pago',        cls: 's-pago'      },
    esperando_piezas:{ label: '📦 Esp. piezas',      cls: 's-piezas'    },
    en_revision    : { label: '🔍 En revisión',       cls: 's-asignado'  },
    diagnostico    : { label: '🖥 Diagnóstico',       cls: 's-nueva'     },
    prueba_carretera:{ label: '🛣 Prueba carretera',  cls: 's-prueba'    },
    finalizada     : { label: '✅ Finalizada',         cls: 's-pago'      },
    pendiente      : { label: '⏳ Pendiente',          cls: 's-nueva'     },
};

function normalizeEstado(raw) {
    if (!raw) return 'pendiente';
    raw = String(raw).toLowerCase().trim();
    if (raw === 'en proceso' || raw === 'en_proceso' || raw === 'enproceso') return 'en_reparacion';
    if (raw === 'finalizado' || raw === 'finalizada') return 'finalizada';
    if (raw === 'pendiente') return 'pendiente';
    if (raw.includes('pago')) return 'pendiente_pago';
    return raw.replace(/\s+/g,'_');
}

async function loadMecanicos() {
    try {
        const res = await apiFetch('/mecanicos');
        mecanicos = res.data || [];
    } catch(e) {
        console.warn('No se pudieron cargar mecánicos:', e);
        mecanicos = [];
    }
}

async function loadReparaciones() {
    try {
        const gRes = await apiFetch('/admin/coches/garaje');
        cochesRep = gRes.data || [];
        document.getElementById('kpi-veh-garaje').textContent = gRes.count ?? cochesRep.length;

        const pRes = await apiFetch('/admin/coches/para-pagar');
        document.getElementById('kpi-pend-pago').textContent = pRes.count ?? 0;

        const rRes = await apiFetch('/admin/reparaciones/en-proceso/count');
        document.getElementById('kpi-en-reparacion').textContent = rRes.count ?? 0;

        renderVehiculosRep();
        loadSolicitudes();
    } catch (e) { console.error('loadReparaciones:', e); }
}

async function loadSolicitudes() {
    try {
        const adminId = {{ auth()->id() ?? 1 }};
        const res = await apiFetch(`/admin/mensajes/recibidos/${adminId}`);
        const mensajes = (res.data || []).filter(m => !m.leido);
        document.getElementById('kpi-sol-pend').textContent = mensajes.length;
        renderSolicitudes(mensajes);
    } catch (e) {
        console.error('loadSolicitudes:', e);
        document.getElementById('kpi-sol-pend').textContent = '0';
        document.getElementById('solicitudesList').innerHTML = '<p style="color:#4a6e9a;font-size:13px;padding:10px 0">Sin solicitudes.</p>';
    }
}

function renderSolicitudes(mensajes) {
    const el = document.getElementById('solicitudesList');
    if (!el) return;
    if (!mensajes.length) {
        el.innerHTML = '<p style="color:#4a6e9a;font-size:13px;padding:10px 0">✓ Sin solicitudes pendientes.</p>';
        return;
    }
    el.innerHTML = mensajes.map(m => `
        <div class="sol-card" id="sc-${m.id_mensaje ?? m.id}">
            <span class="sol-id">#${m.id_mensaje ?? m.id}</span>
            <div class="sol-info">
                <strong>${m.asunto ?? 'Sin asunto'}</strong>
                <span>Matrícula: ${m.matricula ?? '—'}</span>
                <div class="sol-desc">${m.mensaje ?? ''}</div>
            </div>
            <div class="sol-actions">
                <button class="btn btn-sm btn-success" onclick="aprobarSolicitud(${m.id_mensaje ?? m.id})">✅ Aprobar</button>
                <button class="btn btn-sm btn-danger" onclick="eliminarMensaje(${m.id_mensaje ?? m.id})">✕ Eliminar</button>
            </div>
        </div>`).join('');
}

async function aprobarSolicitud(id) {
    try {
        const adminId = {{ auth()->id() ?? 1 }};
        const res = await apiFetch(`/admin/mensajes/recibidos/${adminId}`);
        const mensajes = (res.data || []).filter(m => !m.leido);
        const mensaje = mensajes.find(m => (m.id_mensaje ?? m.id) == id);
        if (!mensaje) {
            return alert('No se ha encontrado la solicitud para aprobar.');
        }

        const matricula = (mensaje.matricula || '').trim();
        if (!matricula) {
            return alert('La solicitud no tiene matrícula válida.');
        }

        let cocheRes;
        try {
            cocheRes = await apiFetch(`/coches/matricula/${encodeURIComponent(matricula)}`);
        } catch (err) {
            console.error('Error al buscar coche por matrícula:', err);
            return alert('No se ha encontrado el coche con matrícula ' + matricula + '.');
        }

        const id_coche = cocheRes.id_coche;
        if (!id_coche) {
            return alert('No se ha encontrado el coche con matrícula ' + matricula + '.');
        }

        console.log('Creando reparación con:', { id_coche, motivo: mensaje.mensaje || 'Sin asunto' });

        let crear;
        try {
            crear = await apiFetch('/admin/reparaciones', {
                method: 'POST',
                body: JSON.stringify({
                    id_coche: parseInt(id_coche),
                    motivo: (mensaje.mensaje || 'Sin asunto').toString()
                })
            });
        } catch (err) {
            console.error('Error al crear reparación:', err);
            const errorMsg = err.message || 'Error desconocido';
            return alert('No se pudo crear la reparación: ' + errorMsg);
        }

        if (crear.status !== 'success') {
            console.error('Respuesta de error del servidor:', crear);
            return alert('No se pudo crear la reparación: ' + (crear.message || 'Error desconocido'));
        }

        await eliminarMensaje(id);
        alert('Solicitud aprobada y reparación creada correctamente.');
        loadReparaciones();
    } catch (e) {
        console.error('aprobarSolicitud:', e);
        alert('Error al aprobar la solicitud: ' + (e.message || 'Error desconocido'));
    }
}

async function eliminarMensaje(id) {
    try {
        await apiFetch(`/admin/mensaje/${id}`, { method: 'DELETE' });
        loadSolicitudes();
    } catch(e) { alert('Error al eliminar mensaje: ' + e.message); }
}

async function renderVehiculosRep() {
    const el = document.getElementById('vehiculosReparGrid');
    if (!el) return;
    if (!cochesRep.length) {
        el.innerHTML = '<p style="color:#4a6e9a;font-size:13px;padding:10px 0">No hay vehículos en el taller.</p>';
        return;
    }

    const cards = [];
    for (const c of cochesRep) {
        const idCoche = c.id_coche ?? c.id;
        // Pedimos estado real al endpoint de la API (param 'buscar')
        let estadoKey = c.estado ?? c.ultima_reparacion?.estado ?? 'pendiente';
        try {
            const parametro = c.matricula ?? idCoche;
            const estRes = await apiFetch(`/reparacion/estado?buscar=${encodeURIComponent(parametro)}`);
            if (estRes && estRes.reparacion?.estado) {
                estadoKey = normalizeEstado(estRes.reparacion.estado);
            } else if (estRes && estRes.estado) {
                estadoKey = normalizeEstado(estRes.estado);
            }
        } catch (err) {
            console.warn('No se pudo obtener estado remoto para', c.matricula || idCoche, err);
        }

        const est = estadoLabels[estadoKey] ?? { label: estadoKey, cls: 's-nueva' };
        let imgSrc = null;
        if (c.imagen) {
            const raw = String(c.imagen).trim();
            if (/^https?:\/\//i.test(raw)) {
                // usar proxy interno para evitar problemas CORS/headers
                imgSrc = `/api/image/proxy?url=${encodeURIComponent(raw)}`;
            } else {
                imgSrc = `/storage/${raw}`;
            }
        }

        // tarjeta simple; la interacción (selector/cobrar) se maneja en el modal
        const card = `<div class="veh-card" data-id="${idCoche}" onclick="openVehRepModal(${idCoche})">
            ${imgSrc ? `<img src="${imgSrc}" class="veh-img" alt="${c.marca} ${c.modelo}" style="width:120px;height:72px;object-fit:cover;border-radius:6px;display:block" loading="lazy" onerror="this.onerror=null;this.src='${PLACEHOLDER_SVG}'">` : ''}
             <div class="veh-img-ph" style="${imgSrc ? 'display:none;width:120px;height:72px;align-items:center;justify-content:center;background:#e6eefb;border-radius:6px' : 'display:flex;width:120px;height:72px;align-items:center;justify-content:center;background:#e6eefb;border-radius:6px'}">🚗</div>
             <div class="veh-info">
                <div class="veh-matricula">${c.matricula}</div>
                <div class="veh-modelo">${c.marca} ${c.modelo}</div>
                <div style="font-size:11px;color:#4a6e9a;margin-top:2px">${c.ultima_reparacion?.motivo ?? '—'}</div>
                <span class="status-pill ${est.cls}">${est.label}</span>
            </div>
        </div>`;
        cards.push(card);
    }

    el.innerHTML = cards.join('');
}

// Asegurar que exista función para cerrar el modal
function closeVehModal() {
    document.getElementById('vehModal').classList.remove('open');
}

async function openVehRepModal(id) {
    try {
        const res = await apiFetch(`/coches/${id}/detalle`);
        const c = res.data;

        // obtener estado desde la API de estado (buscar por matrícula o id)
        let estadoKey = c.ultima_reparacion?.estado ?? 'pendiente';
        try {
            const parametro = c.matricula ?? id;
            const estRes = await apiFetch(`/reparacion/estado?buscar=${encodeURIComponent(parametro)}`);
            if (estRes && estRes.reparacion?.estado) {
                estadoKey = normalizeEstado(estRes.reparacion.estado);
            } else if (estRes && estRes.estado) {
                estadoKey = normalizeEstado(estRes.estado);
            }
        } catch (err) {
            console.warn('No se pudo obtener estado remoto para modal', err);
        }

        const est = estadoLabels[estadoKey] ?? { label: estadoKey, cls: 's-nueva' };
        const cliente = c.usuario?.nombre ?? `Cliente #${c.id_usuario}`;
        let imgSrc  = null;
        if (c.imagen) {
            const raw = String(c.imagen).trim();
            imgSrc = /^https?:\/\//i.test(raw) ? `/api/image/proxy?url=${encodeURIComponent(raw)}` : `/storage/${raw}`;
        }

        // almacenar id del coche en el modal para futuras acciones
        document.getElementById('vehModal').dataset.cocheId = c.id_coche ?? c.id;

        // determinar nombre del mecánico asignado si existe
        let mecanicoNombre = 'Sin mecánico';
        if (c.ultima_reparacion?.mecanico?.nombre) {
            mecanicoNombre = c.ultima_reparacion.mecanico.nombre;
        } else if (c.ultima_reparacion?.id_mecanico) {
            // intentar buscar en la lista de mecanicos cargada
            const found = mecanicos.find(m => (m.id_usuario ?? m.id) == c.ultima_reparacion.id_mecanico);
            if (found) mecanicoNombre = found.nombre;
        }

        document.getElementById('veh-modal-title').textContent = `${c.matricula} · ${c.marca} ${c.modelo}`;

        // construir select de mecánicos (incluye carga si está vacío)
        if (!mecanicos.length) await loadMecanicos();
        const options = mecanicos.length ? mecanicos.map(m => `<option value="${m.id_usuario ?? m.id}">${m.nombre}</option>`).join('') : '<option value="">Sin mecánicos</option>';
        const selId = `modal-mec-${id}`;

        // botones según estado
        let accionesHtml = '';
        if (estadoKey === 'pendiente' || estadoKey === 'en_reparacion') {
            accionesHtml = `<div style="display:flex;gap:8px;align-items:center">
                <select id="${selId}" class="minput" style="min-width:200px">${options}</select>
                <button class="btn btn-primary" onclick="asignarMecanicoApi(${c.ultima_reparacion?.id_reparacion ?? c.ultima_reparacion?.id ?? id}, document.getElementById('${selId}').value)">Asignar mecánico</button>
            </div>`;
        } else if (estadoKey === 'finalizada') {
            accionesHtml = `<button class="btn btn-success" onclick="cobrarReparacionApi(${c.ultima_reparacion?.id_reparacion ?? c.ultima_reparacion?.id ?? id})">Cobrar y sacar del garaje</button>`;
        }

        document.getElementById('veh-modal-body').innerHTML = `
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div>
                ${imgSrc
                    ? `<img src="${imgSrc}" style="width:100%;border-radius:8px;height:180px;object-fit:cover" alt="" loading="lazy" onerror="this.onerror=null;this.src='${PLACEHOLDER_SVG}'">`
                    : '<div style="height:180px;background:#0a1826;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:48px">🚗</div>'}
            </div>
            <div style="display:flex;flex-direction:column;gap:9px;font-size:13px">
                <div><span style="color:#4a6e9a">Matrícula:</span><strong style="color:#deeeff;margin-left:6px">${c.matricula}</strong></div>
                <div><span style="color:#4a6e9a">Vehículo:</span><strong style="color:#deeeff;margin-left:6px">${c.marca} ${c.modelo}</strong></div>
                <div><span style="color:#4a6e9a">Cliente:</span><strong style="color:#deeeff;margin-left:6px">${cliente}</strong></div>
                <div><span style="color:#4a6e9a">Motivo:</span><strong style="color:#deeeff;margin-left:6px">${c.ultima_reparacion?.motivo ?? '—'}</strong></div>
                <div><span style="color:#4a6e9a">Estado:</span><span class="status-pill ${est.cls}" style="margin-left:6px" id="modal-status-pill">${est.label}</span></div>
                <div><span style="color:#4a6e9a">Mecánico:</span><strong style="color:#deeeff;margin-left:6px" id="modal-mecanico">${mecanicoNombre}</strong></div>
                <div><span style="color:#4a6e9a">En garaje:</span><strong style="color:#deeeff;margin-left:6px" id="modal-en-garaje">${c.en_garaje ? 'Sí' : 'No'}</strong></div>
                <div style="margin-top:8px">${accionesHtml}</div>
            </div>
        </div>
        <div style="display:flex;gap:8px;justify-content:flex-end">
            <button class="btn btn-sm" onclick="closeVehModal()">Cerrar</button>
        </div>`;

        // actualizar badge en la tarjeta correspondiente para mantener consistencia visual
        const card = document.querySelector(`.veh-card[data-id="${c.id_coche ?? c.id}"]`);
        if (card) {
            const pill = card.querySelector('.status-pill');
            if (pill) {
                pill.textContent = est.label;
                pill.className = 'status-pill ' + est.cls;
            }
            // también mostrar nombre mecánico en tarjeta si existe
            const existingMech = card.querySelector('.veh-mecanico');
            if (existingMech) existingMech.textContent = mecanicoNombre;
            else if (mecanicoNombre && mecanicoNombre !== 'Sin mecánico') {
                const mechHtml = `<div class="veh-mecanico" style="font-size:11px;color:#b5cfe8;margin-top:6px">Mecánico: <strong style="color:#deeeff">${mecanicoNombre}</strong></div>`;
                const info = card.querySelector('.veh-info');
                if (info) info.insertAdjacentHTML('beforeend', mechHtml);
            }
        }

        document.getElementById('vehModal').classList.add('open');
    } catch(e) { alert('No se pudo cargar el detalle: ' + e.message); }
}

async function asignarMecanicoApi(id_reparacion, id_mecanico) {
    if (!id_mecanico) return alert('Selecciona un mecánico.');
    try {
        const body = { id_reparacion: parseInt(id_reparacion), id_mecanico: parseInt(id_mecanico) };
        const res = await apiFetch('/reparacion/asignar-mecanico', { method: 'POST', body: JSON.stringify(body) });
        if (res.status === 'success') {
            alert('Mecánico asignado correctamente.');
            await loadReparaciones();
            // refrescar modal para mostrar nuevo estado: obtener id_coche del modal dataset
            const cocheId = document.getElementById('vehModal').dataset.cocheId;
            if (cocheId) await openVehRepModal(cocheId);
        } else {
            alert('Error: ' + (res.message || 'Respuesta inesperada'));
        }
    } catch (e) { alert('Error al asignar mecánico: ' + e.message); }
}

// ============================================================
// VEHÍCULOS 2ª MANO
// ============================================================
async function loadVehiculos2() {
    try {
        const res = await apiFetch('/coche2mano');
        coches2 = res.data || [];
        renderVehiculos2();
    } catch(e) { console.error('loadVehiculos2:', e); }
}

function renderVehiculos2() {
    const el = document.getElementById('vehiculos2Grid');
    if (!el) return;

    const total   = coches2.reduce((a, c) => a + parseFloat(c.precio || 0), 0);
    const media   = coches2.length ? Math.round(total / coches2.length) : 0;
    const kmTotal = coches2.reduce((a, c) => a + (parseInt(c.km || 0) || 0), 0);
    const kmMedia = coches2.length ? Math.round(kmTotal / coches2.length) : 0;

    document.getElementById('kpi-total-2mano').textContent = coches2.length;
    document.getElementById('kpi-valor-stock').textContent = '€' + total.toLocaleString('es-ES');
    document.getElementById('kpi-precio-med').textContent  = coches2.length ? '€' + media.toLocaleString('es-ES') : '—';
    document.getElementById('kpi-km-med').textContent      = coches2.length ? kmMedia.toLocaleString('es-ES') + ' km' : '—';

    if (!coches2.length) {
        el.innerHTML = '<p style="color:#4a6e9a;font-size:13px;padding:10px 0">Sin vehículos en catálogo.</p>';
        return;
    }

    el.innerHTML = coches2.map(c => {
        const imgSrc  = c.imagen ? (c.imagen.startsWith('http') ? c.imagen : `/storage/${c.imagen}`) : null;
        const enVenta = c.en_venta == 1 || c.en_venta === true;
        const extras  = [c.especificaciones, c.km ? c.km + ' km' : null].filter(Boolean).join(' · ');
        return `<div class="veh-card" onclick="openVeh2Modal(${c.id ?? c.id_coche2mano})">
            ${imgSrc ? `<img src="${imgSrc}" class="veh-img" alt="${c.marca} ${c.modelo}" style="width:120px;height:72px;object-fit:cover;border-radius:6px;display:block" loading="lazy" onerror="this.onerror=null;this.src='${PLACEHOLDER_SVG}'">` : ''}
            <div class="veh-img-ph" style="${imgSrc ? 'display:none;width:120px;height:72px;align-items:center;justify-content:center;background:#f7f7fb;border-radius:6px' : 'display:flex;width:120px;height:72px;align-items:center;justify-content:center;background:#f7f7fb;border-radius:6px'}">🚘</div>
             <div class="veh-info">
                <div class="veh-matricula">${c.matricula}</div>
                <div class="veh-modelo">${c.marca} ${c.modelo}</div>
                <div class="veh-precio">€${parseFloat(c.precio).toLocaleString('es-ES')}</div>
                <div style="font-size:10px;color:#4a6e9a;margin-top:2px">${extras || 'Sin detalles'}</div>
            </div>
            <div class="veh-actions" onclick="event.stopPropagation()">
                <button class="btn btn-sm btn-danger" onclick="retirarVeh(${c.id ?? c.id_coche2mano})">📤 Retirar</button>
                <button class="btn btn-sm btn-success" onclick="venderVeh(${c.id ?? c.id_coche2mano})">💰 Vender</button>
            </div>
        </div>`;
    }).join('');
}

function openVeh2Modal(id) {
    const c = coches2.find(x => (x.id ?? x.id_coche2mano) == id);
    if (!c) return;
    const imgSrc  = c.imagen ? (c.imagen.startsWith('http') ? c.imagen : `/storage/${c.imagen}`) : null;
    const enVenta = c.en_venta == 1 || c.en_venta === true;

    const extraInfo = [c.especificaciones, c.km ? c.km + ' km' : null].filter(Boolean).join(' · ');
    document.getElementById('veh-modal-title').textContent = `${c.matricula} · ${c.marca} ${c.modelo}`;
    document.getElementById('veh-modal-body').innerHTML = `
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div>
                ${imgSrc
                    ? `<img src="${imgSrc}" style="width:100%;border-radius:8px;height:180px;object-fit:cover" alt="" loading="lazy" onerror="this.onerror=null;this.src='${PLACEHOLDER_SVG}'">`
                    : '<div style="height:180px;background:#0a1826;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:48px">🚘</div>'}
            </div>
            <div style="display:flex;flex-direction:column;gap:9px;font-size:13px">
                <div><span style="color:#4a6e9a">Matrícula:</span><strong style="color:#deeeff;margin-left:6px">${c.matricula}</strong></div>
                <div><span style="color:#4a6e9a">Vehículo:</span><strong style="color:#deeeff;margin-left:6px">${c.marca} ${c.modelo}</strong></div>
                <div><span style="color:#4a6e9a">Precio:</span><strong style="color:#2878f0;font-size:18px;margin-left:6px">€${parseFloat(c.precio).toLocaleString('es-ES')}</strong></div>
                <div style="color:#4a6e9a;font-size:12px;margin-top:2px">${extraInfo || 'Sin detalles'}</div>
                <span class="${enVenta ? 'veh-libre' : 'veh-garaje'} veh-status">${enVenta ? '● En venta' : '● No en venta'}</span>
            </div>
        </div>
        <div style="display:flex;gap:8px;justify-content:flex-end">
            <button class="btn btn-sm" onclick="closeVehModal()">Cerrar</button>
            <button class="btn btn-sm btn-danger" onclick="retirarVeh(${c.id ?? c.id_coche2mano});closeVehModal()">📤 Retirar</button>
            <button class="btn success btn-sm" onclick="venderVeh(${c.id ?? c.id_coche2mano});closeVehModal()">💰 Vender</button>
        </div>`;
    document.getElementById('vehModal').classList.add('open');
}

async function retirarVeh(id) {
    if (!confirm('¿Retirar este vehículo del taller? Se eliminará del catálogo.')) return;
    try {
        await apiFetch(`/coches-segunda-mano/${id}/retirar`, { method: 'DELETE' });
        await loadVehiculos2();
    } catch(e) { alert('Error al retirar: ' + e.message); }
}

function venderVeh(id) {
    const c = coches2.find(x => (x.id ?? x.id_coche2mano) == id);
    if (!c) return;
    document.getElementById('modal-title').textContent = 'Registrar venta';
    document.getElementById('modal-body').innerHTML = `
        <p style="color:#b5cfe8;font-size:14px;margin:4px 0">
            Confirmar venta de <strong style="color:#deeeff">${c.marca} ${c.modelo} (${c.matricula})</strong>
            por <strong style="color:#2878f0">€${parseFloat(c.precio).toLocaleString('es-ES')}</strong>.<br><br>
            El vehículo se retirará del catálogo y el ingreso quedará registrado en contabilidad.
        </p>`;
    const btn = document.getElementById('modal-confirm');
    btn.className = 'btn btn-success';
    btn.textContent = '💰 Confirmar venta';
    btn.onclick = async () => {
        try {
            await apiFetch(`/coches-segunda-mano/${id}/vender`, { method: 'POST', body: JSON.stringify({}) });
            await loadVehiculos2();
            hideModal();
        } catch(e) { alert('Error al registrar venta: ' + e.message); }
        btn.className = 'btn btn-primary';
        btn.textContent = 'Confirmar';
    };
    openModal();
}

// ============================================================
// PIEZAS
// ============================================================
async function loadPiezas() {
    try {
        const [pRes, sinStockRes, bajoRes, provRes] = await Promise.all([
            apiFetch('/piezas'),
            apiFetch('/piezas/sin-stock/total'),
            apiFetch('/piezas/bajo-minimo'),
            apiFetch('/proveedores'),
        ]);
        piezas = pRes.data || [];
        proveedores = provRes.data || [];

        document.getElementById('kpi-piezas-total').textContent = piezas.length;
        document.getElementById('kpi-sin-stock').textContent    = sinStockRes.total_sin_stock ?? 0;
        document.getElementById('kpi-stock-bajo').textContent   = bajoRes.count ?? 0;

        const valorInv = piezas.reduce((a, p) => a + (parseFloat(p.precio_compra) * parseInt(p.cantidad_disponible || 0)), 0);
        document.getElementById('kpi-valor-inv').textContent = '€' + valorInv.toLocaleString('es-ES', { minimumFractionDigits: 0 });

        renderPiezas();
    } catch(e) { console.error('loadPiezas:', e); }
}

function getProveedorNombre(idProveedor) {
    if (!idProveedor) return '—';
    const proveedor = proveedores.find(p => (p.id_proveedor ?? p.id) == idProveedor);
    return proveedor ? proveedor.nombre : `#${idProveedor}`;
}

function renderPiezas() {
    const el = document.getElementById('piezasGrid');
    if (!el) return;
    if (!piezas.length) {
        el.innerHTML = '<p style="color:#4a6e9a;font-size:13px;padding:10px 0">Sin piezas en catálogo.</p>';
        return;
    }
    el.innerHTML = piezas.map(p => {
        const stock = parseInt(p.cantidad_disponible ?? 0);
        const smin  = parseInt(p.stock_minimo ?? 0);
        const pc    = parseFloat(p.precio_compra ?? 0);
        const pv    = parseFloat(p.precio_venta  ?? 0);
        const pid   = p.id_pieza ?? p.id;
        const stockHtml = stock === 0
            ? `<span class="stock-out">✕ Sin stock</span>`
            : stock <= smin
            ? `<span class="stock-low">⚠ Stock bajo (${stock} ud.)</span>`
            : `<span class="stock-ok">✓ En stock (${stock} ud.)</span>`;
        const proveedorNombre = getProveedorNombre(p.id_proveedor);
        return `<div class="pieza-card">
            <div class="pieza-nombre">${p.nombre_pieza}</div>
            <div class="pieza-meta">
                ${stockHtml}
                <span>Mínimo: <strong>${smin} ud.</strong></span>
                <span>P. Compra: <strong>€${pc.toFixed(2)}</strong></span>
                <span>Proveedor: <strong>${proveedorNombre}</strong></span>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:8px;border-top:1px solid #1a3050">
                <span class="pieza-pvp">€${pv.toFixed(2)}</span>
                <button class="btn btn-primary btn-sm" onclick="comprarPieza(${pid})">🛒 Comprar</button>
            </div>
        </div>`;
    }).join('');
}

function comprarPieza(id) {
    const p = piezas.find(x => (x.id_pieza ?? x.id) == id);
    if (!p) return;
    const stock = parseInt(p.cantidad_disponible ?? 0);
    const smin  = parseInt(p.stock_minimo ?? 0);
    const pc    = parseFloat(p.precio_compra ?? 0);
    const defaultQty = Math.max(smin - stock + 5, 5);

    document.getElementById('modal-title').textContent = 'Comprar · ' + p.nombre_pieza;
    document.getElementById('modal-body').innerHTML = `
        <div style="font-size:13px;color:#b5cfe8;margin-bottom:14px">
            Stock actual: <strong style="color:#deeeff">${stock} ud.</strong> &nbsp;|&nbsp;
            Mínimo: <strong style="color:#deeeff">${smin} ud.</strong> &nbsp;|&nbsp;
            P. compra: <strong style="color:#deeeff">€${pc.toFixed(2)}</strong>
        </div>
        <div style="display:flex;align-items:center;gap:12px">
            <div style="flex:1"><label class="mlabel">Cantidad a pedir</label>
            <input class="minput" type="number" id="cq" value="${defaultQty}" min="1" style="width:120px"></div>
            <div style="font-size:13px;color:#4a6e9a;padding-top:18px">Total: <span id="cqTotal" style="color:#2878f0;font-weight:700">€${(defaultQty * pc).toFixed(2)}</span></div>
        </div>`;
    document.getElementById('cq').oninput = function() {
        const t = document.getElementById('cqTotal');
        if (t) t.textContent = '€' + ((parseInt(this.value) || 0) * pc).toFixed(2);
    };
    const btn = document.getElementById('modal-confirm');
    btn.textContent = '🛒 Confirmar pedido';
    btn.onclick = async () => {
        const qty = parseInt(document.getElementById('cq').value) || 0;
        if (qty < 1) return;
        try {
            await apiFetch(`/piezas/${id}/comprar`, {
                method: 'POST',
                body: JSON.stringify({ cantidad: qty })
            });
            await loadPiezas();
            hideModal();
        } catch(e) { alert('Error al comprar: ' + e.message); }
        btn.textContent = 'Confirmar';
    };
    openModal();
}

// ============================================================
// MODAL UNIVERSAL
// ============================================================
function showModal(type) {
    if (type === 'nuevo-usuario') {
        document.getElementById('modal-title').textContent = 'Nuevo usuario';
        document.getElementById('modal-body').innerHTML = `
            <div class="mfg">
                <div><label class="mlabel">Nombre completo</label><input class="minput" id="nu-n" placeholder="Ana García"></div>
                <div><label class="mlabel">Teléfono</label><input class="minput" id="nu-t" placeholder="600 000 000"></div>
                <div class="mfg-full"><label class="mlabel">Email</label><input class="minput" id="nu-e" type="email" placeholder="email@ejemplo.com"></div>
                <div><label class="mlabel">DNI</label><input class="minput" id="nu-d" placeholder="12345678A"></div>
                <div><label class="mlabel">Rol</label>
                    <select class="minput" id="nu-r">
                        <option value="cliente">Cliente</option>
                        <option value="mecanico">Mecánico</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <div><label class="mlabel">Contraseña</label><input class="minput" type="password" id="nu-p" placeholder="••••••••"></div>
            </div>`;
        const btn = document.getElementById('modal-confirm');
        btn.textContent = 'Crear usuario';
        btn.onclick = async () => {
            const body = {
                nombre    : document.getElementById('nu-n').value.trim(),
                email     : document.getElementById('nu-e').value.trim(),
                dni       : document.getElementById('nu-d').value.trim(),
                telefono  : document.getElementById('nu-t').value.trim(),
                contraseña: document.getElementById('nu-p').value,
                rol       : document.getElementById('nu-r').value,
            };
            if (!body.nombre || !body.email || !body.dni || !body.contraseña) return;
            try {
                await apiFetch('/usuarios', { method: 'POST', body: JSON.stringify(body) });
                await loadUsuarios();
                hideModal();
            } catch(e) { alert('Error al crear usuario: ' + e.message); }
            btn.textContent = 'Confirmar';
        };

    } else if (type === 'agregar-veh') {
        document.getElementById('modal-title').textContent = 'Agregar vehículo de 2ª mano';
        document.getElementById('modal-body').innerHTML = `
            <div class="mfg">
                <div><label class="mlabel">Matrícula</label><input class="minput" id="av-m" placeholder="1234 ABC"></div>
                <div><label class="mlabel">Precio (€)</label><input class="minput" type="number" id="av-p" placeholder="6500" min="0"></div>
                <div><label class="mlabel">Marca</label><input class="minput" id="av-mk" placeholder="Volkswagen"></div>
                <div><label class="mlabel">Modelo</label><input class="minput" id="av-mo" placeholder="Golf 1.6 TDI"></div>
                <div><label class="mlabel">Año matriculación</label><input class="minput" id="av-a" type="number" placeholder="2018" min="1900" max="2099"></div>
                <div><label class="mlabel">Motorización</label><input class="minput" id="av-t" placeholder="Gasolina 1.6 TDI"></div>
                <div><label class="mlabel">Kilómetros</label><input class="minput" type="number" id="av-km" placeholder="65000" min="0"></div>
                <div><label class="mlabel">URL imagen</label><input class="minput" id="av-i" placeholder="https://..." type="url"></div>
                <div class="mfg-full"><label class="mlabel">Especificaciones</label><input class="minput" id="av-s" placeholder="2018 · Gasolina · Manual · 85 CV"></div>
            </div>`;
        const btn = document.getElementById('modal-confirm');
        btn.textContent = '+ Agregar';
        btn.onclick = async () => {
            const body = {
                matricula        : document.getElementById('av-m').value.trim(),
                precio           : parseFloat(document.getElementById('av-p').value) || 0,
                marca            : document.getElementById('av-mk').value.trim(),
                modelo           : document.getElementById('av-mo').value.trim(),
                anio_matriculacion: parseInt(document.getElementById('av-a').value) || null,
                motorizacion     : document.getElementById('av-t').value.trim(),
                km               : parseInt(document.getElementById('av-km').value) || 0,
                especificaciones : document.getElementById('av-s').value.trim(),
                imagen           : document.getElementById('av-i').value.trim() || null,
            };
            if (!body.matricula || !body.precio || !body.anio_matriculacion || !body.motorizacion) {
                return alert('Rellena matrícula, precio, año de matriculación y motorización.');
            }
            try {
                const res = await apiFetch('/coche2mano/newCoche2mano', { method: 'POST', body: JSON.stringify(body) });
                await loadVehiculos2();
                hideModal();
                alert(res.message || 'Vehículo agregado correctamente.');
            } catch(e) { alert('Error al agregar vehículo: ' + e.message); }
            btn.textContent = 'Confirmar';
        };

    } else if (type === 'nueva-pieza') {
        document.getElementById('modal-title').textContent = 'Nueva pieza';
        document.getElementById('modal-body').innerHTML = `
            <div class="mfg">
                <div class="mfg-full"><label class="mlabel">Nombre de la pieza</label><input class="minput" id="np-n" placeholder="Filtro de aceite"></div>
                <div><label class="mlabel">Stock inicial</label><input class="minput" type="number" id="np-s" placeholder="10" min="0"></div>
                <div><label class="mlabel">Stock mínimo</label><input class="minput" type="number" id="np-sm" placeholder="5" min="1"></div>
                <div><label class="mlabel">Precio compra (€)</label><input class="minput" type="number" id="np-pc" placeholder="15.00" step="0.01"></div>
                <div><label class="mlabel">Precio venta (€)</label><input class="minput" type="number" id="np-pv" placeholder="30.00" step="0.01"></div>
                <div><label class="mlabel">Proveedor</label>
                    <select class="minput" id="np-pr">
                        <option value="">Sin proveedor</option>
                        ${proveedores.map(pr => `<option value="${pr.id_proveedor ?? pr.id}">${pr.nombre}</option>`).join('')}
                    </select>
                </div>
            </div>`;
        const btn = document.getElementById('modal-confirm');
        btn.textContent = '+ Crear pieza';
        btn.onclick = async () => {
            const body = {
                nombre_pieza       : document.getElementById('np-n').value.trim(),
                cantidad_disponible: parseInt(document.getElementById('np-s').value) || 0,
                stock_minimo       : parseInt(document.getElementById('np-sm').value) || 5,
                precio_compra      : parseFloat(document.getElementById('np-pc').value) || 0,
                precio_venta       : parseFloat(document.getElementById('np-pv').value) || 0,
                id_proveedor       : document.getElementById('np-pr').value || null,
            };
            if (!body.nombre_pieza) return;
            try {
                const res = await apiFetch('/piezas', { method: 'POST', body: JSON.stringify(body) });
                await loadPiezas();
                hideModal();
                alert(res.message || 'Pieza creada con éxito.');
            } catch(e) { alert('Error al crear pieza: ' + e.message); }
            btn.textContent = 'Confirmar';
        };
    }
    openModal();
}

function openModal()  { document.getElementById('modalOverlay').classList.add('open'); }
function hideModal()  { document.getElementById('modalOverlay').classList.remove('open'); }

// ============================================================
// INIT — carga todo al arrancar
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    loadDashboard();
    loadUsuarios();
    loadReparaciones();
    loadVehiculos2();
    loadPiezas();
});
</script>
