@vite(['resources/css/usuarios/welcome.css'])
@vite(['resources/css/contents/topbar.css'])

@extends('layouts.app')
@section('content')

<div class="pg">

    <!-- HERO -->
    <section class="hero">
        <div class="hero-text animate-up">
            <div class="hero-badge"><i class="ti ti-tool" aria-hidden="true"></i> Taller oficial Plasencia</div>
            <h1>Tu vehículo en manos <span>expertas</span></h1>
            <p>Más de 20 años cuidando vehículos en Extremadura. Revisiones, reparaciones y puesta a punto con tecnología de vanguardia y garantía total.</p>
            <div class="hero-btns">
                <a href="#cita" class="btn-primary"><i class="ti ti-calendar" aria-hidden="true"></i> Pedir cita online</a>
                <a href="#" class="btn-outline">Nuestros servicios</a>
            </div>
        </div>
        <div class="hero-stats animate-up delay-1">
            <div class="stat-card">
                <strong>+20</strong>
                <small>Años de experiencia</small>
            </div>
            <div class="stat-card">
                <strong>+8k</strong>
                <small>Clientes satisfechos</small>
            </div>
            <div class="stat-card">
                <strong>24h</strong>
                <small>Diagnóstico rápido</small>
            </div>
        </div>
    </section>

    <!-- BRANDS CAROUSEL -->
    <div class="brands-section animate-up delay-2">
        <div class="brands-track">
            <!-- Primer set de logos -->
            <img src="{{ asset('images/Logos svg/audi.svg') }}" alt="Audi">
            <img src="{{ asset('images/Logos svg/bmw.svg') }}" alt="BMW">
            <img src="{{ asset('images/Logos svg/citroen.svg') }}" alt="Citroen">
            <img src="{{ asset('images/Logos svg/ford.svg') }}" alt="Ford">
            <img src="{{ asset('images/Logos svg/honda.svg') }}" alt="Honda">
            <img src="{{ asset('images/Logos svg/hyundai.svg') }}" alt="Hyundai">
            <img src="{{ asset('images/Logos svg/mercedes.svg') }}" alt="Mercedes">
            <img src="{{ asset('images/Logos svg/peugeot.svg') }}" alt="Peugeot">
            <img src="{{ asset('images/Logos svg/renault.svg') }}" alt="Renault">
            <img src="{{ asset('images/Logos svg/seat.svg') }}" alt="Seat">
            <img src="{{ asset('images/Logos svg/toyota.svg') }}" alt="Toyota">
            <img src="{{ asset('images/Logos svg/volkswagen.svg') }}" alt="Volkswagen">
            <img src="{{ asset('images/Logos svg/volvo.svg') }}" alt="Volvo">
            
            <!-- Segundo set idéntico para el loop infinito perfecto -->
            <img src="{{ asset('images/Logos svg/audi.svg') }}" alt="Audi">
            <img src="{{ asset('images/Logos svg/bmw.svg') }}" alt="BMW">
            <img src="{{ asset('images/Logos svg/citroen.svg') }}" alt="Citroen">
            <img src="{{ asset('images/Logos svg/ford.svg') }}" alt="Ford">
            <img src="{{ asset('images/Logos svg/honda.svg') }}" alt="Honda">
            <img src="{{ asset('images/Logos svg/hyundai.svg') }}" alt="Hyundai">
            <img src="{{ asset('images/Logos svg/mercedes.svg') }}" alt="Mercedes">
            <img src="{{ asset('images/Logos svg/peugeot.svg') }}" alt="Peugeot">
            <img src="{{ asset('images/Logos svg/renault.svg') }}" alt="Renault">
            <img src="{{ asset('images/Logos svg/seat.svg') }}" alt="Seat">
            <img src="{{ asset('images/Logos svg/toyota.svg') }}" alt="Toyota">
            <img src="{{ asset('images/Logos svg/volkswagen.svg') }}" alt="Volkswagen">
            <img src="{{ asset('images/Logos svg/volvo.svg') }}" alt="Volvo">
        </div>
    </div>

    <!-- SERVICIOS CON COCHE X-RAY INTERACTIVO -->
    <section class="xray-section">
        <div class="xray-section-header animate-up">
            <span class="section-label">Lo que hacemos</span>
            <h2 class="section-title">Ingeniería al detalle</h2>
            <p class="section-sub">Explora nuestros servicios especializados pulsando sobre los puntos clave del vehículo.</p>
        </div>

        <div class="xray-layout">
            <!-- Panel izquierdo: tabs + info -->
            <div class="xray-sidebar animate-up">
                <!-- Tabs de servicios -->
                <div class="xray-tabs" id="xray-tabs">
                    <button class="xray-tab" data-service="diagnosis" onclick="setActiveService('diagnosis')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        <span>Diagnóstico</span>
                    </button>
                    <button class="xray-tab" data-service="mantenimiento" onclick="setActiveService('mantenimiento')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                        </svg>
                        <span>Mantenimiento</span>
                    </button>
                    <button class="xray-tab" data-service="aceite" onclick="setActiveService('aceite')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z" />
                        </svg>
                        <span>Motor</span>
                    </button>
                    <button class="xray-tab active" data-service="neumaticos" onclick="setActiveService('neumaticos')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <span>Neumáticos</span>
                    </button>
                    <button class="xray-tab" data-service="baterias" onclick="setActiveService('baterias')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 18H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3.19M15 6h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-3.19" />
                            <line x1="23" y1="13" x2="23" y2="11" />
                            <polyline points="11 6 7 12 13 12 9 18" />
                        </svg>
                        <span>Eléctrico</span>
                    </button>
                    <button class="xray-tab" data-service="aire" onclick="setActiveService('aire')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 12h10a3 3 0 1 0-3-3" />
                            <path d="M2 6h16a3 3 0 1 1-3 3" />
                            <path d="M2 18h7a3 3 0 1 0-3-3" />
                        </svg>
                        <span>Climatización</span>
                    </button>
                </div>

                <!-- Panel de información -->
                <div class="xray-info-card" id="xray-info-panel">
                    <svg class="xray-info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    <div>
                        <h2 class="xray-info-title" id="xray-info-title">Neumáticos</h2>
                        <p class="xray-info-desc" id="xray-info-desc">Trabajamos con todas las marcas del mercado y realizamos cambios de neumáticos de todo tipo de vehículos: turismos, 4x4 y furgonetas. Reparación y alineación.</p>
                    </div>
                    <a href="#cita" class="btn-primary" style="margin-top:auto; width:100%; justify-content:center;">Consultar precio</a>
                </div>
            </div>

            <!-- Panel derecho: imagen del coche con hotspots -->
            <div class="xray-container animate-up delay-1">
                <div class="xray-watermark">PREMIUM</div>
                <img src="{{ asset('images/seat-leon-xray.jpg') }}" alt="Seat León con vista de rayos X" class="xray-car-img">

                <button class="xray-hotspot" id="hs-diagnosis" data-service="diagnosis" style="top:55%;left:78%;" onclick="setActiveService('diagnosis')" aria-label="Diagnóstico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>
                </button>

                <button class="xray-hotspot" id="hs-mantenimiento" data-service="mantenimiento" style="top:40%;left:70%;" onclick="setActiveService('mantenimiento')" aria-label="Mantenimiento">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" /></svg>
                </button>

                <button class="xray-hotspot" id="hs-aceite" data-service="aceite" style="top:62%;left:62%;" onclick="setActiveService('aceite')" aria-label="Cambio de aceite">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z" /></svg>
                </button>

                <button class="xray-hotspot active" id="hs-neumaticos" data-service="neumaticos" style="top:78%;left:78%;" onclick="setActiveService('neumaticos')" aria-label="Neumáticos">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10" /><circle cx="12" cy="12" r="3" /></svg>
                </button>

                <button class="xray-hotspot" id="hs-baterias" data-service="baterias" style="top:48%;left:55%;" onclick="setActiveService('baterias')" aria-label="Baterías">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 18H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3.19M15 6h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-3.19" /><line x1="23" y1="13" x2="23" y2="11" /><polyline points="11 6 7 12 13 12 9 18" /></svg>
                </button>

                <button class="xray-hotspot" id="hs-aire" data-service="aire" style="top:35%;left:48%;" onclick="setActiveService('aire')" aria-label="Aire acondicionado">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12h10a3 3 0 1 0-3-3" /><path d="M2 6h16a3 3 0 1 1-3 3" /><path d="M2 18h7a3 3 0 1 0-3-3" /></svg>
                </button>
            </div>
        </div>
    </section>

    <!-- POR QUÉ ELEGIRNOS -->
    <section class="why">
        <div class="animate-up">
            <span class="section-label">Nuestra diferencia</span>
            <h2 class="section-title">¿Por qué confiar en nosotros?</h2>
            <p class="section-sub">Transparencia, rapidez y calidad certificada en cada intervención.</p>
        </div>
        <div class="why-grid">
            <div class="why-item animate-up">
                <span class="why-num">01</span>
                <h4>Presupuesto sin compromiso</h4>
                <p>Te informamos detalladamente del coste antes de empezar cualquier trabajo. Sin sorpresas finales.</p>
            </div>
            <div class="why-item animate-up delay-1">
                <span class="why-num">02</span>
                <h4>Garantía de 12 meses</h4>
                <p>Todos nuestros trabajos incluyen garantía total o 20.000 km, lo que ocurra antes.</p>
            </div>
            <div class="why-item animate-up delay-2">
                <span class="why-num">03</span>
                <h4>Vehículo de cortesía</h4>
                <p>No dejes de moverte. Disponemos de vehículos de sustitución gratuitos para reparaciones largas.</p>
            </div>
            <div class="why-item animate-up delay-3">
                <span class="why-num">04</span>
                <h4>Recambios Originales</h4>
                <p>Solo utilizamos piezas de primer equipo que aseguran la máxima longevidad de tu vehículo.</p>
            </div>
        </div>
    </section>

    <!-- PEDIR CITA -->
    <section class="cita-section" id="cita">
        <div class="cita-inner animate-up">
            <div class="cita-info">
                <span class="section-label" style="color:var(--primary-light)">Reserva online</span>
                <h2>Pide tu cita ahora</h2>
                <p>Reserva en menos de 2 minutos. Confirmamos tu cita por WhatsApp en menos de 1 hora.</p>
                <div class="cita-detail"><i class="ti ti-clock"></i> Lun–Vie: 8:00 – 19:00 | Sáb: 9:00 – 14:00</div>
                <div class="cita-detail"><i class="ti ti-map-pin"></i> Av. de España, 45 · Plasencia</div>
                <div class="cita-detail"><i class="ti ti-phone"></i> 924 000 000</div>
            </div>
            <div class="cita-form">
                <input type="text" placeholder="Nombre completo">
                <input type="tel" placeholder="Teléfono WhatsApp">
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;">
                    <input type="text" placeholder="Matrícula">
                    <input type="date">
                </div>
                <select>
                    <option value="">Tipo de servicio</option>
                    <option>Revisión general</option>
                    <option>Mecánica compleja</option>
                    <option>Neumáticos</option>
                    <option>Electricidad</option>
                </select>
                <textarea placeholder="Cuéntanos qué necesita tu coche..."></textarea>
                <button class="btn-primary" style="width:100%; justify-content:center;">Confirmar Reserva</button>
            </div>
        </div>
    </section>

    <!-- TESTIMONIOS -->
    <section class="testi">
        <div class="animate-up">
            <span class="section-label">Opiniones</span>
            <h2 class="section-title">Lo que dicen nuestros clientes</h2>
            <p class="section-sub">La confianza de nuestros clientes es nuestro mayor activo.</p>
        </div>
        <div class="testi-grid">
            <div class="testi-card animate-up">
                <div class="stars">★★★★★</div>
                <p>"Llevé mi BMW por un fallo electrónico que nadie encontraba. En 2 horas dieron con la tecla. Profesionales de verdad."</p>
                <div class="testi-author">
                    <div class="testi-avatar">MG</div>
                    <div>
                        <div class="testi-name">Manuel García</div>
                        <div class="testi-car">BMW Serie 3 · Cliente habitual</div>
                    </div>
                </div>
            </div>
            <div class="testi-card animate-up delay-1">
                <div class="stars">★★★★★</div>
                <p>"El coche de sustitución me salvó la semana. El trato es excelente y el precio muy competitivo."</p>
                <div class="testi-author">
                    <div class="testi-avatar">LR</div>
                    <div>
                        <div class="testi-name">Laura Rodríguez</div>
                        <div class="testi-car">VW Golf · Revisión Anual</div>
                    </div>
                </div>
            </div>
            <div class="testi-card animate-up delay-2">
                <div class="stars">★★★★★</div>
                <p>"Rápido, limpio y transparente. Me enviaron fotos de las piezas desgastadas antes de cambiarlas. Muy satisfecho."</p>
                <div class="testi-author">
                    <div class="testi-avatar">JM</div>
                    <div>
                        <div class="testi-name">Javier Moreno</div>
                        <div class="testi-car">Peugeot 308 · Frenos</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    const xrayServices = {
        diagnosis: {
            label: 'Diagnóstico Avanzado',
            desc: 'Utilizamos software oficial para detectar cualquier anomalía en la centralita y sistemas electrónicos de tu vehículo.'
        },
        mantenimiento: {
            label: 'Mantenimiento Preventivo',
            desc: 'Revisiones completas siguiendo los estándares del fabricante para mantener la garantía oficial y seguridad.'
        },
        aceite: {
            label: 'Motor y Lubricación',
            desc: 'Cambio de aceite y filtros de alta gama. Revisión de niveles y estado interno del motor para evitar averías graves.'
        },
        neumaticos: {
            label: 'Neumáticos y Seguridad',
            desc: 'Montaje, equilibrado y alineación 3D. Trabajamos con marcas premium para asegurar el mejor agarre en carretera.'
        },
        baterias: {
            label: 'Sistemas Eléctricos',
            desc: 'Comprobación de alternador, batería y sistema de arranque. Sustitución de componentes con tecnología Start-Stop.'
        },
        aire: {
            label: 'Climatización Confort',
            desc: 'Recarga de gas refrigerante, desinfección de conductos y cambio de filtros de habitáculo para un aire puro.'
        }
    };

    function setActiveService(id) {
        const svc = xrayServices[id];
        if (!svc) return;

        // Actualizar info panel con pequeña animación
        const panel = document.getElementById('xray-info-panel');
        panel.style.opacity = '0';
        panel.style.transform = 'translateY(10px)';
        
        setTimeout(() => {
            document.getElementById('xray-info-title').textContent = svc.label;
            document.getElementById('xray-info-desc').textContent = svc.desc;
            panel.style.opacity = '1';
            panel.style.transform = 'translateY(0)';
        }, 200);

        // Actualizar tabs
        document.querySelectorAll('.xray-tab').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.service === id);
        });

        // Actualizar hotspots
        document.querySelectorAll('.xray-hotspot').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.service === id);
        });
    }

    // Scroll Reveal Intersection Observer
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