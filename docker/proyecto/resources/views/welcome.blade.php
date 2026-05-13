@extends('layouts.app')

@section('content')
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-6xl font-black mb-4">TALLERES <span class="text-blue-500">RÁPIDOS Y CURIOSOS</span></h1>
            <p class="text-xl text-gray-400 mb-10 italic">"Digitalizando el corazón de tu vehículo"</p>
            <div class="w-full h-80 bg-black border-2 border-gray-800 flex items-center justify-center rounded-xl shadow-2xl">
                <span class="text-gray-600 font-bold uppercase tracking-widest">[ IMAGEN TALLER 3D / PRINCIPAL ]</span>
            </div>
        </div>
    </section>

    <section class="py-12 bg-black border-y border-gray-800">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap justify-center gap-16 opacity-50 font-bold text-2xl">
                <span>BOSCH</span>
                <span>CASTROL</span>
                <span>SHELL</span>
            </div>
            <p class="text-center text-sm text-gray-500 mt-6">Utilizamos recambios de primera línea para garantizar la seguridad de nuestros clientes.</p>
        </div>
    </section>

    <section class="py-20 container mx-auto px-6">
        <h2 class="text-3xl font-bold mb-12 border-l-4 border-blue-500 pl-4">Nuestros Servicios</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="bg-gray-800 p-8 rounded-lg border border-gray-700">
                <h3 class="text-2xl font-bold text-blue-400 mb-4">Mecánica Rápida</h3>
                <p class="text-gray-400 mb-6 text-sm">Intervenciones ágiles: Neumáticos, pastillas de freno, mantenimiento oficial, ITV, distribución y embrague. Pensado para que no te detengas.</p>
                <div class="w-full h-40 bg-black border border-gray-700"></div>
            </div>
            <div class="bg-gray-800 p-8 rounded-lg border border-gray-700">
                <h3 class="text-2xl font-bold text-red-500 mb-4">Mecánica Compleja</h3>
                <p class="text-gray-400 mb-6 text-sm">Expertos en cajas de cambio y reconstrucción de motores. Diagnosis avanzada para averías que otros no encuentran.</p>
                <div class="w-full h-40 bg-black border border-gray-700"></div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center border-t border-gray-800 pt-10">
            <div class="w-full h-64 bg-black border border-gray-700 flex items-center justify-center text-gray-600 font-bold">IMAGEN STOCK 2ª MANO</div>
            <div>
                <h2 class="text-3xl font-bold mb-4">Vehículos de Ocasión</h2>
                <p class="text-gray-400 mb-4">¿Por qué elegirnos? Ofrecemos garantía total, revisión de 100 puntos y búsqueda personalizada según tus requisitos.</p>
            </div>
        </div>
    </section>

    <section class="py-20 container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-6 italic">Sobre Nosotros</h2>
        <p class="text-gray-400 max-w-3xl mx-auto">
            Somos un equipo enfocado en la transparencia. Nuestra plataforma digital permite monitorizar tu coche en tiempo real y ver métricas de rendimiento del taller.
        </p>
    </section>

    <section class="py-20 container mx-auto px-6 text-center">
        <p class="text-gray-400 max-w-3xl mx-auto">
            <a href="/login" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
    Ir al Login
</a>
        </p>
    </section>

@endsection
