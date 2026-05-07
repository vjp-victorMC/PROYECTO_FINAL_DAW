<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talleres Rápidos y Curiosos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 dark:bg-black dark:text-white min-h-screen flex flex-col transition-colors duration-300">
    <x-topbar />
    <main class="flex-1">
        @yield('content')
    </main>
    <x-footer />
</body>
</html>