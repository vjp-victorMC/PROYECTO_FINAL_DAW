@vite(['resources/css/admin/header-admin.css'])

<div class="am-wrap">
    <div class="am-topbar">
        <div class="am-contact">
            <span><i class="ti ti-phone"></i>924 000 000</span>
            <div class="am-vdiv"></div>
            <span class="am-mail-item"><i class="ti ti-mail"></i>info@talleresrc.es</span>
        </div>
        <div class="am-auth">
            @auth
            <span class="am-user-name">Hola, <strong>{{ Auth::user()->nombre }}</strong></span>
            <span class="am-auth-sep">|</span>
            <!-- <form action="{{ route('logout') }}" method="POST" style="display: none;" id="logout-form">
        @csrf
      </form> -->

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar sesión
            </a>

            <!-- Formulario oculto que procesa la petición POST -->
            <form id="logout-form" action="{{ url('api/usuario/logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            @else
            <a href="{{ route ('login')}}">Iniciar sesión</a>
            <span class="am-auth-sep">|</span>
            <a href="{{ route ('login', ['action' => 'register']) }}">Registrarse</a>
            @endauth
        </div>
    </div>

    <div class="am-navbar">
        <a href="{{ url('/admin') }}" class="am-logo-block">
            <div class="am-logo">
                <img src="{{ asset('images/Logos svg/logo/logoRYC.png') }}" alt="Talleres R&C" class="am-logo-img">
                <div class="am-brandname">Talleres <em>R&amp;C</em></div>
            </div>
        </a>

        <div class="am-nav-inner">
            <ul class="am-menu" id="adminMenu">

                {{-- Reparación agrupa: solicitudes, mecánico, programar, piezas, pago, entrega --}}
                <li class="am-dropdown">
                    <a href="#" id="anav-reparacion" onclick="adminNav(this,'reparacion');return false;">
                        Reparación
                    </a>
                </li>

                <li>
                    <a href="#" id="anav-vehiculos2" onclick="adminNav(this,'vehiculos2');return false;">
                        2ª Mano
                    </a>
                </li>

                <li>
                    <a href="#" id="anav-piezas" onclick="adminNav(this,'piezas');return false;">
                        Piezas
                    </a>
                </li>

                <li>
                    <a href="#" id="anav-usuarios" onclick="adminNav(this,'usuarios');return false;">
                        Usuarios
                    </a>
                </li>

                <li>
                    <a href="#" id="anav-gestion" class="active" onclick="adminNav(this,'gestion');return false;">
                        Estadísticas
                    </a>
                </li>

            </ul>
            <button class="am-hamburger" id="ham" aria-label="Abrir menú">
                <i class="ti ti-menu-2"></i>
            </button>
        </div>

        @if(request()->query('from_admin'))
            <a href="{{ url('/admin') }}" class="am-cita">← Panel admin</a>
        @else
            <a href="{{ url('/').'?from_admin=1' }}" class="am-cita">← Web pública</a>
        @endif
    </div>

    <nav class="am-mobile-menu" id="mobileMenu">
        <a href="#" onclick="adminNav(document.getElementById('anav-reparacion'),'reparacion');return false;">Reparación</a>
        <a href="#" onclick="adminNav(document.getElementById('anav-vehiculos2'),'vehiculos2');return false;">2ª Mano</a>
        <a href="#" onclick="adminNav(document.getElementById('anav-piezas'),'piezas');return false;">Piezas</a>
        <a href="#" onclick="adminNav(document.getElementById('anav-usuarios'),'usuarios');return false;">Usuarios</a>
        <a href="#" onclick="adminNav(document.getElementById('anav-gestion'),'gestion');return false;">Estadísticas</a>
    </nav>
</div>

<script>
    // ─── Navegación principal ────────────────────────────────────────────────────
    function adminNav(link, panelId) {
        // Quitar active de todos los top-links
        document.querySelectorAll('#adminMenu > li > a').forEach(a => a.classList.remove('active'));

        // Poner active en el li padre del link pulsado
        const parentLi = link.closest ? link.closest('li') : null;
        const topLink = (parentLi ? parentLi.querySelector(':scope > a') : null) || link;
        if (topLink) topLink.classList.add('active');

        // Llamar a showPanel del admin
        if (typeof showPanel === 'function') {
            showPanel(panelId);
        }

        // Cerrar menú móvil
        const mob = document.getElementById('mobileMenu');
        if (mob) mob.classList.remove('open');
    }

    // ─── Hamburguesa ────────────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function() {
        const ham = document.getElementById('ham');
        const mob = document.getElementById('mobileMenu');
        if (ham && mob) {
            ham.addEventListener('click', () => mob.classList.toggle('open'));
        }
    });
</script>