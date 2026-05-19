@vite(['resources/css/components/topbar.css'])
@vite(['resources/css/admin/header-admin.css'])

<div class="am-wrap">
    <div class="am-topbar">
        <div class="am-contact">
            <span><i class="ti ti-phone"></i>924 000 000</span>
            <div class="am-vdiv"></div>
            <span class="am-mail-item"><i class="ti ti-mail"></i>info@azulmotor.es</span>
        </div>
        <div class="am-auth">
            <span class="am-welcome">
                Bienvenido,
                @auth
                {{ Auth::user()->name ?? 'Astdminirador' }}
                @else
                Administrador
                @endauth
            </span>
            <span class="am-auth-sep">|</span>
            <a href="#">Cerrar sesión</a>
        </div>
    </div>

    <div class="am-navbar">
        <div class="am-logo-block">
            <div class="am-logo">
                <div class="am-diamond"><span>A</span></div>
                <div class="am-brandname">AZUL<em>MOTOR</em></div>
            </div>
        </div>
        <div class="am-nav-inner">
            <ul class="am-menu" id="adminMenu">
                <li><a href="#" class="active" onclick="adminNav(this,'solicitudes');return false;">Revisar solicitud</a></li>
                <li><a href="#" onclick="adminNav(this,'mecanico');return false;">Asignar mecánico</a></li>
                <li><a href="#" onclick="adminNav(this,'programar');return false;">Programar fecha</a></li>
                <li><a href="#" onclick="adminNav(this,'piezas');return false;">Aprobar piezas</a></li>
                <li><a href="#" onclick="adminNav(this,'pago');return false;">Confirmar pago</a></li>
                <li><a href="#" onclick="adminNav(this,'entrega');return false;">Marcar entregado</a></li>
                <li>
                    <a href="#" onclick="adminNav(this,'gestion');return false;">Gestión</a>
                </li>
            </ul>
            <button class="am-hamburger" id="ham" aria-label="Abrir menú">
                &#9776;
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
    </nav>
</div>

<script>
    function adminNav(link, panelId) {
        document.querySelectorAll('#adminMenu a, #mobileMenu a').forEach(a => a.classList.remove('active'));
        link.classList.add('active');

        if (typeof showPanel === 'function') {
            showPanel(panelId);
        }

        const mob = document.getElementById('mobileMenu');
        if (mob) mob.classList.remove('open');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const ham = document.getElementById('ham');
        const mob = document.getElementById('mobileMenu');
        if (ham && mob) {
            ham.addEventListener('click', () => mob.classList.toggle('open'));
        }
    });
</script>