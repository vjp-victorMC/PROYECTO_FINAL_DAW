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
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="am-auth-logout">Cerrar sesión</button>
            </form>
        </div>
    </div>

    <div class="am-navbar">
        <a href="{{ url('/admin') }}" class="am-logo-block">
            <div class="am-logo">
                <div class="am-diamond"><span>T</span></div>
                <div class="am-brandname">Talleres <em>R&amp;C</em></div>
            </div>
        </a>

        <div class="am-nav-inner">
            <ul class="am-menu" id="adminMenu">

                {{-- Reparación agrupa: solicitudes, mecánico, programar, piezas, pago, entrega --}}
                <li class="am-dropdown">
                    <a href="#" id="anav-reparacion" onclick="adminNav(this,'reparacion');return false;">
                        Reparación <span class="am-arrow">▾</span>
                    </a>
                    <div class="am-dropdown-menu">
                        <a href="#" onclick="adminNavSub('reparacion','solicitudes');return false;">
                            <i class="ti ti-clipboard-list"></i> Revisar solicitud
                        </a>
                        <a href="#" onclick="adminNavSub('reparacion','mecanico');return false;">
                            <i class="ti ti-user-cog"></i> Asignar mecánico
                        </a>
                        <a href="#" onclick="adminNavSub('reparacion','programar');return false;">
                            <i class="ti ti-calendar-event"></i> Programar fecha
                        </a>
                        <a href="#" onclick="adminNavSub('reparacion','piezas-comp');return false;">
                            <i class="ti ti-package"></i> Aprobar piezas
                        </a>
                        <a href="#" onclick="adminNavSub('reparacion','pago');return false;">
                            <i class="ti ti-credit-card"></i> Confirmar pago
                        </a>
                        <a href="#" onclick="adminNavSub('reparacion','entrega');return false;">
                            <i class="ti ti-circle-check"></i> Marcar entregado
                        </a>
                    </div>
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

        <a href="{{ url('/') }}" class="am-cita">← Web pública</a>
    </div>

    <nav class="am-mobile-menu" id="mobileMenu">
        <a href="#" onclick="adminNav(document.getElementById('anav-reparacion'),'reparacion');return false;">Reparación</a>
        <a href="#" onclick="adminNavSub('reparacion','solicitudes');return false;" class="am-mob-sub">└ Revisar solicitud</a>
        <a href="#" onclick="adminNavSub('reparacion','mecanico');return false;"    class="am-mob-sub">└ Asignar mecánico</a>
        <a href="#" onclick="adminNavSub('reparacion','programar');return false;"   class="am-mob-sub">└ Programar fecha</a>
        <a href="#" onclick="adminNavSub('reparacion','piezas-comp');return false;" class="am-mob-sub">└ Aprobar piezas</a>
        <a href="#" onclick="adminNavSub('reparacion','pago');return false;"        class="am-mob-sub">└ Confirmar pago</a>
        <a href="#" onclick="adminNavSub('reparacion','entrega');return false;"     class="am-mob-sub">└ Marcar entregado</a>
        <a href="#" onclick="adminNav(document.getElementById('anav-vehiculos2'),'vehiculos2');return false;">2ª Mano</a>
        <a href="#" onclick="adminNav(document.getElementById('anav-piezas'),'piezas');return false;">Piezas</a>
        <a href="#" onclick="adminNav(document.getElementById('anav-usuarios'),'usuarios');return false;">Usuarios</a>
        <a href="#" onclick="adminNav(document.getElementById('anav-gestion'),'gestion');return false;">Estadísticas</a>
    </nav>
</div>

<script>
    // ─── Panel activo por sub-sección ───────────────────────────────────────────
    // Mapa: sub-id → panel real del admin + scroll/highlight opcional
    const SUB_PANEL_MAP = {
        'solicitudes':  'reparacion',
        'mecanico':     'reparacion',
        'programar':    'reparacion',
        'piezas-comp':  'reparacion',   // piezas de compra (distinto de panel piezas)
        'pago':         'reparacion',
        'entrega':      'reparacion',
    };

    // Anclas/IDs de sección dentro del panel reparación para hacer scroll
    const SUB_SCROLL_MAP = {
        'solicitudes':  'solicitudesList',
        'mecanico':     'vehiculosReparGrid',
        'programar':    'vehiculosReparGrid',
        'piezas-comp':  'vehiculosReparGrid',
        'pago':         'vehiculosReparGrid',
        'entrega':      'vehiculosReparGrid',
    };

    // ─── Navegación principal ────────────────────────────────────────────────────
    function adminNav(link, panelId) {
        // Quitar active de todos los top-links
        document.querySelectorAll('#adminMenu > li > a').forEach(a => a.classList.remove('active'));

        // Poner active en el li padre del link pulsado
        const parentLi = link.closest ? link.closest('li') : null;
        const topLink  = (parentLi ? parentLi.querySelector(':scope > a') : null) || link;
        if (topLink) topLink.classList.add('active');

        // Llamar a showPanel del admin
        if (typeof showPanel === 'function') {
            showPanel(panelId);
        }

        // Cerrar menú móvil
        const mob = document.getElementById('mobileMenu');
        if (mob) mob.classList.remove('open');
    }

    // ─── Navegación sub-ítem (dropdown / móvil) ──────────────────────────────
    function adminNavSub(panelId, subId) {
        // 1. Activar el link padre en el menú principal
        const parentLink = document.getElementById('anav-' + panelId);
        if (parentLink) {
            document.querySelectorAll('#adminMenu > li > a').forEach(a => a.classList.remove('active'));
            parentLink.classList.add('active');
        }

        // 2. Navegar al panel principal
        if (typeof showPanel === 'function') {
            showPanel(panelId);
        }

        // 3. Resaltar / hacer scroll a la sección concreta
        const scrollTargetId = SUB_SCROLL_MAP[subId];
        if (scrollTargetId) {
            // Esperamos un tick para que el panel sea visible antes de scrollar
            setTimeout(() => {
                const el = document.getElementById(scrollTargetId);
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    // Flash visual para indicar dónde estamos
                    el.style.transition = 'box-shadow .3s';
                    el.style.boxShadow  = '0 0 0 2px #2878f0';
                    setTimeout(() => { el.style.boxShadow = ''; }, 1600);
                }
            }, 80);
        }

        // 4. Cerrar menú móvil
        const mob = document.getElementById('mobileMenu');
        if (mob) mob.classList.remove('open');
    }

    // ─── Hamburguesa ────────────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        const ham = document.getElementById('ham');
        const mob = document.getElementById('mobileMenu');
        if (ham && mob) {
            ham.addEventListener('click', () => mob.classList.toggle('open'));
        }
    });
</script>