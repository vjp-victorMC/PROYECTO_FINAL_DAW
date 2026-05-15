@vite(['resources/css/components/topbar.css'])


<div class="am-wrap">
  <div class="am-topbar">
    <div class="am-contact">
      <span><i class="ti ti-phone"></i>924 000 000</span>
      <div class="am-vdiv"></div>
      <span class="am-mail-item"><i class="ti ti-mail"></i>info@talleresrc.es</span>
    </div>
    <div class="am-auth">
      <a href="{{ route ('login')}}">Iniciar sesión</a>
      <span class="am-auth-sep">|</span>
      <a href="{{ route ('login', ['action' => 'register']) }}">Registrarse</a>
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
        <li><a href="{{ route ('financiacion')}}" class="{{ request()->routeIs('financiacion') ? 'active' : '' }}">Financiación</a></li>
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
    <a href="{{ route ('financiacion')}}" class="{{ request()->routeIs('financiacion') ? 'active' : '' }}">Financiación</a>
    <a href="{{ route ('nosotros')}}" class="{{ request()->routeIs('nosotros') ? 'active' : '' }}">Taller</a>
    <a href="{{ route ('contacto')}}" class="{{ request()->routeIs('contacto') ? 'active' : '' }}">Contacto</a>
    <a href="#cita" class="am-cita-mob">Pedir cita</a>
  </nav>
</div>