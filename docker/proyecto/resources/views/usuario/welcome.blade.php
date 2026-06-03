@vite(['resources/css/usuarios/welcome.css'])
@vite(['resources/css/contents/topbar.css'])

@extends('layouts.app')
@section('content')

<div class="pg">

    <!-- HERO -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-text animate-up">
                <div class="hero-badge"><i class="ti ti-tool" aria-hidden="true"></i> Taller oficial Plasencia</div>
                <h1>Tu vehículo en manos <span>expertas</span></h1>
                <p>Más de 20 años cuidando vehículos en Extremadura. Revisiones, reparaciones y puesta a punto con tecnología de vanguardia y garantía total.</p>
                <div class="hero-btns">
                    <a href="{{ route ('cita')}}" class="btn-primary"><i class="ti ti-calendar" aria-hidden="true"></i> Pedir cita online</a>
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
        <div class="xray-section-container">
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
                        <a href="{{ route ('cita')}}" class="btn-primary" style="margin-top:auto; width:100%; justify-content:center;">Consultar precio</a>
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
        </div>
    </section>

    <!-- STOCK DE OCASIÓN -->
    <section class="stock-section animate-up">
        <div class="stock-container">
            <div class="stock-header">
                <div class="stock-title-group">
                    <span class="section-label">Vehículos Seleccionados</span>
                    <h2 class="stock-title">Stock de Ocasión</h2>
                </div>
                <a href="{{ route('ocasion') }}" class="stock-link-all">Ver todos <i class="ti ti-arrow-right" aria-hidden="true"></i></a>
            </div>

            <div class="stock-grid" id="stock-grid">
                <!-- Card 1 -->
                <div class="stock-card animate-up">
                    <div class="stock-card-top">
                        <svg viewBox="0 0 100 50" width="120" height="60" fill="none" stroke="#A9B8CE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.85;">
                            <path d="M15 30 H25 C28 20, 36 12, 50 12 H65 C73 12, 80 18, 83 25 L86 30 H90 C92 30, 94 32, 94 34 V38 C94 40, 92 41, 90 41 H84" />
                            <path d="M16 41 H10 C8 41, 6 40, 6 38 V34 C6 32, 8 30, 10 30 H15" />
                            <circle cx="25" cy="41" r="5.5" stroke="#A9B8CE" stroke-width="2.5" fill="#F0F4FA" />
                            <circle cx="75" cy="41" r="5.5" stroke="#A9B8CE" stroke-width="2.5" fill="#F0F4FA" />
                            <path d="M31 41 H69" />
                            <path d="M48 18 H63 C68 18, 73 22, 75 27 L76 30 H48 V18 Z" fill="#A9B8CE" fill-opacity="0.15" stroke="#A9B8CE" stroke-width="1.8" />
                            <path d="M33 30 H44 V18 H38 C34 18, 30 22, 29 27 Z" fill="#A9B8CE" fill-opacity="0.15" stroke="#A9B8CE" stroke-width="1.8" />
                        </svg>
                    </div>
                    <div class="stock-card-bottom">
                        <span class="stock-brand">Seat</span>
                        <h3 class="stock-model">León FR</h3>
                        <div class="stock-meta">2021 <span style="opacity:0.5">•</span> 32.000 km</div>
                        <div class="stock-divider"></div>
                        <div class="stock-footer">
                            <span class="stock-price">18.900 €</span>
                            <a href="{{ route('compra') }}?car=Seat%20León%20FR&price=18900&brand=Seat&year=2021&km=32.000" class="stock-btn-detail">Comprar / Financiar <i class="ti ti-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="stock-card animate-up delay-1">
                    <div class="stock-card-top">
                        <svg viewBox="0 0 100 50" width="120" height="60" fill="none" stroke="#A9B8CE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.85;">
                            <path d="M15 30 H25 C28 20, 36 12, 50 12 H65 C73 12, 80 18, 83 25 L86 30 H90 C92 30, 94 32, 94 34 V38 C94 40, 92 41, 90 41 H84" />
                            <path d="M16 41 H10 C8 41, 6 40, 6 38 V34 C6 32, 8 30, 10 30 H15" />
                            <circle cx="25" cy="41" r="5.5" stroke="#A9B8CE" stroke-width="2.5" fill="#F0F4FA" />
                            <circle cx="75" cy="41" r="5.5" stroke="#A9B8CE" stroke-width="2.5" fill="#F0F4FA" />
                            <path d="M31 41 H69" />
                            <path d="M48 18 H63 C68 18, 73 22, 75 27 L76 30 H48 V18 Z" fill="#A9B8CE" fill-opacity="0.15" stroke="#A9B8CE" stroke-width="1.8" />
                            <path d="M33 30 H44 V18 H38 C34 18, 30 22, 29 27 Z" fill="#A9B8CE" fill-opacity="0.15" stroke="#A9B8CE" stroke-width="1.8" />
                        </svg>
                    </div>
                    <div class="stock-card-bottom">
                        <span class="stock-brand">Volkswagen</span>
                        <h3 class="stock-model">Golf 1.5 TSI</h3>
                        <div class="stock-meta">2022 <span style="opacity:0.5">•</span> 28.500 km</div>
                        <div class="stock-divider"></div>
                        <div class="stock-footer">
                            <span class="stock-price">21.500 €</span>
                            <a href="{{ route('compra') }}?car=Volkswagen%20Golf%201.5%20TSI&price=21500&brand=Volkswagen&year=2022&km=28.500" class="stock-btn-detail">Comprar / Financiar <i class="ti ti-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="stock-card animate-up delay-2">
                    <div class="stock-card-top">
                        <svg viewBox="0 0 100 50" width="120" height="60" fill="none" stroke="#A9B8CE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.85;">
                            <path d="M15 30 H25 C28 20, 36 12, 50 12 H65 C73 12, 80 18, 83 25 L86 30 H90 C92 30, 94 32, 94 34 V38 C94 40, 92 41, 90 41 H84" />
                            <path d="M16 41 H10 C8 41, 6 40, 6 38 V34 C6 32, 8 30, 10 30 H15" />
                            <circle cx="25" cy="41" r="5.5" stroke="#A9B8CE" stroke-width="2.5" fill="#F0F4FA" />
                            <circle cx="75" cy="41" r="5.5" stroke="#A9B8CE" stroke-width="2.5" fill="#F0F4FA" />
                            <path d="M31 41 H69" />
                            <path d="M48 18 H63 C68 18, 73 22, 75 27 L76 30 H48 V18 Z" fill="#A9B8CE" fill-opacity="0.15" stroke="#A9B8CE" stroke-width="1.8" />
                            <path d="M33 30 H44 V18 H38 C34 18, 30 22, 29 27 Z" fill="#A9B8CE" fill-opacity="0.15" stroke="#A9B8CE" stroke-width="1.8" />
                        </svg>
                    </div>
                    <div class="stock-card-bottom">
                        <span class="stock-brand">Audi</span>
                        <h3 class="stock-model">A3 Sportback</h3>
                        <div class="stock-meta">2020 <span style="opacity:0.5">•</span> 41.000 km</div>
                        <div class="stock-divider"></div>
                        <div class="stock-footer">
                            <span class="stock-price">24.900 €</span>
                            <a href="{{ route('compra') }}?car=Audi%20A3%20Sportback&price=24900&brand=Audi&year=2020&km=41.000" class="stock-btn-detail">Comprar / Financiar <i class="ti ti-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- POR QUÉ ELEGIRNOS -->
    <section class="why">
        <div class="why-container">
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
        </div>
    </section>

    <!-- CÓMO TRABAJAMOS -->
    <section class="process-section">
        <div class="process-container">
            <div class="animate-up">
                <span class="section-label">Nuestro Método</span>
                <h2 class="section-title">Cómo trabajamos paso a paso</h2>
                <p class="section-sub">Diseñamos una experiencia ágil y transparente para que tu visita sea lo más cómoda posible.</p>
            </div>
            <div class="process-grid">
                <div class="process-card animate-up">
                    <span class="process-step">Paso 1</span>
                    <div class="process-icon-box">
                        <img src="{{ asset('images/como trabajamos/calendario.png') }}" alt="Cita Online">
                    </div>
                    <h3>1. Cita Online</h3>
                    <p>Elige el día y la hora que mejor te vengan desde nuestro simulador o llámanos directamente en pocos segundos.</p>
                </div>
                <div class="process-card animate-up delay-1">
                    <span class="process-step">Paso 2</span>
                    <div class="process-icon-box">
                        <img src="{{ asset('images/como trabajamos/diagnostico-del-automovil.png') }}" alt="Diagnóstico">
                    </div>
                    <h3>2. Recepción y Diagnóstico</h3>
                    <p>Revisamos tu coche con software de vanguardia y te preparamos un presupuesto cerrado al momento.</p>
                </div>
                <div class="process-card animate-up delay-2">
                    <span class="process-step">Paso 3</span>
                    <div class="process-icon-box">
                        <img src="{{ asset('images/como trabajamos/reparacion-de-autos.png') }}" alt="Reparación">
                    </div>
                    <h3>3. Reparación Premium</h3>
                    <p>Nuestros mecánicos expertos efectúan el servicio utilizando recambios oficiales certificados y con total limpieza.</p>
                </div>
                <div class="process-card animate-up delay-3">
                    <span class="process-step">Paso 4</span>
                    <div class="process-icon-box">
                        <img src="{{ asset('images/como trabajamos/entrega.png') }}" alt="Entrega">
                    </div>
                    <h3>4. Control y Entrega</h3>
                    <p>Probamos el coche a fondo, te explicamos el trabajo realizado y te entregamos las llaves con tu garantía de 12 meses.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIOS -->
    <section class="testi">
        <div class="testi-container">
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
        </div>
    </section>

    <!-- PREGUNTAS FRECUENTES (FAQ) -->
    <section class="faq-section">
        <div class="faq-container">
            <div class="animate-up">
                <span class="section-label">Soporte rápido</span>
                <h2 class="section-title" style="text-align: center;">Preguntas Frecuentes</h2>
                <p class="section-sub" style="text-align: center; margin: 0 auto 48px;">Resolvemos todas tus dudas sobre nuestro taller, citas y procesos de revisión.</p>
            </div>
            <div class="faq-grid">
                <div class="faq-item animate-up">
                    <button class="faq-trigger" onclick="toggleFaq(this)">
                        <span class="faq-question">¿Necesito pedir cita previa obligatoriamente?</span>
                        <span class="faq-icon"><i class="ti ti-plus"></i></span>
                    </button>
                    <div class="faq-content">
                        <p>Aunque te recomendamos solicitar cita previa online o por teléfono para asegurarte la recepción inmediata de tu vehículo, también atendemos urgencias y diagnósticos rápidos de forma directa en nuestras instalaciones.</p>
                    </div>
                </div>
                <div class="faq-item animate-up delay-1">
                    <button class="faq-trigger" onclick="toggleFaq(this)">
                        <span class="faq-question">¿Cuánto tiempo se tarda en realizar una revisión general?</span>
                        <span class="faq-icon"><i class="ti ti-plus"></i></span>
                    </button>
                    <div class="faq-content">
                        <p>Una revisión de mantenimiento estándar (cambio de aceite, filtros y chequeo de seguridad de 40 puntos) suele demorarse entre 1 y 2 horas. Te avisaremos mediante un SMS en cuanto tu vehículo esté listo para recoger.</p>
                    </div>
                </div>
                <div class="faq-item animate-up delay-2">
                    <button class="faq-trigger" onclick="toggleFaq(this)">
                        <span class="faq-question">¿Qué garantía tienen las reparaciones realizadas?</span>
                        <span class="faq-icon"><i class="ti ti-plus"></i></span>
                    </button>
                    <div class="faq-content">
                        <p>Todas las reparaciones y sustituciones que realizamos en nuestro taller cuentan con una garantía total de 12 meses o 20.000 kilómetros recorridos (lo que ocurra primero), duplicando la garantía mínima legal exigida.</p>
                    </div>
                </div>
                <div class="faq-item animate-up delay-3">
                    <button class="faq-trigger" onclick="toggleFaq(this)">
                        <span class="faq-question">¿Disponéis de vehículo de sustitución?</span>
                        <span class="faq-icon"><i class="ti ti-plus"></i></span>
                    </button>
                    <div class="faq-content">
                        <p>Sí, ofrecemos vehículos de cortesía completamente gratuitos para reparaciones que requieran más de 4 horas de taller. Te aconsejamos solicitarlo al reservar tu cita previa debido a la disponibilidad limitada.</p>
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

    // FAQ Accordion
    function toggleFaq(button) {
        const item = button.parentElement;
        const content = button.nextElementSibling;
        const icon = button.querySelector('.faq-icon i');

        // Cerrar otros
        document.querySelectorAll('.faq-item').forEach(otherItem => {
            if (otherItem !== item && otherItem.classList.contains('active')) {
                otherItem.classList.remove('active');
                otherItem.querySelector('.faq-content').style.maxHeight = null;
                otherItem.querySelector('.faq-icon i').className = 'ti ti-plus';
            }
        });

        // Alternar el actual
        if (item.classList.contains('active')) {
            item.classList.remove('active');
            content.style.maxHeight = null;
            icon.className = 'ti ti-plus';
        } else {
            item.classList.add('active');
            content.style.maxHeight = content.scrollHeight + "px";
            icon.className = 'ti ti-minus';
        }
    }

    // Scroll Reveal Intersection Observer
    window.observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-up').forEach(el => window.observer.observe(el));

    // Fetch second-hand cars from coches2mano API
    fetch('/api/coche2mano')
        .then(response => response.json())
        .then(res => {
            if (res.success && res.data && res.data.length > 0) {
                const grid = document.getElementById('stock-grid');
                grid.innerHTML = ''; // Clear fallback cards

                // Show up to 3 cars on homepage
                const carsToShow = res.data.slice(0, 3);

                carsToShow.forEach((car, index) => {
                    const imgSource = car.imagen && car.imagen.startsWith('http')
                        ? car.imagen
                        : (car.imagen ? `/storage/${car.imagen}` : null);

                    const priceFormatted = new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR', maximumFractionDigits: 0 }).format(car.precio);
                    const kmFormatted = new Intl.NumberFormat('es-ES').format(car.km);

                    const card = document.createElement('div');
                    card.className = `stock-card animate-up ${index > 0 ? 'delay-' + index : ''}`;

                    let topContent = '';
                    if (imgSource) {
                        topContent = `<img src="${imgSource}" alt="${car.marca} ${car.modelo}">`;
                    } else {
                        topContent = `
                            <svg viewBox="0 0 100 50" width="120" height="60" fill="none" stroke="#A9B8CE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.85;">
                                <path d="M15 30 H25 C28 20, 36 12, 50 12 H65 C73 12, 80 18, 83 25 L86 30 H90 C92 30, 94 32, 94 34 V38 C94 40, 92 41, 90 41 H84" />
                                <path d="M16 41 H10 C8 41, 6 40, 6 38 V34 C6 32, 8 30, 10 30 H15" />
                                <circle cx="25" cy="41" r="5.5" stroke="#A9B8CE" stroke-width="2.5" fill="#F0F4FA" />
                                <circle cx="75" cy="41" r="5.5" stroke="#A9B8CE" stroke-width="2.5" fill="#F0F4FA" />
                                <path d="M31 41 H69" />
                                <path d="M48 18 H63 C68 18, 73 22, 75 27 L76 30 H48 V18 Z" fill="#A9B8CE" fill-opacity="0.15" stroke="#A9B8CE" stroke-width="1.8" />
                                <path d="M33 30 H44 V18 H38 C34 18, 30 22, 29 27 Z" fill="#A9B8CE" fill-opacity="0.15" stroke="#A9B8CE" stroke-width="1.8" />
                            </svg>
                        `;
                    }

                    const buyRoute = `/compra?car=${encodeURIComponent(car.marca + ' ' + car.modelo)}&price=${car.precio}&brand=${encodeURIComponent(car.marca)}&year=${car.anio_matriculacion || 2021}&km=${car.km}`;

                    card.innerHTML = `
                        <div class="stock-card-top">
                            ${topContent}
                        </div>
                        <div class="stock-card-bottom">
                            <span class="stock-brand">${car.marca}</span>
                            <h3 class="stock-model">${car.modelo}</h3>
                            <div class="stock-meta">
                                ${car.anio_matriculacion || 2021}
                                <span style="opacity:0.5">•</span>
                                ${kmFormatted} km
                                ${car.motorizacion ? `<span style="opacity:0.5">•</span> ${car.motorizacion}` : ''}
                            </div>
                            <div class="stock-divider"></div>
                            <div class="stock-footer">
                                <span class="stock-price">${priceFormatted}</span>
                                <a href="${buyRoute}" class="stock-btn-detail">Comprar / Financiar <i class="ti ti-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    `;

                    grid.appendChild(card);
                    window.observer.observe(card);
                });
            }
        })
        .catch(err => console.error("Error fetching second hand cars:", err));
</script>

@endsection
