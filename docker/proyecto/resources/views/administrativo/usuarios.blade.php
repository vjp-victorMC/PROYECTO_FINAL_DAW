{{-- Sección de Usuarios --}}
<div class="panel" id="panel-usuarios">

    <div class="kpi-row">
        <div class="kpi"><span class="kpi-label">Usuarios totales</span><span class="kpi-value" id="kpi-usuarios-total">—</span></div>
        <div class="kpi"><span class="kpi-label">Clientes activos</span><span class="kpi-value" id="kpi-clientes">—</span></div>
        <div class="kpi"><span class="kpi-label">Mecánicos</span><span class="kpi-value" id="kpi-mecanicos">—</span></div>
        <div class="kpi"><span class="kpi-label">Admins</span><span class="kpi-value" id="kpi-admins">—</span></div>
    </div>

    <div class="card card-last">
        <div class="card-title" style="display:flex;align-items:center">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Gestión de usuarios
            <button class="btn btn-primary btn-sm" style="margin-left:auto" onclick="showModal('nuevo-usuario')">+ Nuevo usuario</button>
        </div>
        <table class="user-table">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="usuariosBody"><tr><td colspan="6" style="text-align:center;color:#4a6e9a;padding:20px">Cargando...</td></tr></tbody>
        </table>
    </div>

</div>
