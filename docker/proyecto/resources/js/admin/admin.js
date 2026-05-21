// ============================================================
// DATA MOCK
// ============================================================
const panelTitles = {
    gestion: 'Gestión · Estadísticas del taller',
    usuarios: 'Usuarios · Gestión de cuentas',
    reparacion: 'Reparación · Vehículos en taller',
    vehiculos2: 'Vehículos de 2ª mano',
    piezas: 'Piezas y recambios',
};

// Usuarios
const usuarios = [{
    id: 1,
    nombre: 'Admin Sistema',
    email: 'admin@talleresrc.es',
    tel: '924 000 000',
    rol: 'Administrador',
    fecha: '2023-01-01'
},
{
    id: 27,
    nombre: 'Carlos Martínez',
    email: 'carlos@example.com',
    tel: '600 111 222',
    rol: 'Cliente',
    fecha: '2024-01-15'
},
{
    id: 28,
    nombre: 'María López',
    email: 'maria@example.com',
    tel: '611 222 333',
    rol: 'Cliente',
    fecha: '2024-02-20'
},
{
    id: 29,
    nombre: 'Roberto García',
    email: 'roberto@example.com',
    tel: '622 333 444',
    rol: 'Cliente',
    fecha: '2024-03-10'
},
{
    id: 30,
    nombre: 'Ana Ruiz',
    email: 'ana@example.com',
    tel: '633 444 555',
    rol: 'Mecánico',
    fecha: '2023-11-05'
},
{
    id: 33,
    nombre: 'Pedro Sánchez',
    email: 'pedro@example.com',
    tel: '644 555 666',
    rol: 'Cliente',
    fecha: '2024-04-01'
},
];

// Vehículos en reparación (datos de CocheSeeder)
const cochesRep = [{
    id: 43,
    matricula: '1234ABC',
    marca: 'Volkswagen',
    modelo: 'Golf VI 1.6 TDI',
    id_cliente: 27,
    en_garaje: false,
    imagen: 'https://img.remediosdigitales.com/5915f2/vw-golf-bluemotion-prueba-1p/450_1000.jpg',
    averia: 'Frenos — ruido metálico',
    estado: 'en_reparacion'
},
{
    id: 44,
    matricula: '5678DEF',
    marca: 'BMW',
    modelo: 'Serie 1',
    id_cliente: 30,
    en_garaje: false,
    imagen: 'https://www.autofacil.es/wp-content/uploads/2021/05/bmwdelantera.jpg',
    averia: 'Cambio de aceite + filtros',
    estado: 'pendiente_pago'
},
{
    id: 45,
    matricula: '9012GHI',
    marca: 'Mercedes-Benz',
    modelo: 'Clase A',
    id_cliente: 33,
    en_garaje: false,
    imagen: 'https://www.km77.com/media/fotos/mercedes_clase_a_2018_5_puertas_6778_1.jpg',
    averia: 'Sensor ABS defectuoso',
    estado: 'esperando_piezas'
},
{
    id: 41,
    matricula: '1234AAA',
    marca: 'Citroën',
    modelo: 'XSara',
    id_cliente: 33,
    en_garaje: false,
    imagen: 'https://upload.wikimedia.org/wikipedia/commons/3/31/Citro%C3%ABn_Xsara_%28Facelift%29_%E2%80%93_Frontansicht%2C_17._M%C3%A4rz_2011%2C_W%C3%BClfrath.jpg',
    averia: 'Revisión ITV previa',
    estado: 'en_revision'
},
{
    id: 53,
    matricula: '1111AAA',
    marca: 'Volkswagen',
    modelo: 'Golf IV',
    id_cliente: 29,
    en_garaje: true,
    imagen: 'https://images.ctfassets.net/uaddx06iwzdz/4oYp6OpVnlIt5LFMBJufls/bad0e627bdcf2627eeff0928cc08e5e3/vw-golf-4-l-01.jpg',
    averia: 'Motor — humo blanco',
    estado: 'diagnostico'
},
{
    id: 35,
    matricula: '1111DMG',
    marca: 'Volkswagen',
    modelo: 'Golf IV',
    id_cliente: 29,
    en_garaje: false,
    imagen: 'https://www.tuning.es/358576-large_default/anadido-rdx-vw-golf-4.jpg',
    averia: 'Embrague desgastado',
    estado: 'prueba_carretera'
},
];

// Solicitudes
let solicitudes = [{
    id: 'SOL-0041',
    cliente: 'Ana López',
    matricula: '4521 KMV',
    vehiculo: 'VW Golf VII 1.6 TDI',
    desc: 'Ruido al frenar, pastillas y discos',
    urgencia: 'alta',
    estado: 'pendiente'
},
{
    id: 'SOL-0040',
    cliente: 'Roberto N.',
    matricula: '3012 BCA',
    vehiculo: 'Seat Ibiza 1.0 TSI',
    desc: 'Revisión general + aceite',
    urgencia: 'media',
    estado: 'pendiente'
},
{
    id: 'SOL-0039',
    cliente: 'Carmen Vidal',
    matricula: '9087 HJT',
    vehiculo: 'Ford Focus 2.0 TDCI',
    desc: 'Humo blanco al arrancar',
    urgencia: 'alta',
    estado: 'pendiente'
},
];

// Vehículos 2ª mano
let coches2 = [{
    id: 1,
    matricula: '4455GGH',
    marca: 'Ford',
    modelo: 'Focus 1.6 TDCi',
    precio: 6500,
    specs: '2015 · 120.000 km · Diésel · Manual · 115 CV',
    en_venta: true,
    imagen: 'https://upload.wikimedia.org/wikipedia/commons/6/6c/2014_Ford_Focus_%28AM5%29_Trend_5-door_hatchback_%282015-11-06%29_01.jpg'
},
{
    id: 2,
    matricula: '7823RTY',
    marca: 'Toyota',
    modelo: 'Yaris 1.0',
    precio: 8900,
    specs: '2018 · 65.000 km · Gasolina · Manual · 69 CV',
    en_venta: true,
    imagen: 'https://upload.wikimedia.org/wikipedia/commons/7/7f/Toyota_Yaris_III_%28E150%29_–_Frontansicht%2C_23._August_2014%2C_Wülfrath.jpg'
},
{
    id: 3,
    matricula: '2234KPL',
    marca: 'Seat',
    modelo: 'Ibiza 1.2 TSI',
    precio: 7200,
    specs: '2016 · 98.000 km · Gasolina · Manual · 85 CV',
    en_venta: false,
    imagen: 'https://upload.wikimedia.org/wikipedia/commons/9/98/SEAT_Ibiza_IV_20090808_front.jpg'
},
{
    id: 4,
    matricula: '5500MNA',
    marca: 'Peugeot',
    modelo: '308 1.6 HDi',
    precio: 5800,
    specs: '2014 · 148.000 km · Diésel · Auto · 92 CV',
    en_venta: true,
    imagen: 'https://upload.wikimedia.org/wikipedia/commons/2/29/Peugeot_308_SW_2008.jpg'
},
];

// Piezas (de PiezaSeeder)
const piezas = [{
    id: 1,
    nombre: 'Filtro de aceite',
    stock: 3,
    pc: 5.00,
    pv: 10.00,
    smin: 5,
    prov: 1
},
{
    id: 2,
    nombre: 'Pastillas de freno',
    stock: 8,
    pc: 15.00,
    pv: 30.00,
    smin: 5,
    prov: 2
},
{
    id: 3,
    nombre: 'Batería 70Ah',
    stock: 8,
    pc: 60.00,
    pv: 90.00,
    smin: 3,
    prov: 3
},
{
    id: 4,
    nombre: 'Correa de distribución',
    stock: 11,
    pc: 30.00,
    pv: 55.00,
    smin: 5,
    prov: 4
},
{
    id: 6,
    nombre: 'Embrague',
    stock: 5,
    pc: 80.00,
    pv: 150.00,
    smin: 1,
    prov: 6
},
{
    id: 10,
    nombre: 'Inyector diésel',
    stock: 0,
    pc: 90.00,
    pv: 140.00,
    smin: 2,
    prov: 10
},
];

const estadoLabels = {
    en_reparacion: {
        label: '🔧 En reparación',
        cls: 's-reparando'
    },
    pendiente_pago: {
        label: '💳 Pend. pago',
        cls: 's-pago'
    },
    esperando_piezas: {
        label: '📦 Esp. piezas',
        cls: 's-piezas'
    },
    en_revision: {
        label: '🔍 En revisión',
        cls: 's-asignado'
    },
    diagnostico: {
        label: '🖥 Diagnóstico',
        cls: 's-nueva'
    },
    prueba_carretera: {
        label: '🛣 Prueba carretera',
        cls: 's-prueba'
    },
};

// ============================================================
// NAVEGACIÓN
// ============================================================
function showPanel(id) {
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    const panel = document.getElementById('panel-' + id);
    if (panel) panel.classList.add('active');
    const title = document.getElementById('panel-title');
    if (title) title.textContent = panelTitles[id] || id;
    // Topbar actions
    const ta = document.getElementById('topbarActions');
    const acts = {
        usuarios: `<button class="btn btn-primary btn-sm" onclick="showModal('nuevo-usuario')">+ Nuevo usuario</button>`,
        vehiculos2: `<button class="btn btn-primary btn-sm" onclick="showModal('agregar-veh')">+ Agregar vehículo</button>`,
        piezas: `<button class="btn btn-primary btn-sm" onclick="showModal('nueva-pieza')">+ Nueva pieza</button>`,
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
    const W = vb.width,
        H = vb.height;
    const P = {
        t: 10,
        r: 10,
        b: 26,
        l: 42
    };
    const cW = W - P.l - P.r,
        cH = H - P.t - P.b;
    const mx = Math.max(...data) * 1.15;
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
    const maxV = Math.max(...data);
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

function initCharts() {
    const M = ['E', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'];
    const W = ['S1', 'S2', 'S3', 'S4'];
    renderBarChart('chart-gastos-anual', [2800, 3200, 2600, 3800, 4200, 3500, 2900, 2400, 3700, 4100, 3900, 4600], M, '#2878f0');
    renderBarChart('chart-gastos-mensual', [890, 1240, 980, 1090], W, '#2878f0');
    renderBarChart('chart-coches-anual', [18, 22, 19, 28, 31, 25, 20, 15, 26, 30, 27, 33], M, '#22c55e');
    renderBarChart('chart-coches-mensual', [7, 10, 8, 9], W, '#22c55e');
}

function switchChart(group, periodo, btn) {
    btn.closest('.card').querySelectorAll('.chart-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    btn.closest('.card').querySelectorAll('.chart-section').forEach(s => s.classList.remove('active'));
    document.getElementById(group + '-' + periodo).classList.add('active');
}

// ============================================================
// USUARIOS
// ============================================================
const roleClass = {
    'Administrador': 'role-admin',
    'Mecánico': 'role-mec',
    'Cliente': 'role-cli'
};

function renderUsuarios() {
    const tb = document.getElementById('usuariosBody');
    if (!tb) return;
    tb.innerHTML = usuarios.map(u => `
        <tr>
            <td style="color:#4a6e9a;font-size:11px">#${u.id}</td>
            <td style="font-weight:600;color:#deeeff">${u.nombre}</td>
            <td>${u.email}</td>
            <td>${u.tel}</td>
            <td><span class="role-badge ${roleClass[u.rol] || 'role-cli'}">${u.rol}</span></td>
            <td style="font-size:11px;color:#4a6e9a">${u.fecha}</td>
            <td><div style="display:flex;gap:6px">
                <button class="btn btn-sm" onclick="editUsuario(${u.id})">✏️ Editar</button>
                <button class="btn btn-sm btn-danger" onclick="confirmDeleteUsuario(${u.id})">✕</button>
            </div></td>
        </tr>`).join('');
}

function editUsuario(id) {
    const u = usuarios.find(x => x.id === id);
    if (!u) return;
    document.getElementById('modal-title').textContent = 'Editar — ' + u.nombre;
    document.getElementById('modal-body').innerHTML = `
        <div class="mfg">
            <div><label class="mlabel">Nombre</label><input class="minput" id="eu-n" value="${u.nombre}"></div>
            <div><label class="mlabel">Teléfono</label><input class="minput" id="eu-t" value="${u.tel}"></div>
            <div class="mfg-full"><label class="mlabel">Email</label><input class="minput" id="eu-e" value="${u.email}"></div>
            <div><label class="mlabel">Rol</label>
                <select class="minput" id="eu-r">
                    <option ${u.rol === 'Administrador' ? 'selected' : ''}>Administrador</option>
                    <option ${u.rol === 'Mecánico' ? 'selected' : ''}>Mecánico</option>
                    <option ${u.rol === 'Cliente' ? 'selected' : ''}>Cliente</option>
                </select>
            </div>
            <div><label class="mlabel">Nueva contraseña (vacío = sin cambio)</label><input class="minput" type="password" placeholder="••••••••"></div>
        </div>`;
    const btn = document.getElementById('modal-confirm');
    btn.textContent = 'Guardar cambios';
    btn.onclick = () => {
        u.nombre = document.getElementById('eu-n').value;
        u.tel = document.getElementById('eu-t').value;
        u.email = document.getElementById('eu-e').value;
        u.rol = document.getElementById('eu-r').value;
        renderUsuarios();
        hideModal();
        btn.textContent = 'Confirmar';
    };
    openModal();
}

function confirmDeleteUsuario(id) {
    const u = usuarios.find(x => x.id === id);
    document.getElementById('modal-title').textContent = 'Eliminar usuario';
    document.getElementById('modal-body').innerHTML = `<p style="color:#b5cfe8;font-size:14px;margin:4px 0">¿Eliminar a <strong style="color:#deeeff">${u.nombre}</strong>?<br>Esta acción no se puede deshacer.</p>`;
    const btn = document.getElementById('modal-confirm');
    btn.className = 'btn btn-danger';
    btn.textContent = 'Eliminar';
    btn.onclick = () => {
        const i = usuarios.findIndex(x => x.id === id);
        if (i > -1) usuarios.splice(i, 1);
        renderUsuarios();
        hideModal();
        btn.className = 'btn btn-primary';
        btn.textContent = 'Confirmar';
    };
    openModal();
}

// ============================================================
// SOLICITUDES
// ============================================================
function renderSolicitudes() {
    const el = document.getElementById('solicitudesList');
    if (!el) return;
    const pend = solicitudes.filter(s => s.estado === 'pendiente');
    const kpi = document.getElementById('kpi-sol-pend');
    if (kpi) kpi.textContent = pend.length;
    if (!pend.length) {
        el.innerHTML = '<p style="color:#4a6e9a;font-size:13px;padding:10px 0">✓ Sin solicitudes pendientes.</p>';
        return;
    }
    const urgClass = {
        alta: 'urg-alta',
        media: 'urg-media',
        baja: 'urg-baja'
    };
    el.innerHTML = solicitudes.map((s, i) => {
        if (s.estado !== 'pendiente') return '';
        return `<div class="sol-card" id="sc-${i}">
            <span class="sol-id">${s.id}</span>
            <div class="sol-info">
                <strong>${s.cliente} · ${s.matricula}</strong>
                <span>${s.vehiculo}</span>
                <div class="sol-desc">${s.desc}</div>
            </div>
            <span class="sol-urgency ${urgClass[s.urgencia] || ''}">${s.urgencia.charAt(0).toUpperCase() + s.urgencia.slice(1)}</span>
            <div class="sol-actions">
                <button class="btn btn-sm btn-success" onclick="accionSol(${i},'aceptar')">✓ Aceptar</button>
                <button class="btn btn-sm btn-danger"  onclick="accionSol(${i},'rechazar')">✕ Rechazar</button>
            </div>
        </div>`;
    }).join('');
}

function accionSol(i, accion) {
    solicitudes[i].estado = accion === 'aceptar' ? 'aceptada' : 'rechazada';
    const card = document.getElementById('sc-' + i);
    if (card) {
        card.classList.add(accion === 'aceptar' ? 'aceptada' : 'rechazada');
        card.querySelector('.sol-actions').innerHTML = accion === 'aceptar' ?
            '<span style="color:#4ade80;font-size:12px;font-weight:600">✓ Aceptada</span>' :
            '<span style="color:#f87171;font-size:12px;font-weight:600">✕ Rechazada</span>';
        setTimeout(renderSolicitudes, 1200);
    }
}

// ============================================================
// VEHÍCULOS REPARACIÓN
// ============================================================
function renderVehiculosRep() {
    const el = document.getElementById('vehiculosReparGrid');
    if (!el) return;
    el.innerHTML = cochesRep.map(c => {
        const est = estadoLabels[c.estado] || {
            label: c.estado,
            cls: 's-nueva'
        };
        const imgOk = c.imagen && c.imagen.startsWith('http');
        return `<div class="veh-card" onclick="openVehRepModal(${c.id})">
            ${imgOk ? `<img src="${c.imagen}" class="veh-img" alt="" onerror="this.style.display='none';this.nextSibling.style.display='flex'">` : ''}
            <div class="veh-img-ph" style="${imgOk ? 'display:none' : ''}">🚗</div>
            <div class="veh-info">
                <div class="veh-matricula">${c.matricula}</div>
                <div class="veh-modelo">${c.marca} ${c.modelo}</div>
                <div style="font-size:11px;color:#4a6e9a;margin-top:2px">${c.averia}</div>
                <span class="status-pill ${est.cls}" style="margin-top:6px">${est.label}</span>
            </div>
        </div>`;
    }).join('');
}

function openVehRepModal(id) {
    const c = cochesRep.find(x => x.id === id);
    if (!c) return;
    const est = estadoLabels[c.estado] || {
        label: c.estado,
        cls: 's-nueva'
    };
    const cliente = (usuarios.find(u => u.id === c.id_cliente) || {}).nombre || 'Cliente #' + c.id_cliente;
    const imgOk = c.imagen && c.imagen.startsWith('http');
    document.getElementById('veh-modal-title').textContent = c.matricula + ' · ' + c.marca + ' ' + c.modelo;
    document.getElementById('veh-modal-body').innerHTML = `
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div>
                ${imgOk
            ? `<img src="${c.imagen}" style="width:100%;border-radius:8px;height:180px;object-fit:cover" alt="" onerror="this.parentNode.innerHTML='<div style=height:180px;background:#0a1826;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:48px>🚗</div>'">`
            : '<div style="height:180px;background:#0a1826;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:48px">🚗</div>'}
            </div>
            <div style="display:flex;flex-direction:column;gap:9px;font-size:13px">
                <div><span style="color:#4a6e9a">Matrícula:</span><strong style="color:#deeeff;margin-left:6px">${c.matricula}</strong></div>
                <div><span style="color:#4a6e9a">Vehículo:</span><strong style="color:#deeeff;margin-left:6px">${c.marca} ${c.modelo}</strong></div>
                <div><span style="color:#4a6e9a">Cliente:</span><strong style="color:#deeeff;margin-left:6px">${cliente}</strong></div>
                <div><span style="color:#4a6e9a">Avería:</span><strong style="color:#deeeff;margin-left:6px">${c.averia}</strong></div>
                <div><span style="color:#4a6e9a">Estado:</span><span class="status-pill ${est.cls}" style="margin-left:6px">${est.label}</span></div>
                <div><span style="color:#4a6e9a">En garaje:</span><strong style="color:#deeeff;margin-left:6px">${c.en_garaje ? 'Sí' : 'No'}</strong></div>
            </div>
        </div>
        <div style="display:flex;gap:8px;justify-content:flex-end">
            <button class="btn btn-sm" onclick="closeVehModal()">Cerrar</button>
            <button class="btn btn-primary btn-sm" onclick="alert('Mecánico asignado ✓');closeVehModal()">👤 Asignar mecánico</button>
            <button class="btn btn-success btn-sm" onclick="alert('Pago confirmado ✓');closeVehModal()">💳 Confirmar pago</button>
        </div>`;
    document.getElementById('vehModal').classList.add('open');
}

function closeVehModal() {
    document.getElementById('vehModal').classList.remove('open');
}

// ============================================================
// VEHÍCULOS 2ª MANO
// ============================================================
function renderVehiculos2() {
    const el = document.getElementById('vehiculos2Grid');
    if (!el) return;
    const enVenta = coches2.filter(c => c.en_venta);
    const total = enVenta.reduce((a, c) => a + c.precio, 0);
    const media = enVenta.length ? Math.round(total / enVenta.length) : 0;
    const kv = document.getElementById('kpi-en-venta');
    const kvs = document.getElementById('kpi-valor-stock');
    const kpm = document.getElementById('kpi-precio-med');
    if (kv) kv.textContent = enVenta.length;
    if (kvs) kvs.textContent = '€' + total.toLocaleString('es-ES');
    if (kpm) kpm.textContent = enVenta.length ? '€' + media.toLocaleString('es-ES') : '—';

    el.innerHTML = coches2.map(c => {
        const imgOk = c.imagen && c.imagen.startsWith('http');
        return `<div class="veh-card" onclick="openVeh2Modal(${c.id})">
            ${imgOk ? `<img src="${c.imagen}" class="veh-img" alt="">` : ''}
            <div class="veh-img-ph" style="${imgOk ? 'display:none' : ''}">🚘</div>
            <div class="veh-info">
                <div class="veh-matricula">${c.matricula}</div>
                <div class="veh-modelo">${c.marca} ${c.modelo}</div>
                <div class="veh-precio">€${c.precio.toLocaleString('es-ES')}</div>
                <div style="font-size:10px;color:#4a6e9a;margin-top:2px">${c.specs}</div>
                <span class="${c.en_venta ? 'veh-libre' : 'veh-garaje'} veh-status">${c.en_venta ? '● En venta' : '● Retirado'}</span>
            </div>
            <div class="veh-actions" onclick="event.stopPropagation()">
                <button class="btn btn-sm btn-danger" onclick="sacarVeh(${c.id})">📤 Sacar</button>
                <button class="btn btn-sm btn-success" onclick="venderVeh(${c.id})">💰 Vender</button>
            </div>
        </div>`;
    }).join('');
}

function openVeh2Modal(id) {
    const c = coches2.find(x => x.id === id);
    if (!c) return;
    const imgOk = c.imagen && c.imagen.startsWith('http');
    document.getElementById('veh-modal-title').textContent = c.matricula + ' · ' + c.marca + ' ' + c.modelo;
    document.getElementById('veh-modal-body').innerHTML = `
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div>
                ${imgOk
            ? `<img src="${c.imagen}" style="width:100%;border-radius:8px;height:180px;object-fit:cover" alt="">`
            : '<div style="height:180px;background:#0a1826;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:48px">🚘</div>'}
            </div>
            <div style="display:flex;flex-direction:column;gap:9px;font-size:13px">
                <div><span style="color:#4a6e9a">Matrícula:</span><strong style="color:#deeeff;margin-left:6px">${c.matricula}</strong></div>
                <div><span style="color:#4a6e9a">Vehículo:</span><strong style="color:#deeeff;margin-left:6px">${c.marca} ${c.modelo}</strong></div>
                <div><span style="color:#4a6e9a">Precio:</span><strong style="color:#2878f0;font-size:18px;margin-left:6px">€${c.precio.toLocaleString('es-ES')}</strong></div>
                <div style="color:#4a6e9a;font-size:12px;margin-top:2px">${c.specs}</div>
                <span class="${c.en_venta ? 'veh-libre' : 'veh-garaje'} veh-status">${c.en_venta ? '● En venta' : '● Retirado'}</span>
            </div>
        </div>
        <div style="display:flex;gap:8px;justify-content:flex-end">
            <button class="btn btn-sm" onclick="closeVehModal()">Cerrar</button>
            <button class="btn btn-sm btn-danger" onclick="sacarVeh(${c.id});closeVehModal()">📤 Sacar</button>
            <button class="btn btn-success btn-sm" onclick="venderVeh(${c.id});closeVehModal()">💰 Vender</button>
        </div>`;
    document.getElementById('vehModal').classList.add('open');
}

function sacarVeh(id) {
    const c = coches2.find(x => x.id === id);
    if (c) {
        c.en_venta = false;
        renderVehiculos2();
    }
}

function venderVeh(id) {
    const c = coches2.find(x => x.id === id);
    if (!c) return;
    document.getElementById('modal-title').textContent = 'Registrar venta';
    document.getElementById('modal-body').innerHTML = `
        <p style="color:#b5cfe8;font-size:14px;margin:4px 0">
            Confirmar venta de <strong style="color:#deeeff">${c.marca} ${c.modelo} (${c.matricula})</strong>
            por <strong style="color:#2878f0">€${c.precio.toLocaleString('es-ES')}</strong>.<br><br>
            El vehículo se retirará del inventario.
        </p>`;
    const btn = document.getElementById('modal-confirm');
    btn.className = 'btn btn-success';
    btn.textContent = '💰 Confirmar venta';
    btn.onclick = () => {
        coches2 = coches2.filter(x => x.id !== id);
        renderVehiculos2();
        hideModal();
        btn.className = 'btn btn-primary';
        btn.textContent = 'Confirmar';
    };
    openModal();
}

// ============================================================
// PIEZAS
// ============================================================
function renderPiezas() {
    const el = document.getElementById('piezasGrid');
    if (!el) return;
    el.innerHTML = piezas.map(p => {
        const stockHtml = p.stock === 0 ?
            `<span class="stock-out">✕ Sin stock</span>` :
            p.stock <= p.smin ?
                `<span class="stock-low">⚠ Stock bajo (${p.stock} ud.)</span>` :
                `<span class="stock-ok">✓ En stock (${p.stock} ud.)</span>`;
        return `<div class="pieza-card">
            <div class="pieza-nombre">${p.nombre}</div>
            <div class="pieza-meta">
                ${stockHtml}
                <span>Mínimo: <strong>${p.smin} ud.</strong></span>
                <span>P. Compra: <strong>€${p.pc.toFixed(2)}</strong></span>
                <span>Proveedor: <strong>#${p.prov}</strong></span>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:8px;border-top:1px solid #1a3050">
                <span class="pieza-pvp">€${p.pv.toFixed(2)}</span>
                <button class="btn btn-primary btn-sm" onclick="comprarPieza(${p.id})">🛒 Comprar</button>
            </div>
        </div>`;
    }).join('');
}

function comprarPieza(id) {
    const p = piezas.find(x => x.id === id);
    if (!p) return;
    document.getElementById('modal-title').textContent = 'Comprar · ' + p.nombre;
    document.getElementById('modal-body').innerHTML = `
        <div style="font-size:13px;color:#b5cfe8;margin-bottom:14px">
            Stock actual: <strong style="color:#deeeff">${p.stock} ud.</strong> &nbsp;|&nbsp;
            Mínimo: <strong style="color:#deeeff">${p.smin} ud.</strong> &nbsp;|&nbsp;
            P. compra: <strong style="color:#deeeff">€${p.pc.toFixed(2)}</strong>
        </div>
        <div style="display:flex;align-items:center;gap:12px">
            <div style="flex:1"><label class="mlabel">Cantidad a pedir</label>
            <input class="minput" type="number" id="cq" value="${Math.max(p.smin - p.stock + 5, 5)}" min="1" style="width:120px"></div>
            <div style="font-size:13px;color:#4a6e9a;padding-top:18px">Total: <span id="cqTotal" style="color:#2878f0;font-weight:700">€${(Math.max(p.smin - p.stock + 5, 5) * p.pc).toFixed(2)}</span></div>
        </div>`;
    document.getElementById('cq').oninput = function () {
        const t = document.getElementById('cqTotal');
        if (t) t.textContent = '€' + ((parseInt(this.value) || 0) * p.pc).toFixed(2);
    };
    const btn = document.getElementById('modal-confirm');
    btn.textContent = '🛒 Confirmar pedido';
    btn.onclick = () => {
        const qty = parseInt(document.getElementById('cq').value) || 0;
        p.stock += qty;
        renderPiezas();
        hideModal();
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
                <div><label class="mlabel">Rol</label>
                    <select class="minput" id="nu-r"><option>Cliente</option><option>Mecánico</option><option>Administrador</option></select>
                </div>
                <div><label class="mlabel">Contraseña</label><input class="minput" type="password" id="nu-p" placeholder="••••••••"></div>
            </div>`;
        const btn = document.getElementById('modal-confirm');
        btn.textContent = 'Crear usuario';
        btn.onclick = () => {
            const n = document.getElementById('nu-n').value.trim();
            if (!n) return;
            usuarios.push({
                id: Date.now() % 90000 + 10000,
                nombre: n,
                email: document.getElementById('nu-e').value,
                tel: document.getElementById('nu-t').value,
                rol: document.getElementById('nu-r').value,
                fecha: new Date().toISOString().slice(0, 10)
            });
            renderUsuarios();
            hideModal();
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
                <div class="mfg-full"><label class="mlabel">URL Imagen</label><input class="minput" id="av-i" placeholder="https://…"></div>
                <div class="mfg-full"><label class="mlabel">Especificaciones</label><input class="minput" id="av-s" placeholder="2018 · 65.000 km · Gasolina · Manual · 85 CV"></div>
            </div>`;
        const btn = document.getElementById('modal-confirm');
        btn.textContent = '+ Agregar';
        btn.onclick = () => {
            const mat = document.getElementById('av-m').value.trim();
            const prec = parseFloat(document.getElementById('av-p').value) || 0;
            if (!mat || !prec) return;
            coches2.push({
                id: Date.now() % 90000 + 10000,
                matricula: mat,
                marca: document.getElementById('av-mk').value,
                modelo: document.getElementById('av-mo').value,
                imagen: document.getElementById('av-i').value,
                precio: prec,
                specs: document.getElementById('av-s').value,
                en_venta: true
            });
            renderVehiculos2();
            hideModal();
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
        btn.onclick = () => {
            const n = document.getElementById('np-n').value.trim();
            if (!n) return;
            piezas.push({
                id: Date.now() % 900 + 100,
                nombre: n,
                stock: parseInt(document.getElementById('np-s').value) || 0,
                smin: parseInt(document.getElementById('np-sm').value) || 5,
                pc: parseFloat(document.getElementById('np-pc').value) || 0,
                pv: parseFloat(document.getElementById('np-pv').value) || 0,
                prov: 1
            });
            renderPiezas();
            hideModal();
            btn.textContent = 'Confirmar';
        };
    }
    openModal();
}

function openModal() {
    document.getElementById('modalOverlay').classList.add('open');
}

function hideModal() {
    document.getElementById('modalOverlay').classList.remove('open');
}

// ============================================================
// INIT
// ============================================================
document.addEventListener('DOMContentLoaded', function () {
    initCharts();
    renderUsuarios();
    renderSolicitudes();
    renderVehiculosRep();
    renderVehiculos2();
    renderPiezas();
});