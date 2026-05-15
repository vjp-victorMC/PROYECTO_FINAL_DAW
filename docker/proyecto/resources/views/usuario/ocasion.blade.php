@vite(['resources/css/usuarios/ocasion.css'])
@vite(['resources/css/contents/topbar.css'])

@extends('layouts.app')
@section('content')

<div class="pg-ocasion">
    <!-- HERO -->
    <section class="ocasion-hero">
        <div class="animate-up">
            <h1>Vehículos de <span>Ocasión</span></h1>
            <p>Selección premium de coches revisados, con garantía certificada y las mejores condiciones de financiación.</p>
        </div>
    </section>

    <!-- FILTERS -->
    <div class="filters-bar">
        <div class="filters-inner">
            <div class="filter-group">
                <select name="marca">
                    <option value="">Todas las marcas</option>
                    <option value="audi">Audi</option>
                    <option value="bmw">BMW</option>
                    <option value="mercedes">Mercedes-Benz</option>
                    <option value="seat">Seat</option>
                    <option value="vw">Volkswagen</option>
                </select>
            </div>
            <div class="filter-group">
                <select name="tipo">
                    <option value="">Tipo de vehículo</option>
                    <option value="suv">SUV</option>
                    <option value="sedan">Sedán</option>
                    <option value="compacto">Compacto</option>
                    <option value="furgoneta">Furgoneta</option>
                </select>
            </div>
            <div class="filter-group">
                <select name="precio">
                    <option value="">Precio máximo</option>
                    <option value="10000">Hasta 10.000€</option>
                    <option value="20000">Hasta 20.000€</option>
                    <option value="30000">Hasta 30.000€</option>
                    <option value="50000">Más de 30.000€</option>
                </select>
            </div>
            <button class="btn-search">
                <i class="ti ti-search"></i> Buscar
            </button>
        </div>
    </div>

    <!-- VEHICLE GRID -->
    <section class="ocasion-grid-section">
        <div class="vehicle-grid">
            
            <!-- Coche 1 -->
            <div class="vehicle-card animate-up">
                <div class="badge-ocasion">Destacado</div>
                <div class="vehicle-image">
                    <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=800" alt="BMW Serie 3">
                </div>
                <div class="vehicle-content">
                    <h3 class="vehicle-title">BMW Serie 3 320d</h3>
                    <p class="vehicle-subtitle">M Sport Edition · Automático</p>
                    <div class="vehicle-specs">
                        <div class="spec-item">
                            <span>Año</span>
                            <strong>2021</strong>
                        </div>
                        <div class="spec-item">
                            <span>Kms</span>
                            <strong>45.000</strong>
                        </div>
                        <div class="spec-item">
                            <span>Motor</span>
                            <strong>Diesel</strong>
                        </div>
                    </div>
                    <div class="vehicle-footer">
                        <div class="vehicle-price">
                            <span class="price-promo">Desde 340€/mes</span>
                            <span class="price-main">32.900€</span>
                        </div>
                        <a href="#" class="btn-view">Ver detalle</a>
                    </div>
                </div>
            </div>

            <!-- Coche 2 -->
            <div class="vehicle-card animate-up delay-1">
                <div class="badge-ocasion" style="background:#16a34a">Garantía +</div>
                <div class="vehicle-image">
                    <img src="https://images.unsplash.com/photo-1617531653332-bd46c24f2068?auto=format&fit=crop&q=80&w=800" alt="Audi A3">
                </div>
                <div class="vehicle-content">
                    <h3 class="vehicle-title">Audi A3 Sportback</h3>
                    <p class="vehicle-subtitle">35 TFSI S-Line · Manual</p>
                    <div class="vehicle-specs">
                        <div class="spec-item">
                            <span>Año</span>
                            <strong>2020</strong>
                        </div>
                        <div class="spec-item">
                            <span>Kms</span>
                            <strong>58.200</strong>
                        </div>
                        <div class="spec-item">
                            <span>Motor</span>
                            <strong>Gasolina</strong>
                        </div>
                    </div>
                    <div class="vehicle-footer">
                        <div class="vehicle-price">
                            <span class="price-promo">Financiado</span>
                            <span class="price-main">24.500€</span>
                        </div>
                        <a href="#" class="btn-view">Ver detalle</a>
                    </div>
                </div>
            </div>

            <!-- Coche 3 -->
            <div class="vehicle-card animate-up delay-2">
                <div class="vehicle-image">
                    <img src="https://images.unsplash.com/photo-1606152421802-db97b9c7a11b?auto=format&fit=crop&q=80&w=800" alt="VW Golf">
                </div>
                <div class="vehicle-content">
                    <h3 class="vehicle-title">Volkswagen Golf GTI</h3>
                    <p class="vehicle-subtitle">Performance 245cv · DSG</p>
                    <div class="vehicle-specs">
                        <div class="spec-item">
                            <span>Año</span>
                            <strong>2019</strong>
                        </div>
                        <div class="spec-item">
                            <span>Kms</span>
                            <strong>72.000</strong>
                        </div>
                        <div class="spec-item">
                            <span>Motor</span>
                            <strong>Gasolina</strong>
                        </div>
                    </div>
                    <div class="vehicle-footer">
                        <div class="vehicle-price">
                            <span class="price-promo">Oportunidad</span>
                            <span class="price-main">28.900€</span>
                        </div>
                        <a href="#" class="btn-view">Ver detalle</a>
                    </div>
                </div>
            </div>

            <!-- Coche 4 -->
            <div class="vehicle-card animate-up">
                <div class="vehicle-image">
                    <img src="https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?auto=format&fit=crop&q=80&w=800" alt="Mercedes Clase A">
                </div>
                <div class="vehicle-content">
                    <h3 class="vehicle-title">Mercedes Clase A 200</h3>
                    <p class="vehicle-subtitle">AMG Line · 7G-DCT</p>
                    <div class="vehicle-specs">
                        <div class="spec-item">
                            <span>Año</span>
                            <strong>2022</strong>
                        </div>
                        <div class="spec-item">
                            <span>Kms</span>
                            <strong>15.000</strong>
                        </div>
                        <div class="spec-item">
                            <span>Motor</span>
                            <strong>Híbrido</strong>
                        </div>
                    </div>
                    <div class="vehicle-footer">
                        <div class="vehicle-price">
                            <span class="price-promo">Seminuevo</span>
                            <span class="price-main">35.400€</span>
                        </div>
                        <a href="#" class="btn-view">Ver detalle</a>
                    </div>
                </div>
            </div>

            <!-- Coche 5 -->
            <div class="vehicle-card animate-up delay-1">
                <div class="vehicle-image">
                    <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c34b?auto=format&fit=crop&q=80&w=800" alt="Seat Arona">
                </div>
                <div class="vehicle-content">
                    <h3 class="vehicle-title">Seat Arona 1.0 TSI</h3>
                    <p class="vehicle-subtitle">Style Edition · SUV</p>
                    <div class="vehicle-specs">
                        <div class="spec-item">
                            <span>Año</span>
                            <strong>2021</strong>
                        </div>
                        <div class="spec-item">
                            <span>Kms</span>
                            <strong>32.400</strong>
                        </div>
                        <div class="spec-item">
                            <span>Motor</span>
                            <strong>Gasolina</strong>
                        </div>
                    </div>
                    <div class="vehicle-footer">
                        <div class="vehicle-price">
                            <span class="price-promo">Bajo consumo</span>
                            <span class="price-main">16.800€</span>
                        </div>
                        <a href="#" class="btn-view">Ver detalle</a>
                    </div>
                </div>
            </div>

            <!-- Coche 6 -->
            <div class="vehicle-card animate-up delay-2">
                <div class="vehicle-image">
                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&q=80&w=800" alt="Ford Kuga">
                </div>
                <div class="vehicle-content">
                    <h3 class="vehicle-title">Ford Kuga PHEV</h3>
                    <p class="vehicle-subtitle">ST-Line X · Etiqueta 0</p>
                    <div class="vehicle-specs">
                        <div class="spec-item">
                            <span>Año</span>
                            <strong>2021</strong>
                        </div>
                        <div class="spec-item">
                            <span>Kms</span>
                            <strong>48.000</strong>
                        </div>
                        <div class="spec-item">
                            <span>Motor</span>
                            <strong>Híbrido Ench.</strong>
                        </div>
                    </div>
                    <div class="vehicle-footer">
                        <div class="vehicle-price">
                            <span class="price-promo">Etiqueta 0</span>
                            <span class="price-main">29.900€</span>
                        </div>
                        <a href="#" class="btn-view">Ver detalle</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- TASACION CTA -->
        <div class="tasacion-cta animate-up">
            <div class="tasacion-info">
                <h2>¿Quieres vender tu coche?</h2>
                <p>Tasamos tu vehículo de forma gratuita y sin compromiso. Te damos la mejor valoración del mercado en el acto.</p>
            </div>
            <div class="tasacion-btns">
                <a href="#" class="btn-primary" style="background:#fff; color:var(--secondary);">Quiero tasar mi coche</a>
                <a href="{{ route('contacto') }}" class="btn-outline">Contactar asesor</a>
            </div>
        </div>
    </section>
</div>

<script>
    // Intersection Observer para animaciones
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
