@vite(['resources/css/components/footer.css'])

<div class="ft">
  <div class="ft-top">
    <div class="ft-brand">
      <div class="ft-logo">
        <img src="{{ asset('images/Logos svg/logo/logoRYC.png') }}" alt="Talleres R&C" class="ft-logo-img">
        <div class="ft-name">Talleres<em>R&C</em></div>
      </div>
      <p>Tu taller de confianza en Plasencia. Calidad, honestidad y profesionalidad desde 2003. Más de 20 años cuidando vehículos en Extremadura.</p>
      <div class="ft-social">
        <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
          <img src="{{ asset('images/redes sociales/facebook.png') }}" alt="Facebook" class="ft-social-img">
        </a>
        <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
          <img src="{{ asset('images/redes sociales/instagram.png') }}" alt="Instagram" class="ft-social-img">
        </a>
        <a href="https://www.tiktok.com" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
          <img src="{{ asset('images/redes sociales/tiktok.png') }}" alt="TikTok" class="ft-social-img">
        </a>
        <a href="https://x.com" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)">
          <img src="{{ asset('images/redes sociales/x.png') }}" alt="X" class="ft-social-img">
        </a>
      </div>
    </div>

    <div class="ft-col">
      <h5>Vehículos</h5>
      <a href="{{ route('ocasion') }}"><i class="ti ti-chevron-right" aria-hidden="true"></i>Stock de Ocasión</a>
    </div>

    <div class="ft-col">
      <h5>Taller</h5>
      <a href="{{ route('cita') }}"><i class="ti ti-chevron-right" aria-hidden="true"></i>Cita Previa</a>
      <a href="{{ route('nosotros') }}"><i class="ti ti-chevron-right" aria-hidden="true"></i>Sobre Nosotros</a>
    </div>

    <div class="ft-col">
      <h5>Contacto</h5>
      <a href="{{ route('contacto') }}" class="ft-link-contact"><i class="ti ti-map-pin" aria-hidden="true"></i>Av. de España, 45</a>
      <div class="ft-ci"><i class="ti ti-phone" aria-hidden="true"></i>924 000 000</div>
      <div class="ft-ci"><i class="ti ti-mail" aria-hidden="true"></i>info@talleresr&c.es</div>
      <div class="ft-badge"><i class="ti ti-clock" aria-hidden="true"></i>Lun–Vie 8:00–19:00 · Sáb 9:00–14:00</div>
    </div>
  </div>

  <div class="ft-bottom">
    <p>© 2025 Talelres R&C · Todos los derechos reservados</p>
    <p><a href="#">Política de privacidad</a> · <a href="#">Cookies</a></p>
  </div>
</div>