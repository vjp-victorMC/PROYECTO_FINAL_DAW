@vite(['resources/css/components/topbar.css'])


<div class="am-wrap">
  <div class="am-topbar">
    <div class="am-contact">
      <span><i class="ti ti-phone"></i>924 000 000</span>
      <div class="am-vdiv"></div>
      <span class="am-mail-item"><i class="ti ti-mail"></i>info@azulmotor.es</span>
    </div>
    <div class="am-auth">
      <a href="{{ route ('login')}}">Iniciar sesión</a>
      <span class="am-auth-sep">|</span>
      <a href="{{ route ('login', ['action' => 'register']) }}">Registrarse</a>
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
      <ul class="am-menu">
        <li><a href="#" class="active">Inicio</a></li>
        <li><a href="#">Vehículos</a></li>
        <li><a href="#">Financiación</a></li>
        <li><a href="#">Taller</a></li>
        <li><a href="#">Tasación</a></li>
        <li><a href="#">Contacto</a></li>
      </ul>
      <button class="am-hamburger" id="ham" aria-label="Abrir menú">
        &#9776;
      </button>
    </div>
    <a href="#" class="am-cita">Pedir cita</a>
  </div>

  <nav class="am-mobile-menu" id="mobileMenu">
    <a href="#">Inicio</a>
    <a href="#">Vehículos</a>
    <a href="#">Financiación</a>
    <a href="#">Taller</a>
    <a href="#">Tasación</a>
    <a href="#">Contacto</a>
    <a href="#" class="am-cita-mob">Pedir cita</a>
  </nav>
</div>