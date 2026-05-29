@vite(['resources/css/usuarios/nosotros.css'])
@vite(['resources/css/contents/topbar.css'])

@extends('layouts.app')
@section('content')

<div class="pg-nosotros">

    <!-- HERO COMPLETO Y CINEMÁTICO -->
    <section class="nosotros-hero">
        <div class="nosotros-container">
            <div class="hero-content animate-up">
                <div class="hero-badge"><i class="ti ti-heart" aria-hidden="true"></i> Pasión por el motor</div>
                <h1>La revolución de la <span>mecánica digital</span></h1>
                <p>No somos solo un taller. Somos ingenieros, apasionados y tecnólogos unidos para ofrecerte la experiencia de mantenimiento de vehículos más clara, transparente y premium de Extremadura.</p>
                
                <!-- Estadísticas Flotantes -->
                <div class="hero-stats-grid animate-up delay-1">
                    <div class="stat-item">
                        <strong>+20</strong>
                        <small>Años de historia</small>
                    </div>
                    <div class="stat-item">
                        <strong>100%</strong>
                        <small>Garantía de piezas</small>
                    </div>
                    <div class="stat-item">
                        <strong>+8k</strong>
                        <small>Conductores felices</small>
                    </div>
                    <div class="stat-item">
                        <strong>0</strong>
                        <small>Letra pequeña</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HISTORIA Y VALORES (TIMELINE INTERACTIVO) -->
    <section class="story-section">
        <div class="nosotros-container">
            <div class="story-grid">
                <!-- Columna Izquierda: Filosofía -->
                <div class="story-content animate-up">
                    <span class="section-label">Nuestra Trayectoria</span>
                    <h2 class="section-title">De un box de garaje a la vanguardia de Extremadura</h2>
                    <p>En 2005, comenzamos con dos elevadores, una caja de herramientas de mano y una obsesión: **hacer las cosas de forma diferente**. Veíamos un sector mecánico marcado por la desconfianza del cliente, los presupuestos oscuros y la falta de explicaciones claras.</p>
                    <p>Decidimos que nuestro taller sería un espacio de total honestidad. Si una pieza no necesita cambiarse, no se cambia. Si se cambia, te enseñamos el desgaste real en fotos o vídeo antes de tocar tu coche.</p>
                    
                    <div class="story-quote">
                        "La tecnología avanza bajo el capó de los coches, y nosotros avanzamos con ella para que sigas conduciendo con total tranquilidad."
                    </div>
                    
                    <p>Hoy, con tecnología de alineamiento en 3D, sistemas avanzados de diagnosis electrónica oficial y un equipo certificado para vehículos híbridos y eléctricos, seguimos manteniendo la misma pasión y cercanía del primer día.</p>
                </div>

                <!-- Columna Derecha: Timeline -->
                <div class="timeline animate-up delay-1">
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <span class="timeline-year">2005</span>
                        <h4>El Origen del Taller</h4>
                        <p>Apertura de nuestras primeras instalaciones en Plasencia por Carlos Mendoza con un enfoque centrado puramente en la mecánica clásica de precisión.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <span class="timeline-year">2012</span>
                        <h4>Revolución Diagnosis Electrónica</h4>
                        <p>Incorporamos los primeros equipos de diagnosis por ordenador oficiales, permitiendo analizar averías complejas en marcas premium.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <span class="timeline-year">2018</span>
                        <h4>Garantía de Confianza Absoluta</h4>
                        <p>Lanzamos la cobertura de 12 meses de garantía total en mano de obra y piezas, duplicando las exigencias de la normativa legal de talleres.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <span class="timeline-year">2026</span>
                        <h4>El Taller 4.0</h4>
                        <p>Presentamos este nuevo ecosistema digital: seguimiento en vivo del estado del vehículo, portal de usuario e histórico de mantenimiento en la nube.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NUESTROS VALORES INDISCUTIBLES -->
    <section class="values-section">
        <div class="nosotros-container">
            <div style="text-align: center; margin-bottom: 60px;" class="animate-up">
                <span class="section-label">Principios Fundacionales</span>
                <h2 class="section-title">Valores que conducen nuestro día a día</h2>
                <p class="section-sub" style="margin: 0 auto;">No creemos en los compromisos a medias. Estas son las 4 normas inquebrantables que rigen cada reparación.</p>
            </div>

            <div class="values-grid">
                <!-- Valor 1 -->
                <div class="value-card animate-up">
                    <div class="value-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </div>
                    <h3>Transparencia Radical</h3>
                    <p>Adiós a las sorpresas en la factura final. Te enviamos explicaciones detalladas y fotos del desgaste real antes de realizar cualquier intervención.</p>
                </div>

                <!-- Valor 2 -->
                <div class="value-card animate-up delay-1">
                    <div class="value-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                    </div>
                    <h3>Ingeniería y Vanguardia</h3>
                    <p>Dominamos la tecnología de diagnóstico electrónico y calibración más sofisticada del mercado para adelantarnos a cualquier avería de tu vehículo.</p>
                </div>

                <!-- Valor 3 -->
                <div class="value-card animate-up delay-2">
                    <div class="value-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <h3>Garantía Duplicada</h3>
                    <p>Confiamos tanto en la experiencia de nuestros mecánicos y en los recambios oficiales certificados que te ofrecemos 12 meses de garantía real.</p>
                </div>

                <!-- Valor 4 -->
                <div class="value-card animate-up delay-3">
                    <div class="value-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <h3>Precio Justo y Cerrado</h3>
                    <p>Ajustamos cada presupuesto al detalle basándonos en baremos de fabricante oficiales. Lo que te presupuestamos es exactamente lo que pagas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- EQUIPO CON PERSONALIDAD (HOVER EFFECTS) -->
    <section class="team-section">
        <div class="nosotros-container">
            <div style="text-align: center; margin-bottom: 60px;" class="animate-up">
                <span class="section-label">Nuestros Especialistas</span>
                <h2 class="section-title">El motor de nuestro taller</h2>
                <p class="section-sub" style="margin: 0 auto;">Formados directamente por los fabricantes líderes para garantizar una intervención experta en cada sistema de tu coche.</p>
            </div>

            <div class="team-grid">
                <!-- Miembro 1 -->
                <div class="team-card animate-up">
                    <div class="team-img-box">
                        <div class="team-avatar-placeholder">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <circle cx="9" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round"></circle>
                                <path d="M18.5 10l1.5 1.5 3.5-3.5" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <span class="team-badge">Fundador</span>
                    </div>
                    <div class="team-info">
                        <h3>Carlos Mendoza</h3>
                        <span class="team-role">Director Técnico</span>
                        <p>Más de 25 años de experiencia. Apasionado de la mecánica pura de combustión y experto restaurador de motores clásicos.</p>
                        <div class="team-superpower">
                            <span>⚡ Superpoder: <strong>Detectar holguras al oído</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Miembro 2 -->
                <div class="team-card animate-up delay-1">
                    <div class="team-img-box">
                        <div class="team-avatar-placeholder">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <circle cx="9" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round"></circle>
                                <path d="M19 16V8h-2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <span class="team-badge">Híbridos & Diagnosis</span>
                    </div>
                    <div class="team-info">
                        <h3>Elena Rostova</h3>
                        <span class="team-role">Ingeniera de Diagnosis</span>
                        <p>Ex-ingeniera telemétrica de competición. Experta en diagnosis de centralitas y software de gestión en coches híbridos y eléctricos.</p>
                        <div class="team-superpower">
                            <span>💻 Superpoder: <strong>Hablar con los microchips</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Miembro 3 -->
                <div class="team-card animate-up delay-2">
                    <div class="team-img-box">
                        <div class="team-avatar-placeholder">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <circle cx="9" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round"></circle>
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <span class="team-badge">Especialista Box</span>
                    </div>
                    <div class="team-info">
                        <h3>Manuel Silva</h3>
                        <span class="team-role">Especialista en Chasis</span>
                        <p>Técnico experto en suspensiones, cajas de cambios automáticas y sistemas de alineación inteligente y frenado de alta seguridad.</p>
                        <div class="team-superpower">
                            <span>🔧 Superpoder: <strong>Ajustes a la milésima</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Miembro 4 -->
                <div class="team-card animate-up delay-3">
                    <div class="team-img-box">
                        <div class="team-avatar-placeholder">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <circle cx="9" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round"></circle>
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <span class="team-badge">Atención Premium</span>
                    </div>
                    <div class="team-info">
                        <h3>Sofía Vega</h3>
                        <span class="team-role">Experiencia de Cliente</span>
                        <p>Tu enlace directo con los mecánicos. Asesora experta en planes de mantenimiento y gestiones de vehículos de cortesía.</p>
                        <div class="team-superpower">
                            <span>✨ Superpoder: <strong>Simplificar lo complejo</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INSTALACIONES (NUESTROS BOXES DE TRABAJO) -->
    <section class="facilities-section">
        <div class="nosotros-container">
            <div style="text-align: center; margin-bottom: 60px;" class="animate-up">
                <span class="section-label">Tecnología en el box</span>
                <h2 class="section-title">El quirófano de tu vehículo</h2>
                <p class="section-sub" style="margin: 0 auto;">Disponemos de instalaciones con herramientas de última hornada homologadas por las marcas más exigentes de Europa.</p>
            </div>

            <div class="facilities-grid">
                <!-- Estación 1 -->
                <div class="facility-card animate-up">
                    <div class="facility-graphic">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                            <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                            <line x1="6" y1="6" x2="6.01" y2="6"></line>
                            <line x1="6" y1="18" x2="6.01" y2="18"></line>
                        </svg>
                    </div>
                    <div class="facility-info">
                        <h3>Boxes de Diagnosis Activa</h3>
                        <p>Nuestras estaciones de diagnosis computarizada conectan directamente con los servidores centrales de los fabricantes para lecturas precisas.</p>
                    </div>
                </div>

                <!-- Estación 2 -->
                <div class="facility-card animate-up delay-1">
                    <div class="facility-graphic">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                    </div>
                    <div class="facility-info">
                        <h3>Alineación y Equilibrado 3D</h3>
                        <p>Equipos de captación de imágenes infrarrojas que calibran la pisada, la caída y la convergencia de tus ruedas a nivel microscópico.</p>
                    </div>
                </div>

                <!-- Estación 3 -->
                <div class="facility-card animate-up delay-2">
                    <div class="facility-graphic">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <div class="facility-info">
                        <h3>Área Eco-Eficiente de Fluidos</h3>
                        <p>Sistema encapsulado de recuperación y filtrado de aceites y refrigerantes usados, certificado por normativas ecológicas europeas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION ORIGINAL -->
    <section class="nosotros-cta">
        <div class="nosotros-container">
            <div class="cta-inner animate-up">
                <div class="cta-content">
                    <h2>Experimenta el verdadero cuidado automotriz</h2>
                    <p>Déjanos demostrarte por qué más de 8.000 extremeños ya no confían su vehículo a nadie más. Reserva una cita online en menos de 60 segundos.</p>
                    <a href="{{ route('welcome') }}#cita" class="btn-primary">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:4px;">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Agendar Cita Online
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    // Scroll Reveal Intersection Observer para animaciones fluidas
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-up').forEach(el => observer.observe(el));
</script>

@endsection
