{{-- Sección de Reparación (taller) --}}
<div class="panel" id="panel-reparacion">

    <div class="kpi-row">
        <div class="kpi"><span class="kpi-label">Solicitudes pendientes</span><span class="kpi-value" id="kpi-sol-pend">—</span><span class="kpi-delta warn">Sin revisar</span></div>
        <div class="kpi"><span class="kpi-label">Vehículos en taller</span><span class="kpi-value" id="kpi-veh-garaje">—</span><span class="kpi-delta">Activos ahora</span></div>
        <div class="kpi"><span class="kpi-label">En reparación</span><span class="kpi-value" id="kpi-en-reparacion">—</span><span class="kpi-delta up">En proceso</span></div>
        <div class="kpi"><span class="kpi-label">Pendiente pago</span><span class="kpi-value" id="kpi-pend-pago">—</span><span class="kpi-delta warn">Listo para cobrar</span></div>
    </div>

    <div class="card" style="margin-bottom:1rem">
        <div class="card-title">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Solicitudes pendientes de aprobación
        </div>
        <div id="solicitudesList"><p style="color:#4a6e9a;font-size:13px;padding:10px 0">Cargando...</p></div>
    </div>

    <div class="card card-last">
        <div class="card-title">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
            </svg>
            Vehículos en el taller — pulsa para ampliar
        </div>
        <div class="veh-grid" id="vehiculosReparGrid"><p style="color:#4a6e9a;font-size:13px;padding:10px 0">Cargando...</p></div>
    </div>

</div>
