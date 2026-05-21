@vite(['resources/css/usuarios/compra.css'])
@vite(['resources/css/contents/topbar.css'])

@extends('layouts.app')
@section('content')

<div class="pg-compra">

    <!-- HERO COMPRA -->
    <div class="compra-hero">
        <div class="compra-hero-inner">
            <div class="compra-hero-text">
                <div class="hero-badge"><i class="ti ti-shopping-cart" aria-hidden="true"></i> Adquisición de Vehículo</div>
                <h1>Finaliza tu <span>Compra</span></h1>
                <p>Consigue el coche de tus sueños con las mejores condiciones. Elige entre pago al contado o financiación flexible adaptada totalmente a tu medida.</p>
            </div>
        </div>
    </div>

    <!-- MAIN SECTION: FORM + SIDEBAR -->
    <div class="compra-main">
        <div class="compra-main-inner">

            <!-- Columna Izquierda: Formulario de solicitud -->
            <div class="compra-form-block">
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
                        <span class="selected-car-price-label">Precio de compra</span>
                        <strong class="selected-car-price" id="car-summary-price">18.900 €</strong>
                    </div>
                </div>

                <!-- If no car is selected, this is shown -->
                <div class="no-car-selected-card" id="no-car-selected-card">
                    <div class="no-car-icon"><i class="ti ti-info-circle"></i></div>
                    <p>Puedes simular la compra o financiación de cualquier importe a continuación, o ver nuestro <a href="{{ route('ocasion') }}">Stock de Ocasión</a> para seleccionar un vehículo específico.</p>
                </div>

                <!-- Método de Pago Selector -->
                <div class="section-label">Método de Pago</div>
                <div class="section-title" style="font-size: 20px; margin-bottom: 16px;">Selecciona tu modalidad de pago</div>
                
                <div class="payment-method-container">
                    <div class="payment-method-toggle">
                        <button type="button" class="toggle-btn active" id="btn-pay-cash">
                            <i class="ti ti-cash"></i>
                            <div>
                                <strong>Pago al Contado</strong>
                                <span>Reserva online y transferencia</span>
                            </div>
                        </button>
                        <button type="button" class="toggle-btn" id="btn-pay-finance">
                            <i class="ti ti-percentage"></i>
                            <div>
                                <strong>Pago Financiado</strong>
                                <span>Estudio de crédito personalizado</span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- FORMULARIO -->
                <form class="compra-form" action="#" method="POST" id="compra-form">
                    @csrf
                    <!-- Hidden fields to submit car info + payment method -->
                    <input type="hidden" name="vehiculo_nombre" id="hidden-car-name" value="">
                    <input type="hidden" name="vehiculo_precio" id="hidden-car-price" value="">
                    <input type="hidden" name="metodo_pago" id="hidden-metodo-pago" value="cash">
                    
                    <!-- Hidden finance parameters -->
                    <input type="hidden" name="financiacion_importe" id="hidden-fin-importe" value="15000">
                    <input type="hidden" name="financiacion_plazo" id="hidden-fin-plazo" value="60">
                    <input type="hidden" name="financiacion_cuota" id="hidden-fin-cuota" value="285">

                    <div class="section-label" style="margin-top: 16px;">Tus Datos</div>
                    <div class="section-title" style="font-size: 20px;" id="form-sub-title">Formulario de Compra al Contado</div>
                    <p class="section-sub" id="form-sub-desc" style="margin-bottom: 24px;">Completa tus datos para formalizar la reserva del vehículo.</p>

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

                    <!-- Campos específicos de Financiación (Ocultos/Visibles dinámicamente) -->
                    <div class="form-row" id="finance-only-fields" style="display: none;">
                        <div class="form-group">
                            <label for="f-contrato">Situación Laboral *</label>
                            <select id="f-contrato" name="contrato">
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
                            <input type="number" id="f-ingresos" name="ingresos" placeholder="Ej: 1500" min="500">
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" id="f-privacy" name="privacy" required>
                        <label for="f-privacy">He leído y acepto la <a href="#">política de privacidad</a> y el tratamiento de datos para la adquisición del vehículo.</label>
                    </div>

                    <button type="submit" class="btn-primary btn-submit" id="f-submit" style="margin-top: 16px;">
                        <i class="ti ti-send" aria-hidden="true"></i> Confirmar y Reservar
                    </button>
                </form>
            </div>

            <!-- Columna Derecha: Simulador o Resumen de Compra -->
            <div class="compra-sidebar">
                
                <!-- PANEL CONTADO (Default) -->
                <div class="sidebar-panel active" id="panel-cash">
                    <div class="cash-card">
                        <div class="cash-header">
                            <div class="cash-icon-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="1" x2="12" y2="23" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                            </div>
                            <div class="cash-header-text">
                                <h3>Resumen de Compra</h3>
                                <p>Detalles del pago al contado</p>
                            </div>
                        </div>

                        <!-- Shaded Cash Box -->
                        <div class="cash-result-box">
                            <div class="cash-result-label">PRECIO TOTAL AL CONTADO</div>
                            <div class="cash-result-value" id="cash-val-total">15.000 €</div>
                            <div class="cash-result-note">Incluye impuestos y cambio de nombre</div>
                        </div>

                        <div class="sim-sliders">
                            <div style="background: #fafbfc; border: 1.5px solid #dde2ea; border-radius: 8px; padding: 16px; display: flex; flex-direction: column; gap: 8px;">
                                <div style="display: flex; justify-content: space-between; font-size: 13px; color: #555;">
                                    <span>Importe del vehículo:</span>
                                    <strong id="breakdown-car-price">15.000 €</strong>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 13px; color: #555;">
                                    <span>Depósito de reserva online:</span>
                                    <strong style="color: #16a34a;">300 €</strong>
                                </div>
                                <div style="border-top: 1px solid #e8eaf0; margin-top: 4px; padding-top: 8px; display: flex; justify-content: space-between; font-size: 14px; font-weight: 800; color: #0c141e;">
                                    <span>Restante a la entrega:</span>
                                    <span id="breakdown-remaining">14.700 €</span>
                                </div>
                            </div>
                        </div>

                        <!-- Ventajas Contado -->
                        <div class="compra-advantages">
                            <div class="adv-item">
                                <i class="ti ti-discount-2"></i>
                                <div>
                                    <strong>Sin intereses</strong>
                                    <p>Ahórrate intereses bancarios y costes de financiación.</p>
                                </div>
                            </div>
                            <div class="adv-item">
                                <i class="ti ti-shield-check"></i>
                                <div>
                                    <strong>Trámites rápidos</strong>
                                    <p>Propiedad inmediata del vehículo y entrega en 24/48h.</p>
                                </div>
                            </div>
                            <div class="adv-item">
                                <i class="ti ti-circle-check"></i>
                                <div>
                                    <strong>Garantía de 12 meses</strong>
                                    <p>Garantía de taller a nivel nacional incluida sin coste.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PANEL FINANCIADO (Oculto inicialmente) -->
                <div class="sidebar-panel" id="panel-finance">
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

                        <!-- Ventajas Financiación -->
                        <div class="compra-advantages">
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

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selectores del DOM
    const btnPayCash = document.getElementById('btn-pay-cash');
    const btnPayFinance = document.getElementById('btn-pay-finance');
    const panelCash = document.getElementById('panel-cash');
    const panelFinance = document.getElementById('panel-finance');
    const financeOnlyFields = document.getElementById('finance-only-fields');
    const formSubTitle = document.getElementById('form-sub-title');
    const formSubDesc = document.getElementById('form-sub-desc');
    const hiddenMetodoPago = document.getElementById('hidden-metodo-pago');
    const btnSubmitForm = document.getElementById('f-submit');

    // Inputs del formulario específicos
    const inputContrato = document.getElementById('f-contrato');
    const inputIngresos = document.getElementById('f-ingresos');

    // Simulación de Financiación
    const rangeImporte = document.getElementById('range-importe');
    const rangePlazo = document.getElementById('range-plazo');
    const valImporte = document.getElementById('val-importe');
    const valPlazo = document.getElementById('val-plazo');
    const valCuota = document.getElementById('val-cuota');

    // Datos Contado
    const cashValTotal = document.getElementById('cash-val-total');
    const breakdownCarPrice = document.getElementById('breakdown-car-price');
    const breakdownRemaining = document.getElementById('breakdown-remaining');

    // Inputs ocultos del form
    const hiddenImporte = document.getElementById('hidden-fin-importe');
    const hiddenPlazo = document.getElementById('hidden-fin-plazo');
    const hiddenCuota = document.getElementById('hidden-fin-cuota');
    const hiddenCarName = document.getElementById('hidden-car-name');
    const hiddenCarPrice = document.getElementById('hidden-car-price');

    // Cargar parámetros de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const carName = urlParams.get('car');
    const carPrice = parseInt(urlParams.get('price')) || 15000;
    const carBrand = urlParams.get('brand');
    const carYear = urlParams.get('year');
    const carKm = urlParams.get('km');
    const paramMonths = parseInt(urlParams.get('months'));
    const initialMethod = urlParams.get('method'); // 'cash' o 'finance'

    // Actualizar coche si está seleccionado
    if (carName && urlParams.get('price')) {
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

        // Ajustar sliders e importes por defecto al precio del coche
        if (rangeImporte) {
            rangeImporte.max = Math.max(50000, carPrice);
            rangeImporte.value = carPrice;
        }

        // Llenar datos al contado
        updateCashSummary(carPrice);
    } else {
        // Por defecto
        updateCashSummary(15000);
    }

    // Ajustar el plazo inicial si viene por parámetro
    if (paramMonths && rangePlazo) {
        rangePlazo.value = paramMonths;
    }

    // Función para cambiar de método de pago
    function setPaymentMethod(method) {
        if (method === 'cash') {
            btnPayCash.classList.add('active');
            btnPayFinance.classList.remove('active');
            panelCash.classList.add('active');
            panelFinance.classList.remove('active');
            
            // Ocultar campos de financiación
            financeOnlyFields.style.display = 'none';
            inputContrato.removeAttribute('required');
            inputIngresos.removeAttribute('required');

            // Adaptar textos del formulario
            formSubTitle.textContent = "Formulario de Compra al Contado";
            formSubDesc.textContent = "Completa tus datos para formalizar la reserva del vehículo.";
            btnSubmitForm.innerHTML = '<i class="ti ti-send" aria-hidden="true"></i> Confirmar y Reservar';

            hiddenMetodoPago.value = 'cash';
        } else {
            btnPayCash.classList.remove('active');
            btnPayFinance.classList.add('active');
            panelCash.classList.remove('active');
            panelFinance.classList.add('active');
            
            // Mostrar campos de financiación
            financeOnlyFields.style.display = 'grid';
            inputContrato.setAttribute('required', 'required');
            inputIngresos.setAttribute('required', 'required');

            // Adaptar textos del formulario
            formSubTitle.textContent = "Formulario de Solicitud de Financiación";
            formSubDesc.textContent = "Completa tus datos para realizar el estudio de viabilidad sin compromiso.";
            btnSubmitForm.innerHTML = '<i class="ti ti-send" aria-hidden="true"></i> Enviar Solicitud de Estudio';

            hiddenMetodoPago.value = 'finance';
            calculateFinance();
        }
    }

    // Asignar eventos de clic a los selectores de método de pago
    btnPayCash.addEventListener('click', () => setPaymentMethod('cash'));
    btnPayFinance.addEventListener('click', () => setPaymentMethod('finance'));

    // Configurar método de pago inicial según parámetros de la URL
    if (initialMethod === 'cash') {
        setPaymentMethod('cash');
    } else if (initialMethod === 'finance' || urlParams.get('price')) {
        // Si viene un coche por parámetro, por defecto le mostramos la opción de financiado, que es más completa
        setPaymentMethod('finance');
    } else {
        setPaymentMethod('cash');
    }

    // Funciones de cálculo y actualización
    function updateCashSummary(totalPrice) {
        cashValTotal.textContent = totalPrice.toLocaleString('es-ES') + ' €';
        breakdownCarPrice.textContent = totalPrice.toLocaleString('es-ES') + ' €';
        const remaining = Math.max(0, totalPrice - 300);
        breakdownRemaining.textContent = remaining.toLocaleString('es-ES') + ' €';
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
    document.getElementById('compra-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const method = hiddenMetodoPago.value;
        const successText = method === 'cash' ? '¡Vehículo Reservado con éxito!' : '¡Solicitud de Estudio Enviada!';
        
        btnSubmitForm.innerHTML = `<i class="ti ti-check"></i> ${successText}`;
        btnSubmitForm.style.background = '#16a34a';
        btnSubmitForm.disabled = true;
        
        setTimeout(() => {
            btnSubmitForm.innerHTML = method === 'cash' ? '<i class="ti ti-send"></i> Confirmar y Reservar' : '<i class="ti ti-send"></i> Enviar Solicitud de Estudio';
            btnSubmitForm.style.background = '';
            btnSubmitForm.disabled = false;
            this.reset();
            // Restaurar por defecto
            setPaymentMethod(method);
        }, 4000);
    });
});
</script>

@endsection
