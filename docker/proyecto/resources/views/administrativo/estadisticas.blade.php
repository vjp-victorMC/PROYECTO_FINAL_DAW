{{-- Sección de Estadísticas --}}
<div class="panel active" id="panel-gestion">

    <div class="kpi-row">
        <div class="kpi"><span class="kpi-label">Facturado este año</span><span class="kpi-value" id="kpi-facturado">—</span><span class="kpi-delta up" id="kpi-facturado-sub"></span></div>
        <div class="kpi"><span class="kpi-label">Gastos este año</span><span class="kpi-value" id="kpi-gastos">—</span><span class="kpi-delta warn" id="kpi-gastos-sub"></span></div>
        <div class="kpi"><span class="kpi-label">Coches atendidos (año)</span><span class="kpi-value" id="kpi-coches-anio">—</span></div>
        <div class="kpi"><span class="kpi-label">Margen bruto</span><span class="kpi-value" id="kpi-margen">—</span></div>
    </div>

    <div class="grid-2">
        <div class="card">
            <div class="card-title" style="display:flex;align-items:center">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Gastos del taller
                <div class="chart-tabs">
                    <button type="button" class="chart-tab active" onclick="switchChart('gastos','anual',this)">Anual</button>
                    <button type="button" class="chart-tab" onclick="switchChart('gastos','mensual',this)">Mensual</button>
                </div>
            </div>
            <div class="chart-section active" id="gastos-anual">
                <svg id="chart-gastos-anual" viewBox="0 0 520 150" class="chart-svg"></svg>
                <div class="chart-legend">
                    <div class="chart-leg-item"><span class="chart-leg-dot" style="background:#2878f0"></span>Gastos mensuales (€)</div>
                </div>
            </div>
            <div class="chart-section" id="gastos-mensual">
                <svg id="chart-gastos-mensual" viewBox="0 0 280 150" class="chart-svg"></svg>
                <div class="chart-legend">
                    <div class="chart-leg-item"><span class="chart-leg-dot" style="background:#2878f0"></span>Gastos por semana · mes actual</div>
                </div>
            </div>
        </div>

        <div class="card card-last">
            <div class="card-title" style="display:flex;align-items:center">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Coches atendidos
                <div class="chart-tabs">
                    <button type="button" class="chart-tab active" onclick="switchChart('coches','anual',this)">Anual</button>
                    <button type="button" class="chart-tab" onclick="switchChart('coches','mensual',this)">Mensual</button>
                </div>
            </div>
            <div class="chart-section active" id="coches-anual">
                <svg id="chart-coches-anual" viewBox="0 0 520 150" class="chart-svg"></svg>
                <div class="chart-legend">
                    <div class="chart-leg-item"><span class="chart-leg-dot" style="background:#22c55e"></span>Vehículos atendidos</div>
                </div>
            </div>
            <div class="chart-section" id="coches-mensual">
                <svg id="chart-coches-mensual" viewBox="0 0 280 150" class="chart-svg"></svg>
                <div class="chart-legend">
                    <div class="chart-leg-item"><span class="chart-leg-dot" style="background:#22c55e"></span>Vehículos por semana · mes actual</div>
                </div>
            </div>
        </div>
    </div>

</div>
