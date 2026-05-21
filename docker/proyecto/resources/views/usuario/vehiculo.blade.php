@vite(['resources/css/usuarios/vehiculo.css'])
@vite(['resources/css/contents/topbar.css'])

@extends('layouts.app')
@section('content')

<div class="pg-vehiculo">

    <!-- HERO AÑADIR VEHÍCULO -->
    <div class="vehiculo-hero">
        <div class="vehiculo-hero-inner">
            <div class="vehiculo-hero-text">
                <div class="hero-badge"><i class="ti ti-car" aria-hidden="true"></i> Garaje Virtual</div>
                <h1>Añade tu <span>Vehículo</span></h1>
                <p>Registra tu coche para acceder a ofertas personalizadas de mantenimiento, tasación instantánea en nuestro Stock de Ocasión y un seguimiento detallado de tu historial técnico.</p>
            </div>
        </div>
    </div>

    <!-- MAIN SECTION: FORM + LIVE PREVIEW -->
    <div class="vehiculo-main">
        <div class="vehiculo-main-inner">

            <!-- Columna Izquierda: Formulario -->
            <div class="vehiculo-form-block">
                <form class="vehiculo-form" action="#" method="POST" id="add-vehicle-form" enctype="multipart/form-data">
                    @csrf

                    <!-- SECCIÓN 1: Identificación y Registro -->
                    <div class="form-section-card">
                        <div class="form-section-header">
                            <i class="ti ti-id" aria-hidden="true"></i>
                            <h3>Datos de Identificación</h3>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="v-matricula">Matrícula *</label>
                                <input type="text" id="v-matricula" name="matricula" placeholder="Ej: 1234BBB" required 
                                       pattern="^[0-9]{4}[A-Z]{3}$|^[A-Z]{1,2}[0-9]{4}[A-Z]{1,2}$" 
                                       title="Introduce una matrícula válida (Ej: 1234BBB o M1234XX)">
                            </div>
                            <div class="form-group">
                                <label for="v-marca">Marca *</label>
                                <select id="v-marca" name="marca" required>
                                    <option value="" disabled selected>Selecciona una marca</option>
                                    <option value="Audi">Audi</option>
                                    <option value="BMW">BMW</option>
                                    <option value="Citroën">Citroën</option>
                                    <option value="Ford">Ford</option>
                                    <option value="Hyundai">Hyundai</option>
                                    <option value="Mercedes-Benz">Mercedes-Benz</option>
                                    <option value="Opel">Opel</option>
                                    <option value="Peugeot">Peugeot</option>
                                    <option value="Renault">Renault</option>
                                    <option value="SEAT">SEAT</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="Volkswagen">Volkswagen</option>
                                    <option value="Otro">Otra marca</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group" style="grid-column: span 2;">
                                <label for="v-modelo">Modelo *</label>
                                <input type="text" id="v-modelo" name="modelo" placeholder="Ej: Ibiza, Serie 3, Golf..." required>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 2: Especificaciones Técnicas -->
                    <div class="form-section-card">
                        <div class="form-section-header">
                            <i class="ti ti-settings" aria-hidden="true"></i>
                            <h3>Especificaciones Técnicas</h3>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="v-anio">Año de Matriculación *</label>
                                <select id="v-anio" name="anio_matriculacion" required>
                                    <option value="" disabled selected>Selecciona el año</option>
                                    @for ($i = date('Y'); $i >= 1995; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="v-combustible">Combustible *</label>
                                <select id="v-combustible" name="combustible" required>
                                    <option value="" disabled selected>Selecciona el tipo</option>
                                    <option value="Gasolina">Gasolina</option>
                                    <option value="Diesel">Diésel</option>
                                    <option value="Hibrido">Híbrido (HEV)</option>
                                    <option value="Hibrido Enchufable">Híbrido Enchufable (PHEV)</option>
                                    <option value="Electrico">100% Eléctrico (BEV)</option>
                                    <option value="Gas">Gas (GLP / GNC)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="v-kilometraje">Kilometraje (km) *</label>
                                <input type="number" id="v-kilometraje" name="kilometraje" placeholder="Ej: 85000" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="v-transmision">Transmisión *</label>
                                <select id="v-transmision" name="transmision" required>
                                    <option value="" disabled selected>Selecciona el cambio</option>
                                    <option value="Manual">Manual</option>
                                    <option value="Automatico">Automático</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <!-- SECCIÓN 3: Multimedia -->
                    <div class="form-section-card">
                        <div class="form-section-header">
                            <i class="ti ti-photo" aria-hidden="true"></i>
                            <h3>Fotografía del Vehículo</h3>
                        </div>
                        <p class="section-sub" style="margin-bottom: 16px; font-size:12.5px;">Sube una imagen de tu coche. Si no tienes una, le asignaremos una silueta estándar en tu garaje virtual.</p>

                        <div class="image-upload-wrapper" id="upload-wrapper">
                            <input type="file" id="v-imagen" name="imagen" accept="image/*">
                            <div class="upload-placeholder" id="upload-placeholder">
                                <i class="ti ti-cloud-upload" aria-hidden="true"></i>
                                <span>Selecciona o arrastra una foto</span>
                                <p>Formatos aceptados: JPG, PNG, WEBP (Máx. 5MB)</p>
                            </div>
                            <div class="preview-container" id="preview-container">
                                <img src="" alt="Vista previa" id="img-thumb">
                                <button type="button" class="btn-remove-thumb" id="btn-remove-thumb" title="Eliminar imagen">
                                    <i class="ti ti-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary" id="v-submit" style="margin-top: 8px; width: 100%; justify-content: center; padding: 16px; font-size: 13.5px;">
                        <i class="ti ti-circle-plus" aria-hidden="true"></i> Registrar Vehículo en mi Cuenta
                    </button>
                </form>
            </div>

            <!-- Columna Derecha: Live Preview y Ventajas -->
            <div class="vehiculo-sidebar">
                <div class="preview-card">
                    <div class="preview-header">
                        <div class="preview-icon-box">
                            <i class="ti ti-eye"></i>
                        </div>
                        <div class="preview-header-text">
                            <h3>Vista Previa</h3>
                            <p>Actualización en tiempo real</p>
                        </div>
                    </div>

                    <!-- Tarjeta Visual Interactiva -->
                    <div class="card-live-visual">
                        <div class="live-visual-top">
                            <div>
                                <span class="live-brand" id="live-brand-text">MARCA</span>
                                <h4 class="live-model" id="live-model-text">Modelo del coche</h4>
                            </div>
                            <span class="live-plate-badge" id="live-plate-text">MATRÍCULA</span>
                        </div>

                        <!-- Silueta interactiva SVG del coche -->
                        <div class="live-car-svg-container" id="car-svg-container">
                            <svg id="car-silhouette" viewBox="0 0 240 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Chasis / Carrocería del coche -->
                                <path id="car-body" d="M15 65 C15 65 17 48 35 44 C45 42 55 35 65 25 C75 15 95 12 135 12 C175 12 185 30 195 38 L220 44 C230 46 235 55 235 65 C235 70 230 73 220 73 C210 73 205 73 205 73 C205 65 195 58 185 58 C175 58 165 65 165 73 H85 C85 65 75 58 65 58 C55 58 45 65 45 73 H15 Z" 
                                      fill="#4a5568" stroke="#cbd5e1" stroke-width="2" style="transition: fill 0.4s ease, stroke 0.4s ease;"/>
                                <!-- Ventanas -->
                                <path d="M70 28 C70 28 78 18 95 18 H130 C130 18 140 18 152 28 C160 35 165 38 165 38 H68 L70 28 Z" fill="#1e293b" opacity="0.8"/>
                                <path d="M110 18 V38 H114 V18 H110 Z" fill="#0f172a" opacity="0.9"/>
                                <!-- Faros delanteros -->
                                <path d="M225 48 L232 52 C234 53 234 57 232 58 L225 58 Z" fill="#ffedd5" stroke="#f97316" stroke-width="1"/>
                                <!-- Luces traseras -->
                                <path d="M15 48 H22 V58 H15 Z" fill="#fee2e2" stroke="#ef4444" stroke-width="1"/>
                                <!-- Rueda Delantera -->
                                <circle cx="185" cy="73" r="16" fill="#0f172a" stroke="#cbd5e1" stroke-width="3"/>
                                <circle cx="185" cy="73" r="7" fill="#64748b"/>
                                <!-- Rueda Trasera -->
                                <circle cx="65" cy="73" r="16" fill="#0f172a" stroke="#cbd5e1" stroke-width="3"/>
                                <circle cx="65" cy="73" r="7" fill="#64748b"/>
                                <!-- Suelo/Sombra -->
                                <line x1="10" y1="89" x2="230" y2="89" stroke="#334155" stroke-dasharray="4 4" stroke-width="1.5"/>
                            </svg>
                        </div>

                        <div class="live-visual-bottom">
                            <div class="live-meta-item">
                                <span class="live-meta-label">Combustible</span>
                                <span class="live-meta-value" id="live-fuel-text">N/D</span>
                            </div>
                            <div class="live-meta-item">
                                <span class="live-meta-label">Año</span>
                                <span class="live-meta-value" id="live-year-text">N/D</span>
                            </div>
                            <div class="live-meta-item">
                                <span class="live-meta-label">Kms</span>
                                <span class="live-meta-value" id="live-km-text">N/D</span>
                            </div>
                        </div>
                    </div>

                    <!-- Ventajas -->
                    <div class="advantages-list">
                        <div class="adv-item">
                            <i class="ti ti-shield-check"></i>
                            <div>
                                <strong>Perfil de Mantenimiento</strong>
                                <p>Calculamos los intervalos de cambio de aceite e ITV según tu año y kms.</p>
                            </div>
                        </div>
                        <div class="adv-item">
                            <i class="ti ti-trending-up"></i>
                            <div>
                                <strong>Tasación Automática</strong>
                                <p>Sigue la valoración de mercado estimada de tu vehículo en tiempo real.</p>
                            </div>
                        </div>
                        <div class="adv-item">
                            <i class="ti ti-bell-ringing"></i>
                            <div>
                                <strong>Avisos y Alertas</strong>
                                <p>Recibe recordatorios de mantenimiento preventivo y campañas del fabricante.</p>
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
    // Inputs del formulario
    const inputMatricula = document.getElementById('v-matricula');
    const selectMarca = document.getElementById('v-marca');
    const inputModelo = document.getElementById('v-modelo');
    const selectAnio = document.getElementById('v-anio');
    const selectCombustible = document.getElementById('v-combustible');
    const inputKilometraje = document.getElementById('v-kilometraje');
    const inputImagen = document.getElementById('v-imagen');

    // Elementos de la previsualización en vivo
    const liveBrandText = document.getElementById('live-brand-text');
    const liveModelText = document.getElementById('live-model-text');
    const livePlateText = document.getElementById('live-plate-text');
    const liveFuelText = document.getElementById('live-fuel-text');
    const liveYearText = document.getElementById('live-year-text');
    const liveKmText = document.getElementById('live-km-text');
    const carBody = document.getElementById('car-body');
    const carSvgContainer = document.getElementById('car-svg-container');
    const carSilhouette = document.getElementById('car-silhouette');

    // Elementos de Carga de Imagen
    const uploadWrapper = document.getElementById('upload-wrapper');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const previewContainer = document.getElementById('preview-container');
    const imgThumb = document.getElementById('img-thumb');
    const btnRemoveThumb = document.getElementById('btn-remove-thumb');

    // Actualización en tiempo real
    inputMatricula.addEventListener('input', function() {
        const val = this.value.toUpperCase().trim();
        livePlateText.textContent = val || 'MATRÍCULA';
    });

    selectMarca.addEventListener('change', function() {
        liveBrandText.textContent = this.value.toUpperCase();
    });

    inputModelo.addEventListener('input', function() {
        liveModelText.textContent = this.value || 'Modelo del coche';
    });

    selectAnio.addEventListener('change', function() {
        liveYearText.textContent = this.value;
    });

    selectCombustible.addEventListener('change', function() {
        const val = this.options[this.selectedIndex].text;
        // Acortamos textos largos para mantener la estética
        let cleanText = val;
        if (val.includes('Híbrido Enchufable')) cleanText = 'PHEV';
        else if (val.includes('Híbrido')) cleanText = 'Híbrido';
        else if (val.includes('Eléctrico')) cleanText = 'Eléctrico';
        
        liveFuelText.textContent = cleanText;
    });

    inputKilometraje.addEventListener('input', function() {
        const val = parseInt(this.value);
        if (isNaN(val)) {
            liveKmText.textContent = 'N/D';
        } else {
            liveKmText.textContent = val.toLocaleString('es-ES') + ' km';
        }
    });

    // Control del file input y la previsualización de imagen
    inputImagen.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // Ocultar SVG y mostrar previsualización de imagen cargada
                carSilhouette.style.display = 'none';
                
                // Si ya existe una imagen previa dentro del contenedor visual, la actualizamos. Si no, la creamos
                let visualImg = document.getElementById('visual-loaded-img');
                if (!visualImg) {
                    visualImg = document.createElement('img');
                    visualImg.id = 'visual-loaded-img';
                    visualImg.style.width = '120px';
                    visualImg.style.height = '75px';
                    visualImg.style.borderRadius = '6px';
                    visualImg.style.objectFit = 'cover';
                    visualImg.style.border = '1px solid rgba(255,255,255,0.15)';
                    visualImg.style.boxShadow = '0 4px 10px rgba(0,0,0,0.3)';
                    carSvgContainer.appendChild(visualImg);
                }
                visualImg.src = event.target.result;
                visualImg.style.display = 'block';

                // Actualizar miniatura del Dropzone
                imgThumb.src = event.target.result;
                uploadPlaceholder.style.display = 'none';
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // Eliminar miniatura y restaurar SVG
    btnRemoveThumb.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation(); // Evitar que se active el input file al hacer clic en el botón de borrar
        
        inputImagen.value = ''; // Vaciar input
        
        // Restaurar Dropzone
        previewContainer.style.display = 'none';
        uploadPlaceholder.style.display = 'flex';
        imgThumb.src = '';

        // Restaurar silueta SVG
        carSilhouette.style.display = 'block';
        const visualImg = document.getElementById('visual-loaded-img');
        if (visualImg) {
            visualImg.style.display = 'none';
        }

        // Aplicar el color de chasis por defecto
        carBody.style.fill = '#4a5568';
        carBody.style.stroke = '#cbd5e1';
    });

    // Simular el Drag & Drop visual
    uploadWrapper.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = '#0056b3';
        this.style.backgroundColor = '#f8fafc';
    });

    uploadWrapper.addEventListener('dragleave', function() {
        this.style.borderColor = '#cbd5e1';
        this.style.backgroundColor = '#fff';
    });

    uploadWrapper.addEventListener('drop', function() {
        this.style.borderColor = '#cbd5e1';
        this.style.backgroundColor = '#fff';
    });

    // Envío del formulario con animación de carga
    document.getElementById('add-vehicle-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('v-submit');
        const originalContent = btn.innerHTML;

        // Cambiar botón a cargando
        btn.innerHTML = '<i class="ti ti-loader animate-spin"></i> Registrando vehículo...';
        btn.disabled = true;

        setTimeout(() => {
            // Éxito
            btn.innerHTML = '<i class="ti ti-check"></i> ¡Vehículo añadido con éxito!';
            btn.style.background = '#16a34a';
            btn.style.boxShadow = '0 6px 20px rgba(22, 163, 74, 0.3)';

            // Resetear el formulario después de la simulación
            setTimeout(() => {
                btn.innerHTML = originalContent;
                btn.style.background = '';
                btn.style.boxShadow = '';
                btn.disabled = false;
                
                // Vaciar campos
                this.reset();
                
                // Resetear previsualización en vivo
                liveBrandText.textContent = 'MARCA';
                liveModelText.textContent = 'Modelo del coche';
                livePlateText.textContent = 'MATRÍCULA';
                liveFuelText.textContent = 'N/D';
                liveYearText.textContent = 'N/D';
                liveKmText.textContent = 'N/D';
                carBody.style.fill = '#4a5568';
                carBody.style.stroke = '#cbd5e1';
                
                // Restaurar SVG por si había imagen
                carSilhouette.style.display = 'block';
                const visualImg = document.getElementById('visual-loaded-img');
                if (visualImg) visualImg.remove();
                
                // Restaurar dropzone
                previewContainer.style.display = 'none';
                uploadPlaceholder.style.display = 'flex';
                imgThumb.src = '';
            }, 3000);

        }, 2000);
    });
});
</script>

@endsection
