@vite(['resources/css/components/topbar.css'])


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
      <a href="{{ route('vehiculo') }}" class="am-nav-link {{ request()->routeIs('vehiculo') ? 'active' : '' }}" style="padding: 8px 0; font-size: 14px; font-weight: 600;">Añadir Vehículos</a>
      <span class="am-auth-sep">|</span>

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
    <a href="{{ route('welcome') }}" class="am-logo-block">
      <div class="am-logo">
        <div class="am-diamond"><span>A</span></div>
        <div class="am-brandname">Talleres <em>R&C</em></div>
      </div>
    </a>
    <div class="am-nav-inner">
      <ul class="am-menu">
        <li><a href="{{ route ('welcome')}}" class="{{ request()->routeIs('welcome') ? 'active' : '' }}">Inicio</a></li>
        <li><a href="{{ route ('ocasion')}}" class="{{ request()->routeIs('ocasion') ? 'active' : '' }}">Vehículos</a></li>
        <li><a href="{{ route ('nosotros')}}" class="{{ request()->routeIs('nosotros') ? 'active' : '' }}">Taller</a></li>
        <li><a href="{{ route ('contacto')}}" class="{{ request()->routeIs('contacto') ? 'active' : '' }}">Contacto</a></li>
      </ul>
      <button class="am-hamburger" id="ham" aria-label="Abrir menú">
        <i class="ti ti-menu-2"></i>
      </button>
    </div>
    <a href="#cita" class="am-cita">Pedir cita</a>
  </div>

  <nav class="am-mobile-menu" id="mobileMenu">
    <a href="{{ route ('welcome')}}" class="{{ request()->routeIs('welcome') ? 'active' : '' }}">Inicio</a>
    <a href="{{ route ('ocasion')}}" class="{{ request()->routeIs('ocasion') ? 'active' : '' }}">Vehículos</a>
    <a href="{{ route ('compra')}}" class="{{ request()->routeIs('compra') ? 'active' : '' }}">Compra / Financiación</a>
    <a href="{{ route ('nosotros')}}" class="{{ request()->routeIs('nosotros') ? 'active' : '' }}">Taller</a>
    <a href="{{ route ('contacto')}}" class="{{ request()->routeIs('contacto') ? 'active' : '' }}">Contacto</a>

    <div class="am-mobile-auth" style="margin-top: 15px; padding: 10px 20px; border-top: 1px solid rgba(0,0,0,0.08); display: flex; flex-direction: column; gap: 8px;">
      @auth
      <span class="am-user-name-mob" style="font-size: 14px; color: var(--text-main); font-weight: 500;">Hola, <strong style="color: var(--primary);">{{ Auth::user()->nombre }}</strong></span>

      <form action="{{ route('logout') }}" method="POST" style="display: none;" id="logout-form-mob">
        @csrf
      </form>
      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mob').submit();" style="color: var(--accent); padding: 5px 0; font-size: 14px; font-weight: 700;">Cerrar sesión</a>
      @else
      <a href="{{ route('login') }}" style="padding: 5px 0; font-size: 14px; font-weight: 600;">Iniciar sesión</a>
      <a href="{{ route('login', ['action' => 'register']) }}" style="padding: 5px 0; font-size: 14px; font-weight: 600; color: var(--primary);">Registrarse</a>
      @endauth
    </div>

    <a href="#cita" class="am-cita-mob">Pedir cita</a>
  </nav>
</div>