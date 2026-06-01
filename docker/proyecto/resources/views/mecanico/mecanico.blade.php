@vite(['resources/css/mecanico/mecanico.css'])

@extends('layouts.app')

@section('content')
<div class="mech-page">



    {{-- ── ÁREA PRINCIPAL ───────────────────────────────────── --}}
    <section class="mech-main">

        <header class="mech-header">
            <div class="mech-header-copy">
                <h1>Bienvenido al panel de control,</h1>
                <p>Mis trabajos, tiempos, diagnosis y entregas del taller.</p>
            </div>
            <div class="mech-header-badge">
                <span class="mech-badge mech-badge-blue"><i class="ti ti-user"></i> Mecánico</span>
            </div>
        </header>

        {{-- Hero --}}
        <section class="mech-hero-grid">
            <article class="mech-hero-panel">
                {{-- Imagen decorativa: sustituye src por una imagen real del taller --}}
                <img
                    src="https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=700&q=80"
                    alt="Mecánico trabajando en el taller"
                    class="mech-hero-img"
                    loading="lazy"
                    onerror="this.style.display='none'"
                >
                <div class="mech-eyebrow"><i class="ti ti-tool"></i> Control de reparaciones</div>
                <h2>Gestión de vehículos<br>y reparaciones</h2>
                <p>Panel operativo para registrar entrada de vehículos, diagnosticar y registrar avance en tiempo real.</p>
                <div class="mech-hero-stats">
                    <div class="mech-hero-stat">
                        <div style="font-size:.7rem;color:var(--mech-text-muted);margin-bottom:.2rem;">Pendientes</div>
                        <strong id="count-pending" style="font-size:1.1rem;">0</strong>
                    </div>
                    <div class="mech-hero-stat">
                        <div style="font-size:.7rem;color:var(--mech-text-muted);margin-bottom:.2rem;">En proceso</div>
                        <strong id="count-inprogress" style="font-size:1.1rem;">0</strong>
                    </div>
                    <div class="mech-hero-stat">
                        <div style="font-size:.7rem;color:var(--mech-text-muted);margin-bottom:.2rem;">Finalizadas</div>
                        <strong id="count-finished" style="font-size:1.1rem;">0</strong>
                    </div>
                    <div class="mech-hero-stat">
                        <div style="font-size:.7rem;color:var(--mech-text-muted);margin-bottom:.2rem;">Piezas pendientes</div>
                        <strong id="count-pending-parts" style="font-size:1.1rem;">0</strong>
                    </div>
                </div>
            </article>

            <!-- Acciones rápidas movidas entre hero y tabla -->
        </section>

        {{-- Acciones rápidas (entre hero y tabla) --}}
        <section class="mech-actions-section">
            <div class="mech-actions-container">
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
                                    <p class="mech-small-muted">No hay reparaciones asignadas. Contacta con administración si hace falta asignación.</p>
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


{{-- ============================================================
     MODAL 1: METER COCHE AL TALLER
     ============================================================
     Endpoints necesarios:
       GET  /api/coches?en_garaje=0
            → Devuelve coches con en_garaje=0 (pendientes de entrar).
            → NO EXISTE. Añadir en CocheController:
              public function getCochesDisponibles() {
                  return Coche::where('en_garaje', 0)->with('cliente')->get();
              }

       POST /api/admin/reparaciones  ← YA EXISTE (ReparacionController@setNewReparacion)
            Body: { coche_id, mecanico_id, descripcion, estado:'pendiente' }
            → El controller DEBE además hacer:
              UPDATE coches SET en_garaje=1 WHERE id = :coche_id
            → Si no lo hace, añadir llamada extra:
              PUT /api/coches/{id}  Body: { en_garaje: 1 }  (pendiente)

     Campos BD usados: coches.en_garaje, reparaciones.id_mecanico,
                       reparaciones.motivo, reparaciones.estado
     ============================================================ --}}
<div class="mech-modal" id="modal-meter-coche" role="dialog" aria-modal="true" aria-labelledby="modal-mc-title">
    <div class="mech-modal-content" style="max-width:580px;">
        <div class="mech-modal-header">
            <h2 id="modal-mc-title"><i class="ti ti-car-plus" style="margin-right:8px;vertical-align:middle;"></i>Meter coche al taller</h2>
            <button class="mech-close-btn" onclick="window.closeModal('modal-meter-coche')" aria-label="Cerrar"><i class="ti ti-x"></i></button>
        </div>

        <div style="padding:0 2rem 1.5rem;">
            <label class="mech-search" style="width:100%;border-radius:12px;">
                <i class="ti ti-search"></i>
                <input type="text" id="modal-mc-search" placeholder="Buscar por matrícula, marca o modelo…"
                       oninput="window.filtrarCochesModal(this.value)" autocomplete="off">
            </label>
        </div>

        <div id="modal-mc-list-wrap" style="max-height:300px;overflow-y:auto;margin:0 2rem 1.5rem;">
            <div id="modal-mc-list">
                <div style="text-align:center;padding:2rem;">
                    <p class="mech-small-muted">Cargando vehículos disponibles…</p>
                </div>
            </div>
        </div>

        <div class="mech-form-group" style="margin:0 2rem 1.5rem;">
            <label for="mc-motivo">Motivo de entrada</label>
            <input type="text" id="mc-motivo" placeholder="Ej: Revisión periódica, Avería eléctrica…" />
        </div>

        <div id="mc-selected-info" style="display:none;margin:0 2rem 1.5rem;padding:.85rem 1.25rem;border-radius:12px;background:var(--mech-primary-highlight);border:1px solid rgba(77,148,255,.25);">
            <span style="font-size:.75rem;color:var(--mech-text-muted);text-transform:uppercase;letter-spacing:.08em;">Vehículo seleccionado</span>
            <p id="mc-selected-text" style="font-weight:700;margin:4px 0 0;"></p>
        </div>

        <div class="mech-btn-group" style="margin:1.5rem 2rem 0;">
            <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-meter-coche')">Cancelar</button>
            <button type="button" class="mech-btn mech-btn-primary" id="btn-mc-confirm" disabled onclick="window.confirmMeterCoche()">
                <span id="btn-mc-text"><i class="ti ti-check"></i> Meter coche</span>
                <span id="btn-mc-spinner" style="display:none;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                         style="animation:mech-spin .6s linear infinite;vertical-align:middle;">
                        <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                    </svg> Procesando…
                </span>
            </button>
        </div>
    </div>
</div>


{{-- ============================================================
     MODAL 2: REPARACIONES ASIGNADAS
     ============================================================
     Endpoints necesarios:
       ① GET  /api/mecanico/reparaciones
             → Reparaciones donde id_mecanico = Auth::id()
             → NO EXISTE. Crear en ReparacionController:
               public function getMisReparaciones(Request $request) {
                   return Reparacion::where('id_mecanico', Auth::id())
                       ->with(['coche.cliente'])
                       ->orderByRaw("FIELD(estado,'en proceso','pendiente','finalizada')")
                       ->get();
               }
             → Campos esperados: id_reparacion, id_coche, motivo, estado,
               horas_trabajo, coste_mano_obra, coste_total_piezas,
               coste_total_reparacion, fecha_entrada, fecha_salida,
               matricula, marca, modelo, nombre_cliente

       ② PUT  /api/mecanico/reparaciones/{id}/estado
             Body: { estado: 'pendiente'|'en proceso'|'finalizada' }
             → Si estado='finalizada': SET fecha_salida=NOW()
             → Si estado='en proceso': SET fecha_salida=null
             → NO EXISTE. Añadir en ReparacionController.

       Campos BD con los que trabaja este modal (tabla reparaciones):
         id_reparacion, id_coche, id_mecanico, motivo, estado,
         horas_trabajo, coste_mano_obra, coste_total_piezas,
         coste_total_reparacion, fecha_entrada, fecha_salida

       Campos BD SUGERIDOS (migraciones futuras):
         - reparaciones.notas_mecanico  TEXT nullable
             Para observaciones internas del mecánico.
         - reparaciones.prioridad  ENUM('baja','media','alta') default 'media'
             Para ordenar la cola de trabajo.
     ============================================================ --}}
<div class="mech-modal" id="modal-rep-asignadas" role="dialog" aria-modal="true" aria-labelledby="modal-ra-title">
    <div class="mech-modal-content" style="max-width:680px;">
        <div class="mech-modal-header">
            <h2 id="modal-ra-title">
                <i class="ti ti-file-check" style="margin-right:8px;vertical-align:middle;"></i>
                Reparaciones asignadas
            </h2>
            <button class="mech-close-btn" onclick="window.closeModal('modal-rep-asignadas')" aria-label="Cerrar"><i class="ti ti-x"></i></button>
        </div>

        {{-- Filtros de estado --}}
        <div style="display:flex;gap:.5rem;margin:0 2rem 1.5rem;flex-wrap:wrap;">
            <button class="ra-filter-btn active" data-filter="todos"       onclick="window.raFiltrar('todos')">Todas</button>
            <button class="ra-filter-btn"         data-filter="pendiente"  onclick="window.raFiltrar('pendiente')">
                <i class="ti ti-alert-circle"></i> Pendientes
            </button>
            <button class="ra-filter-btn"         data-filter="en proceso" onclick="window.raFiltrar('en proceso')">
                <i class="ti ti-player-play"></i> En proceso
            </button>
            <button class="ra-filter-btn"         data-filter="finalizada" onclick="window.raFiltrar('finalizada')">
                <i class="ti ti-check"></i> Finalizadas
            </button>
        </div>

        {{-- Buscador --}}
        <div style="margin:0 2rem 1.25rem;">
            <label class="mech-search" style="width:100%;border-radius:12px;">
                <i class="ti ti-search"></i>
                <input type="text" id="ra-search" placeholder="Buscar por matrícula, cliente o motivo…"
                       oninput="window.raBuscar(this.value)" autocomplete="off">
            </label>
        </div>

        {{-- Lista --}}
        <div id="ra-list-wrap" style="max-height:340px;overflow-y:auto;margin:0 2rem 1.5rem;">
            <div id="ra-list">
                <div style="text-align:center;padding:2rem;">
                    <p class="mech-small-muted" style="display:flex;align-items:center;justify-content:center;gap:.5rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2.5" style="animation:mech-spin .7s linear infinite;">
                            <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                        </svg>
                        Cargando reparaciones…
                    </p>
                </div>
            </div>
        </div>

        {{-- Panel de acciones (se muestra al seleccionar) --}}
        <div id="ra-actions-panel" style="display:none;border-top:1px solid var(--mech-divider);padding:1.5rem 2rem 0;margin:0 -2rem;">

            {{-- Info reparación seleccionada --}}
            <div id="ra-selected-info" style="
                display:flex;align-items:center;gap:.75rem;
                background:var(--mech-primary-highlight);
                border:1px solid rgba(77,148,255,.2);
                border-radius:14px;padding:.85rem 1.25rem;margin-bottom:1.5rem;">
                <div id="ra-sel-mark" style="
                    width:42px;height:42px;border-radius:12px;
                    background:rgba(77,148,255,.2);display:grid;place-items:center;
                    flex-shrink:0;color:var(--mech-primary);font-weight:800;font-size:.85rem;">--</div>
                <div style="flex:1;min-width:0;">
                    <p id="ra-sel-nombre" style="font-weight:700;margin:0;font-size:var(--mech-text-sm);
                        white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"></p>
                    <p id="ra-sel-meta"   style="margin:3px 0 0;font-size:var(--mech-text-xs);
                        color:var(--mech-text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"></p>
                    <p id="ra-sel-fechas" style="margin:4px 0 0;font-size:var(--mech-text-xs);color:var(--mech-text-faint);"></p>
                </div>
                <div id="ra-sel-badge" style="flex-shrink:0;"></div>
            </div>

            {{-- Botones de acción de estado --}}
            <p style="font-size:var(--mech-text-xs);font-weight:700;color:var(--mech-text-muted);
                       text-transform:uppercase;letter-spacing:.08em;margin-bottom:.75rem;">
                Cambiar estado
            </p>
            <div style="display:flex;gap:.6rem;flex-wrap:wrap;margin-bottom:1.5rem;" id="ra-estado-btns">
                <button id="ra-btn-iniciar"
                        onclick="window.raCambiarEstado('en proceso')"
                        style="flex:1;min-width:120px;display:flex;align-items:center;justify-content:center;gap:.4rem;
                               background:var(--mech-primary);color:#fff;border:none;border-radius:12px;
                               padding:.7rem 1.1rem;font-weight:700;font-family:'Outfit',sans-serif;
                               font-size:var(--mech-text-sm);cursor:pointer;transition:all var(--mech-transition);">
                    <i class="ti ti-player-play"></i> Iniciar
                </button>
                <button id="ra-btn-pausar"
                        onclick="window.raCambiarEstado('pendiente')"
                        style="flex:1;min-width:120px;display:flex;align-items:center;justify-content:center;gap:.4rem;
                               background:var(--mech-surface-2);border:1px solid var(--mech-border);
                               border-radius:12px;padding:.7rem 1.1rem;font-weight:700;
                               font-family:'Outfit',sans-serif;font-size:var(--mech-text-sm);
                               cursor:pointer;transition:all var(--mech-transition);">
                    <i class="ti ti-player-pause"></i> Pausar
                </button>
                <button id="ra-btn-finalizar"
                        onclick="window.raConfirmarFinalizar()"
                        style="flex:1;min-width:120px;display:flex;align-items:center;justify-content:center;gap:.4rem;
                               background:var(--mech-success);color:#fff;border:none;border-radius:12px;
                               padding:.7rem 1.1rem;font-weight:700;font-family:'Outfit',sans-serif;
                               font-size:var(--mech-text-sm);cursor:pointer;transition:all var(--mech-transition);">
                    <i class="ti ti-check"></i> Finalizar
                </button>
            </div>

            {{-- Notas del mecánico
                 TODO: Campo 'notas_mecanico' TEXT nullable PENDIENTE de añadir
                 a la tabla `reparaciones` mediante una migración.
                 Endpoint necesario: PUT /api/mecanico/reparaciones/{id}/notas
                   Body: { notas_mecanico: string }
                 Por ahora se almacena solo en estado local (no persiste en BD). --}}
            <div class="mech-form-group" style="margin:0;">
                <label for="ra-notas" style="font-size:var(--mech-text-xs);font-weight:700;
                    color:var(--mech-text-muted);text-transform:uppercase;letter-spacing:.08em;">
                    Notas internas
                    <span style="font-weight:400;color:var(--mech-text-faint);text-transform:none;
                                 letter-spacing:0;font-size:.72rem;">
                        — campo <code>notas_mecanico</code> pendiente en BD
                    </span>
                </label>
                <textarea id="ra-notas" rows="2"
                          placeholder="Observaciones internas, incidencias encontradas…"
                          oninput="window.raGuardarNotasLocal(this.value)"
                          style="margin-top:.5rem;resize:vertical;"></textarea>
            </div>
        </div>

        <div class="mech-btn-group" style="margin:1.5rem 2rem 0;">
            <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-rep-asignadas')">Cerrar</button>
            <button type="button" class="mech-btn mech-btn-secondary" onclick="window.raRecargar()">
                <i class="ti ti-refresh"></i> Recargar
            </button>
        </div>
    </div>
</div>


{{-- ============================================================
     MODALES SECUNDARIOS (se crean dinámicamente en JS)
     Ver funciones: openDiagnosticarModal, openAgregarHorasModal,
                    openAgregarPiezasModal, openSolicitarPiezasModal
     ============================================================ --}}


{{-- ============================================================
     ESTILOS ESPECÍFICOS DE ESTA VISTA
     ============================================================ --}}
<style>
/* ── keyframes ────────────────────────────────────────────── */
@keyframes mech-spin   { to { transform: rotate(360deg); } }
@keyframes mechFadeIn  { from { opacity: 0; } to { opacity: 1; } }
@keyframes mechSlideUp { from { transform: translateY(20px); opacity: 0; }
                         to   { transform: translateY(0);    opacity: 1; } }
@keyframes mechSlideIn { from { opacity:0; transform: translateX(20px) scale(.95); }
                         to   { opacity:1; transform: translateX(0) scale(1); } }
@keyframes mechSlideOut { to  { opacity:0; transform: translateX(20px) scale(.95); } }

/* ── Grid acciones rápidas ────────────────────────────────── */
.mech-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}
.mech-action-btn {
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: .5rem; padding: 1rem;
    background: var(--mech-surface-2);
    border: 1px solid var(--mech-border);
    border-radius: 20px; color: var(--mech-text);
    cursor: pointer; font-size: var(--mech-text-sm);
    font-weight: 600; font-family: 'Outfit', sans-serif;
    transition: all var(--mech-transition);
}
.mech-action-btn i { font-size: 1.5rem; color: var(--mech-primary); }
.mech-action-btn:hover {
    background: var(--mech-primary); border-color: transparent; color: #fff;
    transform: translateY(-2px); box-shadow: 0 12px 24px rgba(0,102,255,.25);
}
.mech-action-btn:hover i { color: #fff; }
.mech-action-btn:active { transform: translateY(0); }

/* Acciones rápidas section */
.mech-actions-section { margin: 1.5rem 0; padding: 0; }
.mech-actions-container { display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; align-items: center; padding: 0 1rem; }
.mech-actions-container .mech-action-btn { flex: 1; min-width: 140px; max-width: 200px; }

/* Tabla responsive */
.mech-table-wrap { overflow-x: auto; border-radius: 12px; margin: 1rem 0; }
.mech-table { width: 100%; border-collapse: collapse; }
.mech-table th, .mech-table td { padding: 0.85rem; text-align: left; border-bottom: 1px solid var(--mech-border); }
.mech-table th { background: var(--mech-surface-offset); font-weight: 600; font-size: var(--mech-text-sm); }
.mech-table tbody tr:hover { background: var(--mech-surface-2); }

@media (max-width: 1024px) {
    .mech-actions-container { gap: 0.5rem; }
    .mech-actions-container .mech-action-btn { min-width: 130px; max-width: 160px; font-size: var(--mech-text-sm); }
}

@media (max-width: 768px) {
    .mech-actions-section { padding: 0; }
    .mech-actions-container { gap: 0.5rem; padding: 0 0.75rem; }
    .mech-actions-container .mech-action-btn { min-width: 100px; max-width: 130px; padding: 0.7rem 0.6rem; font-size: 0.85rem; }
    .mech-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .mech-table th, .mech-table td { padding: 0.6rem 0.5rem; font-size: var(--mech-text-xs); }
}

@media (max-width: 480px) {
    .mech-action-btn span { display: none; }
    .mech-action-btn { padding: 0.75rem; border-radius: 50%; min-width: auto; flex: 0 0 auto; }
    .mech-actions-container { gap: 0.4rem; justify-content: space-around; }
    .mech-table th { font-size: 0.75rem; padding: 0.5rem; }
    .mech-table td { padding: 0.5rem; font-size: 0.75rem; }
}

/* ── Modal base ───────────────────────────────────────────── */
/* ══════════════════════════════════════════════════════════════
   SISTEMA DE MODALES — diseño unificado
   Glassmorphism suave · border-radius 28px · Outfit
   Paleta idéntica a .mech-header y .mech-hero-panel
   ══════════════════════════════════════════════════════════════ */

.mech-modal {
    display: none; position: fixed; z-index: 1000;
    inset: 0; width: 100%; height: 100%;
    background: rgba(8, 13, 22, 0.65);
    backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
    align-items: center; justify-content: center; padding: 1.5rem;
}
.mech-modal.show { display: flex; animation: modalOverlayIn .2s ease; }

@keyframes modalOverlayIn { from { opacity:0; } to { opacity:1; } }
@keyframes modalContentIn {
    from { opacity:0; transform: translateY(20px) scale(.96); }
    to   { opacity:1; transform: translateY(0)    scale(1);   }
}

/* Contenedor */
.mech-modal-content {
    background: var(--mech-surface);
    border: 1px solid var(--mech-border);
    border-radius: 28px; padding: 0;
    width: 100%; max-width: 560px; max-height: 88vh;
    overflow: hidden; display: flex; flex-direction: column;
    box-shadow:
        0 0 0 1px rgba(255,255,255,.05) inset,
        0 28px 64px rgba(8,13,22,.22),
        0  8px 24px rgba(8,13,22,.10);
    animation: modalContentIn .28s cubic-bezier(.16,1,.3,1);
}
.mech-modal-content.modal-wide   { max-width: 700px; }
.mech-modal-content.modal-narrow { max-width: 440px; }

/* Header */
.mech-modal-header {
    display: flex; align-items: center;
    justify-content: space-between; gap: 1.5rem;
    padding: 1.75rem 2rem 1.5rem;
    border-bottom: 1px solid var(--mech-divider);
    flex-shrink: 0; background: var(--mech-surface);
}
.mech-modal-header-left { display: flex; align-items: center; gap: .875rem; }
.mech-modal-icon {
    width: 40px; height: 40px; border-radius: 13px;
    background: var(--mech-primary-highlight);
    display: grid; place-items: center;
    color: var(--mech-primary); flex-shrink: 0;
}
.mech-modal-icon i { font-size: 1.15rem; }
.mech-modal-header h2 {
    font-size: 1.3rem; font-weight: 700;
    letter-spacing: -.03em; margin: 0; color: var(--mech-text);
}
.mech-modal-subtitle {
    font-size: var(--mech-text-xs); color: var(--mech-text-muted); margin: .18rem 0 0;
}

/* Botón cerrar */
.mech-close-btn {
    width: 38px; height: 38px; border-radius: 12px;
    display: grid; place-items: center;
    background: var(--mech-danger); border: none;
    color: #fff; cursor: pointer;
    font-size: 1.1rem; line-height: 1; flex-shrink: 0;
    transition: all var(--mech-transition);
    padding: 0;
}
.mech-close-btn i { font-size: 1.1rem; }
.mech-close-btn:hover { background: #a82f2f; color: #fff; transform: scale(1.1); }

/* Body scrollable */
.mech-modal-body {
    padding: 1.75rem 2rem; overflow-y: auto; flex: 1;
    scrollbar-width: thin; scrollbar-color: var(--mech-border) transparent;
}
.mech-modal-body::-webkit-scrollbar { width: 4px; }
.mech-modal-body::-webkit-scrollbar-thumb { background: var(--mech-border); border-radius: 99px; }

/* Buscador interno */
.mech-modal-search {
    display: flex; align-items: center; gap: .6rem;
    padding: .6rem 1rem; border: 1px solid var(--mech-border);
    border-radius: 14px; background: var(--mech-surface-2); margin-bottom: 1rem;
    transition: border-color var(--mech-transition), box-shadow var(--mech-transition);
}
.mech-modal-search:focus-within {
    border-color: var(--mech-primary);
    box-shadow: 0 0 0 3px var(--mech-primary-highlight);
    background: var(--mech-surface);
}
.mech-modal-search i { color: var(--mech-text-faint); font-size: .95rem; flex-shrink: 0; }
.mech-modal-search input {
    border: none; background: transparent; outline: none;
    color: var(--mech-text); font-family: 'Outfit', sans-serif;
    font-size: var(--mech-text-sm); width: 100%;
}
.mech-modal-search input::placeholder { color: var(--mech-text-faint); }

/* Filtros */
.mech-modal-filters { display: flex; gap: .5rem; flex-wrap: wrap; margin-bottom: 1rem; }

/* Avisos inline */
.mech-form-notice {
    display: flex; align-items: flex-start; gap: .55rem;
    padding: .65rem 1rem; border-radius: 12px;
    font-size: var(--mech-text-xs); line-height: 1.5; margin-bottom: 1rem;
}
.mech-form-notice i { flex-shrink: 0; margin-top: .05rem; }
.mech-form-notice.warning { background: rgba(210,122,0,.09); border: 1px solid rgba(210,122,0,.2); color: var(--mech-warning); }
.mech-form-notice.info    { background: var(--mech-primary-highlight); border: 1px solid rgba(0,102,255,.2); color: var(--mech-primary); }
.mech-form-notice.danger  { background: rgba(197,61,61,.09); border: 1px solid rgba(197,61,61,.2); color: var(--mech-danger); }

/* Formularios */
.mech-form-group { margin-bottom: 1.1rem; }
.mech-form-group label {
    display: block; margin-bottom: .4rem;
    font-size: .7rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .09em; color: var(--mech-text-muted);
}
.mech-form-group input,
.mech-form-group select,
.mech-form-group textarea {
    width: 100%; padding: .72rem 1rem;
    border: 1px solid var(--mech-border); border-radius: 14px;
    background: var(--mech-surface-2); color: var(--mech-text);
    font-family: 'Outfit', sans-serif; font-size: var(--mech-text-sm);
    transition: border-color var(--mech-transition), box-shadow var(--mech-transition);
    outline: none; appearance: none; -webkit-appearance: none;
}
.mech-form-group select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236f7785' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right .85rem center; padding-right: 2.5rem;
}
.mech-form-group textarea { resize: vertical; min-height: 88px; line-height: 1.55; }
.mech-form-group input::placeholder,
.mech-form-group textarea::placeholder { color: var(--mech-text-faint); }
.mech-form-group input:focus,
.mech-form-group select:focus,
.mech-form-group textarea:focus {
    border-color: var(--mech-primary);
    box-shadow: 0 0 0 3px var(--mech-primary-highlight);
    background: var(--mech-surface);
}
.mech-form-group input:disabled,
.mech-form-group select:disabled { opacity: .5; cursor: not-allowed; }
.mech-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: .85rem; }

/* Botones del modal */
.mech-btn-group {
    display: flex; gap: .75rem; justify-content: flex-end;
    margin-top: 1.6rem; padding-top: 1.2rem; border-top: 1px solid var(--mech-divider);
}
.mech-btn-cancel {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    padding: .68rem 1.25rem; border-radius: 14px;
    border: 1px solid var(--mech-border); background: var(--mech-surface-2);
    color: var(--mech-text-muted); font-family: 'Outfit', sans-serif;
    font-size: var(--mech-text-sm); font-weight: 600; cursor: pointer;
    transition: all var(--mech-transition);
}
.mech-btn-cancel:hover { background: var(--mech-surface-offset); color: var(--mech-text); transform: translateY(-1px); }

/* Lista de ítems */
.mech-modal-list { display: flex; flex-direction: column; gap: .45rem; }

.mc-car-item, .ra-rep-item {
    display: grid; align-items: center; gap: .75rem;
    padding: .85rem 1rem; border: 1px solid var(--mech-border);
    border-radius: 18px; cursor: pointer; background: var(--mech-surface-2);
    transition: all var(--mech-transition);
}
.mc-car-item  { grid-template-columns: 42px 1fr auto; }
.ra-rep-item  { grid-template-columns: 44px 1fr auto; }
.mc-car-item:hover, .ra-rep-item:hover {
    border-color: var(--mech-primary); background: var(--mech-primary-highlight);
    transform: translateX(3px); box-shadow: 0 4px 16px rgba(0,102,255,.08);
}
.mc-car-item.selected, .ra-rep-item.selected {
    border-color: var(--mech-primary); background: var(--mech-primary-highlight);
    box-shadow: 0 0 0 2px var(--mech-primary), 0 4px 16px rgba(0,102,255,.12);
    transform: none;
}
.mc-car-mark, .ra-rep-mark {
    width: 42px; height: 42px; border-radius: 13px;
    background: var(--mech-surface-offset); display: grid; place-items: center;
    color: var(--mech-primary); font-weight: 800; font-size: .8rem;
    flex-shrink: 0; transition: background var(--mech-transition);
}
.mc-car-item.selected .mc-car-mark,
.ra-rep-item.selected .ra-rep-mark { background: rgba(0,102,255,.18); }
.mc-check {
    width: 22px; height: 22px; border: 2px solid var(--mech-border);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    transition: all var(--mech-transition); flex-shrink: 0; color: transparent;
}
.mc-car-item.selected .mc-check { border-color: var(--mech-primary); background: var(--mech-primary); color: #fff; }

/* Filtros */
.ra-filter-btn {
    display: inline-flex; align-items: center; gap: .35rem;
    padding: .38rem .9rem; border-radius: 999px;
    border: 1px solid var(--mech-border); background: var(--mech-surface-2);
    color: var(--mech-text-muted); font-size: var(--mech-text-xs);
    font-weight: 600; font-family: 'Outfit', sans-serif; cursor: pointer;
    transition: all var(--mech-transition);
}
.ra-filter-btn:hover  { border-color: var(--mech-primary); color: var(--mech-primary); }
.ra-filter-btn.active { background: var(--mech-primary); border-color: var(--mech-primary); color: #fff; }

/* Badges */
.ra-badge-pendiente, .ra-badge-enproceso, .ra-badge-finalizada {
    display: inline-flex; align-items: center; gap: .3rem;
    padding: .22rem .65rem; border-radius: 9999px;
    font-size: .68rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .06em; white-space: nowrap;
}
.ra-badge-pendiente  { background: rgba(210,122,0,.14); color: var(--mech-warning); }
.ra-badge-enproceso  { background: var(--mech-primary-highlight); color: var(--mech-primary); }
.ra-badge-finalizada { background: rgba(31,143,85,.12); color: var(--mech-success); }

/* Panel detalle reparación */
.mech-detalle-reparacion { padding: .25rem 0; }
.mech-detail-section { margin-bottom: 1.1rem; padding-bottom: 1.1rem; border-bottom: 1px solid var(--mech-divider); }
.mech-detail-section:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
.mech-detail-section h4 {
    display: flex; align-items: center; gap: .45rem; margin: 0 0 .75rem;
    font-size: .7rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: .09em; color: var(--mech-text-muted);
}
.mech-detail-row {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: .45rem; font-size: var(--mech-text-xs); gap: .5rem;
}
.mech-detail-label { color: var(--mech-text-muted); flex-shrink: 0; }
.mech-detail-value { font-weight: 600; text-align: right; }
.mech-action-row { display: flex; gap: .5rem; flex-wrap: wrap; margin-top: .875rem; }
.mech-action-row button {
    flex: 1; min-width: 88px; padding: .5rem .75rem; border-radius: 12px;
    border: none; cursor: pointer; font-weight: 600; font-size: var(--mech-text-xs);
    font-family: 'Outfit', sans-serif; transition: all var(--mech-transition);
    display: inline-flex; align-items: center; justify-content: center; gap: .35rem;
}

/* Panel info pieza seleccionada */
.ap-pieza-info {
    display: none; padding: .95rem 1.1rem; border-radius: 16px;
    background: var(--mech-surface-offset); border: 1px solid var(--mech-border);
    margin-bottom: 1rem; gap: 1rem;
}
.ap-pieza-info.visible { display: grid; grid-template-columns: 1fr 1fr 1fr; }
.ap-pieza-info-item { display: flex; flex-direction: column; gap: .2rem; }
.ap-pieza-info-item .ap-info-label {
    font-size: .65rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: .08em; color: var(--mech-text-faint);
}
.ap-pieza-info-item .ap-info-value {
    font-size: var(--mech-text-sm); font-weight: 700;
    color: var(--mech-text); font-variant-numeric: tabular-nums;
}
.ap-pieza-info-item .ap-info-value.highlight { color: var(--mech-primary); }
.ap-error {
    display: none; padding: .55rem .9rem; border-radius: 12px;
    background: rgba(197,61,61,.09); border: 1px solid rgba(197,61,61,.2);
    color: var(--mech-danger); font-size: var(--mech-text-xs);
    font-weight: 600; margin-top: .6rem;
}

/* Skeleton */
@keyframes mechShimmer {
    0%   { background-position: -200% 0; }
    100% { background-position:  200% 0; }
}
.mech-skeleton-item {
    height: 64px; border-radius: 18px; margin-bottom: .45rem;
    background: linear-gradient(90deg, var(--mech-surface-offset) 25%, var(--mech-border) 50%, var(--mech-surface-offset) 75%);
    background-size: 200% 100%; animation: mechShimmer 1.4s ease-in-out infinite;
}

/* Toast */
.mech-toast {
    position: fixed; top: 1.25rem; right: 1.25rem; z-index: 2000;
    display: flex; align-items: center; gap: .75rem;
    padding: .875rem 1.25rem; border-radius: 16px;
    font-family: 'Outfit', sans-serif; font-size: var(--mech-text-sm);
    font-weight: 600; color: #fff; box-shadow: var(--mech-shadow-lg);
    animation: mechSlideIn .3s cubic-bezier(.16,1,.3,1);
    max-width: 380px; pointer-events: none;
    border: 1px solid rgba(255,255,255,.1);
}
.mech-toast.success { background: linear-gradient(135deg, #156336, #1f8f55); }
.mech-toast.error   { background: linear-gradient(135deg, #922626, #c53d3d); }
.mech-toast.exit    { animation: mechSlideOut .25s ease forwards; }

@keyframes mechSlideIn  { from { opacity:0; transform: translateX(24px) scale(.95); } to { opacity:1; transform: translateX(0) scale(1); } }
@keyframes mechSlideOut { from { opacity:1; transform: translateX(0) scale(1); } to { opacity:0; transform: translateX(16px) scale(.96); } }

/* Responsive */
@media (max-width: 600px) {
    .mech-modal { padding: 0; align-items: flex-end; }
    .mech-modal-content { max-width: 100%; width: 100%; border-radius: 28px 28px 0 0; max-height: 92vh; }
    .ap-pieza-info.visible { grid-template-columns: 1fr 1fr; }
    .mech-form-row { grid-template-columns: 1fr; }
}


/* ── Overrides layout sin sidebar ─────────────────────── */
.mech-page { display: block !important; }
.mech-main { width: 100%; min-height: auto; padding: 1.5rem 1rem; max-width: none; }

/* Header badge rol */
.mech-header-badge .mech-badge {
    padding: .45rem .85rem;
    font-size: .72rem;
    border-radius: 999px;
}

/* Tabla card full width en grid */
.mech-content-grid { grid-template-columns: 1.4fr 0.7fr; }
.mech-table-card { border-radius: 24px; padding: 0; }

/* Timeline card (panel detalle) */
.mech-timeline-card {
    border-radius: 24px;
    padding: 1.5rem;
    position: sticky; top: 1rem;
    max-height: 520px; overflow-y: auto;
}
.mech-timeline-card h3 { font-size: var(--mech-text-base); letter-spacing:-.03em; margin: 0 0 .25rem; }
.mech-timeline-card > p { font-size: var(--mech-text-xs); color: var(--mech-text-muted); margin: 0 0 1rem; }

/* Empty state tabla */
.mech-empty-row td {
    padding: 3rem 1rem !important;
    text-align: center;
}
.mech-empty-icon {
    width: 56px; height: 56px; border-radius: 18px;
    background: var(--mech-surface-offset);
    display: grid; place-items: center;
    color: var(--mech-text-faint); font-size: 1.6rem;
    margin: 0 auto 1rem;
    border: 1px solid var(--mech-border);
}

@media (max-width: 1100px) { .mech-content-grid { grid-template-columns: 1fr; } }
@media (max-width: 768px)  { .mech-main { padding: 1rem 0.75rem; } }
</style>


{{-- ============================================================
     JAVASCRIPT PRINCIPAL
     ============================================================ --}}
<script>
(() => {
    'use strict';

    // ── Configuración ──────────────────────────────────────────
    const BASE_URL = '/api';

    // ID del mecánico en sesión.
    // TODO: Reemplazar con: const MECANICO_ID = {{ Auth::id() }};
    const MECANICO_ID = 1; // MOCK temporal

    // ── Tema ───────────────────────────────────────────────────
    document.documentElement.setAttribute('data-theme', 'dark');

    // ── Estado global ──────────────────────────────────────────
    const state = {
        // Reparaciones en la tabla principal del dashboard
        // Los estados internos usan los valores REALES de la BD:
        // 'pendiente' | 'en proceso' | 'finalizada'
        reparaciones: [],

        // Coches disponibles para meter al taller (en_garaje=0)
        cochesDisponibles: [],
        selectedCarId: null,
    };

    // ── MOCK: reparaciones iniciales del dashboard ─────────────
    // TODO: Reemplazar con GET /api/mecanico/reparaciones al inicializar
    const MOCK_REPARACIONES = [
        {
            id: 55, matricula: '4821 MXS', marca: 'Seat',    modelo: 'León FR',
            motivo: 'Embrague', estado: 'en proceso',
            horas: 0, piezas: [], piezasPendientes: [],
            fecha_entrada: '2026-05-31 07:51:01', fecha_salida: null,
            coste_total: 0, notas: '',
        },
        {
            id: 43, matricula: '7718 LPT', marca: 'VW',      modelo: 'Golf',
            motivo: 'Cambio correa distribución', estado: 'finalizada',
            horas: 10, piezas: ['Correa distribución', 'Juntas'], piezasPendientes: [],
            fecha_entrada: '2026-05-30 18:16:44', fecha_salida: '2026-05-31 12:31:30',
            coste_total: 250, notas: '',
        },
        {
            id: 67, matricula: '5555 ABC', marca: 'Ford',    modelo: 'Focus',
            motivo: 'Revisión 60.000 km', estado: 'pendiente',
            horas: 0, piezas: [], piezasPendientes: ['Filtro aceite'],
            fecha_entrada: '2026-05-31 09:00:00', fecha_salida: null,
            coste_total: 0, notas: '',
        },
    ];

    // ── MOCK: coches disponibles (en_garaje=0) ─────────────────
    // TODO: Reemplazar con GET /api/coches?en_garaje=0
    const MOCK_COCHES_DISPONIBLES = [
        { id: 101, matricula: '4821 MXS', marca: 'Seat',    modelo: 'León FR',  cliente: 'María García'   },
        { id: 102, matricula: '7718 LPT', marca: 'VW',      modelo: 'Golf',     cliente: 'Pedro López'    },
        { id: 103, matricula: '1942 KBN', marca: 'Peugeot', modelo: '308',      cliente: 'Laura Martínez' },
        { id: 104, matricula: '5555 ABC', marca: 'Ford',    modelo: 'Focus',    cliente: 'Ana Fernández'  },
        { id: 105, matricula: '9823 GTH', marca: 'BMW',     modelo: 'Serie 1',  cliente: 'Elena Sánchez'  },
        { id: 106, matricula: '3310 PLM', marca: 'Toyota',  modelo: 'Corolla',  cliente: 'Carlos Torres'  },
    ];

    // ── MOCK: reparaciones asignadas para el modal ─────────────
    // TODO: Reemplazar con GET /api/mecanico/reparaciones
    // Campos directamente de ReparacionSeeder.php:
    const MOCK_REP_ASIGNADAS = [
        {
            id_reparacion: 55, id_coche: 49,
            motivo: 'Embrague', estado: 'en proceso',
            horas_trabajo: 0, coste_mano_obra: 0,
            coste_total_piezas: 0, coste_total_reparacion: 0,
            fecha_entrada: '2026-05-31 07:51:01', fecha_salida: null,
            matricula: '4821 MXS', marca: 'Seat', modelo: 'León FR',
            nombre_cliente: 'María García', notas_mecanico: '',
        },
        {
            id_reparacion: 43, id_coche: 34,
            motivo: 'Cambio de la correa de distribución.', estado: 'finalizada',
            horas_trabajo: 10, coste_mano_obra: 200,
            coste_total_piezas: 50, coste_total_reparacion: 250,
            fecha_entrada: '2025-05-07 18:16:44', fecha_salida: '2025-05-09 12:31:30',
            matricula: '7718 LPT', marca: 'VW', modelo: 'Golf',
            nombre_cliente: 'Pedro López', notas_mecanico: '',
        },
        {
            id_reparacion: 67, id_coche: 60,
            motivo: 'Revisión 60.000 km', estado: 'pendiente',
            horas_trabajo: 0, coste_mano_obra: 0,
            coste_total_piezas: 0, coste_total_reparacion: 0,
            fecha_entrada: '2026-05-31 09:00:00', fecha_salida: null,
            matricula: '5555 ABC', marca: 'Ford', modelo: 'Focus',
            nombre_cliente: 'Ana Fernández', notas_mecanico: '',
        },
        {
            id_reparacion: 68, id_coche: 61,
            motivo: 'Cambio de frenos delanteros', estado: 'pendiente',
            horas_trabajo: 0, coste_mano_obra: 0,
            coste_total_piezas: 0, coste_total_reparacion: 0,
            fecha_entrada: '2026-05-31 10:30:00', fecha_salida: null,
            matricula: '9823 GTH', marca: 'BMW', modelo: 'Serie 1',
            nombre_cliente: 'Elena Sánchez', notas_mecanico: '',
        },
    ];

    // ==========================================================
    //  HELPERS GLOBALES
    // ==========================================================
    function formatFecha(f) {
        if (!f) return '—';
        return new Date(f).toLocaleDateString('es-ES', { day:'2-digit', month:'short', year:'numeric' });
    }

    function getBadgeDashboard(estado) {
        const map = {
            'pendiente':  { cls: 'mech-badge-orange', text: 'Pendiente',  icon: 'ti-clock'        },
            'en proceso': { cls: 'mech-badge-blue',   text: 'En proceso', icon: 'ti-player-play'  },
            'finalizada': { cls: 'mech-badge-green',  text: 'Finalizada', icon: 'ti-circle-check' },
        };
        return map[estado] || map['pendiente'];
    }

    window.showNotification = function(message, type = 'success') {
        const el = document.createElement('div');
        el.className = `mech-toast ${type}`;
        el.innerHTML = `<i class="ti ti-${type === 'success' ? 'check' : 'alert-circle'}"></i> ${message}`;
        document.body.appendChild(el);
        setTimeout(() => { el.classList.add('exit'); setTimeout(() => el.remove(), 260); }, 3500);
    };

    // ==========================================================
    //  RENDER TABLA PRINCIPAL + KPIs
    // ==========================================================
    function renderReparaciones() {
        const tbody = document.getElementById('tabla-reparaciones');
        if (!state.reparaciones.length) {
            tbody.innerHTML = `<tr class="mech-empty-row">
                <td colspan="6">
                    <div class="mech-empty-icon"><i class="ti ti-car-off"></i></div>
                    <p style="font-weight:700;letter-spacing:-.02em;margin:0 0 .35rem;">Sin reparaciones activas</p>
                    <p class="mech-small-muted" style="font-size:.78rem;">Pulsa <strong>Meter coche</strong> para registrar el primer vehículo.</p>
                </td></tr>`;
            updateKPIs();
            return;
        }
        tbody.innerHTML = state.reparaciones.map(rep => {
            const b = getBadgeDashboard(rep.estado);
            const initials = (rep.marca || '??').slice(0,2).toUpperCase();
            const motivo = rep.motivo ? (rep.motivo.length > 32 ? rep.motivo.slice(0,32)+'…' : rep.motivo) : '—';
            return `<tr onclick="window.selectReparacion(${rep.id})" style="cursor:pointer;">
                <td>
                    <div class="mech-vehicle">
                        <div class="mech-vehicle-mark">${initials}</div>
                        <div>
                            <strong style="color:#fff;">${rep.marca} ${rep.modelo}</strong>
                            <div class="mech-muted">${rep.matricula} · ${rep.año || ''}</div>
                        </div>
                    </div>
                </td>
                <td style="max-width:180px;color:var(--mech-text-muted);">${motivo}</td>
                <td><span class="mech-badge ${b.cls}"><i class="ti ${b.icon}" style="font-size:.75rem;"></i> ${b.text}</span></td>
                <td style="text-align:center;font-variant-numeric:tabular-nums;font-weight:600;">${rep.horas.toFixed(1)}<span style="color:var(--mech-text-faint);font-weight:400;"> h</span></td>
                <td style="text-align:center;">
                    <span class="mech-badge mech-badge-blue" style="min-width:32px;justify-content:center;">${rep.piezas.length}</span>
                </td>
                <td style="text-align:right;">
                    <button class="mech-btn-edit"
                            onclick="window.editarReparacion(event,${rep.id})">
                        <i class="ti ti-edit"></i> Editar
                    </button>
                </td>
            </tr>`;
        }).join('');
        updateKPIs();
    }

    function updateKPIs() {
        const c = state.reparaciones.reduce((a, r) => {
            if (r.estado === 'pendiente')  a.pending++;
            if (r.estado === 'en proceso') a.inprogress++;
            if (r.estado === 'finalizada') a.finished++;
            a.parts += (r.piezasPendientes || []).length;
            return a;
        }, { pending:0, inprogress:0, finished:0, parts:0 });

        // Actualizar hero stats
        document.getElementById('count-pending').textContent    = c.pending;
        document.getElementById('count-inprogress').textContent = c.inprogress;
        document.getElementById('count-finished').textContent   = c.finished;
        document.getElementById('count-pending-parts').textContent = c.parts;
        const badgeTotal = document.getElementById('badge-total-reps');
        if (badgeTotal) badgeTotal.textContent = state.reparaciones.length + ' órdenes';
    }

    // ==========================================================
    //  PANEL DETALLE (sidebar derecho de la tabla)
    // ==========================================================
    window.selectReparacion = function(id) {
        const rep = state.reparaciones.find(r => r.id === id);
        if (!rep) return;
        const b = getBadgeDashboard(rep.estado);
        document.getElementById('reparacion-detalle').innerHTML = `
            <div class="mech-detail-section">
                <h4><i class="ti ti-car"></i> Vehículo</h4>
                <div class="mech-detail-row"><span class="mech-detail-label">Matrícula</span><span class="mech-detail-value">${rep.matricula}</span></div>
                <div class="mech-detail-row"><span class="mech-detail-label">Vehículo</span><span class="mech-detail-value">${rep.marca} ${rep.modelo}</span></div>
                <div class="mech-detail-row"><span class="mech-detail-label">Entrada</span><span class="mech-detail-value">${formatFecha(rep.fecha_entrada)}</span></div>
            </div>
            <div class="mech-detail-section">
                <h4><i class="ti ti-tool"></i> Reparación</h4>
                <div class="mech-detail-row"><span class="mech-detail-label">Motivo</span><span class="mech-detail-value">${rep.motivo || '—'}</span></div>
                <div class="mech-detail-row"><span class="mech-detail-label">Estado</span>
                    <span class="mech-badge ${b.cls}" style="font-size:.7rem;">${b.text}</span></div>
                <div class="mech-detail-row"><span class="mech-detail-label">Horas</span><span class="mech-detail-value">${rep.horas.toFixed(1)} h</span></div>
                ${rep.coste_total > 0 ? `<div class="mech-detail-row"><span class="mech-detail-label">Coste total</span><span class="mech-detail-value">${rep.coste_total.toFixed(2)} €</span></div>` : ''}
            </div>
            ${rep.piezas.length ? `
            <div class="mech-detail-section">
                <h4><i class="ti ti-package"></i> Piezas (${rep.piezas.length})</h4>
                ${rep.piezas.map(p=>`<div class="mech-detail-row"><span class="mech-detail-label">—</span><span class="mech-detail-value">${p}</span></div>`).join('')}
            </div>` : ''}
            ${rep.piezasPendientes?.length ? `
            <div class="mech-detail-section">
                <h4><i class="ti ti-package-x"></i> Piezas pendientes</h4>
                ${rep.piezasPendientes.map(p=>`<div class="mech-detail-row"><span class="mech-badge mech-badge-orange" style="font-size:.7rem;">${p}</span></div>`).join('')}
            </div>` : ''}
            <div class="mech-action-row">
                <button onclick="window.cambiarEstadoRep(${rep.id})"
                        style="background:var(--mech-primary-highlight);color:var(--mech-primary);">
                    <i class="ti ti-refresh"></i> Estado
                </button>
                <button onclick="window.finalizarReparacion(${rep.id})"
                        style="background:rgba(31,143,85,.12);color:var(--mech-success);">
                    <i class="ti ti-check"></i> Finalizar
                </button>
            </div>`;
    };

    window.editarReparacion = function(e, id) {
        e.stopPropagation();
        window.selectReparacion(id);
        window.cambiarEstadoRep(id);
    };

    // ==========================================================
    //  CERRAR MODALES
    // ==========================================================
    window.closeModal = function(modalId) {
        const m = document.getElementById(modalId);
        if (m) m.classList.remove('show');
        if (modalId === 'modal-meter-coche') {
            document.getElementById('btn-mc-text').style.display = 'inline';
            document.getElementById('btn-mc-spinner').style.display = 'none';
        }
    };
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape')
            document.querySelectorAll('.mech-modal.show').forEach(m => m.classList.remove('show'));
    });
    document.querySelectorAll('.mech-modal').forEach(modal => {
        modal.addEventListener('click', e => { if (e.target === modal) window.closeModal(modal.id); });
    });

    // ==========================================================
    //  MODAL 1: METER COCHE
    // ==========================================================
    window.openMeterCocheModal = function() {
        const modal = document.getElementById('modal-meter-coche');
        if (!modal) { window.showNotification('Funcionalidad gestionada por administración', 'error'); return; }
        modal.classList.add('show');
        document.getElementById('mc-motivo').value = '';
        document.getElementById('modal-mc-search').value = '';
        state.selectedCarId = null;
        document.getElementById('btn-mc-confirm').disabled = true;
        document.getElementById('mc-selected-info').style.display = 'none';

        document.getElementById('modal-mc-list').innerHTML =
            `<div style="text-align:center;padding:2rem;">
                <p class="mech-small-muted" style="display:flex;align-items:center;justify-content:center;gap:.5rem;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                         style="animation:mech-spin .7s linear infinite;"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                    Cargando vehículos disponibles…
                </p></div>`;

        // TODO: Reemplazar por:
        // fetch(`${BASE_URL}/coches?en_garaje=0`)
        //   .then(r => { if(!r.ok) throw new Error(r.statusText); return r.json(); })
        //   .then(data => { state.cochesDisponibles = data; renderCochesModal(data); })
        //   .catch(err => { /* mostrar error */ });
        setTimeout(() => {
            state.cochesDisponibles = [...MOCK_COCHES_DISPONIBLES];
            renderCochesModal(state.cochesDisponibles);
        }, 350);
    };

    function renderCochesModal(coches) {
        const list = document.getElementById('modal-mc-list');
        if (!coches.length) {
            list.innerHTML = `<div style="text-align:center;padding:2rem;">
                <p class="mech-small-muted">No hay vehículos disponibles para entrar al taller.</p></div>`;
            return;
        }
        list.innerHTML = coches.map(c => `
            <div class="mc-car-item ${state.selectedCarId === c.id ? 'selected' : ''}"
                 onclick="window.selectCarModal(${c.id})" tabindex="0"
                 onkeydown="if(event.key==='Enter')window.selectCarModal(${c.id})">
                <div class="mc-car-mark">${c.marca.slice(0,2).toUpperCase()}</div>
                <div>
                    <strong style="font-size:var(--mech-text-sm);">${c.marca} ${c.modelo}</strong>
                    <div class="mech-muted" style="display:flex;gap:.5rem;align-items:center;margin-top:2px;">
                        <span style="font-family:monospace;font-size:.75rem;background:var(--mech-surface-offset);
                                     padding:1px 6px;border-radius:6px;border:1px solid var(--mech-border);">${c.matricula}</span>
                        <span style="font-size:var(--mech-text-xs);color:var(--mech-text-faint);">${c.cliente || ''}</span>
                    </div>
                </div>
                <div class="mc-check">
                    ${state.selectedCarId === c.id
                        ? '<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5"><polyline points="20 6 9 17 4 12"/></svg>'
                        : ''}
                </div>
            </div>`).join('');
    }

    window.selectCarModal = function(id) {
        state.selectedCarId = (state.selectedCarId === id) ? null : id;
        const car = state.cochesDisponibles.find(c => c.id === id);
        const btn  = document.getElementById('btn-mc-confirm');
        const info = document.getElementById('mc-selected-info');
        if (state.selectedCarId && car) {
            btn.disabled = false;
            info.style.display = 'block';
            document.getElementById('mc-selected-text').textContent = `${car.marca} ${car.modelo} · ${car.matricula}`;
        } else {
            btn.disabled = true;
            info.style.display = 'none';
        }
        renderCochesModal(state.cochesDisponibles);
    };

    window.filtrarCochesModal = function(q) {
        const query = q.trim().toLowerCase();
        renderCochesModal(query
            ? state.cochesDisponibles.filter(c =>
                c.matricula.toLowerCase().includes(query) ||
                c.marca.toLowerCase().includes(query) ||
                c.modelo.toLowerCase().includes(query) ||
                (c.cliente || '').toLowerCase().includes(query))
            : state.cochesDisponibles);
    };

    window.confirmMeterCoche = async function() {
        const car = state.cochesDisponibles.find(c => c.id === state.selectedCarId);
        if (!car) return;
        const motivo = document.getElementById('mc-motivo').value.trim() || 'Entrada al taller';

        document.getElementById('btn-mc-text').style.display = 'none';
        document.getElementById('btn-mc-spinner').style.display = 'inline';
        document.getElementById('btn-mc-confirm').disabled = true;

        try {
            // TODO: Descomentar cuando el endpoint esté listo:
            // const res = await fetch(`${BASE_URL}/admin/reparaciones`, {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            //         'Accept': 'application/json',
            //     },
            //     body: JSON.stringify({
            //         coche_id:    car.id,
            //         mecanico_id: MECANICO_ID,
            //         descripcion: motivo,
            //         estado:      'pendiente',
            //     }),
            // });
            // if (!res.ok) { const e = await res.json().catch(()=>{}); throw new Error(e?.message || `Error ${res.status}`); }
            // const nuevaRep = await res.json();

            // MOCK temporal:
            await new Promise(r => setTimeout(r, 700));
            const nuevaRep = {
                id: Date.now(), matricula: car.matricula, marca: car.marca, modelo: car.modelo,
                motivo, estado: 'pendiente', horas: 0, piezas: [], piezasPendientes: [],
                fecha_entrada: new Date().toISOString(), fecha_salida: null, coste_total: 0, notas: '',
            };

            state.reparaciones.push(nuevaRep);
            state.cochesDisponibles = state.cochesDisponibles.filter(c => c.id !== car.id);
            renderReparaciones();
            window.closeModal('modal-meter-coche');
            window.showNotification(`✓ ${car.marca} ${car.modelo} (${car.matricula}) registrado en el taller`);

        } catch(err) {
            window.showNotification(`Error: ${err.message}`, 'error');
            document.getElementById('btn-mc-text').style.display = 'inline';
            document.getElementById('btn-mc-spinner').style.display = 'none';
            document.getElementById('btn-mc-confirm').disabled = false;
        }
    };

    // ==========================================================
    //  MODAL 2: REPARACIONES ASIGNADAS
    // ==========================================================
    const raState = {
        reparaciones: [],
        filtradas:    [],
        filtroActivo: 'todos',
        busqueda:     '',
        selectedId:   null,
    };

    function raBadgeHtml(estado) {
        const map = {
            'pendiente':  '<span class="ra-badge-pendiente"><i class="ti ti-alert-circle"></i> Pendiente</span>',
            'en proceso': '<span class="ra-badge-enproceso"><i class="ti ti-player-play"></i> En proceso</span>',
            'finalizada': '<span class="ra-badge-finalizada"><i class="ti ti-check"></i> Finalizada</span>',
        };
        return map[estado] || map['pendiente'];
    }

    function raRenderList() {
        const list = document.getElementById('ra-list');
        if (!raState.filtradas.length) {
            list.innerHTML = `<div style="text-align:center;padding:2rem;">
                <p class="mech-small-muted"><i class="ti ti-mood-empty"
                   style="font-size:1.5rem;display:block;margin-bottom:.5rem;"></i>
                   No hay reparaciones con ese filtro.</p></div>`;
            return;
        }
        list.innerHTML = raState.filtradas.map(r => `
            <div class="ra-rep-item ${raState.selectedId === r.id_reparacion ? 'selected' : ''}"
                 onclick="window.raSeleccionar(${r.id_reparacion})" tabindex="0"
                 onkeydown="if(event.key==='Enter')window.raSeleccionar(${r.id_reparacion})">
                <div class="ra-rep-mark">${r.marca.slice(0,2).toUpperCase()}</div>
                <div style="min-width:0;">
                    <p style="font-weight:700;font-size:var(--mech-text-sm);margin:0;
                               white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        ${r.marca} ${r.modelo}
                        <span style="font-family:monospace;font-size:.72rem;
                                     background:var(--mech-surface-offset);padding:1px 5px;
                                     border-radius:5px;border:1px solid var(--mech-border);
                                     margin-left:.4rem;">${r.matricula}</span>
                    </p>
                    <p style="margin:2px 0 0;font-size:var(--mech-text-xs);color:var(--mech-text-muted);
                               white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        ${r.motivo || 'Sin descripción'}
                        ${r.nombre_cliente ? `· <span style="color:var(--mech-text-faint);">${r.nombre_cliente}</span>` : ''}
                    </p>
                    <p style="margin:3px 0 0;font-size:var(--mech-text-xs);color:var(--mech-text-faint);">
                        Entrada: ${formatFecha(r.fecha_entrada)}
                        ${r.horas_trabajo > 0 ? `· ${r.horas_trabajo}h` : ''}
                        ${r.coste_total_reparacion > 0 ? `· ${r.coste_total_reparacion.toFixed(2)} €` : ''}
                    </p>
                </div>
                <div style="flex-shrink:0;">${raBadgeHtml(r.estado)}</div>
            </div>`).join('');
    }

    function raAplicarFiltros() {
        let data = [...raState.reparaciones];
        if (raState.filtroActivo !== 'todos')
            data = data.filter(r => r.estado === raState.filtroActivo);
        if (raState.busqueda) {
            const q = raState.busqueda.toLowerCase();
            data = data.filter(r =>
                r.matricula.toLowerCase().includes(q) ||
                r.marca.toLowerCase().includes(q) ||
                r.modelo.toLowerCase().includes(q) ||
                (r.motivo || '').toLowerCase().includes(q) ||
                (r.nombre_cliente || '').toLowerCase().includes(q));
        }
        raState.filtradas = data;
        raRenderList();
    }

    function raActualizarPanel() {
        const panel = document.getElementById('ra-actions-panel');
        const rep   = raState.reparaciones.find(r => r.id_reparacion === raState.selectedId);
        if (!rep) { panel.style.display = 'none'; return; }

        panel.style.display = 'block';

        document.getElementById('ra-sel-mark').textContent   = rep.marca.slice(0,2).toUpperCase();
        document.getElementById('ra-sel-nombre').textContent = `${rep.marca} ${rep.modelo} · ${rep.matricula}`;
        document.getElementById('ra-sel-meta').textContent   = `${rep.motivo || 'Sin descripción'}${rep.nombre_cliente ? ' · ' + rep.nombre_cliente : ''}`;
        document.getElementById('ra-sel-fechas').textContent =
            `Entrada: ${formatFecha(rep.fecha_entrada)}` +
            (rep.fecha_salida ? `  ·  Salida: ${formatFecha(rep.fecha_salida)}` : '');
        document.getElementById('ra-sel-badge').innerHTML    = raBadgeHtml(rep.estado);

        const btnI = document.getElementById('ra-btn-iniciar');
        const btnP = document.getElementById('ra-btn-pausar');
        const btnF = document.getElementById('ra-btn-finalizar');

        if (rep.estado === 'finalizada') {
            btnI.style.display = btnP.style.display = btnF.style.display = 'none';
            // Muestra nota de reparación cerrada
            const existing = document.getElementById('ra-cerrada-notice');
            if (!existing) {
                const notice = document.createElement('p');
                notice.id = 'ra-cerrada-notice';
                notice.style.cssText = 'font-size:var(--mech-text-xs);color:var(--mech-text-faint);text-align:center;padding:.5rem 0;';
                notice.innerHTML = '<i class="ti ti-lock"></i> Reparación finalizada — solo lectura';
                document.getElementById('ra-estado-btns').after(notice);
            }
        } else {
            const notice = document.getElementById('ra-cerrada-notice');
            if (notice) notice.remove();
            btnI.style.display = rep.estado === 'pendiente'  ? 'flex' : 'none';
            btnP.style.display = rep.estado === 'en proceso' ? 'flex' : 'none';
            btnF.style.display = 'flex';
        }

        document.getElementById('ra-notas').value = rep.notas_mecanico || '';
    }

    window.raSeleccionar = function(id) {
        raState.selectedId = (raState.selectedId === id) ? null : id;
        raRenderList();
        raActualizarPanel();
    };

    window.raFiltrar = function(filtro) {
        raState.filtroActivo = filtro;
        document.querySelectorAll('.ra-filter-btn').forEach(b =>
            b.classList.toggle('active', b.dataset.filter === filtro));
        raAplicarFiltros();
    };

    window.raBuscar = function(q) {
        raState.busqueda = q.trim();
        raAplicarFiltros();
    };

    // ❌ ENDPOINT PENDIENTE: PUT /api/reparaciones/{id}/estado
    //    No existe ninguna ruta para actualizar el estado de una reparación.
    //
    //    Añadir en ReparacionController.php:
    //    public function updateEstado(Request $request, $id_reparacion) {
    //        $request->validate(['estado' => 'required|in:pendiente,en proceso,finalizada']);
    //        $rep = Reparacion::findOrFail($id_reparacion);
    //        $rep->estado = $request->estado;
    //        if ($request->estado === 'finalizada') $rep->fecha_salida = now();
    //        if ($request->estado === 'en proceso')  $rep->fecha_salida = null;
    //        $rep->save();
    //        return response()->json(['status' => 'success', 'data' => $rep], 200);
    //    }
    //    Ruta en api.php:
    //    Route::put('/reparaciones/{id}/estado', [ReparacionController::class, 'updateEstado']);
    //
    //    Cuando esté disponible, hacer raCambiarEstado async y añadir al inicio:
    //    const res = await fetch(`${BASE_URL}/reparaciones/${raState.selectedId}/estado`, {
    //        method: 'PUT',
    //        headers: {
    //            'Content-Type': 'application/json',
    //            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
    //            'Accept': 'application/json',
    //        },
    //        body: JSON.stringify({ estado: nuevoEstado }),
    //    });
    //    if (!res.ok) {
    //        const e = await res.json().catch(()=>({}));
    //        window.showNotification(`Error: ${e?.message || res.status}`, 'error'); return;
    //    }
    window.raCambiarEstado = function(nuevoEstado) {
        const rep = raState.reparaciones.find(r => r.id_reparacion === raState.selectedId);
        if (!rep) return;

        rep.estado = nuevoEstado;
        if (nuevoEstado === 'finalizada') rep.fecha_salida = new Date().toISOString().replace('T',' ').slice(0,19);
        if (nuevoEstado === 'en proceso') rep.fecha_salida = null;

        // Sincronizar con tabla principal del dashboard
        const repMain = state.reparaciones.find(r => r.id === raState.selectedId);
        if (repMain) { repMain.estado = nuevoEstado; renderReparaciones(); }

        raAplicarFiltros();
        raActualizarPanel();
        window.showNotification(`✓ Estado actualizado a "${nuevoEstado}"`);
    };

    // Guardia antes de finalizar
    window.raConfirmarFinalizar = function() {
        const rep = raState.reparaciones.find(r => r.id_reparacion === raState.selectedId);
        if (!rep) return;
        if (rep.horas_trabajo === 0) {
            if (!confirm(`⚠️ La reparación "${rep.motivo || rep.matricula}" tiene 0 horas registradas.\n\n¿Finalizar igualmente?`)) return;
        }
        window.raCambiarEstado('finalizada');
    };

    // Notas locales (no persisten hasta que exista el endpoint)
    window.raGuardarNotasLocal = function(valor) {
        const rep = raState.reparaciones.find(r => r.id_reparacion === raState.selectedId);
        if (rep) rep.notas_mecanico = valor;
    };

    function raCargar() {
        document.getElementById('ra-list').innerHTML =
            `<div style="text-align:center;padding:2rem;">
                <p class="mech-small-muted" style="display:flex;align-items:center;justify-content:center;gap:.5rem;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" style="animation:mech-spin .7s linear infinite;">
                         <path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                    Cargando…</p></div>`;

        // TODO: Reemplazar por:
        // fetch(`${BASE_URL}/mecanico/reparaciones`, { headers:{'Accept':'application/json'} })
        //   .then(r => { if(!r.ok) throw new Error(r.statusText); return r.json(); })
        //   .then(data => {
        //       raState.reparaciones = data;
        //       raState.filtroActivo = 'todos';
        //       raState.busqueda = '';
        //       raAplicarFiltros();
        //   })
        //   .catch(err => {
        //       document.getElementById('ra-list').innerHTML =
        //           `<p style="text-align:center;padding:1.5rem;" class="mech-small-muted">
        //              Error al cargar: ${err.message}</p>`;
        //   });
        setTimeout(() => {
            raState.reparaciones = JSON.parse(JSON.stringify(MOCK_REP_ASIGNADAS));
            raState.filtroActivo = 'todos';
            raState.busqueda = '';
            document.getElementById('ra-search').value = '';
            raAplicarFiltros();
        }, 400);
    }

    window.raRecargar = function() {
        raState.selectedId = null;
        document.getElementById('ra-actions-panel').style.display = 'none';
        raCargar();
    };

    window.openRepAsignadasModal = function() {
        const modal = document.getElementById('modal-rep-asignadas');
        modal.classList.add('show');
        raState.selectedId = null;
        document.getElementById('ra-actions-panel').style.display = 'none';
        window.raFiltrar('todos');
        raCargar();
    };

    // ==========================================================
    //  MODALES SECUNDARIOS (creados dinámicamente)
    // ==========================================================
    const MODAL_META = {
        'modal-meter-coche':            { icon: 'ti-car',            sub: 'Selecciona el vehículo a registrar' },
        'modal-reparaciones-asignadas': { icon: 'ti-tools',          sub: 'Gestiona tus órdenes de trabajo'   },
        'modal-agregar-piezas':         { icon: 'ti-tool',           sub: 'Descuenta unidades del almacén'    },
        'modal-solicitar-piezas':       { icon: 'ti-package',        sub: 'Revisada por administración'       },
        'modal-diagnosticar':           { icon: 'ti-clipboard-list', sub: 'Registra los hallazgos del vehículo' },
        'modal-agregar-horas':          { icon: 'ti-clock-hour-4',   sub: 'Añade horas a una reparación activa' },
        'modal-notas':                  { icon: 'ti-notes',          sub: 'Notas internas de la reparación'   },
    };

    function createModal(id, title, content) {
        const meta = MODAL_META[id] || {};
        const icon = meta.icon || 'ti-settings';
        const sub  = meta.sub  || '';

        let m = document.getElementById(id);
        if (!m) {
            m = document.createElement('div');
            m.id = id;
            m.className = 'mech-modal';
            m.innerHTML = `
                <div class="mech-modal-content">
                    <div class="mech-modal-header">
                        <div class="mech-modal-header-left">
                            <div class="mech-modal-icon">
                                <i class="ti ${icon}"></i>
                            </div>
                            <div>
                                <h2>${title}</h2>
                                ${sub ? `<p class="mech-modal-subtitle">${sub}</p>` : ''}
                            </div>
                        </div>
                        <button class="mech-close-btn"
                                onclick="window.closeModal('${id}')"
                                aria-label="Cerrar">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                    <div class="mech-modal-body" id="${id}-body">${content}</div>
                </div>`;
            document.body.appendChild(m);
            m.addEventListener('click', e => { if (e.target === m) window.closeModal(id); });
        } else {
            document.getElementById(`${id}-body`).innerHTML = content;
        }
        return m;
    }

    const repOptions = () => state.reparaciones.map(r =>
        `<option value="${r.id}">${r.marca} ${r.modelo} (${r.matricula})</option>`).join('');

    function openDiagnosticarModal() {
        window.showNotification('Diagnóstico gestionado por administración', 'error');
        return;
        const m = createModal('modal-diagnosticar', 'Diagnosticar vehículo', `
            <form onsubmit="window.submitDiagnosticar(event)">
                <div class="mech-form-group">
                    <label>Vehículo *</label>
                    <select id="vehiculo-diag" required>
                        <option value="">Selecciona un vehículo</option>${repOptions()}
                    </select>
                </div>
                <div class="mech-form-group">
                    <label>Hallazgos del diagnóstico *</label>
                    <textarea id="diagnostico" placeholder="Describe los problemas encontrados" rows="3" required></textarea>
                </div>
                <div class="mech-form-group">
                    <label>Recomendaciones</label>
                    <textarea id="recomendaciones" placeholder="Acciones recomendadas" rows="2"></textarea>
                </div>
                <div class="mech-btn-group">
                    <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-diagnosticar')">Cancelar</button>
                    <button type="submit" class="mech-btn mech-btn-primary"><i class="ti ti-magnify"></i> Guardar diagnóstico</button>
                </div>
            </form>`);
        m.classList.add('show');
    }

    function openAgregarHorasModal() {
        // TODO: Conectar con PUT /api/mecanico/reparaciones/{id}/horas
        //   Body: { horas_trabajo: total_acumulado, coste_mano_obra: total * tarifa }
        //   NOTA: tarifa_hora NO existe en BD. Sugerencia: añadir campo
        //   `tarifa_hora` DECIMAL(8,2) a tabla `mecanicos`, o usar valor fijo.
        const m = createModal('modal-agregar-horas', 'Añadir horas de trabajo', `
            <form onsubmit="window.submitAgregarHoras(event)">
                <div class="mech-form-group">
                    <label>Vehículo / Reparación *</label>
                    <select id="vehiculo-horas" required>
                        <option value="">Selecciona una reparación</option>${repOptions()}
                    </select>
                </div>
                <div class="mech-form-group">
                    <label>Horas trabajadas *</label>
                    <input type="number" id="horas-value" placeholder="Ej: 2.5" step="0.5" min="0.5" required>
                </div>
                <div class="mech-form-group">
                    <label>Descripción del trabajo realizado</label>
                    <textarea id="descripcion-trabajo" placeholder="Qué trabajo se realizó en estas horas" rows="2"></textarea>
                </div>
                <div class="mech-btn-group">
                    <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-agregar-horas')">Cancelar</button>
                    <button type="submit" class="mech-btn mech-btn-primary"><i class="ti ti-clock-plus"></i> Registrar horas</button>
                </div>
            </form>`);
        m.classList.add('show');
    }

    function openAgregarPiezasModal() {
        const m = createModal('modal-agregar-piezas', 'Añadir piezas utilizadas', `
            <form onsubmit="window.submitAgregarPiezas(event)">
                <div class="mech-form-group">
                    <label>Reparación *</label>
                    <select id="vehiculo-piezas" required>
                        <option value="">Selecciona una reparación</option>${repOptions()}
                    </select>
                </div>
                <div class="mech-form-group">
                    <label for="select-pieza">Pieza *</label>
                    <div id="pieza-select-wrap" style="position:relative;">
                        <div style="display:flex;align-items:center;gap:8px;
                                    background:var(--mech-surface-2);border:1px solid var(--mech-border);
                                    border-radius:14px;padding:.5rem 1rem;font-size:var(--mech-text-xs);
                                    color:var(--mech-text-muted);">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.5" style="animation:mech-spin .7s linear infinite;flex-shrink:0;">
                                <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                            </svg>
                            Cargando catálogo de piezas…
                        </div>
                    </div>
                </div>
                <div class="mech-form-group" id="pieza-info-box" style="display:none;">
                    <div class="ap-pieza-info visible">
                        <div class="ap-pieza-info-item">
                            <span class="ap-info-label">Stock disponible</span>
                            <span class="ap-info-value" id="pieza-stock"></span>
                        </div>
                        <div class="ap-pieza-info-item">
                            <span class="ap-info-label">Precio venta</span>
                            <span class="ap-info-value" id="pieza-precio"></span>
                        </div>
                        <div class="ap-pieza-info-item">
                            <span class="ap-info-label">Coste estimado</span>
                            <span class="ap-info-value highlight" id="pieza-coste-est"></span>
                        </div>
                    </div>
                    <div id="pieza-stock-warn" class="mech-form-notice warning" style="display:none;">
                        <i class="ti ti-alert-triangle"></i>
                        <span id="pieza-stock-warn-text"></span>
                    </div>
                </div>
                <div class="mech-form-group">
                    <label for="cantidad-pieza">Cantidad *</label>
                    <input type="number" id="cantidad-pieza" value="1" min="1" required
                           oninput="window.piezaActualizarCoste()">
                </div>
                <div id="ap-error" class="ap-error"></div>
                <div class="mech-btn-group">
                    <button type="button" class="mech-btn-cancel"
                            onclick="window.closeModal('modal-agregar-piezas')">Cancelar</button>
                    <button type="submit" id="btn-ap-submit" class="mech-btn mech-btn-primary" disabled>
                        <span id="btn-ap-text"><i class="ti ti-tool"></i> Añadir pieza</span>
                        <span id="btn-ap-spinner" style="display:none;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.5" style="animation:mech-spin .6s linear infinite;vertical-align:middle;">
                                <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                            </svg> Registrando…
                        </span>
                    </button>
                </div>
            </form>`);

        m.classList.add('show');

        // Catálogo de piezas — estado interno del modal
        window._apState = {
            catalogo: [],   // piezas cargadas desde API / mock
            selectedPieza: null,
        };

        // TODO: Reemplazar el mock por la llamada real:
        //   fetch(`${BASE_URL}/piezas`, { headers: { 'Accept': 'application/json' } })
        //     .then(r => { if(!r.ok) throw new Error(r.statusText); return r.json(); })
        //     .then(data => { window._apState.catalogo = data; window.apRenderSelect(); })
        //     .catch(err => {
        //         document.getElementById('pieza-select-wrap').innerHTML =
        //             `<p style="color:var(--mech-danger);font-size:var(--mech-text-xs);">
        //              <i class='ti ti-alert-circle'></i> Error al cargar piezas: ${err.message}</p>`;
        //     });
        //
        // Estructura esperada del JSON (GET /api/piezas):
        //   [ { id_pieza, nombre_pieza, cantidad_disponible, precio_compra, precio_venta,
        //       stock_minimo, id_proveedor }, ... ]
        setTimeout(() => {
            window._apState.catalogo = [
                { id_pieza: 1,  nombre_pieza: 'Filtro de aceite',      cantidad_disponible: 3,  precio_venta: 10.00,  stock_minimo: 5  },
                { id_pieza: 2,  nombre_pieza: 'Pastillas de freno',    cantidad_disponible: 8,  precio_venta: 30.00,  stock_minimo: 5  },
                { id_pieza: 3,  nombre_pieza: 'Batería 70Ah',          cantidad_disponible: 8,  precio_venta: 90.00,  stock_minimo: 3  },
                { id_pieza: 4,  nombre_pieza: 'Correa de distribución',cantidad_disponible: 11, precio_venta: 55.00,  stock_minimo: 5  },
                { id_pieza: 5,  nombre_pieza: 'Amortiguador delantero',cantidad_disponible: 6,  precio_venta: 80.00,  stock_minimo: 2  },
                { id_pieza: 6,  nombre_pieza: 'Embrague',              cantidad_disponible: 5,  precio_venta: 150.00, stock_minimo: 1  },
                { id_pieza: 7,  nombre_pieza: 'Aceite 5W30 5L',        cantidad_disponible: 15, precio_venta: 35.00,  stock_minimo: 5  },
                { id_pieza: 8,  nombre_pieza: 'Radiador',              cantidad_disponible: 5,  precio_venta: 100.00, stock_minimo: 3  },
                { id_pieza: 9,  nombre_pieza: 'Espejo retrovisor',     cantidad_disponible: 9,  precio_venta: 45.00,  stock_minimo: 2  },
                { id_pieza: 10, nombre_pieza: 'Inyector diésel',       cantidad_disponible: 0,  precio_venta: 140.00, stock_minimo: 2  },
                { id_pieza: 11, nombre_pieza: 'Turbo',                 cantidad_disponible: 3,  precio_venta: 320.00, stock_minimo: 2  },
                { id_pieza: 12, nombre_pieza: 'Sensor ABS',            cantidad_disponible: 7,  precio_venta: 32.00,  stock_minimo: 3  },
                { id_pieza: 13, nombre_pieza: 'Rótula de dirección',   cantidad_disponible: 12, precio_venta: 17.00,  stock_minimo: 10 },
                { id_pieza: 14, nombre_pieza: 'Termostato',            cantidad_disponible: 11, precio_venta: 18.00,  stock_minimo: 5  },
                { id_pieza: 17, nombre_pieza: 'Cachapón',              cantidad_disponible: 10, precio_venta: 15.00,  stock_minimo: 3  },
            ];
            window.apRenderSelect();
        }, 350);
    }

    // Renderiza el <select> de piezas con stock y estado
    window.apReintentarCatalogo = function() {
        const wrap = document.getElementById('pieza-select-wrap');
        if (wrap) wrap.innerHTML =
            `<div style="display:flex;align-items:center;gap:8px;padding:.4rem .75rem;
                          font-size:var(--mech-text-xs);color:var(--mech-text-muted);">
                 <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                      stroke-width="2.5" style="animation:mech-spin .7s linear infinite;">
                      <path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                 Reintentando…</div>`;
        fetch(`${BASE_URL}/piezas`, { headers: { 'Accept': 'application/json' } })
            .then(r => { if (!r.ok) throw new Error(`HTTP ${r.status}`); return r.json(); })
            .then(json => { window._apState.catalogo = json.data || json; window.apRenderSelect(); })
            .catch(err => {
                if (wrap) wrap.innerHTML =
                    `<p style="color:var(--mech-danger);font-size:var(--mech-text-xs);padding:.5rem;">
                         Error: ${err.message}</p>`;
            });
    };

    window.apRenderSelect = function() {
        const wrap = document.getElementById('pieza-select-wrap');
        if (!wrap) return;
        const catalogo = window._apState?.catalogo || [];
        wrap.innerHTML = `
            <select id="select-pieza" required onchange="window.apOnPiezaChange(this.value)"
                    style="width:100%;padding:.75rem 1rem;border:1px solid var(--mech-border);
                           border-radius:14px;background:var(--mech-surface-2);color:var(--mech-text);
                           font-family:'Outfit',sans-serif;font-size:var(--mech-text-sm);
                           transition:border-color var(--mech-transition),box-shadow var(--mech-transition);">
                <option value="">Selecciona una pieza…</option>
                ${catalogo.map(p => {
                    const sinStock = p.cantidad_disponible === 0;
                    const bajoMin  = p.cantidad_disponible > 0 && p.cantidad_disponible < p.stock_minimo;
                    const label    = sinStock
                        ? `${p.nombre_pieza}  ·  ✗ Sin stock`
                        : bajoMin
                            ? `${p.nombre_pieza}  ·  ${p.cantidad_disponible} uds ⚠`
                            : `${p.nombre_pieza}  ·  ${p.cantidad_disponible} uds`;
                    return `<option value="${p.id_pieza}" ${sinStock ? 'disabled' : ''}>${label}</option>`;
                }).join('')}
            </select>`;
        // Restaurar focus style
        const sel = document.getElementById('select-pieza');
        if (sel) {
            sel.addEventListener('focus', () => {
                sel.style.outline = 'none';
                sel.style.borderColor = 'var(--mech-primary)';
                sel.style.boxShadow   = '0 0 0 3px var(--mech-primary-highlight)';
            });
            sel.addEventListener('blur', () => {
                sel.style.borderColor = '';
                sel.style.boxShadow   = '';
            });
        }
    };

    // Al cambiar la pieza seleccionada: muestra info + valida stock
    window.apOnPiezaChange = function(idPieza) {
        const p = window._apState.catalogo.find(x => x.id_pieza === parseInt(idPieza));
        window._apState.selectedPieza = p || null;

        const infoBox  = document.getElementById('pieza-info-box');
        const warnBox  = document.getElementById('pieza-stock-warn');
        const submitBtn= document.getElementById('btn-ap-submit');
        const errBox   = document.getElementById('ap-error');

        if (errBox) errBox.style.display = 'none';

        if (!p) {
            if (infoBox)  infoBox.style.display = 'none';
            if (submitBtn) submitBtn.disabled = true;
            return;
        }

        // Rellenar info
        infoBox.style.display = 'block';
        document.getElementById('pieza-stock').textContent  =
            p.cantidad_disponible > 0 ? `${p.cantidad_disponible} uds` : '— Sin stock';
        document.getElementById('pieza-precio').textContent =
            `${p.precio_venta.toFixed(2)} €`;

        const cant = parseInt(document.getElementById('cantidad-pieza')?.value || 1);
        document.getElementById('pieza-coste-est').textContent =
            `${(p.precio_venta * cant).toFixed(2)} €`;

        // Aviso bajo mínimo
        if (p.cantidad_disponible < p.stock_minimo) {
            warnBox.style.display = 'flex';
            document.getElementById('pieza-stock-warn-text').textContent =
                `Stock por debajo del mínimo (${p.stock_minimo} uds). Considera reponerlo antes de usar.`;
        } else {
            warnBox.style.display = 'none';
        }

        // Ajustar max cantidad
        const cantInput = document.getElementById('cantidad-pieza');
        if (cantInput) cantInput.max = p.cantidad_disponible;

        submitBtn.disabled = false;
    };

    // Actualiza el coste estimado al cambiar cantidad
    window.piezaActualizarCoste = function() {
        const p    = window._apState?.selectedPieza;
        const cant = parseInt(document.getElementById('cantidad-pieza')?.value || 1);
        const el   = document.getElementById('pieza-coste-est');
        if (p && el) el.textContent = `${(p.precio_venta * cant).toFixed(2)} €`;

        // Validar que no supere el stock
        const submitBtn = document.getElementById('btn-ap-submit');
        const errBox    = document.getElementById('ap-error');
        if (p && cant > p.cantidad_disponible) {
            if (errBox) {
                errBox.style.display = 'block';
                errBox.textContent   =
                    `Stock insuficiente. Solo hay ${p.cantidad_disponible} unidades disponibles.`;
            }
            if (submitBtn) submitBtn.disabled = true;
        } else {
            if (errBox) errBox.style.display = 'none';
            if (submitBtn && p) submitBtn.disabled = false;
        }
    };

    function openSolicitarPiezasModal() {
        // ❌ ENDPOINT PENDIENTE: POST /api/solicitudes-piezas
        //    comprarPieza (POST /api/piezas/{id}/comprar) es para ADMINISTRACIÓN: sube stock y
        //    registra un gasto contable. El mecánico NO debe invocar ese endpoint directamente.
        //
        //    Flujo recomendado: el mecánico solicita → administración revisa → convierte en compra.
        //    Implementar:
        //      - Tabla:     solicitudes_piezas (id, id_reparacion, id_pieza, cantidad, id_mecanico, estado, created_at)
        //      - Endpoint:  POST /api/solicitudes-piezas → SolicitudPiezaController@store
        //      - Admin:     GET  /api/admin/solicitudes-piezas  → para procesar y convertir en compra
        //
        //    Cuando esté disponible, reemplazar submitSolicitarPiezas con:
        //    const res = await fetch(`${BASE_URL}/solicitudes-piezas`, {
        //        method: 'POST',
        //        headers: { 'Content-Type':'application/json',
        //                   'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content||'',
        //                   'Accept':'application/json' },
        //        body: JSON.stringify({ id_reparacion, id_pieza, cantidad, id_mecanico: MECANICO_ID, motivo }),
        //    });

        const m = createModal('modal-solicitar-piezas', 'Solicitar piezas al proveedor', `
            <div class="mech-form-notice warning">
                <i class="ti ti-alert-triangle"></i>
                Esta solicitud será revisada por administración — no repone stock directamente.
            </div>
            <form onsubmit="window.submitSolicitarPiezas(event)">
                <div class="mech-form-group">
                    <label>Reparación *</label>
                    <select id="vehiculo-solicitud" required>
                        <option value="">Selecciona una reparación</option>${repOptions()}
                    </select>
                </div>
                <div class="mech-form-group">
                    <label>Pieza a solicitar *</label>
                    <div id="pieza-solicitud-wrap">
                        <div style="display:flex;align-items:center;gap:8px;padding:.4rem .75rem;
                                    background:var(--mech-surface-2);border:1px solid var(--mech-border);
                                    border-radius:14px;font-size:var(--mech-text-xs);color:var(--mech-text-muted);">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.5" style="animation:mech-spin .7s linear infinite;flex-shrink:0;">
                                <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                            </svg>
                            Cargando catálogo de piezas…
                        </div>
                    </div>
                </div>
                <div class="mech-form-group">
                    <label>Cantidad *</label>
                    <input type="number" id="cantidad-solicitud" value="1" min="1" required>
                </div>
                <div class="mech-form-group">
                    <label>Motivo / Urgencia</label>
                    <input type="text" id="motivo-solicitud"
                           placeholder="Ej: Bloquea reparación — urgente">
                </div>
                <div class="mech-btn-group">
                    <button type="button" class="mech-btn-cancel"
                            onclick="window.closeModal('modal-solicitar-piezas')">Cancelar</button>
                    <button type="submit" id="btn-sol-submit" class="mech-btn mech-btn-primary">
                        <span id="btn-sol-text"><i class="ti ti-package"></i> Solicitar pieza</span>
                        <span id="btn-sol-spinner" style="display:none;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.5" style="animation:mech-spin .6s linear infinite;vertical-align:middle;">
                                <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                            </svg> Enviando…
                        </span>
                    </button>
                </div>
            </form>`);
        m.classList.add('show');

        // ✅ FETCH REAL — GET /api/piezas → PiezaController@index
        // Carga el catálogo completo. Las piezas sin stock o bajo mínimo se marcan visualmente.
        fetch(`${BASE_URL}/piezas`, { headers: { 'Accept': 'application/json' } })
            .then(r => { if (!r.ok) throw new Error(`HTTP ${r.status}`); return r.json(); })
            .then(json => {
                const piezas = json.data || json;
                const wrap   = document.getElementById('pieza-solicitud-wrap');
                if (!wrap) return;
                wrap.innerHTML = `
                    <select id="pieza-solicitud-select" required
                            style="width:100%;padding:.75rem 1rem;border:1px solid var(--mech-border);
                                   border-radius:14px;background:var(--mech-surface-2);color:var(--mech-text);
                                   font-family:'Outfit',sans-serif;font-size:var(--mech-text-sm);">
                        <option value="">Selecciona una pieza…</option>
                        ${piezas.map(p => {
                            const sinStock = p.cantidad_disponible === 0;
                            const bajMin   = p.cantidad_disponible < p.stock_minimo && !sinStock;
                            const icono    = sinStock ? '✗ Sin stock — ' : bajMin ? '⚠ Bajo mínimo — ' : '';
                            return `<option value="${p.id_pieza}"
                                            data-nombre="${p.nombre_pieza}">
                                        ${icono}${p.nombre_pieza} (stock: ${p.cantidad_disponible})
                                    </option>`;
                        }).join('')}
                    </select>`;
            })
            .catch(err => {
                const wrap = document.getElementById('pieza-solicitud-wrap');
                if (wrap) wrap.innerHTML =
                    `<div style="padding:.6rem 1rem;border-radius:12px;font-size:var(--mech-text-xs);
                                  background:rgba(197,61,61,.1);border:1px solid rgba(197,61,61,.25);
                                  color:var(--mech-danger);display:flex;align-items:center;gap:.5rem;">
                         <i class="ti ti-alert-circle"></i> Error al cargar piezas: ${err.message}
                     </div>`;
            });
    }

    // ==========================================================
    //  FORM SUBMISSIONS MODALES SECUNDARIOS
    // ==========================================================
    window.submitDiagnosticar = function(e) {
        e.preventDefault();
        // TODO: POST /api/mecanico/diagnosticos (endpoint pendiente)
        //   Body: { id_reparacion, hallazgos, recomendaciones }
        //   Sugerencia: añadir tabla `diagnosticos` o campo TEXT en `reparaciones`
        window.closeModal('modal-diagnosticar');
        window.showNotification('✓ Diagnóstico registrado correctamente');
    };

    window.submitAgregarHoras = function(e) {
        e.preventDefault();
        const id    = parseInt(document.getElementById('vehiculo-horas').value);
        const horas = parseFloat(document.getElementById('horas-value').value);
        const rep   = state.reparaciones.find(r => r.id === id);
        if (rep) { rep.horas += horas; renderReparaciones(); }
        window.closeModal('modal-agregar-horas');
        window.showNotification(`✓ +${horas}h registradas`);
    };

    window.submitAgregarPiezas = async function(e) {
        e.preventDefault();

        const id_reparacion = parseInt(document.getElementById('vehiculo-piezas').value);
        const pieza         = window._apState?.selectedPieza;
        const cantidad      = parseInt(document.getElementById('cantidad-pieza').value);
        const errBox        = document.getElementById('ap-error');
        const submitBtn     = document.getElementById('btn-ap-submit');

        if (!pieza || !id_reparacion || cantidad < 1) return;

        // Validación final de stock en cliente
        if (cantidad > pieza.cantidad_disponible) {
            if (errBox) {
                errBox.style.display = 'block';
                errBox.textContent   =
                    `Stock insuficiente. Solo hay ${pieza.cantidad_disponible} unidades disponibles.`;
            }
            return;
        }

        // Estado de carga
        document.getElementById('btn-ap-text').style.display    = 'none';
        document.getElementById('btn-ap-spinner').style.display = 'inline';
        submitBtn.disabled = true;

        try {
            // ❌ ENDPOINT PENDIENTE: POST /api/reparaciones/{id}/piezas
            //
            // ⚠️  comprarPieza (POST /api/piezas/{id}/comprar) NO sirve aquí: ese endpoint
            //     INCREMENTA el stock y registra un gasto contable (reposición de almacén).
            //     Lo que se necesita es el caso contrario: DECREMENTAR stock al usar la pieza.
            //
            //    Añadir en ReparacionController.php:
            //    public function addPieza(Request $request, $id_reparacion) {
            //        $request->validate([
            //            'id_pieza'       => 'required|integer|exists:piezas,id_pieza',
            //            'cantidad_usada' => 'required|integer|min:1',
            //        ]);
            //        DB::transaction(function () use ($request, $id_reparacion) {
            //            $pieza = \App\Models\Pieza::lockForUpdate()->findOrFail($request->id_pieza);
            //            if ($pieza->cantidad_disponible < $request->cantidad_usada) {
            //                abort(422, "Stock insuficiente. Disponible: {$pieza->cantidad_disponible}");
            //            }
            //            \App\Models\ReparacionPieza::create([
            //                'id_reparacion'  => $id_reparacion,
            //                'id_pieza'       => $request->id_pieza,
            //                'cantidad_usada' => $request->cantidad_usada,
            //                'id_usuario'     => Auth::id(),
            //            ]);
            //            $pieza->decrement('cantidad_disponible', $request->cantidad_usada);
            //            $total = \App\Models\ReparacionPieza::where('id_reparacion', $id_reparacion)
            //                ->join('piezas', 'reparaciones_piezas.id_pieza', '=', 'piezas.id_pieza')
            //                ->sum(\DB::raw('reparaciones_piezas.cantidad_usada * piezas.precio_venta'));
            //            \App\Models\Reparacion::where('id_reparacion', $id_reparacion)
            //                ->update(['coste_total_piezas' => $total]);
            //        });
            //        return response()->json(['status' => 'success', 'message' => 'Pieza añadida'], 201);
            //    }
            //    Ruta en api.php:
            //    Route::post('/reparaciones/{id}/piezas', [ReparacionController::class, 'addPieza']);
            //
            //    Cuando esté disponible, reemplazar el bloque mock por:
            //    const res = await fetch(`${BASE_URL}/reparaciones/${id_reparacion}/piezas`, {
            //        method: 'POST',
            //        headers: {
            //            'Content-Type': 'application/json',
            //            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            //            'Accept': 'application/json',
            //        },
            //        body: JSON.stringify({ id_pieza: pieza.id_pieza, cantidad_usada: cantidad }),
            //    });
            //    if (!res.ok) {
            //        const e = await res.json().catch(()=>({}));
            //        throw new Error(e?.message || `Error ${res.status}`);
            //    }

            // MOCK temporal: simula latencia y actualiza estado local
            await new Promise(r => setTimeout(r, 600));

            // Actualizar stock local del catálogo (optimistic update)
            const piezaCatalogo = window._apState.catalogo.find(x => x.id_pieza === pieza.id_pieza);
            if (piezaCatalogo) piezaCatalogo.cantidad_disponible -= cantidad;

            // Actualizar reparación en el dashboard
            const rep = state.reparaciones.find(r => r.id === id_reparacion);
            if (rep) {
                // Añadir nombre si no está ya listado
                if (!rep.piezas.includes(pieza.nombre_pieza)) rep.piezas.push(pieza.nombre_pieza);
                // Sumar al coste total de piezas
                rep.coste_total = (rep.coste_total || 0) + (pieza.precio_venta * cantidad);
                renderReparaciones();
            }

            window.closeModal('modal-agregar-piezas');
            window.showNotification(
                `✓ ${cantidad}× ${pieza.nombre_pieza} añadida a la reparación (−${cantidad} del stock)`
            );

        } catch(err) {
            if (errBox) {
                errBox.style.display = 'block';
                errBox.textContent   = `Error: ${err.message}`;
            }
            document.getElementById('btn-ap-text').style.display    = 'inline';
            document.getElementById('btn-ap-spinner').style.display = 'none';
            submitBtn.disabled = false;
        }
    };

    window.submitSolicitarPiezas = async function(e) {
        e.preventDefault();

        const id_reparacion = parseInt(document.getElementById('vehiculo-solicitud')?.value);
        const selectPieza   = document.getElementById('pieza-solicitud-select');
        // Fallback al input de texto si el select dinámico no existe (no debería ocurrir)
        const id_pieza      = selectPieza ? parseInt(selectPieza.value) : null;
        const nombre_pieza  = selectPieza
            ? selectPieza.options[selectPieza.selectedIndex]?.dataset?.nombre || selectPieza.value
            : (document.getElementById('pieza-solicitada')?.value || '');
        const cantidad      = parseInt(document.getElementById('cantidad-solicitud')?.value || 1);
        const motivo        = document.getElementById('motivo-solicitud')?.value || '';

        if (!id_reparacion || !id_pieza) return;

        const btnText    = document.getElementById('btn-sol-text');
        const btnSpinner = document.getElementById('btn-sol-spinner');
        const btnSubmit  = document.getElementById('btn-sol-submit');

        if (btnText)    btnText.style.display    = 'none';
        if (btnSpinner) btnSpinner.style.display = 'inline';
        if (btnSubmit)  btnSubmit.disabled       = true;

        try {
            // ❌ ENDPOINT PENDIENTE: POST /api/solicitudes-piezas
            //    comprarPieza NO se usa aquí: es para administración (sube stock + gasto contable).
            //    Cuando el endpoint de solicitudes esté disponible, reemplazar el mock por:
            //    const res = await fetch(`${BASE_URL}/solicitudes-piezas`, {
            //        method: 'POST',
            //        headers: {
            //            'Content-Type': 'application/json',
            //            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            //            'Accept': 'application/json',
            //        },
            //        body: JSON.stringify({ id_reparacion, id_pieza, cantidad, id_mecanico: MECANICO_ID, motivo }),
            //    });
            //    if (!res.ok) { const e = await res.json().catch(()=>({})); throw new Error(e?.message || `Error ${res.status}`); }

            await new Promise(r => setTimeout(r, 500)); // MOCK

            // Actualizar estado local del dashboard
            const rep = state.reparaciones.find(r => r.id === id_reparacion);
            if (rep && !rep.piezasPendientes.includes(nombre_pieza)) {
                rep.piezasPendientes.push(nombre_pieza);
                renderReparaciones();
            }

            window.closeModal('modal-solicitar-piezas');
            window.showNotification(`✓ Solicitud de "${nombre_pieza}" enviada a administración`);

        } catch(err) {
            window.showNotification(`Error: ${err.message}`, 'error');
            if (btnText)    btnText.style.display    = 'inline';
            if (btnSpinner) btnSpinner.style.display = 'none';
            if (btnSubmit)  btnSubmit.disabled       = false;
        }
    };

    // ==========================================================
    //  CAMBIAR ESTADO Y FINALIZAR (desde tabla principal)
    // ==========================================================
    window.cambiarEstadoRep = function(id) {
        const rep = state.reparaciones.find(r => r.id === id);
        if (!rep) return;
        const estados = [
            { value: 'pendiente',  label: 'Pendiente'   },
            { value: 'en proceso', label: 'En proceso'  },
            { value: 'finalizada', label: 'Finalizada'  },
        ];
        const m = createModal('modal-estado-rep', 'Cambiar estado de reparación', `
            <form onsubmit="window.submitCambiarEstado(event,${id})">
                <div class="mech-form-group">
                    <label>Nuevo estado *</label>
                    <select id="nuevo-estado" required>
                        ${estados.map(e => `<option value="${e.value}" ${rep.estado===e.value?'selected':''}>${e.label}</option>`).join('')}
                    </select>
                </div>
                <div class="mech-form-group">
                    <label>Notas del cambio</label>
                    <textarea id="notas-cambio" placeholder="Describe el motivo del cambio" rows="2"></textarea>
                </div>
                <div class="mech-btn-group">
                    <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-estado-rep')">Cancelar</button>
                    <button type="submit" class="mech-btn mech-btn-primary">Guardar cambio</button>
                </div>
            </form>`);
        m.classList.add('show');
    };

    window.submitCambiarEstado = function(e, id) {
        e.preventDefault();
        const rep = state.reparaciones.find(r => r.id === id);
        if (rep) {
            rep.estado = document.getElementById('nuevo-estado').value;
            renderReparaciones();
            window.selectReparacion(id);
        }
        window.closeModal('modal-estado-rep');
        window.showNotification('✓ Estado actualizado correctamente');
    };

    window.finalizarReparacion = function(id) {
        const rep = state.reparaciones.find(r => r.id === id);
        if (!rep) return;
        const m = createModal('modal-finalizar-rep', 'Finalizar reparación', `
            <form onsubmit="window.submitFinalizar(event,${id})">
                <div class="mech-form-group">
                    <label><strong>${rep.marca} ${rep.modelo} — ${rep.matricula}</strong></label>
                    <div style="background:var(--mech-surface-offset);padding:.875rem;border-radius:14px;margin-top:.5rem;">
                        <div class="mech-detail-row"><span class="mech-detail-label">Total horas</span><span class="mech-detail-value">${rep.horas.toFixed(1)} h</span></div>
                        <div class="mech-detail-row"><span class="mech-detail-label">Piezas utilizadas</span><span class="mech-detail-value">${rep.piezas.length}</span></div>
                        <div class="mech-detail-row"><span class="mech-detail-label">Motivo</span><span class="mech-detail-value">${rep.motivo || '—'}</span></div>
                    </div>
                </div>
                <div class="mech-form-group">
                    <label>Observaciones finales</label>
                    <textarea id="obs-finales" placeholder="Notas de entrega, trabajo adicional, etc." rows="3"></textarea>
                </div>
                <div class="mech-form-group" style="display:flex;align-items:center;gap:.5rem;">
                    <input type="checkbox" id="confirmar-entrega" required style="width:auto;">
                    <label for="confirmar-entrega" style="margin:0;font-weight:500;cursor:pointer;">
                        Confirmar que el vehículo está listo para entregar
                    </label>
                </div>
                <div class="mech-btn-group">
                    <button type="button" class="mech-btn-cancel" onclick="window.closeModal('modal-finalizar-rep')">Cancelar</button>
                    <button type="submit" class="mech-btn mech-btn-primary" style="background:var(--mech-success);">
                        <i class="ti ti-check"></i> Finalizar y sacar coche
                    </button>
                </div>
            </form>`);
        m.classList.add('show');
    };

    window.submitFinalizar = function(e, id) {
        e.preventDefault();
        const rep = state.reparaciones.find(r => r.id === id);
        if (rep) { rep.estado = 'finalizada'; renderReparaciones(); }
        window.closeModal('modal-finalizar-rep');
        window.showNotification('✓ Reparación finalizada. Coche listo para entrega.');
    };

    // ==========================================================
    //  DISPATCHER: botones data-action
    // ==========================================================
    const actionMap = {
        'meter-coche':            () => window.showNotification('Funcionalidad gestionada por administración', 'error'),
        'reparaciones-asignadas': () => window.openRepAsignadasModal(),
        'diagnosticar':           () => window.showNotification('Diagnóstico gestionado por administración', 'error'),
        'agregar-horas':          () => openAgregarHorasModal(),
        'agregar-piezas':         () => openAgregarPiezasModal(),
        'solicitar-piezas':       () => openSolicitarPiezasModal(),
    };
    document.querySelectorAll('[data-action]').forEach(btn => {
        btn.addEventListener('click', () => {
            const fn = actionMap[btn.dataset.action];
            if (fn) fn();
        });
    });

    // ==========================================================
    //  INIT
    // ==========================================================
    state.reparaciones = [...MOCK_REPARACIONES];
    renderReparaciones();

})();
</script>

@endsection
