@php
    $navItems = [
        ['to' => '/', 'label' => 'Inicio'],
        ['to' => '/servicios', 'label' => 'Servicios'],
        ['to' => '/segunda-mano', 'label' => '2ª Mano'],
        ['to' => '/nosotros', 'label' => 'Nosotros'],
        ['to' => '/contacto', 'label' => 'Contacto'],
    ];
@endphp

<header
    x-data="{ open: false }"
    class="sticky top-0 z-50 w-full border-b-4 border-yellow-400 dark:border-red-600 bg-red-600 dark:bg-black text-white shadow-xl backdrop-blur supports-[backdrop-filter]:bg-red-600/90"
>
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 md:px-6">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-sm bg-white dark:bg-red-600 font-black text-red-600 dark:text-white transform -rotate-3 border-2 border-yellow-400 shadow-lg">
                TRC
            </div>
            <span class="flex flex-col leading-tight">
                <span class="text-xl font-black italic tracking-tighter uppercase">
                    Talleres <span class="text-yellow-300">R&C</span>
                </span>
                <span class="text-[10px] uppercase tracking-widest text-red-100 dark:text-gray-400 font-bold">
                    Mecánica & Venta
                </span>
            </span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden items-center gap-1 md:flex">
            @foreach($navItems as $item)
                <a
                    href="{{ $item['to'] }}"
                    class="rounded-md px-3 py-2 text-sm font-bold uppercase transition-all hover:text-yellow-300 dark:hover:text-red-500 {{ Request::is(ltrim($item['to'], '/')) ? 'text-yellow-300 underline underline-offset-4' : 'text-white' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <!-- Right Side Actions -->
        <div class="hidden items-center gap-4 md:flex">
            <!-- Theme Toggle -->
            <button id="theme-toggle" class="bg-yellow-400 dark:bg-red-600 text-black dark:text-white px-3 py-1 rounded-full text-xs font-black hover:scale-110 transition-transform shadow-md">
                MODO +/-
            </button>

            <!-- User Status -->
            <div class="flex items-center gap-2 bg-red-700 dark:bg-gray-900 px-3 py-1.5 rounded-sm border border-yellow-400/50">
                <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                <span class="text-[10px] font-black uppercase tracking-wider">Invitado</span>
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <button
            @click="open = !open"
            class="inline-flex h-10 w-10 items-center justify-center rounded-md border-2 border-yellow-400 md:hidden bg-red-700 dark:bg-red-900"
        >
            <svg x-show="!open" xmlns="http://w3.org" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
            <svg x-show="open" x-cloak xmlns="http://w3.org" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
    </div>

    <!-- Mobile Navigation -->
    <div
        x-show="open"
        x-cloak
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="border-t border-yellow-400 dark:border-red-600 bg-red-700 dark:bg-gray-950 md:hidden"
    >
        <nav class="flex flex-col space-y-1 px-4 py-4">
            @foreach($navItems as $item)
                <a
                    href="{{ $item['to'] }}"
                    class="block rounded-md px-3 py-3 text-base font-bold uppercase {{ Request::is(ltrim($item['to'], '/')) ? 'bg-yellow-400 text-black' : 'text-white hover:bg-red-800 dark:hover:bg-red-900' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach

            <div class="pt-4 mt-2 border-t border-red-500 flex items-center justify-between">
                <button onclick="document.getElementById('theme-toggle').click()" class="text-xs font-bold bg-yellow-400 text-black px-4 py-2 rounded-full uppercase">Cambiar Color</button>
                <span class="text-xs font-bold opacity-75 italic italic uppercase">R&C Motorsport</span>
            </div>
        </nav>
    </div>
</header>

<script>
    // Mantengo tu lógica de Dark Mode intacta para que no deje de funcionar
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;

        if (localStorage.getItem('theme') === 'dark') {
            htmlElement.classList.add('dark');
        }

        btn.addEventListener('click', function() {
            htmlElement.classList.toggle('dark');
            localStorage.setItem('theme', htmlElement.classList.contains('dark') ? 'dark' : 'light');
        });
    });
</script>


