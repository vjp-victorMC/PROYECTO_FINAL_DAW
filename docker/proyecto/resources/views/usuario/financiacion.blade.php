@vite(['resources/css/usuarios/financiacion.css'])
@vite(['resources/css/contents/topbar.css'])

@extends('layouts.app')
@section('content')

<div class="pg-financiacion">

    <!-- HERO FINANCIACIÓN -->
    <div class="financiacion-hero">
        <div class="financiacion-hero-inner">
            <div class="financiacion-hero-text">
                <div class="hero-badge"><i class="ti ti-percentage" aria-hidden="true"></i> Financiación Flexible</div>
                <h1>Solicita tu <span>Financiación</span></h1>
                <p>Consigue el coche de tus sueños con las mejores condiciones. Proceso 100% transparente, cuotas adaptadas a tu medida y respuesta en menos de 24 horas.</p>
            </div>
        </div>
    </div>

    <!-- MAIN SECTION: FORM + SIMULATOR -->
    <div class="financiacion-main">
        <div class="financiacion-main-inner">

            <!-- Columna Izquierda: Formulario de solicitud -->
            <div class="financiacion-form-block">
                <!-- Vehicle Panel (Loaded dynamically) -->
                <div class="section-label">Tu Elección</div>
                <div class="section-title">Vehículo Seleccionado</div>
                
                <!-- If a car is selected, this is shown -->
                <div class="selected-car-card" id="selected-car-card" style="display: none;">
                    <div class="selected-car-icon">
                        <svg viewBox="0 0 100 50" width="60" height="30" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 30 H25 C28 20, 36 12, 50 12 H65 C73 12, 80 18, 83 25 L86 30 H90 C92 30, 94 32, 94 34 V38 C94 40, 92 41, 90 41 H84" />
                            <path d="M16 41 H10 C8 41, 6 40, 6 38 V34 C6 32, 8 30, 10 30 H15" />
                            <circle cx="25" cy="41" r="5.5" stroke="currentColor" stroke-width="2.5" fill="#fff" />
                            <circle cx="75" cy="41" r="5.5" stroke="currentColor" stroke-width="2.5" fill="#fff" />
                            <path d="M31 41 H69" />
                        </svg>
                    </div>
                    <div class="selected-car-details">
                        <span class="selected-car-brand" id="car-summary-brand">SEAT</span>
                        <h4 class="selected-car-title" id="car-summary-title">León FR</h4>
                        <p class="selected-car-meta" id="car-summary-meta">Año 2021 · 32.000 km</p>
                    </div>
                    <div class="selected-car-price-box">
                        <span class="selected-car-price-label">Precio al contado</span>
                        <strong class="selected-car-price" id="car-summary-price">18.900 €</strong>
                    </div>
                </div>

                <!-- If no car is selected, this is shown -->
                <div class="no-car-selected-card" id="no-car-selected-card">
                    <div class="no-car-icon"><i class="ti ti-info-circle"></i></div>
                    <p>Puedes simular la financiación de cualquier importe a continuación, o ver nuestro <a href="{{ route('ocasion') }}">Stock de Ocasión</a> para seleccionar un vehículo específico.</p>
                </div>

                <form class="financiacion-form" action="#" method="POST" id="financiacion-form" style="margin-top: 32px;">
                    @csrf
                    <!-- Hidden fields to submit car info if present -->
                    <input type="hidden" name="vehiculo_nombre" id="hidden-car-name" value="">
                    <input type="hidden" name="vehiculo_precio" id="hidden-car-price" value="">
                    <input type="hidden" name="financiacion_importe" id="hidden-fin-importe" value="15000">
                    <input type="hidden" name="financiacion_plazo" id="hidden-fin-plazo" value="60">
                    <input type="hidden" name="financiacion_cuota" id="hidden-fin-cuota" value="285">

                    <div class="section-label" style="margin-top: 16px;">Tus Datos</div>
                    <div class="section-title" style="font-size: 20px;">Formulario de Solicitud</div>
                    <p class="section-sub" style="margin-bottom: 24px;">Completa tus datos para realizar el estudio de viabilidad sin compromiso.</p>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="f-nombre">Nombre y Apellidos *</label>
                            <input type="text" id="f-nombre" name="nombre" placeholder="Ej: Juan García" required>
                        </div>
                        <div class="form-group">
                            <label for="f-dni">DNI / NIE *</label>
                            <input type="text" id="f-dni" name="dni" placeholder="Ej: 12345678Z" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="f-telefono">Teléfono (WhatsApp) *</label>
                            <input type="tel" id="f-telefono" name="telefono" placeholder="Ej: 600 123 456" required>
                        </div>
                        <div class="form-group">
                            <label for="f-email">Correo Electrónico *</label>
                            <input type="email" id="f-email" name="email" placeholder="ejemplo@correo.com" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="f-contrato">Situación Laboral *</label>
                            <select id="f-contrato" name="contrato" required>
                                <option value="">Selecciona tu situación</option>
                                <option value="indefinido">Contrato Indefinido</option>
                                <option value="temporal">Contrato Temporal</option>
                                <option value="autonomo">Autónomo</option>
                                <option value="funcionario">Funcionario público</option>
                                <option value="jubilado">Jubilado / Pensionista</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f-ingresos">Ingresos Mensuales Netos *</label>
                            <input type="number" id="f-ingresos" name="ingresos" placeholder="Ej: 1500" min="500" required>
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" id="f-privacy" name="privacy" required>
                        <label for="f-privacy">He leído y acepto la <a href="#">política de privacidad</a> y el tratamiento de datos para el estudio de financiación.</label>
                    </div>

                    <button type="submit" class="btn-primary btn-submit" id="f-submit" style="margin-top: 16px;">
                        <i class="ti ti-send" aria-hidden="true"></i> Enviar Solicitud de Estudio
                    </button>
                </form>
            </div>

            <!-- Columna Derecha: Simulador interactivo -->
            <div class="financiacion-sidebar">
                <div class="sim-card">
                    <div class="sim-header">
                        <div class="sim-icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="4" y="2" width="16" height="20" rx="2" ry="2" />
                                <line x1="9" y1="22" x2="9" y2="16" />
                                <line x1="8" y1="6" x2="16" y2="6" />
                                <line x1="16" y1="16" x2="16" y2="22" />
                                <line x1="12" y1="16" x2="12" y2="22" />
                                <circle cx="9" cy="11" r="1" />
                                <circle cx="15" cy="11" r="1" />
                                <circle cx="12" cy="11" r="1" />
                            </svg>
                        </div>
                        <div class="sim-header-text">
                            <h3>Ajusta tu cuota</h3>
                            <p>Simulación en tiempo real (TAE 7,9%)</p>
                        </div>
                    </div>

                    <div class="sim-sliders">
                        <!-- Importe Slider -->
                        <div class="sim-slider-group">
                            <div class="sim-slider-labels">
                                <label for="range-importe">Importe Financiado</label>
                                <span class="sim-value" id="val-importe">15.000 €</span>
                            </div>
                            <input type="range" class="sim-slider-input" id="range-importe" min="3000" max="50000" step="500" value="15000">
                        </div>

                        <!-- Plazo Slider -->
                        <div class="sim-slider-group">
                            <div class="sim-slider-labels">
                                <label for="range-plazo">Plazo de Devolución</label>
                                <span class="sim-value" id="val-plazo">60 meses</span>
                            </div>
                            <input type="range" class="sim-slider-input" id="range-plazo" min="12" max="96" step="12" value="60">
                        </div>
                    </div>

                    <!-- Shaded Result Box -->
                    <div class="sim-result-box">
                        <div class="sim-result-label">CUOTA MENSUAL ESTIMADA</div>
                        <div class="sim-result-value" id="val-cuota">285 €</div>
                        <div class="sim-result-note">TIN 5,4% · TAE 7,9% orientativo</div>
                    </div>

                    <!-- Ventajas -->
                    <div class="financiacion-advantages">
                        <div class="adv-item">
                            <i class="ti ti-bolt"></i>
                            <div>
                                <strong>Respuesta rápida</strong>
                                <p>Te contestamos en menos de 24h laborables.</p>
                            </div>
                        </div>
                        <div class="adv-item">
                            <i class="ti ti-shield-check"></i>
                            <div>
                                <strong>Sin sorpresas</strong>
                                <p>Interés fijo durante todo el período del préstamo.</p>
                            </div>
                        </div>
                        <div class="adv-item">
                            <i class="ti ti-discount"></i>
                            <div>
                                <strong>Amortización flexible</strong>
                                <p>Cancela anticipadamente cuando quieras.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const rangeImporte = document.getElementById('range-importe');
    const rangePlazo = document.getElementById('range-plazo');
    const valImporte = document.getElementById('val-importe');
    const valPlazo = document.getElementById('val-plazo');
    const valCuota = document.getElementById('val-cuota');

    // Inputs ocultos del form
    const hiddenImporte = document.getElementById('hidden-fin-importe');
    const hiddenPlazo = document.getElementById('hidden-fin-plazo');
    const hiddenCuota = document.getElementById('hidden-fin-cuota');
    const hiddenCarName = document.getElementById('hidden-car-name');
    const hiddenCarPrice = document.getElementById('hidden-car-price');

    // Cargar parámetros de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const carName = urlParams.get('car');
    const carPrice = parseInt(urlParams.get('price'));
    const carBrand = urlParams.get('brand');
    const carYear = urlParams.get('year');
    const carKm = urlParams.get('km');
    const paramMonths = parseInt(urlParams.get('months'));

    if (carName && carPrice) {
        // Mostrar tarjeta del vehículo
        document.getElementById('selected-car-card').style.display = 'flex';
        document.getElementById('no-car-selected-card').style.display = 'none';

        // Llenar tarjeta de resumen
        document.getElementById('car-summary-brand').textContent = carBrand || '';
        document.getElementById('car-summary-title').textContent = carName;
        document.getElementById('car-summary-meta').textContent = `Año ${carYear || 'N/D'} · ${carKm || '0'} km`;
        document.getElementById('car-summary-price').textContent = carPrice.toLocaleString('es-ES') + ' €';

        // Llenar hidden inputs
        hiddenCarName.value = carName;
        hiddenCarPrice.value = carPrice;

        // Ajustar el importe al precio del coche por defecto
        if (rangeImporte) {
            rangeImporte.value = carPrice;
        }
    }

    // Ajustar el plazo inicial si viene por parámetro
    if (paramMonths && rangePlazo) {
        rangePlazo.value = paramMonths;
    }

    function calculateFinance() {
        if (!rangeImporte || !rangePlazo) return;
        const amount = parseFloat(rangeImporte.value);
        const months = parseInt(rangePlazo.value);
        
        // Actualizar textos
        valImporte.textContent = amount.toLocaleString('es-ES') + ' €';
        valPlazo.textContent = `${months} meses`;

        // Llenar inputs ocultos del form
        hiddenImporte.value = amount;
        hiddenPlazo.value = months;

        // Amortización estándar TIN 5.4%
        const annualRate = 0.054;
        const monthlyRate = annualRate / 12;
        const monthlyPayment = (amount * monthlyRate * Math.pow(1 + monthlyRate, months)) / (Math.pow(1 + monthlyRate, months) - 1);
        
        const finalCuota = Math.round(monthlyPayment);
        valCuota.textContent = `${finalCuota} €`;
        hiddenCuota.value = finalCuota;
    }

    if (rangeImporte && rangePlazo) {
        rangeImporte.addEventListener('input', calculateFinance);
        rangePlazo.addEventListener('input', calculateFinance);
        calculateFinance(); // Ejecución inicial
    }

    // Envío del formulario
    document.getElementById('financiacion-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('f-submit');
        btn.innerHTML = '<i class="ti ti-check"></i> Solicitud Enviada con éxito';
        btn.style.background = '#16a34a';
        btn.disabled = true;
        setTimeout(() => {
            btn.innerHTML = '<i class="ti ti-send"></i> Enviar Solicitud de Estudio';
            btn.style.background = '';
            btn.disabled = false;
            this.reset();
        }, 4000);
    });
});
</script>

@endsection
