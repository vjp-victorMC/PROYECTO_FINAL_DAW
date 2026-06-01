<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Talleres Rápidos y Curiosos</title>
    @stack('head')
    @vite([
        'resources/css/components/topbar.css',
        'resources/css/admin/header-admin.css',
    ])
</head>
<body class="bg-white text-gray-900 dark:bg-black dark:text-white min-h-screen flex flex-col transition-colors duration-300">
    @auth
        @if(isset(Auth::user()->rol) && (Auth::user()->rol === 'admin'))
            @include('components.header-admin')
        @else
            <x-topbar />
        @endif
    @else
        <x-topbar />
    @endauth
    <main class="flex-1">
        @yield('content')
    </main>
    <x-footer />
</body>
</html>
