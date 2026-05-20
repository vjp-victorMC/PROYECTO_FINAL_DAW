@vite(['resources/css/admin/header-admin.css'])

<div class="am-wrap">
    <div class="am-topbar">
        <div class="am-contact">
            <span><i class="ti ti-phone"></i>924 000 000</span>
            <div class="am-vdiv"></div>
            <span class="am-mail-item"><i class="ti ti-mail"></i>info@talleresrc.es</span>
        </div>
        <div class="am-auth">
            <span class="am-welcome">
                Bienvenido,
                @auth
                    {{ Auth::user()->name ?? 'Administrador' }}
                @else
                    Administrador
                @endauth
            </span>
            <span class="am-auth-sep">|</span>
            <form method="POST" action="/logout" style="display:inline">
        </div>
    </div>

    <div class="am-navbar">
        {{-- Logo: mismo bloque animado que el topbar público --}}
        <a href="{{ url('/admin') }}" class="am-logo-block">
            <div class="am-logo">
                <div class="am-diamond"><span>T</span></div>
                <div class="am-brandname">Talleres <em>R&amp;C</em></div>
            </div>
        </a>

        <div class="am-nav-inner">
            <ul class="am-menu" id="adminMenu">
                <li><a href="#" class="active" onclick="adminNav(this,'solicitudes');return false;">Revisar solicitud</a></li>
                <li><a href="#" onclick="adminNav(this,'mecanico');return false;">Asignar mecánico</a></li>
                <li><a href="#" onclick="adminNav(this,'programar');return false;">Programar fecha</a></li>
                <li><a href="#" onclick="adminNav(this,'piezas');return false;">Aprobar piezas</a></li>
                <li><a href="#" onclick="adminNav(this,'pago');return false;">Confirmar pago</a></li>
                <li><a href="#" onclick="adminNav(this,'entrega');return false;">Marcar entregado</a></li>
                <li class="am-dropdown">
                    <a href="#" onclick="adminNav(this,'gestion');return false;">Gestión</a>
                    <div class="am-dropdown-menu">
                        <a href="#" onclick="adminNav(this,'presupuestos');return false;">Presupuestos</a>
                        <a href="#" onclick="adminNav(this,'facturacion');return false;">Facturación</a>
                    </div>
                </li>
            </ul>
            <button class="am-hamburger" id="ham" aria-label="Abrir menú">
                <i class="ti ti-menu-2"></i>
            </button>
        </div>

        <a href="{{ url('/') }}" class="am-cita">← Web pública</a>
    </div>

    <nav class="am-mobile-menu" id="mobileMenu">
        <a href="#" onclick="adminNav(this,'solicitudes');return false;">Revisar solicitud</a>
        <a href="#" onclick="adminNav(this,'mecanico');return false;">Asignar mecánico</a>
        <a href="#" onclick="adminNav(this,'programar');return false;">Programar fecha</a>
        <a href="#" onclick="adminNav(this,'piezas');return false;">Aprobar piezas</a>
        <a href="#" onclick="adminNav(this,'pago');return false;">Confirmar pago</a>
        <a href="#" onclick="adminNav(this,'entrega');return false;">Marcar entregado</a>
        <a href="#" onclick="adminNav(this,'gestion');return false;">Gestión</a>
        <a href="#" onclick="adminNav(this,'presupuestos');return false;" style="padding-left:32px;font-size:14px;opacity:.8">└ Presupuestos</a>
        <a href="#" onclick="adminNav(this,'facturacion');return false;" style="padding-left:32px;font-size:14px;opacity:.8">└ Facturación</a>
    </nav>
</div>

<script>
    function adminNav(link, panelId) {
        // Quitar active de todos los links del menú principal (no sub-items del dropdown)
        document.querySelectorAll('#adminMenu > li > a').forEach(a => a.classList.remove('active'));

        // Poner active solo en el link del menú principal correspondiente
        const parentLi = link.closest('li');
        const topLink  = parentLi ? parentLi.querySelector(':scope > a') : link;
        if (topLink) topLink.classList.add('active');

        // Navegar al panel si la función existe (definida en admin.blade.php)
        if (typeof showPanel === 'function') {
            showPanel(panelId);
        }

        // Cerrar menú móvil
        const mob = document.getElementById('mobileMenu');
        if (mob) mob.classList.remove('open');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const ham = document.getElementById('ham');
        const mob = document.getElementById('mobileMenu');
        if (ham && mob) {
            ham.addEventListener('click', () => mob.classList.toggle('open'));
        }
    });
</script>