@vite(['resources/css/mecanico/mecanico.css'])

@extends('layouts.app')

@section('content')
<div class="mech-page">
    <aside class="mech-sidebar">
        <div class="mech-brand">
            <div class="mech-brand-mark" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 16l4-4 3 3 5-7"/>
                    <path d="M4 20h16"/>
                </svg>
            </div>
            <div class="mech-brand-copy">
                <strong>Talleres RC</strong>
                <span>Panel de mecánico</span>
            </div>
        </div>

        <div class="mech-menu-label">Operación</div>
        <nav class="mech-nav">
            <a href="#" class="active"><i class="ti ti-layout-dashboard"></i><span>Resumen</span></a>
            <a href="#"><i class="ti ti-tool"></i><span>Órdenes</span></a>
            <a href="#"><i class="ti ti-car"></i><span>Vehículos</span></a>
            <a href="#"><i class="ti ti-calendar-event"></i><span>Citas</span></a>
            <a href="#"><i class="ti ti-engine"></i><span>Diagnóstico</span></a>
        </nav>

        <div class="mech-menu-label">Gestión</div>
        <nav class="mech-nav">
            <a href="#"><i class="ti ti-package"></i><span>Recambios</span></a>
            <a href="#"><i class="ti ti-users"></i><span>Clientes</span></a>
            <a href="#"><i class="ti ti-file-invoice"></i><span>Facturación</span></a>
            <a href="#"><i class="ti ti-settings"></i><span>Ajustes</span></a>
        </nav>

        <div class="mech-side-card">
            <span class="mech-badge mech-badge-blue">Tarea crítica</span>
            <h3>3 entregas hoy</h3>
            <p>Dos vehículos están listos para revisión final y uno espera aprobación de piezas.</p>
            <a href="#" class="mech-btn mech-btn-primary"><i class="ti ti-bolt"></i> Abrir cola</a>
        </div>
    </aside>

    <section class="mech-main">
        <header class="mech-header">
            <div class="mech-header-copy">
                <h1>Interfaz de mecánico</h1>
                <p>Mis trabajos, tiempos, diagnosis y entregas del taller en una sola vista.</p>
            </div>

            <div class="mech-header-actions">
                <label class="mech-search">
                    <i class="ti ti-search"></i>
                    <input type="text" placeholder="Buscar matrícula, cliente u orden">
                </label>
                <button type="button" class="mech-icon-btn" aria-label="Notificaciones">
                    <i class="ti ti-bell"></i>
                </button>
                <a href="#" class="mech-btn mech-btn-secondary"><i class="ti ti-scan"></i> Abrir diagnosis</a>
                <a href="#" class="mech-btn mech-btn-primary"><i class="ti ti-plus"></i> Nueva orden</a>
            </div>
        </header>

        <section class="mech-hero-grid">
            <article class="mech-hero-panel">
                <div class="mech-eyebrow"><i class="ti ti-tool"></i> Control de reparaciones</div>
                <h2>Gestión de vehículos y reparaciones</h2>
                <p>Panel operativo para registrar entrada de vehículos, diagnosticar, asignar trabajos y registrar avance de reparaciones en tiempo real.</p>
                <div class="mech-hero-stats">
                    <div class="mech-hero-stat"><strong>8</strong><span>Reparaciones activas</span></div>
                    <div class="mech-hero-stat"><strong>3</strong><span>Pendientes entrada</span></div>
                    <div class="mech-hero-stat"><strong>2</strong><span>Listas para entrega</span></div>
                </div>
            </article>

            <aside class="mech-queue-card">
                <div class="mech-card-head">
                    <div>
                        <h3>Acciones rápidas</h3>
                        <p>Operaciones inmediatas del taller.</p>
                    </div>
                </div>

                <div class="mech-actions-grid">
                    <button class="mech-action-btn" data-action="meter-coche">
                        <i class="ti ti-car-plus"></i>
                        <span>Meter coche</span>
                    </button>
                    <button class="mech-action-btn" data-action="crear-reparacion">
                        <i class="ti ti-file-plus"></i>
                        <span>Nueva reparación</span>
                    </button>
                    <button class="mech-action-btn" data-action="diagnosticar">
                        <i class="ti ti-magnify"></i>
                        <span>Diagnosticar</span>
                    </button>
                    <button class="mech-action-btn" data-action="agregar-horas">
                        <i class="ti ti-clock-plus"></i>
                        <span>Añadir horas</span>
                    </button>
                    <button class="mech-action-btn" data-action="agregar-piezas">
                        <i class="ti ti-package-plus"></i>
                        <span>Añadir piezas</span>
                    </button>
                    <button class="mech-action-btn" data-action="solicitar-piezas">
                        <i class="ti ti-send"></i>
                        <span>Solicitar piezas</span>
                    </button>
                </div>
            </aside>
        </section>

        <section class="mech-kpi-grid">
            <article class="mech-panel">
                <div class="mech-kpi-top">
                    <div>
                        <h3>Estado: Pendiente</h3>
                        <p>Reparaciones sin iniciar</p>
                    </div>
                    <div class="mech-kpi-icon"><i class="ti ti-alert-circle"></i></div>
                </div>
                <div class="mech-kpi-value" id="count-pending">0</div>
                <div class="mech-small-muted">Esperando asignación</div>
            </article>

            <article class="mech-panel">
                <div class="mech-kpi-top">
                    <div>
                        <h3>Estado: En progreso</h3>
                        <p>Reparaciones iniciadas</p>
                    </div>
                    <div class="mech-kpi-icon"><i class="ti ti-player-play"></i></div>
                </div>
                <div class="mech-kpi-value" id="count-inprogress">0</div>
                <div class="mech-small-muted">Trabajo activo</div>
            </article>

            <article class="mech-panel">
                <div class="mech-kpi-top">
                    <div>
                        <h3>Estado: Terminada</h3>
                        <p>Listas para entrega</p>
                    </div>
                    <div class="mech-kpi-icon"><i class="ti ti-check"></i></div>
                </div>
                <div class="mech-kpi-value" id="count-finished">0</div>
                <div class="mech-small-muted">Esperando recogida</div>
            </article>

            <article class="mech-panel">
                <div class="mech-kpi-top">
                    <div>
                        <h3>Piezas pendientes</h3>
                        <p>Solicitadas pero no llegadas</p>
                    </div>
                    <div class="mech-kpi-icon"><i class="ti ti-package-x"></i></div>
                </div>
                <div class="mech-kpi-value" id="count-pending-parts">0</div>
                <div class="mech-small-muted">Bloquean trabajos</div>
            </article>
        </section>

        <section class="mech-content-grid">
            <article class="mech-table-card">
                <div class="mech-card-head mech-card-head-start">
                    <div>
                        <h3>Reparaciones activas</h3>
                        <p>Listado de todos los trabajos en el taller.</p>
                    </div>
                </div>

                <div class="mech-table-wrap">
                    <table class="mech-table" id="reparaciones-table">
                        <thead>
                            <tr>
                                <th>Vehículo</th>
                                <th>Motivo de reparación</th>
                                <th>Estado</th>
                                <th>Horas</th>
                                <th>Piezas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-reparaciones">
                            <tr class="mech-empty-row">
                                <td colspan="6" style="text-align: center; padding: 2rem;">
                                    <p class="mech-small-muted">No hay reparaciones registradas. Comienza por <strong>meter un coche</strong>.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </article>

            <aside class="mech-timeline-card">
                <h3>Detalles de reparación</h3>
                <p>Información de la reparación seleccionada.</p>
                <div id="reparacion-detalle" class="mech-detalle-reparacion">
                    <p class="mech-small-muted">Selecciona una reparación de la tabla para ver detalles.</p>
                </div>
            </aside>
        </section>

        <!-- Sección Bottom Grid removida: Plan del taller y Recambios no necesarios para las funcionalidades solicitadas -->

    </section>
</div>

<nav class="mech-mobile-bar" aria-label="Navegación móvil">
    <a href="#" class="active"><i class="ti ti-layout-dashboard"></i><span>Inicio</span></a>
    <a href="#"><i class="ti ti-tool"></i><span>Órdenes</span></a>
    <a href="#"><i class="ti ti-car"></i><span>Vehículos</span></a>
    <a href="#"><i class="ti ti-calendar-event"></i><span>Citas</span></a>
</nav>

<style>
    .mech-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .mech-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 1rem;
        background: var(--color-bg-secondary, #1f2937);
        border: 1px solid var(--color-border, #374151);
        border-radius: 0.5rem;
        color: var(--color-text, #f3f4f6);
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .mech-action-btn:hover {
        background: var(--color-primary, #3b82f6);
        border-color: var(--color-primary, #3b82f6);
        transform: translateY(-2px);
    }

    .mech-action-btn i {
        font-size: 1.5rem;
    }

    .mech-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        animation: fadeIn 0.3s ease;
    }

    .mech-modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .mech-modal-content {
        background: var(--color-bg-primary, #111827);
        border-radius: 0.75rem;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
        border: 1px solid var(--color-border, #374151);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .mech-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid var(--color-border, #374151);
        padding-bottom: 1rem;
    }

    .mech-modal-header h2 {
        font-size: 1.5rem;
        margin: 0;
    }

    .mech-close-btn {
        background: none;
        border: none;
        color: var(--color-text, #f3f4f6);
        font-size: 1.5rem;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.2s;
    }

    .mech-close-btn:hover {
        opacity: 1;
    }

    .mech-form-group {
        margin-bottom: 1.5rem;
    }

    .mech-form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--color-text, #f3f4f6);
    }

    .mech-form-group input,
    .mech-form-group select,
    .mech-form-group textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--color-border, #374151);
        border-radius: 0.375rem;
        background: var(--color-bg-secondary, #1f2937);
        color: var(--color-text, #f3f4f6);
        font-family: inherit;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    .mech-form-group input:focus,
    .mech-form-group select:focus,
    .mech-form-group textarea:focus {
        outline: none;
        border-color: var(--color-primary, #3b82f6);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .mech-btn-group {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
    }

    .mech-btn-cancel {
        background: var(--color-bg-secondary, #1f2937);
        border: 1px solid var(--color-border, #374151);
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        color: var(--color-text, #f3f4f6);
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .mech-btn-cancel:hover {
        background: var(--color-bg-tertiary, #111827);
    }

    .mech-detalle-reparacion {
        padding: 1rem 0;
    }

    .mech-detail-section {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--color-border, #374151);
    }

    .mech-detail-section h4 {
        margin: 0 0 0.75rem 0;
        color: var(--color-text, #f3f4f6);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .mech-detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .mech-detail-label {
        color: var(--color-text-secondary, #9ca3af);
    }

    .mech-detail-value {
        font-weight: 500;
        color: var(--color-text, #f3f4f6);
    }

    .mech-action-row {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .mech-action-row button {
        flex: 1;
        min-width: 100px;
        padding: 0.5rem;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .mech-status-badge-pending { background: #f59e0b; color: black; }
    .mech-status-badge-inprogress { background: #3b82f6; color: white; }
    .mech-status-badge-finished { background: #10b981; color: white; }

    .mech-empty-row { color: var(--color-text-secondary, #9ca3af); }
</style>

<script>
(() => {
    // ============ TEMA OSCURO POR DEFECTO ============
    const root = document.documentElement;
    root.setAttribute('data-theme', 'dark');

    // ============ MOCK DATA ============
    const mockData = {
        reparaciones: [
            { id: 1, matricula: '4821 MXS', marca: 'Seat', modelo: 'León FR', motivo: 'Cambio de distribución', estado: 'in_progress', horas: 4.5, piezas: ['Correa de distribución', 'Juntas'], piezasPendientes: [] },
            { id: 2, matricula: '7718 LPT', marca: 'VW', modelo: 'Golf', motivo: 'Diagnosis ABS', estado: 'pending', horas: 1.0, piezas: [], piezasPendientes: ['Sensor ABS delantero'] },
            { id: 3, matricula: '1942 KBN', marca: 'Peugeot', modelo: '308', motivo: 'Mantenimiento 90.000 km', estado: 'finished', horas: 2.5, piezas: ['Filtro aceite', 'Filtro aire', 'Aceite 5W30'], piezasPendientes: [] }
        ]
    };

    // ============ HELPERS ============
    function getEstadoBadge(estado) {
        const map = {
            'pending': { text: 'Pendiente', class: 'mech-badge-orange' },
            'in_progress': { text: 'En progreso', class: 'mech-badge-blue' },
            'finished': { text: 'Terminada', class: 'mech-badge-green' }
        };
        return map[estado] || map['pending'];
    }

    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed; top: 1rem; right: 1rem; z-index: 2000;
            padding: 1rem 1.5rem; border-radius: 0.5rem; color: white;
            background: ${type === 'success' ? '#10b981' : '#ef4444'};
            animation: slideIn 0.3s ease;
        `;
        notification.textContent = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 3000);
    }

    // ============ RENDER FUNCTIONS ============
    function renderReparaciones() {
        const tbody = document.getElementById('tabla-reparaciones');
        
        if (mockData.reparaciones.length === 0) {
            tbody.innerHTML = '<tr class="mech-empty-row"><td colspan="6" style="text-align: center; padding: 2rem;"><p class="mech-small-muted">No hay reparaciones registradas.</p></td></tr>';
            return;
        }

        tbody.innerHTML = mockData.reparaciones.map(rep => {
            const badge = getEstadoBadge(rep.estado);
            return `
                <tr onclick="window.selectReparacion(${rep.id})">
                    <td><strong>${rep.marca} ${rep.modelo}</strong><div class="mech-muted">${rep.matricula}</div></td>
                    <td>${rep.motivo}</td>
                    <td><span class="mech-badge ${badge.class}">${badge.text}</span></td>
                    <td>${rep.horas.toFixed(1)} h</td>
                    <td><span class="mech-badge mech-badge-blue">${rep.piezas.length}</span></td>
                    <td>
                        <button class="mech-btn mech-btn-secondary" onclick="window.editarReparacion(event, ${rep.id})" style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">
                            <i class="ti ti-edit"></i> Editar
                        </button>
                    </td>
                </tr>
            `;
        }).join('');

        // Update KPI counters
        const counts = mockData.reparaciones.reduce((acc, rep) => {
            acc[rep.estado === 'pending' ? 'pending' : rep.estado === 'in_progress' ? 'inprogress' : 'finished']++;
            acc.pendingParts += rep.piezasPendientes.length;
            return acc;
        }, { pending: 0, inprogress: 0, finished: 0, pendingParts: 0 });

        document.getElementById('count-pending').textContent = counts.pending;
        document.getElementById('count-inprogress').textContent = counts.inprogress;
        document.getElementById('count-finished').textContent = counts.finished;
        document.getElementById('count-pending-parts').textContent = counts.pendingParts;
    }

    window.selectReparacion = function(id) {
        const rep = mockData.reparaciones.find(r => r.id === id);
        if (!rep) return;

        const detalle = document.getElementById('reparacion-detalle');
        detalle.innerHTML = `
            <div class="mech-detail-section">
                <h4><i class="ti ti-car"></i> Vehículo</h4>
                <div class="mech-detail-row">
                    <span class="mech-detail-label">Matrícula:</span>
                    <span class="mech-detail-value">${rep.matricula}</span>
                </div>
                <div class="mech-detail-row">
                    <span class="mech-detail-label">Modelo:</span>
                    <span class="mech-detail-value">${rep.marca} ${rep.modelo}</span>
                </div>
            </div>

            <div class="mech-detail-section">
                <h4><i class="ti ti-tool"></i> Reparación</h4>
                <div class="mech-detail-row">
                    <span class="mech-detail-label">Motivo:</span>
                    <span class="mech-detail-value">${rep.motivo}</span>
                </div>
                <div class="mech-detail-row">
                    <span class="mech-detail-label">Estado:</span>
                    <span class="mech-detail-value">${getEstadoBadge(rep.estado).text}</span>
                </div>
                <div class="mech-detail-row">
                    <span class="mech-detail-label">Horas trabajadas:</span>
                    <span class="mech-detail-value">${rep.horas.toFixed(1)} h</span>
                </div>
            </div>

            <div class="mech-detail-section">
                <h4><i class="ti ti-package"></i> Piezas (${rep.piezas.length})</h4>
                ${rep.piezas.length > 0 
                    ? rep.piezas.map(p => `<div class="mech-detail-row"><span class="mech-detail-label">✓</span><span class="mech-detail-value">${p}</span></div>`).join('')
                    : '<p class="mech-small-muted">Sin piezas registradas</p>'
                }
            </div>

            ${rep.piezasPendientes.length > 0 ? `
                <div class="mech-detail-section">
                    <h4><i class="ti ti-alert-circle"></i> Piezas Pendientes (${rep.piezasPendientes.length})</h4>
                    ${rep.piezasPendientes.map(p => `<div class="mech-detail-row"><span class="mech-detail-label">⏳</span><span class="mech-detail-value">${p}</span></div>`).join('')}
                </div>
            ` : ''}

            <div class="mech-detail-section" style="border-bottom: none;">
                <h4><i class="ti ti-list-check"></i> Acciones</h4>
                <div class="mech-action-row">
                    <button class="mech-btn mech-btn-primary" onclick="window.cambiarEstado(${rep.id})">Cambiar estado</button>
                    <button class="mech-btn mech-btn-secondary" onclick="window.finalizarReparacion(${rep.id})">Finalizar</button>
                </div>
            </div>
        `;
    };

    window.editarReparacion = function(e, id) {
        e.stopPropagation();
        window.showModal('editar-reparacion');
        window.currentReparacionId = id;
    };

    // ============ MODAL MANAGEMENT ============
    function createModal(id, title, content, actions) {
        let modal = document.getElementById(id);
        if (!modal) {
            modal = document.createElement('div');
            modal.id = id;
            modal.className = 'mech-modal';
            modal.innerHTML = `
                <div class="mech-modal-content">
                    <div class="mech-modal-header">
                        <h2>${title}</h2>
                        <button class="mech-close-btn" onclick="window.closeModal('${id}')">✕</button>
                    </div>
                    <div id="${id}-body">${content}</div>
                </div>
            `;
            document.body.appendChild(modal);
        }
        return modal;
    }

    window.showModal = function(modalId) {
        const modals = {
            'meter-coche': () => createModal('meter-coche', 'Meter coche al taller', `
                <form onsubmit="window.submitMeterCoche(event)">
                    <div class="mech-form-group">
                        <label>Matrícula *</label>
                        <input type="text" id="matricula" placeholder="Ej: 4821 MXS" required>
                    </div>
                    <div class="mech-form-group">
                        <label>Marca *</label>
                        <input type="text" id="marca" placeholder="Ej: Seat" required>
                    </div>
                    <div class="mech-form-group">
                        <label>Modelo *</label>
                        <input type="text" id="modelo" placeholder="Ej: León FR" required>
                    </div>
                    <div class="mech-form-group">
                        <label>Motivo de entrada *</label>
                        <input type="text" id="motivo" placeholder="Ej: Revisión completa" required>
                    </div>
                    <div class="mech-btn-group">
                        <button type="button" class="mech-btn-cancel" onclick="window.closeModal('meter-coche')">Cancelar</button>
                        <button type="submit" class="mech-btn mech-btn-primary">Meter coche</button>
                    </div>
                </form>
            `),

            'crear-reparacion': () => createModal('crear-reparacion', 'Crear nueva reparación', `
                <form onsubmit="window.submitCrearReparacion(event)">
                    <div class="mech-form-group">
                        <label>Vehículo *</label>
                        <select id="vehiculo-select" required>
                            <option value="">Selecciona un vehículo</option>
                            ${mockData.reparaciones.map(r => `<option value="${r.id}">${r.marca} ${r.modelo} (${r.matricula})</option>`).join('')}
                        </select>
                    </div>
                    <div class="mech-form-group">
                        <label>Motivo de reparación *</label>
                        <textarea id="motivo-rep" placeholder="Describe el trabajo a realizar" required></textarea>
                    </div>
                    <div class="mech-form-group">
                        <label>Estado inicial</label>
                        <select id="estado-inicial">
                            <option value="pending">Pendiente</option>
                            <option value="in_progress">En progreso</option>
                        </select>
                    </div>
                    <div class="mech-btn-group">
                        <button type="button" class="mech-btn-cancel" onclick="window.closeModal('crear-reparacion')">Cancelar</button>
                        <button type="submit" class="mech-btn mech-btn-primary">Crear reparación</button>
                    </div>
                </form>
            `),

            'diagnosticar': () => createModal('diagnosticar', 'Diagnosticar vehículo', `
                <form onsubmit="window.submitDiagnosticar(event)">
                    <div class="mech-form-group">
                        <label>Vehículo *</label>
                        <select id="vehiculo-diag" required>
                            <option value="">Selecciona un vehículo</option>
                            ${mockData.reparaciones.map(r => `<option value="${r.id}">${r.marca} ${r.modelo} (${r.matricula})</option>`).join('')}
                        </select>
                    </div>
                    <div class="mech-form-group">
                        <label>Hallazgos del diagnóstico *</label>
                        <textarea id="diagnostico" placeholder="Describe los problemas encontrados y componentes inspeccionados" required></textarea>
                    </div>
                    <div class="mech-form-group">
                        <label>Recomendaciones</label>
                        <textarea id="recomendaciones" placeholder="Acciones recomendadas"></textarea>
                    </div>
                    <div class="mech-btn-group">
                        <button type="button" class="mech-btn-cancel" onclick="window.closeModal('diagnosticar')">Cancelar</button>
                        <button type="submit" class="mech-btn mech-btn-primary">Registrar diagnóstico</button>
                    </div>
                </form>
            `),

            'agregar-horas': () => createModal('agregar-horas', 'Añadir horas de trabajo', `
                <form onsubmit="window.submitAgregarHoras(event)">
                    <div class="mech-form-group">
                        <label>Vehículo *</label>
                        <select id="vehiculo-horas" required>
                            <option value="">Selecciona un vehículo</option>
                            ${mockData.reparaciones.map(r => `<option value="${r.id}">${r.marca} ${r.modelo} (${r.matricula})</option>`).join('')}
                        </select>
                    </div>
                    <div class="mech-form-group">
                        <label>Horas trabajadas *</label>
                        <input type="number" id="horas-value" placeholder="Ej: 2.5" step="0.5" min="0.5" required>
                    </div>
                    <div class="mech-form-group">
                        <label>Descripción del trabajo</label>
                        <textarea id="descripcion-trabajo" placeholder="Qué trabajo se realizó"></textarea>
                    </div>
                    <div class="mech-btn-group">
                        <button type="button" class="mech-btn-cancel" onclick="window.closeModal('agregar-horas')">Cancelar</button>
                        <button type="submit" class="mech-btn mech-btn-primary">Registrar horas</button>
                    </div>
                </form>
            `),

            'agregar-piezas': () => createModal('agregar-piezas', 'Añadir piezas utilizadas', `
                <form onsubmit="window.submitAgregarPiezas(event)">
                    <div class="mech-form-group">
                        <label>Vehículo *</label>
                        <select id="vehiculo-piezas" required>
                            <option value="">Selecciona un vehículo</option>
                            ${mockData.reparaciones.map(r => `<option value="${r.id}">${r.marca} ${r.modelo} (${r.matricula})</option>`).join('')}
                        </select>
                    </div>
                    <div class="mech-form-group">
                        <label>Nombre de la pieza *</label>
                        <input type="text" id="nombre-pieza" placeholder="Ej: Filtro de aceite" required>
                    </div>
                    <div class="mech-form-group">
                        <label>Cantidad *</label>
                        <input type="number" id="cantidad-pieza" placeholder="1" min="1" value="1" required>
                    </div>
                    <div class="mech-form-group">
                        <label>Referencia/Código</label>
                        <input type="text" id="referencia-pieza" placeholder="Opcional">
                    </div>
                    <div class="mech-btn-group">
                        <button type="button" class="mech-btn-cancel" onclick="window.closeModal('agregar-piezas')">Cancelar</button>
                        <button type="submit" class="mech-btn mech-btn-primary">Añadir pieza</button>
                    </div>
                </form>
            `),

            'solicitar-piezas': () => createModal('solicitar-piezas', 'Solicitar piezas faltantes', `
                <form onsubmit="window.submitSolicitarPiezas(event)">
                    <div class="mech-form-group">
                        <label>Vehículo *</label>
                        <select id="vehiculo-solicitud" required>
                            <option value="">Selecciona un vehículo</option>
                            ${mockData.reparaciones.map(r => `<option value="${r.id}">${r.marca} ${r.modelo} (${r.matricula})</option>`).join('')}
                        </select>
                    </div>
                    <div class="mech-form-group">
                        <label>Pieza requerida *</label>
                        <input type="text" id="pieza-solicitada" placeholder="Ej: Sensor ABS delantero" required>
                    </div>
                    <div class="mech-form-group">
                        <label>Referencia/Código *</label>
                        <input type="text" id="referencia-solicitud" placeholder="Código del fabricante" required>
                    </div>
                    <div class="mech-form-group">
                        <label>Proveedor (opcional)</label>
                        <input type="text" id="proveedor-solicitud" placeholder="Ej: AutoParts SA">
                    </div>
                    <div class="mech-btn-group">
                        <button type="button" class="mech-btn-cancel" onclick="window.closeModal('solicitar-piezas')">Cancelar</button>
                        <button type="submit" class="mech-btn mech-btn-primary">Solicitar pieza</button>
                    </div>
                </form>
            `)
        };

        if (modals[modalId]) {
            const modal = modals[modalId]();
            modal.classList.add('show');
        }
    };

    window.closeModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('show');
            setTimeout(() => {
                if (modal.parentNode) modal.parentNode.removeChild(modal);
            }, 300);
        }
    };

    // ============ FORM SUBMISSIONS ============
    window.submitMeterCoche = function(e) {
        e.preventDefault();
        const matricula = document.getElementById('matricula').value;
        const marca = document.getElementById('marca').value;
        const modelo = document.getElementById('modelo').value;
        const motivo = document.getElementById('motivo').value;

        mockData.reparaciones.push({
            id: Math.max(...mockData.reparaciones.map(r => r.id)) + 1,
            matricula, marca, modelo,
            motivo,
            estado: 'pending',
            horas: 0,
            piezas: [],
            piezasPendientes: []
        });

        window.closeModal('meter-coche');
        renderReparaciones();
        showNotification('✓ Coche registrado correctamente');
    };

    window.submitCrearReparacion = function(e) {
        e.preventDefault();
        showNotification('✓ Reparación creada y asignada');
        window.closeModal('crear-reparacion');
    };

    window.submitDiagnosticar = function(e) {
        e.preventDefault();
        showNotification('✓ Diagnóstico registrado completamente');
        window.closeModal('diagnosticar');
    };

    window.submitAgregarHoras = function(e) {
        e.preventDefault();
        const vehiculoId = parseInt(document.getElementById('vehiculo-horas').value);
        const horas = parseFloat(document.getElementById('horas-value').value);
        const rep = mockData.reparaciones.find(r => r.id === vehiculoId);
        if (rep) {
            rep.horas += horas;
            renderReparaciones();
        }
        window.closeModal('agregar-horas');
        showNotification('✓ Horas de trabajo registradas');
    };

    window.submitAgregarPiezas = function(e) {
        e.preventDefault();
        const vehiculoId = parseInt(document.getElementById('vehiculo-piezas').value);
        const nombrePieza = document.getElementById('nombre-pieza').value;
        const rep = mockData.reparaciones.find(r => r.id === vehiculoId);
        if (rep) {
            rep.piezas.push(nombrePieza);
            renderReparaciones();
        }
        window.closeModal('agregar-piezas');
        showNotification('✓ Pieza añadida al registro');
    };

    window.submitSolicitarPiezas = function(e) {
        e.preventDefault();
        const vehiculoId = parseInt(document.getElementById('vehiculo-solicitud').value);
        const pieza = document.getElementById('pieza-solicitada').value;
        const rep = mockData.reparaciones.find(r => r.id === vehiculoId);
        if (rep) {
            if (!rep.piezasPendientes.includes(pieza)) {
                rep.piezasPendientes.push(pieza);
                renderReparaciones();
            }
        }
        window.closeModal('solicitar-piezas');
        showNotification('✓ Pieza solicitada al proveedor');
    };

    // ============ ESTADO Y FINALIZACIÓN ============
    window.cambiarEstado = function(repId) {
        const rep = mockData.reparaciones.find(r => r.id === repId);
        if (!rep) return;

        const estadoOptions = {
            'pending': 'in_progress',
            'in_progress': 'finished',
            'finished': 'pending'
        };

        const estados = [
            { value: 'pending', text: 'Pendiente', icon: 'alert-circle' },
            { value: 'in_progress', text: 'En progreso', icon: 'player-play' },
            { value: 'finished', text: 'Terminada', icon: 'check' }
        ];

        const modal = createModal('cambiar-estado-modal', 'Cambiar estado de reparación', `
            <form onsubmit="window.submitCambiarEstado(event, ${repId})">
                <div class="mech-form-group">
                    <label>Nuevo estado *</label>
                    <select id="nuevo-estado" required>
                        ${estados.map(e => `<option value="${e.value}" ${rep.estado === e.value ? 'selected' : ''}><i class="ti ti-${e.icon}"></i> ${e.text}</option>`).join('')}
                    </select>
                </div>
                <div class="mech-form-group">
                    <label>Notas del cambio</label>
                    <textarea id="notas-cambio" placeholder="Describe por qué cambias el estado"></textarea>
                </div>
                <div class="mech-btn-group">
                    <button type="button" class="mech-btn-cancel" onclick="window.closeModal('cambiar-estado-modal')">Cancelar</button>
                    <button type="submit" class="mech-btn mech-btn-primary">Cambiar estado</button>
                </div>
            </form>
        `);
        modal.classList.add('show');
    };

    window.submitCambiarEstado = function(e, repId) {
        e.preventDefault();
        const nuevoEstado = document.getElementById('nuevo-estado').value;
        const rep = mockData.reparaciones.find(r => r.id === repId);
        if (rep) {
            rep.estado = nuevoEstado;
            renderReparaciones();
            window.selectReparacion(repId);
        }
        window.closeModal('cambiar-estado-modal');
        showNotification('✓ Estado actualizado correctamente');
    };

    window.finalizarReparacion = function(repId) {
        const rep = mockData.reparaciones.find(r => r.id === repId);
        if (!rep) return;

        const modal = createModal('finalizar-modal', 'Finalizar reparación y sacar coche', `
            <form onsubmit="window.submitFinalizarReparacion(event, ${repId})">
                <div class="mech-form-group">
                    <label><strong>Vehículo: ${rep.marca} ${rep.modelo} (${rep.matricula})</strong></label>
                </div>
                <div class="mech-form-group">
                    <label>Verificar datos finales</label>
                    <div style="background: var(--color-bg-secondary, #1f2937); padding: 1rem; border-radius: 0.375rem; margin: 0.5rem 0;">
                        <div class="mech-detail-row">
                            <span class="mech-detail-label">Total de horas:</span>
                            <span class="mech-detail-value">${rep.horas.toFixed(1)} h</span>
                        </div>
                        <div class="mech-detail-row">
                            <span class="mech-detail-label">Piezas utilizadas:</span>
                            <span class="mech-detail-value">${rep.piezas.length}</span>
                        </div>
                        <div class="mech-detail-row">
                            <span class="mech-detail-label">Estado actual:</span>
                            <span class="mech-detail-value">${getEstadoBadge(rep.estado).text}</span>
                        </div>
                    </div>
                </div>
                <div class="mech-form-group">
                    <label>Observaciones finales</label>
                    <textarea id="observaciones-finales" placeholder="Notas de entrega, trabajo adicional realizado, etc."></textarea>
                </div>
                <div class="mech-form-group">
                    <label><input type="checkbox" id="confirmar-entrega" required> Confirmar que el vehículo está listo para entregar</label>
                </div>
                <div class="mech-btn-group">
                    <button type="button" class="mech-btn-cancel" onclick="window.closeModal('finalizar-modal')">Cancelar</button>
                    <button type="submit" class="mech-btn mech-btn-primary">Finalizar y sacar coche</button>
                </div>
            </form>
        `);
        modal.classList.add('show');
    };

    window.submitFinalizarReparacion = function(e, repId) {
        e.preventDefault();
        const rep = mockData.reparaciones.find(r => r.id === repId);
        if (rep) {
            rep.estado = 'finished';
            renderReparaciones();
        }
        window.closeModal('finalizar-modal');
        showNotification('✓ Reparación finalizada. Coche listo para entrega.');
    };


    // ============ ACTION LISTENERS ============
    document.querySelectorAll('[data-action]').forEach(btn => {
        btn.addEventListener('click', () => {
            window.showModal(btn.dataset.action);
        });
    });

    // Initial render
    renderReparaciones();
})();
</script>
@endsection
