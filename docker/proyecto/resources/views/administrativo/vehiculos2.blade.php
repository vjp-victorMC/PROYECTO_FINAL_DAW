{{-- Sección de Vehículos de 2ª Mano --}}
<div class="panel" id="panel-vehiculos2">

    <div class="kpi-row">
        <div class="kpi"><span class="kpi-label">Valor total stock</span><span class="kpi-value" id="kpi-valor-stock">—</span></div>
        <div class="kpi"><span class="kpi-label">Total en catálogo</span><span class="kpi-value" id="kpi-total-2mano">—</span></div>
        <div class="kpi"><span class="kpi-label">Precio medio</span><span class="kpi-value" id="kpi-precio-med">—</span></div>
        <div class="kpi"><span class="kpi-label">Km medio</span><span class="kpi-value" id="kpi-km-med">—</span></div>
    </div>

    <div class="card card-last">
        <div class="card-title" style="display:flex;align-items:center">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
            </svg>
            Inventario de 2ª mano
            <button class="btn btn-primary btn-sm" style="margin-left:auto" onclick="showModal('agregar-veh')">+ Agregar vehículo</button>
        </div>
        <div class="veh-grid" id="vehiculos2Grid"><p style="color:#4a6e9a;font-size:13px;padding:10px 0">Cargando...</p></div>
    </div>

</div>
