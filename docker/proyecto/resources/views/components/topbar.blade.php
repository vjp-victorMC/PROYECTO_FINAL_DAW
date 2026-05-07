<nav class="bg-red-600 dark:bg-black text-white border-b-4 border-yellow-400 dark:border-red-600 flex items-center justify-between px-6 py-3 shadow-xl">
    <div class="flex items-center space-x-2">
        <div class="w-12 h-12 bg-white dark:bg-red-600 rounded-sm flex items-center justify-center font-black text-red-600 dark:text-white transform -rotate-3 border-2 border-yellow-400">TRC</div>
        <span class="font-black text-xl italic tracking-tighter">TALLERES <span class="text-yellow-300">R&C</span></span>
    </div>

    <ul class="hidden md:flex space-x-8 font-bold uppercase text-sm">
        <li><a href="/" class="hover:text-yellow-300 dark:hover:text-red-500 transition">Inicio</a></li>
        <li><a href="/servicios" class="hover:text-yellow-300 dark:hover:text-red-500 transition">Servicios</a></li>
        <li><a href="/segunda-mano" class="hover:text-yellow-300 dark:hover:text-red-500 transition">2ª Mano</a></li>
        <li><a href="/nosotros" class="hover:text-yellow-300 dark:hover:text-red-500 transition">Nosotros</a></li>
    </ul>

    <div class="flex items-center space-x-4">
        <button id="theme-toggle" class="bg-yellow-400 dark:bg-red-600 text-black dark:text-white px-3 py-1 rounded-full text-xs font-bold hover:scale-110 transition">
            MODO +/-
        </button>
        <div class="flex items-center space-x-2 bg-red-700 dark:bg-gray-900 px-3 py-1 rounded-sm border border-yellow-400">
            <div class="w-6 h-6 bg-yellow-400 rounded-full"></div>
            <span class="text-xs font-bold uppercase">Invitado</span>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;

        // 1. Comprobar si ya había una preferencia guardada
        if (localStorage.getItem('theme') === 'dark') {
            htmlElement.classList.add('dark');
        }

        // 2. Escuchar el click del botón
        btn.addEventListener('click', function() {
            htmlElement.classList.toggle('dark');
            
            // 3. Guardar la elección para la próxima vez
            if (htmlElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });
    });
</script>