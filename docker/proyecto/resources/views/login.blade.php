<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso VIP | Talleres R&C</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://googleapis.com');

        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
            overflow: hidden;
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(59, 130, 246, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5),
                        0 0 20px rgba(37, 99, 235, 0.1);
        }

        .neon-glow:focus {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.4);
            border-color: #60a5fa;
        }

        /* Animación suave para la aparición de campos */
        .field-transition {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="text-slate-200 h-screen flex items-center justify-center p-4">

    <!-- Contenedor Principal -->
    <div class="glass-card p-8 md:p-12 rounded-[2.5rem] w-full max-w-md transform transition-all">

        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600/10 rounded-2xl mb-4 border border-blue-500/20">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="Path para icono de herramienta..."></path>
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                </svg>
            </div>
            <h2 id="form-title" class="text-4xl font-black tracking-tighter italic text-white uppercase">
                Talleres <span class="text-blue-500">R&C</span>
            </h2>
            <p id="form-subtitle" class="text-blue-400/60 text-[10px] font-bold mt-2 uppercase tracking-[0.3em]">
                Sistema de Gestión de Flota
            </p>
        </div>

        <form id="auth-form" class="space-y-5">
            <!-- Campo Nombre (Solo Registro) -->
            <div id="group-nombre" class="hidden opacity-0 -translate-y-2 field-transition">
                <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1.5 ml-1">Nombre Propietario</label>
                <input type="text" id="nombre" placeholder="Nombre completo"
                    class="w-full bg-slate-950/50 border border-slate-800 p-4 rounded-2xl outline-none neon-glow text-white placeholder-slate-600 transition-all">
            </div>

            <!-- Identificador -->
            <div>
                <label id="label-identificador" class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1.5 ml-1">DNI o Email</label>
                <div class="relative">
                    <input type="text" id="identificador" required placeholder="tu@ejemplo.com"
                        class="w-full bg-slate-950/50 border border-slate-800 p-4 rounded-2xl outline-none neon-glow text-white placeholder-slate-600 transition-all">
                </div>
            </div>

            <!-- Contraseña -->
            <div>
                <div class="flex justify-between items-center mb-1.5 ml-1">
                    <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest">Contraseña</label>
                    <a href="#" class="text-[10px] font-bold text-slate-500 hover:text-blue-400 transition-colors uppercase">¿Olvidaste?</a>
                </div>
                <input type="password" id="password" required placeholder="••••••••"
                    class="w-full bg-slate-950/50 border border-slate-800 p-4 rounded-2xl outline-none neon-glow text-white placeholder-slate-600 transition-all">
            </div>

            <!-- Botón Submit -->
            <button type="submit" id="btn-submit"
                class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-900/40 transform hover:-translate-y-1 active:scale-95 transition-all duration-200 uppercase tracking-widest text-sm">
                Entrar al Taller
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-10 text-center">
            <button id="toggle-form" class="group text-slate-400 text-xs font-medium transition-all">
                <span id="footer-text">¿No tienes cuenta?</span>
                <span class="text-blue-400 font-bold group-hover:text-blue-300 ml-1 underline decoration-blue-500/30 underline-offset-4">Regístrate gratis</span>
            </button>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggle-form');
        const groupNombre = document.getElementById('group-nombre');
        const formTitle = document.getElementById('form-title');
        const btnSubmit = document.getElementById('btn-submit');
        const footerText = document.getElementById('footer-text');
        const labelId = document.getElementById('label-identificador');

        // Lee la URL para comprobar si viene de la opción "Registrarse" del menú
        const urlParams = new URLSearchParams(window.location.search);
        let isLogin = urlParams.get('action') !== 'register';

        // Si no es Login (es decir, es Registro), cambia el diseño nada más cargar la página
        if (!isLogin) {
            groupNombre.classList.remove('hidden', 'opacity-0', '-translate-y-2');
            groupNombre.classList.add('opacity-100', 'translate-y-0');
            formTitle.innerHTML = 'Nuevo <span class="text-blue-500">Cliente</span>';
            btnSubmit.innerText = 'Crear mi Cuenta';
            footerText.innerText = '¿Ya eres cliente?';
            toggleBtn.querySelector('span:last-child').innerText = 'Inicia Sesión';
            labelId.innerText = 'Correo Electrónico';
        }

        // Mantiene la funcionalidad original para cambiar al hacer clic abajo
        toggleBtn.addEventListener('click', () => {
            isLogin = !isLogin;

            if(!isLogin) {
                groupNombre.classList.remove('hidden');
                setTimeout(() => {
                    groupNombre.classList.remove('opacity-0', '-translate-y-2');
                    groupNombre.classList.add('opacity-100', 'translate-y-0');
                }, 10);
            } else {
                groupNombre.classList.add('opacity-0', '-translate-y-2');
                setTimeout(() => groupNombre.classList.add('hidden'), 400);
            }

            formTitle.innerHTML = isLogin ? 'Talleres <span class="text-blue-500">R&C</span>' : 'Nuevo <span class="text-blue-500">Cliente</span>';
            btnSubmit.innerText = isLogin ? 'Entrar al Taller' : 'Crear mi Cuenta';
            footerText.innerText = isLogin ? '¿No tienes cuenta?' : '¿Ya eres cliente?';
            toggleBtn.querySelector('span:last-child').innerText = isLogin ? 'Regístrate gratis' : 'Inicia Sesión';
            labelId.innerText = isLogin ? 'DNI o Email' : 'Correo Electrónico';
        });
</script>

</body>
</html>
