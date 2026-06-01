@extends('layouts.app')

@section('content')
@vite(['resources/css/usuarios/datosUsuario.css'])

<div class="profile-pg">
    <div class="profile-container animate-up">
        <!-- Sidebar - Datos del Usuario -->
        <aside class="profile-sidebar">
            <div class="avatar-container">
                <div class="avatar-box">
                    <span>{{ strtoupper(substr($usuario->nombre ?? 'U', 0, 1)) }}</span>
                </div>
                <span class="badge-level">Cliente</span>
            </div>
            
            <h2 class="profile-name">{{ $usuario->nombre }}</h2>
            <span class="profile-role">{{ ucfirst($usuario->rol ?? 'Cliente') }}</span>

            <ul class="profile-details-list">
                <li class="profile-detail-item">
                    <div class="detail-icon">
                        <i class="ti ti-id-badge" aria-hidden="true"></i>
                    </div>
                    <div class="detail-info">
                        <span class="detail-label">DNI / Identificador</span>
                        <span class="detail-value">{{ $usuario->dni ?? 'No especificado' }}</span>
                    </div>
                </li>
                <li class="profile-detail-item">
                    <div class="detail-icon">
                        <i class="ti ti-mail" aria-hidden="true"></i>
                    </div>
                    <div class="detail-info">
                        <span class="detail-label">Correo Electrónico</span>
                        <span class="detail-value">{{ $usuario->email }}</span>
                    </div>
                </li>
                <li class="profile-detail-item">
                    <div class="detail-icon">
                        <i class="ti ti-phone" aria-hidden="true"></i>
                    </div>
                    <div class="detail-info">
                        <span class="detail-label">Teléfono de contacto</span>
                        <span class="detail-value">{{ $usuario->telefono ?? 'No especificado' }}</span>
                    </div>
                </li>
            </ul>

            <div style="display: flex; flex-direction: column; gap: 12px; width: 100%;">
                <a href="{{ route('vehiculo') }}" class="btn-action-garaje">
                    <i class="ti ti-circle-plus" aria-hidden="true"></i> Registrar nuevo vehículo
                </a>
                <a href="{{ route('cita') }}" class="btn-outline" style="border-radius: 12px; color: var(--secondary); border: 1px solid #E5E5E7; padding: 14px 20px; font-size: 14px; text-decoration: none; display: flex; justify-content: center; align-items: center; gap: 8px; font-weight: 700; transition: var(--transition);">
                    <i class="ti ti-calendar" aria-hidden="true"></i> Pedir cita en taller
                </a>
            </div>
        </aside>

        <!-- Contenido Principal - Garaje / Vehículos -->
        <section class="profile-content">
            <div class="section-card-header">
                <h1 class="profile-section-title">Mi <span>Garaje Virtual</span></h1>
                @if($coches->isNotEmpty())
                    <a href="{{ route('vehiculo') }}" class="btn-add-vehicle-sm">
                        <i class="ti ti-plus" aria-hidden="true"></i> Añadir coche
                    </a>
                @endif
            </div>

            @if($coches->isEmpty())
                <!-- Estado vacío -->
                <div class="empty-vehicles-card">
                    <div class="empty-icon-box">
                        <i class="ti ti-car-crash" aria-hidden="true"></i>
                    </div>
                    <h3>Tu garaje está vacío</h3>
                    <p>Registra tus vehículos para poder gestionar sus revisiones, averías, y solicitar citas de taller de forma mucho más rápida y personalizada.</p>
                    <a href="{{ route('vehiculo') }}" class="btn-add-first-vehicle">
                        <i class="ti ti-circle-plus" aria-hidden="true"></i> Registrar mi primer vehículo
                    </a>
                </div>
            @else
                <!-- Grid de Vehículos -->
                <div class="vehicles-grid">
                    @foreach($coches as $coche)
                        <article class="vehicle-profile-card">
                            <div class="vehicle-card-top">
                                @if($coche->imagen)
                                    <img src="{{ Illuminate\Support\Str::startsWith($coche->imagen, ['http://', 'https://']) ? $coche->imagen : asset('storage/' . $coche->imagen) }}" alt="Vehículo {{ $coche->marca }} {{ $coche->modelo }}">
                                @else
                                    <!-- Si no hay imagen, un SVG estilizado de coche -->
                                    <svg class="vehicle-avatar-placeholder" viewBox="0 0 100 50" fill="none" stroke="#A9B8CE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M15 30 H25 C28 20, 36 12, 50 12 H65 C73 12, 80 18, 83 25 L86 30 H90 C92 30, 94 32, 94 34 V38 C94 40, 92 41, 90 41 H84" />
                                        <path d="M16 41 H10 C8 41, 6 40, 6 38 V34 C6 32, 8 30, 10 30 H15" />
                                        <circle cx="25" cy="41" r="5.5" stroke="#A9B8CE" stroke-width="2" fill="#F0F4FA" />
                                        <circle cx="75" cy="41" r="5.5" stroke="#A9B8CE" stroke-width="2" fill="#F0F4FA" />
                                        <path d="M31 41 H69" />
                                        <path d="M48 18 H63 C68 18, 73 22, 75 27 L76 30 H48 V18 Z" fill="#A9B8CE" fill-opacity="0.1" stroke="#A9B8CE" stroke-width="1.5" />
                                        <path d="M33 30 H44 V18 H38 C34 18, 30 22, 29 27 Z" fill="#A9B8CE" fill-opacity="0.1" stroke="#A9B8CE" stroke-width="1.5" />
                                    </svg>
                                @endif

                                @if($coche->en_garaje)
                                    <span class="status-badge in-garage">En Taller</span>
                                @endif
                            </div>

                            <div class="vehicle-card-body">
                                <span class="vehicle-plate-badge">{{ strtoupper($coche->matricula) }}</span>
                                <h3 class="vehicle-card-title">{{ $coche->marca }} {{ $coche->modelo }}</h3>

                                <div class="vehicle-specs-mini">
                                    <div class="spec-mini-item">
                                        <i class="ti ti-dashboard" aria-hidden="true"></i>
                                        <span>Km: <strong class="spec-mini-value">{{ number_format($coche->km ?? 0, 0, ',', '.') }}</strong></span>
                                    </div>
                                    <div class="spec-mini-item">
                                        <i class="ti ti-droplet" aria-hidden="true"></i>
                                        <span>Comb.: <strong class="spec-mini-value">{{ ucfirst($coche->combustible ?? 'N/A') }}</strong></span>
                                    </div>
                                    <div class="spec-mini-item">
                                        <i class="ti ti-settings" aria-hidden="true"></i>
                                        <span>Transm.: <strong class="spec-mini-value">{{ ucfirst($coche->transmision ?? 'Manual') }}</strong></span>
                                    </div>
                                    <div class="spec-mini-item">
                                        <i class="ti ti-shield-check" aria-hidden="true"></i>
                                        <span>Garantía: <strong class="spec-mini-value">Sí</strong></span>
                                    </div>
                                </div>

                                <div class="vehicle-card-footer">
                                    <span class="vehicle-year-label">Matriculación</span>
                                    <span class="vehicle-year-value">{{ $coche->anio_matriculacion ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
