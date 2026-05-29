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

    <!-- VEHICLE GRID -->
    <section class="ocasion-grid-section">
        <div class="vehicle-grid" id="vehicle-grid">
            <!-- Cargado dinámicamente mediante JS -->
            <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--text-muted);" id="loading-spinner">
                <i class="ti ti-loader" style="font-size: 40px; display: inline-block; animation: spin 1.5s linear infinite; color: var(--primary);"></i>
                <p style="margin-top: 15px; font-weight: 600;">Cargando catálogo premium...</p>
            </div>
        </div>
    </section>
</div>

<style>
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const grid = document.getElementById('vehicle-grid');
        const spinner = document.getElementById('loading-spinner');
        
        // Cargar coches de ocasión desde la API
        fetch('/api/coche2mano')
            .then(response => response.json())
            .then(res => {
                if (spinner) spinner.remove();
                
                if (!res.success || !res.data || res.data.length === 0) {
                    grid.innerHTML = `
                        <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">
                            <i class="ti ti-alert-circle" style="font-size: 50px; color: var(--primary);"></i>
                            <h3 style="margin-top: 15px; font-size: 20px; font-weight: 700; color: var(--secondary);">No hay vehículos disponibles</h3>
                            <p style="color: var(--text-muted); margin-top: 8px;">En este momento no disponemos de vehículos de ocasión en stock. Vuelve a consultar más tarde.</p>
                        </div>
                    `;
                    return;
                }
                
                let html = '';
                res.data.forEach((veh, index) => {
                    const delayClass = index % 3 === 0 ? '' : (index % 3 === 1 ? 'delay-1' : 'delay-2');
                    
                    // Comprobar la URL de la imagen
                    let imgSource = '';
                    if (veh.imagen) {
                        imgSource = (veh.imagen.startsWith('http://') || veh.imagen.startsWith('https://')) 
                            ? veh.imagen 
                            : `/storage/${veh.imagen}`;
                    }
                    
                    const priceFormatted = veh.precio ? new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR', maximumFractionDigits: 0 }).format(veh.precio) : 'Consultar';
                    const kmFormatted = veh.km ? new Intl.NumberFormat('es-ES').format(veh.km) + ' km' : '0 km';
                    
                    const specsHtml = `
                        <div class="spec-item">
                            <span>Año</span>
                            <strong>${veh.anio_matriculacion || 2021}</strong>
                        </div>
                        <div class="spec-item">
                            <span>Kms</span>
                            <strong>${kmFormatted}</strong>
                        </div>
                        <div class="spec-item">
                            <span>Motor</span>
                            <strong>${veh.motorizacion || 'Gasolina'}</strong>
                        </div>
                    `;
                    
                    let imageBlock = '';
                    if (imgSource) {
                        imageBlock = `<img src="${imgSource}" alt="${veh.marca} ${veh.modelo}">`;
                    } else {
                        // Vector SVG fallback
                        imageBlock = `
                            <svg viewBox="0 0 100 50" width="120" height="60" fill="none" stroke="#A9B8CE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.85; margin: auto;">
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
                    
                    const buyRoute = `/compra?car=${encodeURIComponent(veh.marca + ' ' + veh.modelo)}&price=${veh.precio}&brand=${encodeURIComponent(veh.marca)}&year=${veh.anio_matriculacion || 2021}&km=${veh.km || 0}`;
                    
                    html += `
                        <div class="vehicle-card animate-up ${delayClass}">
                            <div class="badge-ocasion">Ocasión</div>
                            <div class="vehicle-image">
                                ${imageBlock}
                            </div>
                            <div class="vehicle-content">
                                <h3 class="vehicle-title">${veh.marca} ${veh.modelo}</h3>
                                <p class="vehicle-subtitle">Revisado con certificado oficial</p>
                                <div class="vehicle-specs">
                                    ${specsHtml}
                                </div>
                                <div class="vehicle-footer">
                                    <div class="vehicle-price">
                                        <span class="price-promo">Entrega Inmediata</span>
                                        <span class="price-main">${priceFormatted}</span>
                                    </div>
                                    <a href="${buyRoute}" class="btn-view">Comprar / Financiar</a>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                grid.innerHTML = html;
                
                // Inicializar observador de animaciones tras renderizar
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                }, { threshold: 0.1 });
                
                document.querySelectorAll('.animate-up').forEach(el => observer.observe(el));
            })
            .catch(error => {
                console.error("Error al cargar los vehículos de ocasión:", error);
                if (spinner) spinner.remove();
                grid.innerHTML = `
                    <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: var(--accent);">
                        <i class="ti ti-alert-triangle" style="font-size: 50px;"></i>
                        <h3 style="margin-top: 15px; font-size: 20px; font-weight: 700;">Error de conexión</h3>
                        <p style="color: var(--text-muted); margin-top: 8px;">No se ha podido conectar con el servidor para cargar el catálogo. Por favor, recarga la página.</p>
                    </div>
                `;
            });
    });
</script>

@endsection