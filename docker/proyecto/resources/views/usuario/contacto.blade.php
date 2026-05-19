@vite(['resources/css/usuarios/contacto.css'])
@vite(['resources/css/contents/topbar.css'])

@extends('layouts.app')
@section('content')

<div class="pg-contacto">

    <!-- HERO CONTACTO -->
    <div class="contacto-hero">
        <div class="contacto-hero-inner">
            <div class="contacto-hero-text">
                <div class="hero-badge"><i class="ti ti-phone" aria-hidden="true"></i> Estamos aquí para ayudarte</div>
                <h1>Contacta con <span>Talleres R&C</span></h1>
                <p>¿Tienes una duda, quieres pedir un presupuesto o necesitas asistencia urgente? Escríbenos o llámanos, te atendemos con rapidez y sin compromiso.</p>
                <div class="hero-btns">
                    <a href="tel:924000000" class="btn-primary"><i class="ti ti-phone" aria-hidden="true"></i> Llamar ahora</a>
                    <a href="#formulario" class="btn-outline"><i class="ti ti-mail" aria-hidden="true"></i> Enviar mensaje</a>
                </div>
            </div>
            <div class="contacto-hero-cards">
                <div class="contact-quick-card">
                    <div class="contact-quick-icon"><i class="ti ti-phone"></i></div>
                    <div>
                        <div class="contact-quick-label">Teléfono</div>
                        <div class="contact-quick-value">924 000 000</div>
                    </div>
                </div>
                <div class="contact-quick-card">
                    <div class="contact-quick-icon"><i class="ti ti-clock"></i></div>
                    <div>
                        <div class="contact-quick-label">Horario</div>
                        <div class="contact-quick-value">Lun–Vie 8:00–19:00</div>
                    </div>
                </div>
                <div class="contact-quick-card">
                    <div class="contact-quick-icon"><i class="ti ti-map-pin"></i></div>
                    <div>
                        <div class="contact-quick-label">Dirección</div>
                        <div class="contact-quick-value">Av. de España, 45 · Plasencia</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTACTO MAIN: FORMULARIO + MAPA -->
    <div class="contacto-main" id="formulario">
        <div class="contacto-main-inner">

            <!-- Formulario de contacto -->
            <div class="contacto-form-block">
                <div class="section-label">Escríbenos</div>
                <div class="section-title">Envíanos un mensaje</div>
                <p class="section-sub">Te respondemos en menos de 24 horas en días laborables.</p>

                <form class="contacto-form" action="#" method="POST" id="contacto-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="cf-nombre">Nombre y apellidos *</label>
                            <input type="text" id="cf-nombre" name="nombre" placeholder="Ej: Juan García" required>
                        </div>
                        <div class="form-group">
                            <label for="cf-telefono">Teléfono *</label>
                            <input type="tel" id="cf-telefono" name="telefono" placeholder="Ej: 924 123 456" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cf-email">Correo electrónico *</label>
                        <input type="email" id="cf-email" name="email" placeholder="ejemplo@correo.com" required>
                    </div>
                    <div class="form-group">
                        <label for="cf-asunto">Asunto</label>
                        <select id="cf-asunto" name="asunto">
                            <option value="">Selecciona un motivo</option>
                            <option value="presupuesto">Solicitar presupuesto</option>
                            <option value="cita">Pedir cita</option>
                            <option value="garantia">Consulta de garantía</option>
                            <option value="segunda-mano">Vehículos de segunda mano</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cf-mensaje">Mensaje *</label>
                        <textarea id="cf-mensaje" name="mensaje" rows="5" placeholder="Cuéntanos en qué podemos ayudarte..." required></textarea>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="cf-privacy" name="privacy" required>
                        <label for="cf-privacy">He leído y acepto la <a href="#">política de privacidad</a></label>
                    </div>
                    <button type="submit" class="btn-primary btn-submit" id="cf-submit">
                        <i class="ti ti-send" aria-hidden="true"></i> Enviar mensaje
                    </button>
                </form>
            </div>

            <!-- Info lateral -->
            <div class="contacto-info-block">
                <!-- Tarjeta horarios -->
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-icon"><i class="ti ti-clock"></i></div>
                        <div class="info-card-title">Horario de atención</div>
                    </div>
                    <div class="horario-list">
                        <div class="horario-item">
                            <span>Lunes – Viernes</span>
                            <span class="horario-open">8:00 – 19:00</span>
                        </div>
                        <div class="horario-item">
                            <span>Sábado</span>
                            <span class="horario-open">9:00 – 14:00</span>
                        </div>
                        <div class="horario-item">
                            <span>Domingo</span>
                            <span class="horario-closed">Cerrado</span>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta datos de contacto -->
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-icon"><i class="ti ti-address-book"></i></div>
                        <div class="info-card-title">Datos de contacto</div>
                    </div>
                    <div class="contact-data-list">
                        <a href="tel:924000000" class="contact-data-item">
                            <i class="ti ti-phone"></i>
                            <span>924 000 000</span>
                        </a>
                        <a href="mailto:info@talleresrc.es" class="contact-data-item">
                            <i class="ti ti-mail"></i>
                            <span>info@talleresrc.es</span>
                        </a>
                        <div class="contact-data-item">
                            <i class="ti ti-map-pin"></i>
                            <span>Av. de España, 45<br>10600 Plasencia, Cáceres</span>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta urgencias -->
                <div class="info-card info-card--accent">
                    <div class="info-card-header">
                        <div class="info-icon info-icon--white"><i class="ti ti-emergency-car"></i></div>
                        <div class="info-card-title info-card-title--white">¿Urgencia o avería?</div>
                    </div>
                    <p class="urgencia-desc">Si tu vehículo ha sufrido una avería, llámanos directamente. Tenemos servicio de asistencia prioritaria en horario laboral.</p>
                    <a href="tel:924000000" class="btn-white"><i class="ti ti-phone"></i> Llamar ahora</a>
                </div>
            </div>

        </div>
    </div>

    <!-- MAPA -->
    <div class="contacto-mapa-section">
        <div class="contacto-mapa-inner">
            <div class="section-label">Cómo llegar</div>
            <div class="section-title">Encuéntranos en Plasencia</div>
            <p class="section-sub">Estamos en el Polígono Industrial Av. de España, con fácil acceso y amplio aparcamiento.</p>
            <div class="mapa-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3049.7!2d-6.0924!3d40.0305!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDAyJzA5LjgiTiA2wrAwNSczMi42Ilc!5e0!3m2!1ses!2ses!4v1"
                    width="100%"
                    height="420"
                    style="border:0; border-radius:12px; display:block;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Ubicación Talleres R&C · Plasencia">
                </iframe>
            </div>
        </div>
    </div>

    <!-- FAQ RÁPIDAS -->
    <div class="faq-section">
        <div class="faq-inner">
            <div class="section-label">Preguntas frecuentes</div>
            <div class="section-title">Resolvemos tus dudas</div>
            <p class="section-sub">Las preguntas más habituales de nuestros clientes.</p>

            <div class="faq-grid">
                <div class="faq-item" id="faq-1">
                    <button class="faq-question" onclick="toggleFaq('faq-1')" aria-expanded="false">
                        <span>¿Necesito pedir cita previa?</span>
                        <i class="ti ti-chevron-down faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Recomendamos pedir cita para garantizar atención inmediata, pero también atendemos sin cita según disponibilidad. Puedes reservar online o por teléfono.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq-2">
                    <button class="faq-question" onclick="toggleFaq('faq-2')" aria-expanded="false">
                        <span>¿Ofrecéis presupuesto sin compromiso?</span>
                        <i class="ti ti-chevron-down faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Sí, siempre. Realizamos el diagnóstico y te presentamos el presupuesto detallado antes de empezar cualquier reparación, sin coste ni obligación.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq-3">
                    <button class="faq-question" onclick="toggleFaq('faq-3')" aria-expanded="false">
                        <span>¿Cuánto tiempo tarda una revisión general?</span>
                        <i class="ti ti-chevron-down faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Una revisión estándar suele tardar entre 1 y 2 horas. Si necesitas dejar el vehículo, disponemos de zona de espera y vehículo de sustitución bajo petición.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq-4">
                    <button class="faq-question" onclick="toggleFaq('faq-4')" aria-expanded="false">
                        <span>¿Trabajáis todas las marcas de coches?</span>
                        <i class="ti ti-chevron-down faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Sí, somos un taller multimarca con equipos de diagnóstico compatibles con todas las marcas. Turismos, SUV, furgonetas y vehículos eléctricos/híbridos.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq-5">
                    <button class="faq-question" onclick="toggleFaq('faq-5')" aria-expanded="false">
                        <span>¿Tenéis garantía en las reparaciones?</span>
                        <i class="ti ti-chevron-down faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Todos nuestros trabajos están cubiertos por una garantía de 12 meses o 20.000 km, lo que ocurra antes. Usamos recambios de primera calidad.</p>
                    </div>
                </div>
                <div class="faq-item" id="faq-6">
                    <button class="faq-question" onclick="toggleFaq('faq-6')" aria-expanded="false">
                        <span>¿Hay aparcamiento en el taller?</span>
                        <i class="ti ti-chevron-down faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Sí, disponemos de amplia zona de aparcamiento gratuita en nuestras instalaciones. También hay parada de autobús urbano a 200 metros.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function toggleFaq(id) {
    const item = document.getElementById(id);
    const btn  = item.querySelector('.faq-question');
    const ans  = item.querySelector('.faq-answer');
    const isOpen = item.classList.contains('open');

    // Cerrar todos
    document.querySelectorAll('.faq-item').forEach(el => {
        el.classList.remove('open');
        el.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
    });

    // Abrir el pulsado si estaba cerrado
    if (!isOpen) {
        item.classList.add('open');
        btn.setAttribute('aria-expanded', 'true');
    }
}

// Envío del formulario (demo)
document.getElementById('contacto-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('cf-submit');
    btn.innerHTML = '<i class="ti ti-check"></i> Mensaje enviado';
    btn.style.background = '#16a34a';
    btn.disabled = true;
    setTimeout(() => {
        btn.innerHTML = '<i class="ti ti-send"></i> Enviar mensaje';
        btn.style.background = '';
        btn.disabled = false;
        this.reset();
    }, 3500);
});
</script>

@endsection
