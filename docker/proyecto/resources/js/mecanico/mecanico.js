// ============================================================
// mecanico.js  v3 — CORREGIDO
// - fin declarado correctamente en selectReparacion
// - finalizada consistente en todo el archivo
// - Tabla muestra coste piezas y botón Ver con texto
// ============================================================
(() => {
'use strict';

// ── Config ────────────────────────────────────────────────
const BASE = '/api';

function getMecanicoId() {
    const meta = document.querySelector('meta[name="mecanico-id"]');
    if (meta && meta.content && parseInt(meta.content) > 0) return parseInt(meta.content);
    if (window.__MECANICO_ID__ && window.__MECANICO_ID__ > 0) return window.__MECANICO_ID__;
    console.error('[Mecánico] No se pudo obtener el id del mecánico. Comprueba la meta tag.');
    return null;
}

function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

// ── Estado global ─────────────────────────────────────────
const state = {
    reparaciones: [],
    selectedRepId: null,
    cochesDisponibles: [],
};

document.documentElement.setAttribute('data-theme', 'dark');

// ── Helpers ───────────────────────────────────────────────
function fmt(f) {
    if (!f) return '—';
    return new Date(f).toLocaleDateString('es-ES', {day:'2-digit',month:'short',year:'numeric'});
}

function badge(estado) {
    const map = {
        'pendiente':  {cls:'mech-badge-orange', text:'Pendiente',  icon:'ti-clock'},
        'en proceso': {cls:'mech-badge-blue',   text:'En proceso', icon:'ti-player-play'},
        'finalizada': {cls:'mech-badge-green',  text:'Finalizada', icon:'ti-circle-check'},
    };
    return map[estado] || map['pendiente'];
}

window.showNotification = function(msg, type = 'success') {
    const el = document.createElement('div');
    el.className = `mech-toast ${type}`;
    el.innerHTML = `<i class="ti ti-${type==='success'?'circle-check':'alert-circle'}"></i> ${msg}`;
    document.body.appendChild(el);
    setTimeout(() => { el.classList.add('exit'); setTimeout(() => el.remove(), 260); }, 3500);
};

// ── Fetch helper ──────────────────────────────────────────
async function api(path, opts = {}) {
    const headers = {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken(),
        ...opts.headers
    };
    if (opts.body && typeof opts.body === 'object' && !(opts.body instanceof FormData)) {
        opts.body = JSON.stringify(opts.body);
        headers['Content-Type'] = 'application/json';
    }
    const r = await fetch(BASE + path, { ...opts, headers });
    const json = await r.json().catch(() => ({}));
    if (!r.ok) throw new Error(json.message || `HTTP ${r.status}`);
    return json;
}

// ══════════════════════════════════════════════════════════
// TABLA PRINCIPAL + KPIs
// ══════════════════════════════════════════════════════════
function renderReparaciones() {
    const tbody = document.getElementById('tabla-reparaciones');
    if (!tbody) return;
    if (!state.reparaciones.length) {
        tbody.innerHTML = `<tr class="mech-empty-row">
            <td colspan="6" style="text-align:center;padding:2rem;">
                <p class="mech-small-muted">No tienes reparaciones asignadas aún.</p>
            </td></tr>`;
        updateKPIs(); return;
    }
    tbody.innerHTML = state.reparaciones.map(r => {
        const b   = badge(r.estado);
        const c   = r.coche || {};
        const mat = c.matricula || r.matricula || '—';
        const veh = `${c.marca||''} ${c.modelo||''}`.trim();
        const h   = parseFloat(r.horas_trabajo) || 0;

        return `<tr class="mech-tr${state.selectedRepId===r.id_reparacion?' selected':''}"
                    onclick="window.selectReparacion(${r.id_reparacion})" style="cursor:pointer;">
            <td>
                <span class="mech-veh-matricula">${mat}</span>
                <span class="mech-small-muted">${veh}</span>
            </td>
            <td>${r.motivo||'—'}</td>
            <td><span class="mech-badge ${b.cls}"><i class="ti ${b.icon}"></i> ${b.text}</span></td>
            <td style="text-align:center;">${h > 0 ? h + 'h' : '—'}</td>
            <td style="text-align:center;">
                ${parseFloat(r.coste_total_piezas||0) > 0
                    ? parseFloat(r.coste_total_piezas).toFixed(2) + ' €'
                    : '—'}
            </td>
            <td style="text-align:right;">
                <button class="mech-btn mech-btn-xs mech-btn-primary"
                    style="gap:.35rem;"
                    onclick="event.stopPropagation();window.openRepAsignadasModal(${r.id_reparacion})">
                    <i class="ti ti-eye"></i> Ver
                </button>
            </td>
        </tr>`;
    }).join('');
    updateKPIs();
}

function updateKPIs() {
    const reps = state.reparaciones;
    const pen  = reps.filter(r=>r.estado==='pendiente').length;
    const enP  = reps.filter(r=>r.estado==='en proceso').length;
    const fin  = reps.filter(r=>r.estado==='finalizada').length;
    const set = (id,v) => { const el=document.getElementById(id); if(el) el.textContent=v; };
    set('count-pending',    pen);
    set('count-inprogress', enP);
    set('count-finished',   fin);
    set('count-pending-parts', reps.filter(r=>r.estado!=='finalizada'&&!r.horas_trabajo).length);
    set('hero-active',  reps.length);
    set('hero-pending', pen);
    set('hero-ready',   fin);
    const b = document.getElementById('badge-total-reps');
    if (b) b.textContent = `${reps.length} órdenes`;
}

window.selectReparacion = function(id) {
    state.selectedRepId = id;
    document.querySelectorAll('#tabla-reparaciones .mech-tr').forEach(tr =>
        tr.classList.toggle('selected', tr.onclick?.toString().includes(`(${id})`)));

    const rep = state.reparaciones.find(r=>r.id_reparacion===id);
    if (!rep) return;

    const c   = rep.coche || {};
    const b   = badge(rep.estado);
    const fin = rep.estado === 'finalizada'; // ✅ declarado aquí, en el scope correcto

    document.getElementById('reparacion-detalle').innerHTML = `
        <div style="display:flex;flex-direction:column;gap:.75rem;">
            <div style="display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;">
                <span class="mech-badge ${b.cls}"><i class="ti ${b.icon}"></i> ${b.text}</span>
                <span class="mech-small-muted">ID #${rep.id_reparacion}</span>
            </div>
            <div>
                <span class="mech-small-muted">Vehículo</span>
                <p style="font-weight:700;font-size:.9rem;color:var(--mech-text);">
                    ${c.matricula||'—'} · ${c.marca||''} ${c.modelo||''}</p>
            </div>
            <div>
                <span class="mech-small-muted">Motivo</span>
                <p style="font-weight:600;color:var(--mech-text);">${rep.motivo||'—'}</p>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.5rem;">
                <div><span class="mech-small-muted">Entrada</span><p style="color:var(--mech-text);">${fmt(rep.fecha_entrada)}</p></div>
                <div><span class="mech-small-muted">Salida</span><p style="color:var(--mech-text);">${fmt(rep.fecha_salida)}</p></div>
                <div><span class="mech-small-muted">Horas</span><p style="color:var(--mech-text);">${rep.horas_trabajo||0} h</p></div>
                <div><span class="mech-small-muted">M. obra</span><p style="color:var(--mech-text);">${parseFloat(rep.coste_mano_obra||0).toFixed(2)} €</p></div>
                <div><span class="mech-small-muted">Piezas</span><p style="color:var(--mech-text);">${parseFloat(rep.coste_total_piezas||0).toFixed(2)} €</p></div>
                <div><span class="mech-small-muted">Total</span>
                    <p style="font-weight:700;color:var(--mech-primary);">${parseFloat(rep.coste_total_reparacion||0).toFixed(2)} €</p></div>
            </div>
            <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-top:.25rem;">
                ${!fin ? `
                <button class="mech-btn mech-btn-xs mech-btn-primary"
                    onclick="window.openAgregarHorasModal(${id})">
                    <i class="ti ti-clock-plus"></i> Horas
                </button>
                <button class="mech-btn mech-btn-xs"
                    onclick="window.openAgregarPiezasModal(${id})"
                    style="background:var(--mech-surface-offset);">
                    <i class="ti ti-tool"></i> Piezas
                </button>
                <button class="mech-btn mech-btn-xs"
                    onclick="window.openCambiarEstadoModal(${id})"
                    style="background:var(--mech-surface-offset);">
                    <i class="ti ti-refresh"></i> Estado
                </button>` : `
                <div style="padding:.5rem .75rem;border-radius:10px;background:var(--mech-surface-offset);
                    font-size:.72rem;color:var(--mech-text-muted);display:flex;align-items:center;gap:.4rem;">
                    <i class="ti ti-lock"></i> Reparación finalizada · solo lectura
                </div>`}
            </div>
        </div>`;
};

// ── Cargar reparaciones ───────────────────────────────────
async function cargarReparaciones() {
    const MECANICO_ID = getMecanicoId();
    if (!MECANICO_ID) {
        window.showNotification('Error: ID de mecánico no disponible. Verifica la sesión.','error');
        return;
    }
    try {
        const data = await api(`/reparaciones/mecanico/${MECANICO_ID}`);
        state.reparaciones = data.data || [];
        renderReparaciones();
    } catch(e) {
        window.showNotification('Error al cargar reparaciones: '+e.message,'error');
    }
}

async function cargarCochesDisponibles() {
    try {
        const data = await api('/coches/disponibles');
        state.cochesDisponibles = data.data || data || [];
    } catch {
        state.cochesDisponibles = [];
    }
}

// ══════════════════════════════════════════════════════════
// MODAL GENÉRICO
// ══════════════════════════════════════════════════════════
const MODAL_META = {
    'modal-meter-coche':      {icon:'ti-car',          sub:'Selecciona el vehículo a registrar'},
    'modal-rep-asignadas':    {icon:'ti-file-check',   sub:'Gestiona tus órdenes de trabajo'},
    'modal-agregar-horas':    {icon:'ti-clock-hour-4', sub:'Añade horas (12 €/h, se acumulan)'},
    'modal-agregar-piezas':   {icon:'ti-tool',         sub:'Descuenta unidades del almacén'},
    'modal-solicitar-piezas': {icon:'ti-package',      sub:'Piezas con stock bajo'},
    'modal-cambiar-estado':   {icon:'ti-refresh',      sub:'Cambia el estado de la reparación'},
};

function createModal(id, title, content, wide=false) {
    const meta = MODAL_META[id]||{};
    let m = document.getElementById(id);
    if (!m) {
        m = document.createElement('div');
        m.id = id;
        m.className = 'mech-modal';
        m.setAttribute('role','dialog');
        m.setAttribute('aria-modal','true');
        m.innerHTML = `
        <div class="mech-modal-content${wide?' modal-wide':''}">
            <div class="mech-modal-header">
                <div class="mech-modal-header-left">
                    <div class="mech-modal-icon"><i class="ti ${meta.icon||'ti-settings'}"></i></div>
                    <div>
                        <h2 style="color:var(--mech-text);">${title}</h2>
                        <p class="mech-modal-subtitle">${meta.sub||''}</p>
                    </div>
                </div>
                <button class="mech-close-btn" onclick="window.closeModal('${id}')" aria-label="Cerrar">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="mech-modal-body" id="${id}-body">${content}</div>
        </div>`;
        document.body.appendChild(m);
        m.addEventListener('click', e => { if(e.target===m) window.closeModal(id); });
    } else {
        const b = document.getElementById(`${id}-body`);
        if (b) b.innerHTML = content;
    }
    return m;
}

window.closeModal = function(id) {
    const m = id ? document.getElementById(id) : document.querySelector('.mech-modal.show');
    if (m) { m.classList.remove('show'); document.body.style.overflow=''; }
};

function openModal(id) {
    const m = document.getElementById(id);
    if (m) { m.classList.add('show'); document.body.style.overflow='hidden'; }
}

// ══════════════════════════════════════════════════════════
// MODAL: METER COCHE
// ══════════════════════════════════════════════════════════
window.openMeterCocheModal = async function() {
    const MECANICO_ID = getMecanicoId();
    createModal('modal-meter-coche', 'Meter coche al taller', `
        <div class="mech-form-group">
            <label>Vehículo disponible</label>
            <select id="mc-coche" class="mech-form-group select">
                <option value="">Cargando vehículos…</option>
            </select>
        </div>
        <div id="mc-car-detail" style="display:none;margin-bottom:1rem;padding:.75rem 1rem;
            border-radius:14px;background:var(--mech-surface-2);border:1px solid var(--mech-border);">
        </div>
        <div class="mech-form-group">
            <label>Motivo de la reparación</label>
            <input id="mc-motivo" type="text" placeholder="Ej: Cambio de pastillas de freno" />
        </div>
        <div id="mc-error" class="mech-modal-error" style="display:none;"></div>
        <div class="mech-btn-group">
            <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-meter-coche')">
                <i class="ti ti-x"></i> Cancelar
            </button>
            <button type="button" id="mc-submit" class="mech-btn mech-btn-primary"
                onclick="window.mcConfirmar()">
                <i class="ti ti-car-garage"></i> Registrar entrada
            </button>
        </div>`);
    openModal('modal-meter-coche');
    applyFormStyles('modal-meter-coche');
    const sel = document.getElementById('mc-coche');
    try {
        const data = await api('/coches/disponibles');
        const coches = data.data || data || [];
        state.cochesDisponibles = coches;
        if (!coches.length) {
            sel.innerHTML = '<option value="">No hay vehículos disponibles</option>';
        } else {
            sel.innerHTML = '<option value="">— Selecciona un vehículo —</option>' +
                coches.map(c => `<option value="${c.id_coche}"
                    data-marca="${c.marca||''}" data-modelo="${c.modelo||''}"
                    data-mat="${c.matricula||''}" data-anio="${c.anio_matriculacion||''}"
                    data-fuel="${c.combustible||''}">
                    ${c.matricula} · ${c.marca} ${c.modelo}
                </option>`).join('');
            sel.addEventListener('change', () => mcMostrarDetalle(sel));
        }
    } catch(e) {
        sel.innerHTML = `<option value="">Error al cargar: ${e.message}</option>`;
    }
};

function mcMostrarDetalle(sel) {
    const det = document.getElementById('mc-car-detail');
    const opt = sel.options[sel.selectedIndex];
    if (!opt||!opt.value) { det.style.display='none'; return; }
    det.style.display = 'block';
    det.innerHTML = `
        <div style="display:flex;align-items:center;gap:.75rem;">
            <i class="ti ti-car" style="font-size:1.6rem;color:var(--mech-primary);flex-shrink:0;"></i>
            <div>
                <p style="font-weight:700;margin:0;color:var(--mech-text);font-size:.9rem;">
                    ${opt.dataset.marca} ${opt.dataset.modelo}</p>
                <p style="margin:.15rem 0 0;font-size:.75rem;color:var(--mech-text-muted);">
                    ${opt.dataset.mat} · ${opt.dataset.anio} · ${opt.dataset.fuel}</p>
            </div>
            <span class="mech-badge mech-badge-green" style="margin-left:auto;">Disponible</span>
        </div>`;
}

window.mcConfirmar = async function() {
    const MECANICO_ID = getMecanicoId();
    const errBox  = document.getElementById('mc-error');
    const idCoche = parseInt(document.getElementById('mc-coche')?.value);
    const motivo  = document.getElementById('mc-motivo')?.value.trim();
    const btn     = document.getElementById('mc-submit');
    errBox.style.display='none';
    if (!idCoche) { errBox.textContent='Selecciona un vehículo.'; errBox.style.display='block'; return; }
    if (!motivo)  { errBox.textContent='El motivo es obligatorio.'; errBox.style.display='block'; return; }
    btn.disabled=true; btn.innerHTML='<i class="ti ti-loader ti-spin"></i> Registrando…';
    try {
        const rep = await api('/admin/reparaciones', {method:'POST', body:{id_coche:idCoche, motivo}});
        const idRep = rep.data?.id_reparacion || rep.id_reparacion;
        if (idRep && MECANICO_ID) {
            await api('/reparacion/asignar-mecanico', {
                method:'POST',
                body: {id_reparacion: idRep, id_mecanico: MECANICO_ID}
            }).catch(()=>{});
        }
        window.showNotification('Vehículo registrado en el taller.','success');
        window.closeModal('modal-meter-coche');
        await cargarReparaciones();
    } catch(e) {
        errBox.textContent='Error: '+e.message; errBox.style.display='block';
        btn.disabled=false; btn.innerHTML='<i class="ti ti-car-garage"></i> Registrar entrada';
    }
};

// ══════════════════════════════════════════════════════════
// MODAL: REPARACIONES ASIGNADAS
// ══════════════════════════════════════════════════════════
const raState = {reparaciones:[], filtroActivo:'todos', busqueda:'', selectedId:null};

window.raFiltrar = function(filtro) {
    raState.filtroActivo = filtro;
    document.querySelectorAll('.ra-filter-btn').forEach(b=>
        b.classList.toggle('active', b.dataset.filter===filtro));
    raAplicarFiltros();
};

function raAplicarFiltros() {
    let lista = [...raState.reparaciones];
    if (raState.filtroActivo!=='todos') lista=lista.filter(r=>r.estado===raState.filtroActivo);
    if (raState.busqueda) {
        const q=raState.busqueda.toLowerCase();
        lista=lista.filter(r=>
            (r.coche?.matricula||r.matricula||'').toLowerCase().includes(q)||
            (r.motivo||'').toLowerCase().includes(q));
    }
    const ul=document.getElementById('ra-list');
    if (!ul) return;
    if (!lista.length) {
        ul.innerHTML=`<li style="text-align:center;padding:2rem;color:var(--mech-text-muted);">Sin resultados</li>`;
        return;
    }
    ul.innerHTML = lista.map(r=>{
        const b=badge(r.estado);
        const c=r.coche||{};
        const mat=c.matricula||r.matricula||'—';
        return `<li class="ra-list-item${raState.selectedId===r.id_reparacion?' selected':''}"
                    onclick="window.raSeleccionar(${r.id_reparacion})">
            <div style="display:flex;align-items:center;gap:.6rem;justify-content:space-between;">
                <div>
                    <p style="font-weight:700;margin:0;font-size:.82rem;color:var(--mech-text);">
                        ${mat} <span style="font-weight:400;color:var(--mech-text-muted);">
                        ${c.marca||''} ${c.modelo||''}</span></p>
                    <p style="margin:0;font-size:.74rem;color:var(--mech-text-muted);">${r.motivo||'—'}</p>
                </div>
                <span class="mech-badge ${b.cls}" style="font-size:.65rem;flex-shrink:0;">
                    <i class="ti ${b.icon}"></i>${b.text}</span>
            </div>
            <p style="font-size:.68rem;margin:.25rem 0 0;color:var(--mech-text-muted);">
                Entrada: ${fmt(r.fecha_entrada)}
                ${r.horas_trabajo>0?`· ${r.horas_trabajo}h`:''}
                ${r.coste_total_reparacion>0?`· ${parseFloat(r.coste_total_reparacion).toFixed(2)}€`:''}
            </p>
        </li>`;
    }).join('');
}

window.raSeleccionar = function(id) {
    raState.selectedId = id;
    raAplicarFiltros();
    const panel=document.getElementById('ra-actions-panel');
    if (panel) panel.style.display='block';
    const rep=raState.reparaciones.find(r=>r.id_reparacion===id);
    if (!rep) return;
    const fin = rep.estado==='finalizada';
    const enP = rep.estado==='en proceso';
    const bi  = document.getElementById('ra-btn-iniciar');
    const bp  = document.getElementById('ra-btn-pausar');
    const bf  = document.getElementById('ra-btn-finalizar');
    if (bi) bi.disabled = enP||fin;
    if (bp) bp.disabled = !enP;
    if (bf) bf.disabled = fin;
};

window.raCambiarEstado = async function(nuevoEstado) {
    if (!raState.selectedId) { window.showNotification('Selecciona una reparación','error'); return; }
    try {
        await api('/reparaciones/cambiar-estado',{
            method:'PUT', body:{id_reparacion:raState.selectedId, estado:nuevoEstado}});
        window.showNotification(`Estado → "${nuevoEstado}"`,'success');
        await raCargar(); await cargarReparaciones();
    } catch(e) { window.showNotification('Error: '+e.message,'error'); }
};

window.raConfirmarFinalizar = async function() {
    if (!raState.selectedId){window.showNotification('Selecciona una reparación','error');return;}
    if (!confirm('¿Estás seguro de finalizar esta reparación? No se podrá editar.')) return;
    await window.raCambiarEstado('finalizada');
};

async function raCargar() {
    const MECANICO_ID = getMecanicoId();
    if (!MECANICO_ID) return;
    const ul=document.getElementById('ra-list');
    if (ul) ul.innerHTML=`<li style="text-align:center;padding:2rem;">
        <span class="mech-small-muted">Cargando…</span></li>`;
    try {
        const data=await api(`/reparaciones/mecanico/${MECANICO_ID}`);
        raState.reparaciones=data.data||[];
        raAplicarFiltros();
    } catch(e) {
        if(ul) ul.innerHTML=`<li style="color:var(--mech-error);padding:1rem;">Error: ${e.message}</li>`;
    }
}

window.raRecargar = async function() {
    raState.selectedId=null;
    const p=document.getElementById('ra-actions-panel'); if(p) p.style.display='none';
    await raCargar();
};

window.openRepAsignadasModal = function(preselId) {
    const modal=document.getElementById('modal-rep-asignadas');
    if (!modal) { window.showNotification('Modal no encontrado','error'); return; }
    modal.classList.add('show'); document.body.style.overflow='hidden';
    raState.selectedId = preselId||null;
    const p=document.getElementById('ra-actions-panel');
    if (p) p.style.display=preselId?'block':'none';
    window.raFiltrar('todos');
    raCargar().then(()=>{ if(preselId) window.raSeleccionar(preselId); });
    const s=document.getElementById('ra-search');
    if (s&&!s._bound){ s._bound=true;
        s.addEventListener('input',e=>{raState.busqueda=e.target.value; raAplicarFiltros();}); }
};

// ══════════════════════════════════════════════════════════
// MODAL: AÑADIR HORAS
// ══════════════════════════════════════════════════════════
window.openAgregarHorasModal = function(preselId) {
    const activas = state.reparaciones.filter(r=>r.estado!=='finalizada');
    const opts = activas.map(r=>{
        const c=r.coche||{};
        return `<option value="${r.id_reparacion}" ${r.id_reparacion===preselId?'selected':''}>
            #${r.id_reparacion} · ${c.matricula||'—'} — ${r.motivo||''}</option>`;
    }).join('');
    createModal('modal-agregar-horas','Añadir horas de trabajo',`
        <div class="mech-form-group">
            <label>Reparación</label>
            <select id="ah-rep">${opts||'<option value="">Sin reparaciones activas</option>'}</select>
        </div>
        <div class="mech-form-group">
            <label>Horas a añadir</label>
            <input id="ah-horas" type="number" min="0.5" step="0.5" placeholder="Ej: 2.5" />
        </div>
        <p style="font-size:.72rem;color:var(--mech-text-muted);margin:.25rem 0 1rem;">
            Tarifa fija: 12 €/h · Las horas se acumulan al total existente.</p>
        <div id="ah-error" class="mech-modal-error" style="display:none;"></div>
        <div class="mech-btn-group">
            <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-agregar-horas')">
                <i class="ti ti-x"></i> Cancelar
            </button>
            <button type="button" id="ah-submit" class="mech-btn mech-btn-primary"
                onclick="window.ahConfirmar()">
                <i class="ti ti-clock-plus"></i> Añadir horas
            </button>
        </div>`);
    applyFormStyles('modal-agregar-horas');
    openModal('modal-agregar-horas');
};

window.ahConfirmar = async function() {
    const errBox=document.getElementById('ah-error');
    const idRep =parseInt(document.getElementById('ah-rep')?.value);
    const horas =parseFloat(document.getElementById('ah-horas')?.value);
    const btn   =document.getElementById('ah-submit');
    errBox.style.display='none';
    if (!idRep)          {errBox.textContent='Selecciona una reparación.';errBox.style.display='block';return;}
    if (!horas||horas<=0){errBox.textContent='Introduce horas válidas.';errBox.style.display='block';return;}
    btn.disabled=true; btn.innerHTML='<i class="ti ti-loader ti-spin"></i> Guardando…';
    try {
        await api('/reparaciones/add-horas',{method:'POST',body:{id_reparacion:idRep,horas}});
        window.showNotification(`${horas}h añadidas correctamente.`,'success');
        window.closeModal('modal-agregar-horas');
        await cargarReparaciones();
    } catch(e) {
        errBox.textContent='Error: '+e.message; errBox.style.display='block';
        btn.disabled=false; btn.innerHTML='<i class="ti ti-clock-plus"></i> Añadir horas';
    }
};

// ══════════════════════════════════════════════════════════
// MODAL: AÑADIR PIEZAS
// ══════════════════════════════════════════════════════════
window.openAgregarPiezasModal = function(preselId) {
    const MECANICO_ID = getMecanicoId();
    const activas = state.reparaciones.filter(r=>r.estado!=='finalizada');
    const optsRep = activas.map(r=>{
        const c=r.coche||{};
        return `<option value="${r.id_reparacion}" ${r.id_reparacion===preselId?'selected':''}>
            #${r.id_reparacion} · ${c.matricula||'—'} — ${r.motivo||''}</option>`;
    }).join('');
    createModal('modal-agregar-piezas','Añadir piezas utilizadas',`
        <div class="mech-form-group">
            <label>Reparación</label>
            <select id="ap-rep">${optsRep||'<option value="">Sin reparaciones activas</option>'}</select>
        </div>
        <div class="mech-form-group">
            <label>Pieza</label>
            <select id="ap-pieza" onchange="window.apMostrarInfo()">
                <option value="">Cargando catálogo…</option>
            </select>
        </div>
        <div id="ap-pieza-info" style="display:none;margin-bottom:.75rem;padding:.6rem .85rem;
            border-radius:12px;background:var(--mech-surface-2);border:1px solid var(--mech-border);
            font-size:.75rem;">
        </div>
        <div class="mech-form-group">
            <label>Cantidad</label>
            <input id="ap-cantidad" type="number" min="1" step="1" value="1" />
        </div>
        <div id="ap-error" class="mech-modal-error" style="display:none;"></div>
        <div class="mech-btn-group">
            <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-agregar-piezas')">
                <i class="ti ti-x"></i> Cancelar
            </button>
            <button type="button" id="ap-submit" class="mech-btn mech-btn-primary"
                onclick="window.apConfirmar()">
                <i class="ti ti-tool"></i> Añadir pieza
            </button>
        </div>`);
    applyFormStyles('modal-agregar-piezas');
    openModal('modal-agregar-piezas');
    api('/piezas').then(data=>{
        window._apCatalogo = Array.isArray(data)?data:(data.data||[]);
        const sel=document.getElementById('ap-pieza');
        if (!sel) return;
        if (!window._apCatalogo.length){
            sel.innerHTML='<option value="">Sin piezas en catálogo</option>'; return;
        }
        sel.innerHTML='<option value="">— Selecciona pieza —</option>'+
            window._apCatalogo.map(p=>`<option value="${p.id_pieza}"
                data-stock="${p.cantidad_disponible}" data-precio="${p.precio_venta}"
                ${p.cantidad_disponible===0?'disabled':''}>
                ${p.nombre_pieza} · Stock: ${p.cantidad_disponible} · ${parseFloat(p.precio_venta).toFixed(2)} €
                ${p.cantidad_disponible===0?' (Sin stock)':''}
            </option>`).join('');
    }).catch(e=>{
        const sel=document.getElementById('ap-pieza');
        if(sel) sel.innerHTML=`<option>Error: ${e.message}</option>`;
    });
};

window.apMostrarInfo = function() {
    const sel=document.getElementById('ap-pieza');
    const inf=document.getElementById('ap-pieza-info');
    if (!sel||!inf) return;
    const opt=sel.options[sel.selectedIndex];
    if (!opt||!opt.value){inf.style.display='none';return;}
    const stock=parseInt(opt.dataset.stock||0);
    const precio=parseFloat(opt.dataset.precio||0);
    inf.style.display='block';
    inf.innerHTML=`
        <span style="color:var(--mech-text);">Stock disponible: <strong>${stock}</strong></span>
        &nbsp;·&nbsp;
        <span style="color:var(--mech-text);">Precio: <strong>${precio.toFixed(2)} €/ud</strong></span>
        ${stock===0?`<span style="color:var(--mech-error);margin-left:.5rem;">
            <i class="ti ti-alert-triangle"></i> Sin stock</span>`:''}`;
};

window.apConfirmar = async function() {
    const MECANICO_ID = getMecanicoId();
    const errBox   =document.getElementById('ap-error');
    const idRep    =parseInt(document.getElementById('ap-rep')?.value);
    const idPieza  =parseInt(document.getElementById('ap-pieza')?.value);
    const cantidad =parseInt(document.getElementById('ap-cantidad')?.value);
    const btn      =document.getElementById('ap-submit');
    errBox.style.display='none';
    if (!idRep)             {errBox.textContent='Selecciona una reparación.';errBox.style.display='block';return;}
    if (!idPieza)           {errBox.textContent='Selecciona una pieza.';errBox.style.display='block';return;}
    if (!cantidad||cantidad<1){errBox.textContent='La cantidad debe ser al menos 1.';errBox.style.display='block';return;}
    btn.disabled=true; btn.innerHTML='<i class="ti ti-loader ti-spin"></i> Añadiendo…';
    try {
        await api('/reparaciones/add-pieza',{method:'POST',body:{
            id_reparacion:idRep, id_pieza:idPieza, cantidad_usada:cantidad, id_usuario:MECANICO_ID
        }});
        window.showNotification('Pieza añadida y costes actualizados.','success');
        window.closeModal('modal-agregar-piezas');
        await cargarReparaciones();
    } catch(e) {
        errBox.textContent='Error: '+e.message; errBox.style.display='block';
        btn.disabled=false; btn.innerHTML='<i class="ti ti-tool"></i> Añadir pieza';
    }
};

// ══════════════════════════════════════════════════════════
// MODAL: SOLICITAR PIEZAS
// ══════════════════════════════════════════════════════════
window.openSolicitarPiezasModal = function() {
    createModal('modal-solicitar-piezas','Solicitar piezas',`
        <p style="font-size:.8rem;color:var(--mech-text-muted);margin-bottom:1rem;">
            Piezas con stock bajo o agotado. Comunica esta lista a administración.</p>
        <div id="sp-list" style="display:flex;flex-direction:column;gap:.5rem;">
            <span style="color:var(--mech-text-muted);">Cargando inventario…</span>
        </div>
        <div class="mech-btn-group">
            <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-solicitar-piezas')">
                <i class="ti ti-x"></i> Cerrar
            </button>
        </div>`);
    openModal('modal-solicitar-piezas');
    api('/piezas/bajo-minimo').then(data=>{
        const list=document.getElementById('sp-list');
        if (!list) return;
        const piezas=Array.isArray(data)?data:(data.data||[]);
        if (!piezas.length){
            list.innerHTML=`<div style="text-align:center;padding:1.5rem;color:var(--mech-success);">
                <i class="ti ti-circle-check" style="font-size:1.5rem;"></i>
                <p style="margin:.5rem 0 0;color:var(--mech-text);">Todo el stock está en niveles correctos.</p></div>`;
            return;
        }
        list.innerHTML=piezas.map(p=>`
            <div style="display:flex;align-items:center;justify-content:space-between;
                padding:.65rem 1rem;border-radius:12px;background:var(--mech-surface-2);
                border:1px solid var(--mech-border);">
                <div>
                    <p style="font-weight:600;margin:0;font-size:.82rem;color:var(--mech-text);">${p.nombre_pieza}</p>
                    <p style="margin:.1rem 0 0;font-size:.7rem;color:var(--mech-text-muted);">
                        Stock actual: ${p.cantidad_disponible} · Mínimo: ${p.stock_minimo}</p>
                </div>
                <span class="mech-badge ${p.cantidad_disponible===0?'mech-badge-red':'mech-badge-orange'}"
                    style="font-size:.65rem;flex-shrink:0;">
                    ${p.cantidad_disponible===0?'Sin stock':'Bajo mínimo'}</span>
            </div>`).join('');
    }).catch(e=>{
        const list=document.getElementById('sp-list');
        if(list) list.innerHTML=`<span style="color:var(--mech-error);">Error: ${e.message}</span>`;
    });
};

// ══════════════════════════════════════════════════════════
// MODAL: CAMBIAR ESTADO
// ══════════════════════════════════════════════════════════
window.openCambiarEstadoModal = function(idRep) {
    const rep=state.reparaciones.find(r=>r.id_reparacion===idRep);
    if (!rep) return;
    const b=badge(rep.estado);
    const estados=['pendiente','en proceso','finalizada'].filter(e=>e!==rep.estado);
    createModal('modal-cambiar-estado','Cambiar estado',`
        <p style="font-size:.82rem;color:var(--mech-text-muted);margin-bottom:1rem;">
            Reparación <strong style="color:var(--mech-text);">#${idRep}</strong>
            — Estado actual:
            <span class="mech-badge ${b.cls}" style="vertical-align:middle;">
                <i class="ti ${b.icon}"></i>${b.text}</span>
        </p>
        <div style="display:flex;flex-direction:column;gap:.6rem;">
            ${estados.map(e=>{
                const eb=badge(e);
                return `<button class="mech-btn" onclick="window.ceCambiar(${idRep},'${e}')"
                    style="justify-content:flex-start;gap:.75rem;background:var(--mech-surface-2);
                    border:1px solid var(--mech-border);color:var(--mech-text);">
                    <span class="mech-badge ${eb.cls}" style="font-size:.7rem;">
                        <i class="ti ${eb.icon}"></i>${eb.text}</span>
                    Cambiar a <strong>${eb.text}</strong>
                    ${e==='finalizada'?`<span style="margin-left:auto;font-size:.65rem;
                        color:var(--mech-text-muted);">Acción irreversible</span>`:''}
                </button>`;
            }).join('')}
        </div>
        <div id="ce-error" class="mech-modal-error" style="display:none;margin-top:.75rem;"></div>
        <div class="mech-btn-group">
            <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-cambiar-estado')">
                <i class="ti ti-x"></i> Cancelar
            </button>
        </div>`);
    openModal('modal-cambiar-estado');
};

window.ceCambiar = async function(idRep,estado) {
    if (estado==='finalizada'&&!confirm('¿Estás seguro de finalizar esta reparación? No se podrá editar.')) return;
    try {
        await api('/reparaciones/cambiar-estado',{method:'PUT',body:{id_reparacion:idRep,estado}});
        window.showNotification(`Estado cambiado a "${estado}".`,'success');
        window.closeModal('modal-cambiar-estado');
        await cargarReparaciones();
        window.selectReparacion(idRep);
    } catch(e) {
        const err=document.getElementById('ce-error');
        if(err){err.textContent='Error: '+e.message;err.style.display='block';}
        else window.showNotification('Error: '+e.message,'error');
    }
};

// ══════════════════════════════════════════════════════════
// HELPER
// ══════════════════════════════════════════════════════════
function applyFormStyles(modalId) {
    const m = document.getElementById(modalId);
    if (!m) return;
    m.querySelectorAll('.mech-form-group input, .mech-form-group select, .mech-form-group textarea')
     .forEach(() => {});
}

// ══════════════════════════════════════════════════════════
// DISPATCHER + INIT
// ══════════════════════════════════════════════════════════
document.addEventListener('DOMContentLoaded', () => {
    const actionMap = {
        'meter-coche':            ()=>window.openMeterCocheModal(),
        'reparaciones-asignadas': ()=>window.openRepAsignadasModal(),
        'agregar-horas':          ()=>window.openAgregarHorasModal(),
        'agregar-piezas':         ()=>window.openAgregarPiezasModal(),
        'solicitar-piezas':       ()=>window.openSolicitarPiezasModal(),
    };
    document.querySelectorAll('[data-action]').forEach(btn=>{
        btn.addEventListener('click',()=>{ const fn=actionMap[btn.dataset.action]; if(fn) fn(); });
    });
    cargarReparaciones();
});

})();
