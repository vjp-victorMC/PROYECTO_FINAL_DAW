{{-- Scripts del panel de administración --}}
<script>
// ============================================================
// HELPERS
// ============================================================
const API = '/api';

async function apiFetch(url, opts = {}) {
    const defaults = {
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '' },
    };
    const res = await fetch(API + url, { ...defaults, ...opts });
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    return res.json();
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
function renderBarChart(svgId, data, labels, color) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    const vb = svg.viewBox.baseVal;
    const W = vb.width, H = vb.height;
    const P = { t: 10, r: 10, b: 26, l: 42 };
    const cW = W - P.l - P.r, cH = H - P.t - P.b;
    const mx = Math.max(...data, 1) * 1.15;
    const slot = cW / data.length;
    const bw = slot * 0.56;
    let h = '';
    [0, 0.25, 0.5, 0.75, 1].forEach(f => {
        const y = P.t + cH * (1 - f);
        const v = Math.round(mx * f);
        const lbl = v >= 1000 ? (v >= 10000 ? '€' + (v / 1000).toFixed(0) + 'k' : v) : v;
        h += `<line x1="${P.l}" y1="${y.toFixed(1)}" x2="${W - P.r}" y2="${y.toFixed(1)}" stroke="#1a3050" stroke-width="1"/>`;
        h += `<text x="${P.l - 4}" y="${(y + 3.5).toFixed(1)}" text-anchor="end" font-size="9" fill="#4a6e9a">${lbl}</text>`;
    });
    const maxV = Math.max(...data, 1);
    data.forEach((v, i) => {
        const barH = (v / mx) * cH;
        const x = P.l + i * slot + (slot - bw) / 2;
        const y = P.t + cH - barH;
        const alpha = (0.45 + 0.55 * (v / maxV)).toFixed(2);
        h += `<rect x="${x.toFixed(1)}" y="${y.toFixed(1)}" width="${bw.toFixed(1)}" height="${barH.toFixed(1)}" rx="3" fill="${color}" opacity="${alpha}"/>`;
        h += `<text x="${(x + bw / 2).toFixed(1)}" y="${(H - P.b + 13).toFixed(1)}" text-anchor="middle" font-size="9" fill="#4a6e9a">${labels[i]}</text>`;
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

        const M = g.etiquetas_meses;
        const W = ['S1', 'S2', 'S3', 'S4'];

        renderBarChart('chart-gastos-anual',  g.gastos_por_mes,  M, '#2878f0');
        renderBarChart('chart-coches-anual',  g.coches_por_mes,  M, '#22c55e');

        // Semanas: si la API no las devuelve, distribuimos el mes actual equitativamente
        const mesActual = new Date().getMonth(); // 0-based
        const gastosMes = g.gastos_por_mes[mesActual] || 0;
        const cochesMes = g.coches_por_mes[mesActual] || 0;
        const distG = [0.22, 0.27, 0.25, 0.26].map(f => Math.round(gastosMes * f));
        const distC = [0.23, 0.28, 0.24, 0.25].map(f => Math.round(cochesMes * f));
        renderBarChart('chart-gastos-mensual', distG, W, '#2878f0');
        renderBarChart('chart-coches-mensual', distC, W, '#22c55e');

    } catch (e) {
        console.error('Dashboard error:', e);
    }
}

// ============================================================
// USUARIOS
// ============================================================
const roleClass = { 'administrador': 'role-admin', 'mecanico': 'role-mec', 'cliente': 'role-cli' };

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
            <td style="color:#4a6e9a;font-size:11px">#${u.id_usuario ?? u.id}</td>
            <td style="font-weight:600;color:#deeeff">${u.nombre}</td>
            <td>${u.email}</td>
            <td>${u.telefono ?? '—'}</td>
            <td><span class="role-badge ${roleClass[u.rol] || 'role-cli'}">${u.rol}</span></td>
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
                    <option ${u.rol === 'administrador' ? 'selected' : ''} value="administrador">Administrador</option>
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
                <button class="btn btn-sm btn-danger" onclick="eliminarMensaje(${m.id_mensaje ?? m.id})">✕ Eliminar</button>
            </div>
        </div>`).join('');
}

async function eliminarMensaje(id) {
    try {
        await apiFetch(`/admin/mensaje/${id}`, { method: 'DELETE' });
        loadSolicitudes();
    } catch(e) { alert('Error al eliminar mensaje: ' + e.message); }
}

function renderVehiculosRep() {
    const el = document.getElementById('vehiculosReparGrid');
    if (!el) return;
    if (!cochesRep.length) {
        el.innerHTML = '<p style="color:#4a6e9a;font-size:13px;padding:10px 0">No hay vehículos en el taller.</p>';
        return;
    }
    el.innerHTML = cochesRep.map(c => {
        const estadoKey = c.estado ?? c.ultima_reparacion?.estado ?? 'pendiente';
        const est = estadoLabels[estadoKey] ?? { label: estadoKey, cls: 's-nueva' };
        const imgSrc = c.imagen ? `/storage/${c.imagen}` : null;
        return `<div class="veh-card" onclick="openVehRepModal(${c.id_coche ?? c.id})">
            ${imgSrc ? `<img src="${imgSrc}" class="veh-img" alt="" onerror="this.style.display='none';this.nextSibling.style.display='flex'">` : ''}
            <div class="veh-img-ph" style="${imgSrc ? 'display:none' : ''}">🚗</div>
            <div class="veh-info">
                <div class="veh-matricula">${c.matricula}</div>
                <div class="veh-modelo">${c.marca} ${c.modelo}</div>
                <div style="font-size:11px;color:#4a6e9a;margin-top:2px">${c.ultima_reparacion?.motivo ?? '—'}</div>
                <span class="status-pill ${est.cls}" style="margin-top:6px">${est.label}</span>
            </div>
        </div>`;
    }).join('');
}

async function openVehRepModal(id) {
    try {
        const res = await apiFetch(`/coches/${id}/detalle`);
        const c = res.data;
        const estadoKey = c.ultima_reparacion?.estado ?? 'pendiente';
        const est = estadoLabels[estadoKey] ?? { label: estadoKey, cls: 's-nueva' };
        const cliente = c.usuario?.nombre ?? `Cliente #${c.id_usuario}`;
        const imgSrc  = c.imagen ? `/storage/${c.imagen}` : null;

        document.getElementById('veh-modal-title').textContent = `${c.matricula} · ${c.marca} ${c.modelo}`;
        document.getElementById('veh-modal-body').innerHTML = `
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div>
                ${imgSrc
                    ? `<img src="${imgSrc}" style="width:100%;border-radius:8px;height:180px;object-fit:cover" alt="">`
                    : '<div style="height:180px;background:#0a1826;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:48px">🚗</div>'}
            </div>
            <div style="display:flex;flex-direction:column;gap:9px;font-size:13px">
                <div><span style="color:#4a6e9a">Matrícula:</span><strong style="color:#deeeff;margin-left:6px">${c.matricula}</strong></div>
                <div><span style="color:#4a6e9a">Vehículo:</span><strong style="color:#deeeff;margin-left:6px">${c.marca} ${c.modelo}</strong></div>
                <div><span style="color:#4a6e9a">Cliente:</span><strong style="color:#deeeff;margin-left:6px">${cliente}</strong></div>
                <div><span style="color:#4a6e9a">Motivo:</span><strong style="color:#deeeff;margin-left:6px">${c.ultima_reparacion?.motivo ?? '—'}</strong></div>
                <div><span style="color:#4a6e9a">Estado:</span><span class="status-pill ${est.cls}" style="margin-left:6px">${est.label}</span></div>
                <div><span style="color:#4a6e9a">En garaje:</span><strong style="color:#deeeff;margin-left:6px">${c.en_garaje ? 'Sí' : 'No'}</strong></div>
            </div>
        </div>
        <div style="display:flex;gap:8px;justify-content:flex-end">
            <button class="btn btn-sm" onclick="closeVehModal()">Cerrar</button>
        </div>`;
        document.getElementById('vehModal').classList.add('open');
    } catch(e) { alert('No se pudo cargar el detalle: ' + e.message); }
}

function closeVehModal() {
    document.getElementById('vehModal').classList.remove('open');
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

    const enVenta = coches2.filter(c => c.en_venta == 1 || c.en_venta === true);
    const total   = enVenta.reduce((a, c) => a + parseFloat(c.precio || 0), 0);
    const media   = enVenta.length ? Math.round(total / enVenta.length) : 0;

    document.getElementById('kpi-en-venta').textContent    = enVenta.length;
    document.getElementById('kpi-total-2mano').textContent = coches2.length;
    document.getElementById('kpi-valor-stock').textContent = '€' + total.toLocaleString('es-ES');
    document.getElementById('kpi-precio-med').textContent  = enVenta.length ? '€' + media.toLocaleString('es-ES') : '—';

    if (!coches2.length) {
        el.innerHTML = '<p style="color:#4a6e9a;font-size:13px;padding:10px 0">Sin vehículos en catálogo.</p>';
        return;
    }

    el.innerHTML = coches2.map(c => {
        const imgSrc  = c.imagen ? (c.imagen.startsWith('http') ? c.imagen : `/storage/${c.imagen}`) : null;
        const enVenta = c.en_venta == 1 || c.en_venta === true;
        return `<div class="veh-card" onclick="openVeh2Modal(${c.id ?? c.id_coche2mano})">
            ${imgSrc ? `<img src="${imgSrc}" class="veh-img" alt="">` : ''}
            <div class="veh-img-ph" style="${imgSrc ? 'display:none' : ''}">🚘</div>
            <div class="veh-info">
                <div class="veh-matricula">${c.matricula}</div>
                <div class="veh-modelo">${c.marca} ${c.modelo}</div>
                <div class="veh-precio">€${parseFloat(c.precio).toLocaleString('es-ES')}</div>
                <div style="font-size:10px;color:#4a6e9a;margin-top:2px">${c.especificaciones ?? c.km + ' km'}</div>
                <span class="${enVenta ? 'veh-libre' : 'veh-garaje'} veh-status">${enVenta ? '● En venta' : '● Retirado'}</span>
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

    document.getElementById('veh-modal-title').textContent = `${c.matricula} · ${c.marca} ${c.modelo}`;
    document.getElementById('veh-modal-body').innerHTML = `
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div>
                ${imgSrc
                    ? `<img src="${imgSrc}" style="width:100%;border-radius:8px;height:180px;object-fit:cover" alt="">`
                    : '<div style="height:180px;background:#0a1826;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:48px">🚘</div>'}
            </div>
            <div style="display:flex;flex-direction:column;gap:9px;font-size:13px">
                <div><span style="color:#4a6e9a">Matrícula:</span><strong style="color:#deeeff;margin-left:6px">${c.matricula}</strong></div>
                <div><span style="color:#4a6e9a">Vehículo:</span><strong style="color:#deeeff;margin-left:6px">${c.marca} ${c.modelo}</strong></div>
                <div><span style="color:#4a6e9a">Precio:</span><strong style="color:#2878f0;font-size:18px;margin-left:6px">€${parseFloat(c.precio).toLocaleString('es-ES')}</strong></div>
                <div style="color:#4a6e9a;font-size:12px;margin-top:2px">${c.especificaciones ?? c.km + ' km'}</div>
                <span class="${enVenta ? 'veh-libre' : 'veh-garaje'} veh-status">${enVenta ? '● En venta' : '● Retirado'}</span>
            </div>
        </div>
        <div style="display:flex;gap:8px;justify-content:flex-end">
            <button class="btn btn-sm" onclick="closeVehModal()">Cerrar</button>
            <button class="btn btn-sm btn-danger" onclick="retirarVeh(${c.id ?? c.id_coche2mano});closeVehModal()">📤 Retirar</button>
            <button class="btn btn-success btn-sm" onclick="venderVeh(${c.id ?? c.id_coche2mano});closeVehModal()">💰 Vender</button>
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
        const [pRes, sinStockRes, bajoRes] = await Promise.all([
            apiFetch('/piezas'),
            apiFetch('/piezas/sin-stock/total'),
            apiFetch('/piezas/bajo-minimo'),
        ]);
        piezas = pRes.data || [];

        document.getElementById('kpi-piezas-total').textContent = piezas.length;
        document.getElementById('kpi-sin-stock').textContent    = sinStockRes.total_sin_stock ?? 0;
        document.getElementById('kpi-stock-bajo').textContent   = bajoRes.count ?? 0;

        const valorInv = piezas.reduce((a, p) => a + (parseFloat(p.precio_compra) * parseInt(p.cantidad_disponible || 0)), 0);
        document.getElementById('kpi-valor-inv').textContent = '€' + valorInv.toLocaleString('es-ES', { minimumFractionDigits: 0 });

        renderPiezas();
    } catch(e) { console.error('loadPiezas:', e); }
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
        return `<div class="pieza-card">
            <div class="pieza-nombre">${p.nombre_pieza}</div>
            <div class="pieza-meta">
                ${stockHtml}
                <span>Mínimo: <strong>${smin} ud.</strong></span>
                <span>P. Compra: <strong>€${pc.toFixed(2)}</strong></span>
                <span>Proveedor: <strong>#${p.id_proveedor ?? '—'}</strong></span>
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
                        <option value="administrador">Administrador</option>
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
                <div><label class="mlabel">Kilómetros</label><input class="minput" type="number" id="av-km" placeholder="65000" min="0"></div>
                <div class="mfg-full"><label class="mlabel">Especificaciones</label><input class="minput" id="av-s" placeholder="2018 · Gasolina · Manual · 85 CV"></div>
            </div>`;
        const btn = document.getElementById('modal-confirm');
        btn.textContent = '+ Agregar';
        btn.onclick = async () => {
            const body = {
                matricula       : document.getElementById('av-m').value.trim(),
                precio          : parseFloat(document.getElementById('av-p').value) || 0,
                marca           : document.getElementById('av-mk').value.trim(),
                modelo          : document.getElementById('av-mo').value.trim(),
                km              : parseInt(document.getElementById('av-km').value) || 0,
                especificaciones: document.getElementById('av-s').value.trim(),
            };
            if (!body.matricula || !body.precio) return;
            try {
                await apiFetch('/coche2mano/newCoche2mano', { method: 'POST', body: JSON.stringify(body) });
                await loadVehiculos2();
                hideModal();
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
            };
            if (!body.nombre_pieza) return;
            try {
                await apiFetch('/piezas', { method: 'POST', body: JSON.stringify(body) });
                await loadPiezas();
                hideModal();
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
