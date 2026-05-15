@vite(['resources/css/mecanico/dashboard.css'])

@extends('layouts.app')
@section('content')

<div class="pg">

    <!-- HERO SECTION -->
    <div class="hero bg-gradient-to-r from-[#002e6d] to-[#0056b3]">
        <div class="hero-text">
            <div class="hero-badge">
                <i class="ti ti-tools"></i> Panel de Mecánico
            </div>
            <h1 class="text-white">Gestiona tus <span class="text-[#4a9eff]">reparaciones</span></h1>
            <p class="text-[#a0c4ff]">Control total de tus trabajos, diagnósticos y piezas en un solo lugar.</p>
            <div class="hero-btns">
                <a href="#" class="btn-primary"><i class="ti ti-plus"></i> Nueva reparación</a>
                <a href="#" class="btn-outline"><i class="ti ti-list"></i> Ver todas</a>
            </div>
        </div>
        <div class="hero-stats">
            <div class="stat-card">
                <strong>3</strong>
                <small>Asignadas</small>
            </div>
            <div class="stat-card">
                <strong>2</strong>
                <small>En proceso</small>
            </div>
            <div class="stat-card">
                <strong>5</strong>
                <small>Finalizadas</small>
            </div>
        </div>
    </div>

    <!-- REPARACIONES ASIGNADAS -->
    <div class="section py-20 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="section-label">Estado actual</div>
            <div class="section-title">Reparaciones asignadas</div>
            <div class="section-sub">Consulta y gestiona tus trabajos en tiempo real.</div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tarjeta 1 -->
                <div class="svc-card dark:bg-gray-900 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-[#002e6d] dark:text-yellow-300 uppercase">Seat León</h3>
                        <span class="inline-block bg-yellow-400 text-black text-xs font-bold px-2 py-1 rounded">Pendiente</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Cambio de aceite y filtro</p>
                    <div class="flex gap-2">
                        <button class="btn-primary text-xs">Ver</button>
                        <button class="btn-outline text-xs">Actualizar</button>
                    </div>
                </div>
                
                <!-- Tarjeta 2 -->
                <div class="svc-card dark:bg-gray-900 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-[#002e6d] dark:text-yellow-300 uppercase">VW Golf</h3>
                        <span class="inline-block bg-blue-400 text-white text-xs font-bold px-2 py-1 rounded">En proceso</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Diagnóstico eléctrico completo</p>
                    <div class="flex gap-2">
                        <button class="btn-primary text-xs">Ver</button>
                        <button class="btn-outline text-xs">Finalizar</button>
                    </div>
                </div>
                
                <!-- Tarjeta 3 -->
                <div class="svc-card dark:bg-gray-900 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-[#002e6d] dark:text-yellow-300 uppercase">Peugeot 308</h3>
                        <span class="inline-block bg-green-400 text-black text-xs font-bold px-2 py-1 rounded">Finalizada</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Sustitución de batería</p>
                    <div class="flex gap-2">
                        <button class="btn-primary text-xs">Ver</button>
                        <button class="btn-outline text-xs">Entregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FORMULARIOS DE GESTIÓN -->
    <div class="bg-[#0c141e] dark:bg-black py-20 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="section-label text-[#4a9eff]">Herramientas</div>
            <div class="section-title text-white">Gestión de trabajos</div>
            <div class="section-sub text-[#8a9ab5]">Completa estas tareas para mantener todo bajo control.</div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
                
                <!-- Diagnostica vehículo -->
                <div class="why-item bg-[#1f2937] dark:bg-gray-900 p-6 rounded-lg border border-[#374151] dark:border-gray-700">
                    <h4 class="text-white font-bold text-sm uppercase mb-4 flex items-center gap-2">
                        <i class="ti ti-search text-[#4a9eff]"></i> Diagnostica vehículo
                    </h4>
                    <form class="space-y-4">
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Matrícula o VIN</label>
                            <input type="text" placeholder="Ej: 1234 ABC" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm focus:outline-none focus:border-[#4a9eff]">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Descripción</label>
                            <textarea placeholder="Descripción del diagnóstico" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm h-24 focus:outline-none focus:border-[#4a9eff]"></textarea>
                        </div>
                        <button class="btn-primary w-full justify-center">Guardar diagnóstico</button>
                    </form>
                </div>

                <!-- Añade horas de trabajo -->
                <div class="why-item bg-[#1f2937] dark:bg-gray-900 p-6 rounded-lg border border-[#374151] dark:border-gray-700">
                    <h4 class="text-white font-bold text-sm uppercase mb-4 flex items-center gap-2">
                        <i class="ti ti-clock text-[#4a9eff]"></i> Horas de trabajo
                    </h4>
                    <form class="space-y-4">
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Reparación</label>
                            <input type="text" placeholder="Ej: Seat León" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm focus:outline-none focus:border-[#4a9eff]">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Horas trabajadas</label>
                            <input type="number" placeholder="0" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm focus:outline-none focus:border-[#4a9eff]">
                        </div>
                        <button class="btn-primary w-full justify-center">Añadir horas</button>
                    </form>
                </div>

                <!-- Añade piezas -->
                <div class="why-item bg-[#1f2937] dark:bg-gray-900 p-6 rounded-lg border border-[#374151] dark:border-gray-700">
                    <h4 class="text-white font-bold text-sm uppercase mb-4 flex items-center gap-2">
                        <i class="ti ti-package text-[#4a9eff]"></i> Piezas necesarias
                    </h4>
                    <form class="space-y-4">
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Reparación</label>
                            <input type="text" placeholder="Ej: Seat León" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm focus:outline-none focus:border-[#4a9eff]">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Pieza</label>
                            <input type="text" placeholder="Ej: Filtro de aceite" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm focus:outline-none focus:border-[#4a9eff]">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Cantidad</label>
                            <input type="number" placeholder="1" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm focus:outline-none focus:border-[#4a9eff]">
                        </div>
                        <button class="btn-primary w-full justify-center">Añadir pieza</button>
                    </form>
                </div>

                <!-- Solicita piezas faltantes -->
                <div class="why-item bg-[#1f2937] dark:bg-gray-900 p-6 rounded-lg border border-[#374151] dark:border-gray-700">
                    <h4 class="text-white font-bold text-sm uppercase mb-4 flex items-center gap-2">
                        <i class="ti ti-alert-circle text-[#4a9eff]"></i> Solicitar piezas
                    </h4>
                    <form class="space-y-4">
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Pieza faltante</label>
                            <input type="text" placeholder="Ej: Batería" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm focus:outline-none focus:border-[#4a9eff]">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Cantidad</label>
                            <input type="number" placeholder="1" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm focus:outline-none focus:border-[#4a9eff]">
                        </div>
                        <button class="btn-primary w-full justify-center">Solicitar pieza</button>
                    </form>
                </div>

                <!-- Actualizar estado -->
                <div class="why-item bg-[#1f2937] dark:bg-gray-900 p-6 rounded-lg border border-[#374151] dark:border-gray-700">
                    <h4 class="text-white font-bold text-sm uppercase mb-4 flex items-center gap-2">
                        <i class="ti ti-check text-[#4a9eff]"></i> Actualizar estado
                    </h4>
                    <form class="space-y-4">
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Reparación</label>
                            <input type="text" placeholder="Ej: Seat León" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm focus:outline-none focus:border-[#4a9eff]">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Estado</label>
                            <select class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm focus:outline-none focus:border-[#4a9eff]">
                                <option>Pendiente</option>
                                <option>En proceso</option>
                                <option>Finalizada</option>
                            </select>
                        </div>
                        <button class="btn-primary w-full justify-center">Actualizar</button>
                    </form>
                </div>

                <!-- Marcar como finalizada -->
                <div class="why-item bg-[#1f2937] dark:bg-gray-900 p-6 rounded-lg border border-[#374151] dark:border-gray-700">
                    <h4 class="text-white font-bold text-sm uppercase mb-4 flex items-center gap-2">
                        <i class="ti ti-flag-check text-[#4a9eff]"></i> Finalizar
                    </h4>
                    <form class="space-y-4">
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Reparación</label>
                            <input type="text" placeholder="Ej: Seat León" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm focus:outline-none focus:border-[#4a9eff]">
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 uppercase font-bold block mb-2">Notas finales</label>
                            <textarea placeholder="Descripción final del trabajo" class="w-full px-3 py-2 bg-[#111827] dark:bg-black border border-[#374151] rounded text-white text-sm h-16 focus:outline-none focus:border-[#4a9eff]"></textarea>
                        </div>
                        <button class="bg-green-600 hover:bg-green-700 text-white font-bold text-xs uppercase px-4 py-2 rounded w-full">Marcar finalizada</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
