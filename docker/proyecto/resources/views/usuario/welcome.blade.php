@vite(['resources/css/usuarios/welcome.css'])
@vite(['resources/css/contents/topbar.css'])

@extends('layouts.app')
@section('content')

<div class="pg">

    <!-- HERO -->
    <div class="hero">
        <div class="hero-text">
            <div class="hero-badge"><i class="ti ti-tool" aria-hidden="true"></i> Taller oficial Badajoz</div>
            <h1>Tu vehículo en manos <span>expertas</span></h1>
            <p>Más de 20 años cuidando vehículos en Extremadura. Revisiones, reparaciones y puesta a punto con garantía total y presupuesto sin compromiso.</p>
            <div class="hero-btns">
                <a href="#" class="btn-primary"><i class="ti ti-calendar" aria-hidden="true"></i> Pedir cita</a>
                <a href="#" class="btn-outline"><i class="ti ti-car" aria-hidden="true"></i> Nuestros servicios</a>
            </div>
        </div>
        <div class="hero-stats">
            <div class="stat-card">
                <strong>+20</strong>
                <small>Años de experiencia</small>
            </div>
            <div class="stat-card">
                <strong>+8.000</strong>
                <small>Clientes satisfechos</small>
            </div>
            <div class="stat-card">
                <strong>24h</strong>
                <small>Diagnóstico rápido</small>
            </div>
        </div>
    </div>

    <!-- SERVICIOS CON COCHE X-RAY INTERACTIVO -->
    <div class="xray-section">
        <div class="xray-section-header">
            <div class="section-label">Lo que hacemos</div>
            <div class="section-title">Nuestros servicios</div>
            <div class="section-sub">Pulsa sobre los iconos del coche para ver el detalle de cada servicio.</div>
        </div>

        <div class="xray-layout">
            <!-- Panel izquierdo: tabs + info -->
            <div class="xray-sidebar">
                <!-- Tabs de servicios -->
                <div class="xray-tabs" id="xray-tabs">
                    <button class="xray-tab" data-service="diagnosis" onclick="setActiveService('diagnosis')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>Diagnóstico</span>
                    </button>
                    <button class="xray-tab" data-service="mantenimiento" onclick="setActiveService('mantenimiento')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        <span>Mantenimiento</span>
                    </button>
                    <button class="xray-tab" data-service="aceite" onclick="setActiveService('aceite')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/></svg>
                        <span>Cambio de aceite</span>
                    </button>
                    <button class="xray-tab active" data-service="neumaticos" onclick="setActiveService('neumaticos')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>
                        <span>Neumáticos</span>
                    </button>
                    <button class="xray-tab" data-service="baterias" onclick="setActiveService('baterias')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 18H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3.19M15 6h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-3.19"/><line x1="23" y1="13" x2="23" y2="11"/><polyline points="11 6 7 12 13 12 9 18"/></svg>
                        <span>Baterías</span>
                    </button>
                    <button class="xray-tab" data-service="aire" onclick="setActiveService('aire')">
                        <svg class="xray-tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12h10a3 3 0 1 0-3-3"/><path d="M2 6h16a3 3 0 1 1-3 3"/><path d="M2 18h7a3 3 0 1 0-3-3"/></svg>
                        <span>Aire acond.</span>
                    </button>
                </div>

                <!-- Panel de información -->
                <div class="xray-info-card" id="xray-info-panel">
                    <svg class="xray-info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <div>
                        <h2 class="xray-info-title" id="xray-info-title">Neumáticos</h2>
                        <p class="xray-info-desc" id="xray-info-desc">Trabajamos con todas las marcas del mercado y realizamos cambios de neumáticos de todo tipo de vehículos: turismos, 4x4 y furgonetas. Reparación y alineación.</p>
                    </div>
                    <a href="#" class="xray-cta-btn">Ver más <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="14" height="14"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                </div>
            </div>

            <!-- Panel derecho: imagen del coche con hotspots -->
            <div class="xray-container">
                <!-- Watermark -->
                <div class="xray-watermark">X-RAY</div>

                <!-- Imagen del coche -->
                <img src="{{ asset('images/seat-leon-xray.jpg') }}" alt="Seat León con vista de rayos X" class="xray-car-img">

                <!-- Hotspot: Diagnóstico -->
                <button class="xray-hotspot" id="hs-diagnosis" data-service="diagnosis"
                        style="top:55%;left:78%;" onclick="setActiveService('diagnosis')" aria-label="Diagnóstico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <span class="xray-hotspot-pulse"></span>
                </button>

                <!-- Hotspot: Mantenimiento -->
                <button class="xray-hotspot" id="hs-mantenimiento" data-service="mantenimiento"
                        style="top:40%;left:70%;" onclick="setActiveService('mantenimiento')" aria-label="Mantenimiento">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    <span class="xray-hotspot-pulse"></span>
                </button>

                <!-- Hotspot: Aceite -->
                <button class="xray-hotspot" id="hs-aceite" data-service="aceite"
                        style="top:62%;left:62%;" onclick="setActiveService('aceite')" aria-label="Cambio de aceite">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/></svg>
                    <span class="xray-hotspot-pulse"></span>
                </button>

                <!-- Hotspot: Neumáticos -->
                <button class="xray-hotspot active" id="hs-neumaticos" data-service="neumaticos"
                        style="top:78%;left:78%;" onclick="setActiveService('neumaticos')" aria-label="Neumáticos">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>
                    <span class="xray-hotspot-pulse"></span>
                </button>

                <!-- Hotspot: Baterías -->
                <button class="xray-hotspot" id="hs-baterias" data-service="baterias"
                        style="top:48%;left:55%;" onclick="setActiveService('baterias')" aria-label="Baterías">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 18H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3.19M15 6h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-3.19"/><line x1="23" y1="13" x2="23" y2="11"/><polyline points="11 6 7 12 13 12 9 18"/></svg>
                    <span class="xray-hotspot-pulse"></span>
                </button>

                <!-- Hotspot: Aire acondicionado -->
                <button class="xray-hotspot" id="hs-aire" data-service="aire"
                        style="top:35%;left:48%;" onclick="setActiveService('aire')" aria-label="Aire acondicionado">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12h10a3 3 0 1 0-3-3"/><path d="M2 6h16a3 3 0 1 1-3 3"/><path d="M2 18h7a3 3 0 1 0-3-3"/></svg>
                    <span class="xray-hotspot-pulse"></span>
                </button>
            </div>
        </div>
    </div>

    <script>
    const xrayServices = {
        diagnosis: {
            label: 'Diagnóstico',
            desc: 'Diagnóstico electrónico completo de todos los sistemas del vehículo. Detectamos averías mediante equipos multimarca de última generación.'
        },
        mantenimiento: {
            label: 'Mantenimiento',
            desc: 'Revisiones periódicas según el plan del fabricante: filtros, correas, frenos, suspensión y puesta a punto general.'
        },
        aceite: {
            label: 'Cambio de aceite',
            desc: 'Cambio de aceite y filtro con lubricantes de primera marca, adaptados a las especificaciones de cada motor.'
        },
        neumaticos: {
            label: 'Neumáticos',
            desc: 'Trabajamos con todas las marcas del mercado y realizamos cambios de neumáticos de todo tipo de vehículos: turismos, 4x4 y furgonetas. Reparación y alineación.'
        },
        baterias: {
            label: 'Baterías',
            desc: 'Comprobación, carga y sustitución de baterías. Disponemos de baterías para todo tipo de vehículos, incluidos start-stop.'
        },
        aire: {
            label: 'Aire acondicionado',
            desc: 'Recarga, mantenimiento y reparación del sistema de aire acondicionado y climatización. Dejamos tu coche a punto para cualquier estación.'
        }
    };

    function setActiveService(id) {
        const svc = xrayServices[id];
        if (!svc) return;

        // Actualizar info panel
        document.getElementById('xray-info-title').textContent = svc.label;
        document.getElementById('xray-info-desc').textContent = svc.desc;

        // Actualizar tabs
        document.querySelectorAll('.xray-tab').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.service === id);
        });

        // Actualizar hotspots
        document.querySelectorAll('.xray-hotspot').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.service === id);
        });
    }
    </script>

    <!-- POR QUÉ ELEGIRNOS -->
    <div class="why">
        <div class="section-label">Nuestra diferencia</div>
        <div class="section-title">¿Por qué Azul Motor?</div>
        <div class="section-sub">Transparencia, rapidez y calidad en cada intervención.</div>
        <div class="why-grid">
            <div class="why-item">
                <div class="why-num">01</div>
                <div>
                    <h4>Presupuesto gratis</h4>
                    <p>Sin sorpresas. Te informamos del coste antes de empezar cualquier trabajo.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-num">02</div>
                <div>
                    <h4>Garantía en reparaciones</h4>
                    <p>Todos nuestros trabajos incluyen garantía de 12 meses o 20.000 km.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-num">03</div>
                <div>
                    <h4>Vehículo de sustitución</h4>
                    <p>Para que no te quedes sin movilidad mientras reparamos tu coche.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-num">04</div>
                <div>
                    <h4>Técnicos certificados</h4>
                    <p>Profesionales con formación continua y equipos de diagnóstico de última generación.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- PEDIR CITA -->
    <div class="cita-section">
        <div class="cita-inner">
            <div class="cita-info">
                <div class="section-label">Reserva online</div>
                <h2>Pide tu cita</h2>
                <p>Reserva en menos de 2 minutos. Te confirmamos disponibilidad en menos de 1 hora en horario laboral.</p>
                <div class="cita-detail"><i class="ti ti-clock" aria-hidden="true"></i> Lun–Vie: 8:00 – 19:00</div>
                <div class="cita-detail"><i class="ti ti-clock" aria-hidden="true"></i> Sáb: 9:00 – 14:00</div>
                <div class="cita-detail"><i class="ti ti-map-pin" aria-hidden="true"></i> Av. de Huelva, 45 · Badajoz</div>
                <div class="cita-detail"><i class="ti ti-phone" aria-hidden="true"></i> 924 000 000</div>
            </div>
            <div class="cita-form">
                <input type="text" placeholder="Nombre y apellidos">
                <input type="tel" placeholder="Teléfono de contacto">
                <input type="text" placeholder="Matrícula del vehículo">
                <select>
                    <option value="">Tipo de servicio</option>
                    <option>Revisión general</option>
                    <option>Motor y mecánica</option>
                    <option>Frenos y suspensión</option>
                    <option>Electricidad</option>
                    <option>Cambio de aceite</option>
                    <option>Neumáticos</option>
                    <option>Otro</option>
                </select>
                <input type="date">
                <textarea placeholder="¿Algún detalle adicional?"></textarea>
                <a href="#" class="btn-primary"><i class="ti ti-calendar" aria-hidden="true"></i> Confirmar cita</a>
            </div>
        </div>
    </div>

    <!-- TESTIMONIOS -->
    <div class="testi">
        <div class="section-label" style="padding:0 0 8px;">Opiniones</div>
        <div class="section-title" style="margin-bottom:6px;">Lo que dicen nuestros clientes</div>
        <div class="section-sub">Más de 8.000 clientes confían en nosotros.</div>
        <div class="testi-grid">
            <div class="testi-card">
                <div class="stars">★★★★★</div>
                <p>"Llevé el coche por un ruido extraño y en menos de 24 horas lo tenía listo. Presupuesto claro y precio justo."</p>
                <div class="testi-author">
                    <div class="testi-avatar">MG</div>
                    <div>
                        <div class="testi-name">Manuel García</div>
                        <div class="testi-car">Seat León · Cliente desde 2019</div>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <div class="stars">★★★★★</div>
                <p>"La revisión anual siempre la hago aquí. Profesionales, puntuales y sin cobrar de más. Muy recomendables."</p>
                <div class="testi-author">
                    <div class="testi-avatar">LR</div>
                    <div>
                        <div class="testi-name">Laura Rodríguez</div>
                        <div class="testi-car">Volkswagen Golf · Cliente desde 2021</div>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <div class="stars">★★★★★</div>
                <p>"Me dieron coche de sustitución mientras reparaban el mío. Un detalle que marca la diferencia. Volveré seguro."</p>
                <div class="testi-author">
                    <div class="testi-avatar">JM</div>
                    <div>
                        <div class="testi-name">Javier Moreno</div>
                        <div class="testi-car">Peugeot 308 · Cliente desde 2022</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

