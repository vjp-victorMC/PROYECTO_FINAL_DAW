@vite(['resources/css/mecanico/mecanico.css','resources/js/mecanico/mecanico.js'])

@extends('layouts.app')

@section('content')
<div class="mech-page">



    {{-- ── ÁREA PRINCIPAL ───────────────────────────────────── --}}
    <section class="mech-main">
        @auth
        <header class="mech-header">
            <div class="mech-header-copy">
                <h1>Bienvenido, {{ Auth::user()->nombre }}</h1>
                <p>Mis trabajos, tiempos, diagnosis y entregas del taller.</p>
            </div>
            <div class="mech-header-badge">
                <span class="mech-badge mech-badge-blue"><i class="ti ti-user"></i> Mecánico</span>
            </div>
        </header>
        @endauth

        {{-- Hero --}}
        <section class="mech-hero-grid">
            <article class="mech-hero-panel">
                {{-- Imagen decorativa: sustituye src por una imagen real del taller --}}
                <img
                    src="https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=700&q=80"
                    alt="Mecánico trabajando en el taller"
                    class="mech-hero-img"
                    loading="lazy"
                    onerror="this.style.display='none'">
                <div class="mech-eyebrow"><i class="ti ti-tool"></i> Control de reparaciones</div>
                <h2>Gestión de vehículos<br>y reparaciones</h2>
                <p>Panel operativo para registrar entrada de vehículos, diagnosticar y registrar avance en tiempo real.</p>
                <div class="mech-hero-stats">
                    <div class="mech-hero-stat"><strong id="hero-active">0</strong><span>Activas</span></div>
                    <div class="mech-hero-stat"><strong id="hero-pending">0</strong><span>Pendientes</span></div>
                    <div class="mech-hero-stat"><strong id="hero-ready">0</strong><span>Para entrega</span></div>
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
                        <i class="ti ti-car-garage"></i>
                        <span>Meter coche</span>
                    </button>
                    <button class="mech-action-btn" data-action="reparaciones-asignadas">
                        <i class="ti ti-file-check"></i>
                        <span>Reparaciones</span>
                    </button>
                    <button class="mech-action-btn" data-action="agregar-horas">
                        <i class="ti ti-clock-plus"></i>
                        <span>Añadir horas</span>
                    </button>
                    <button class="mech-action-btn" data-action="agregar-piezas">
                        <i class="ti ti-tool"></i>
                        <span>Añadir piezas</span>
                    </button>
                    <button class="mech-action-btn" data-action="solicitar-piezas">
                        <i class="ti ti-package"></i>
                        <span>Solicitar piezas</span>
                    </button>
                </div>
            </aside>
        </section>

        {{-- KPIs --}}
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
                <div class="mech-small-muted">Esperando inicio</div>
            </article>
            <article class="mech-panel">
                <div class="mech-kpi-top">
                    <div>
                        <h3>Estado: En proceso</h3>
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
                        <h3>Estado: Finalizada</h3>
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
                        <p>Solicitadas, no llegadas</p>
                    </div>
                    <div class="mech-kpi-icon"><i class="ti ti-package-x"></i></div>
                </div>
                <div class="mech-kpi-value" id="count-pending-parts">0</div>
                <div class="mech-small-muted">Bloquean trabajos</div>
            </article>
        </section>

        {{-- Tabla + detalle --}}
        <section class="mech-content-grid">
            <article class="mech-table-card">
                <div class="mech-card-head mech-card-head-start" style="padding: 1rem 1.25rem .5rem;">
                    <div>
                        <h3 style="letter-spacing:-.03em;">Reparaciones activas</h3>
                        <p>Listado de trabajos en curso en el taller.</p>
                    </div>
                    <span class="mech-badge mech-badge-blue" id="badge-total-reps" style="flex-shrink:0;">0 órdenes</span>
                </div>
                <div class="mech-table-wrap">
                    <table class="mech-table" id="reparaciones-table">
                        <thead>
                            <tr>
                                <th><i class="ti ti-car" style="margin-right:.35rem;opacity:.6;"></i>Vehículo</th>
                                <th>Motivo</th>
                                <th>Estado</th>
                                <th style="text-align:center;">Horas</th>
                                <th style="text-align:center;">Piezas</th>
                                <th style="text-align:right;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-reparaciones">
                            <tr class="mech-empty-row">
                                <td colspan="6" style="text-align:center;padding:2rem;">
                                    <p class="mech-small-muted">No hay reparaciones. Comienza por <strong>meter un coche</strong>.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </article>

            <aside class="mech-timeline-card">
                <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.25rem;">
                    <div style="width:36px;height:36px;border-radius:11px;background:var(--mech-surface-offset);display:grid;place-items:center;color:var(--mech-primary);font-size:1rem;border:1px solid var(--mech-border);">
                        <i class="ti ti-info-circle"></i>
                    </div>
                    <div>
                        <h3>Detalle de reparación</h3>
                        <p style="font-size:.7rem;color:var(--mech-text-faint);margin:0;">Selecciona una fila de la tabla</p>
                    </div>
                </div>
                <div style="height:1px;background:var(--mech-divider);margin:.85rem 0 1rem;"></div>
                <div id="reparacion-detalle" class="mech-detalle-reparacion">
                    <div style="display:flex;flex-direction:column;align-items:center;text-align:center;padding:1.5rem 0;">
                        <div style="width:52px;height:52px;border-radius:16px;background:var(--mech-surface-offset);display:grid;place-items:center;color:var(--mech-text-faint);font-size:1.5rem;margin-bottom:.75rem;border:1px solid var(--mech-border);">
                            <i class="ti ti-clipboard"></i>
                        </div>
                        <p style="font-weight:600;font-size:var(--mech-text-xs);color:var(--mech-text-muted);">Ninguna reparación seleccionada</p>
                    </div>
                </div>
            </aside>
        </section>

    </section>
</div>

{{-- Nav móvil --}}
<nav class="mech-mobile-bar" aria-label="Navegación móvil">
    <a href="#" class="active"><i class="ti ti-layout-dashboard"></i><span>Inicio</span></a>
    <a href="#"><i class="ti ti-tool"></i><span>Órdenes</span></a>
    <a href="#"><i class="ti ti-car"></i><span>Vehículos</span></a>
    <a href="#"><i class="ti ti-calendar-event"></i><span>Citas</span></a>
</nav>


<!-- Modal 'Meter coche' eliminado (UI y modal removidos) -->


{{-- ============================================================
    MODAL 2: REPARACIONES ASIGNADAS (wrapper recuperado)
    ============================================================ --}}
<div class="mech-modal" id="modal-rep-asignadas" role="dialog" aria-modal="true" aria-labelledby="modal-ra-title">
    <div class="mech-modal-content modal-wide">
        <div class="mech-modal-header">
            <div class="mech-modal-header-left">
                <div class="mech-modal-icon"><i class="ti ti-file-check"></i></div>
                <div>
                    <h2 id="modal-ra-title">Reparaciones asignadas</h2>
                    <p class="mech-modal-subtitle">Gestiona tus órdenes de trabajo</p>
                </div>
            </div>
            <button class="mech-close-btn" onclick="window.closeModal('modal-rep-asignadas')" aria-label="Cerrar">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M18 6L6 18"></path>
                    <path d="M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="mech-modal-body">
            {{-- Filtros de estado --}}
            <div class="mech-modal-filters" style="margin-bottom:1rem;">
                <button class="ra-filter-btn active" data-filter="todos" onclick="window.raFiltrar('todos')">Todas</button>
                <button class="ra-filter-btn" data-filter="pendiente" onclick="window.raFiltrar('pendiente')">
                    <i class="ti ti-alert-circle"></i> Pendientes
                </button>
                <button class="ra-filter-btn" data-filter="en proceso" onclick="window.raFiltrar('en proceso')">
                    <i class="ti ti-player-play"></i> En proceso
                </button>
                <button class="ra-filter-btn" data-filter="finalizada" onclick="window.raFiltrar('finalizada')">
                    <i class="ti ti-check"></i> Finalizadas
                </button>
            </div>

            {{-- Buscador --}}
            <div style="margin-bottom:1rem;">
                <label class="mech-modal-search" style="width:100%;border-radius:12px;">
                    <i class="ti ti-search"></i>
                    <input type="text" id="ra-search" placeholder="Buscar por matrícula, cliente o motivo…"
                        oninput="window.raBuscar(this.value)" autocomplete="off">
                </label>
            </div>

            {{-- Lista --}}
            <div id="ra-list-wrap" style="margin-bottom:1rem;">
                <div id="ra-list">
                    <div style="text-align:center;padding:2rem;">
                        <p class="mech-small-muted" style="display:flex;align-items:center;justify-content:center;gap:.5rem;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" style="animation:mech-spin .7s linear infinite;">
                                <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                            </svg>
                            Cargando reparaciones…
                        </p>
                    </div>
                </div>
            </div>

            {{-- Panel de acciones (se muestra al seleccionar) --}}
            <div id="ra-actions-panel" style="display:none;">

                {{-- Info reparación seleccionada --}}
                <div id="ra-selected-info" class="mech-detalle-reparacion" style="display:flex;align-items:center;gap:.75rem;">
                    <div id="ra-sel-mark" style="
                        width:42px;height:42px;border-radius:12px;
                        background:rgba(77,148,255,.2);display:grid;place-items:center;
                        flex-shrink:0;color:var(--mech-primary);font-weight:800;font-size:.85rem;">--</div>
                    <div style="flex:1;min-width:0;">
                        <p id="ra-sel-nombre" style="font-weight:700;margin:0;font-size:var(--mech-text-sm);
                            white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"></p>
                        <p id="ra-sel-meta" style="margin:2px 0 0;font-size:var(--mech-text-xs);
                            color:var(--mech-text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"></p>
                        <p id="ra-sel-fechas" style="margin:3px 0 0;font-size:var(--mech-text-xs);color:var(--mech-text-faint);"></p>
                    </div>
                    <div id="ra-sel-badge" style="flex-shrink:0;"></div>
                </div>

                {{-- Botones de acción de estado --}}
                <p style="font-size:var(--mech-text-xs);font-weight:700;color:var(--mech-text-muted);
                           text-transform:uppercase;letter-spacing:.08em;margin-bottom:.6rem;margin-top:1rem;">
                    Cambiar estado
                </p>
                <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:1rem;" id="ra-estado-btns">
                    <button id="ra-btn-iniciar" onclick="window.raCambiarEstado('en proceso')" class="mech-btn-primary" style="flex:1;min-width:120px;display:flex;align-items:center;justify-content:center;gap:.4rem;">
                        <i class="ti ti-player-play"></i> Iniciar
                    </button>
                    <button id="ra-btn-pausar" onclick="window.raCambiarEstado('pendiente')" class="mech-btn" style="flex:1;min-width:120px;display:flex;align-items:center;justify-content:center;gap:.4rem;">
                        <i class="ti ti-player-pause"></i> Pausar
                    </button>
                    <button id="ra-btn-finalizar" onclick="window.raConfirmarFinalizar()" class="mech-btn" style="flex:1;min-width:120px;display:flex;align-items:center;justify-content:center;gap:.4rem;background:var(--mech-success);color:#fff;border:none;">
                        <i class="ti ti-check"></i> Finalizar
                    </button>
                </div>

                <div class="mech-form-group" style="margin-bottom:0;">
                    <label for="ra-notas" style="font-size:var(--mech-text-xs);font-weight:700;
                        color:var(--mech-text-muted);text-transform:uppercase;letter-spacing:.08em;">
                        Notas internas
                        <span style="font-weight:400;color:var(--mech-text-faint);text-transform:none;
                                     letter-spacing:0;font-size:.72rem;">
                            — campo <code>notas_mecanico</code> pendiente en BD
                        </span>
                    </label>
                    <textarea id="ra-notas" rows="2" placeholder="Observaciones internas, incidencias encontradas…" oninput="window.raGuardarNotasLocal(this.value)" style="margin-top:.4rem;resize:vertical;"></textarea>
                </div>
            </div>

            <div class="mech-btn-group" style="margin-top:1rem;">
                <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-rep-asignadas')">Cerrar</button>
                <button type="button" class="mech-btn mech-btn-primary" onclick="window.raRecargar()">
                    <i class="ti ti-refresh"></i> Recargar
                </button>
            </div>
        </div>
    </div>
</div>






{{-- ── Inyección de datos del usuario autenticado ────────── --}}
@auth
@push('head')
    <meta name="mecanico-id" content="{{ Auth::id() }}">
    <script>window.__MECANICO_ID__ = {{ Auth::id() }};</script>
@endpush
@endauth

@endsection