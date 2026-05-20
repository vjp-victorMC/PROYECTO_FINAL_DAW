<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
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

            <!-- Campo DNI (Solo Registro) -->
            <div id="group-dni" class="hidden opacity-0 -translate-y-2 field-transition">
                <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1.5 ml-1">DNI</label>
                <input type="text" id="dni" placeholder="12345678A"
                    class="w-full bg-slate-950/50 border border-slate-800 p-4 rounded-2xl outline-none neon-glow text-white placeholder-slate-600 transition-all">
            </div>

            <!-- Identificador (DNI o Email / Correo) -->
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
                    <a href="#" id="forgot-password" class="text-[10px] font-bold text-slate-500 hover:text-blue-400 transition-colors uppercase">¿Olvidaste?</a>
                </div>
                <div class="relative">
                    <input type="password" id="password" required placeholder="••••••••"
                        class="w-full bg-slate-950/50 border border-slate-800 p-4 rounded-2xl outline-none neon-glow text-white placeholder-slate-600 transition-all pr-12">
                    <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 px-4 flex items-center text-slate-500 hover:text-blue-400 transition-colors">
                        <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Confirmar Contraseña (Solo Registro) -->
            <div id="group-password-confirm" class="hidden opacity-0 -translate-y-2 field-transition">
                <label class="block text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1.5 ml-1">Confirmar Contraseña</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" placeholder="••••••••"
                        class="w-full bg-slate-950/50 border border-slate-800 p-4 rounded-2xl outline-none neon-glow text-white placeholder-slate-600 transition-all pr-12">
                    <button type="button" id="toggle-password-confirm" class="absolute inset-y-0 right-0 px-4 flex items-center text-slate-500 hover:text-blue-400 transition-colors">
                        <svg id="eye-icon-confirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
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
        const groupDni = document.getElementById('group-dni');
        const groupPasswordConfirm = document.getElementById('group-password-confirm');
        const forgotPassword = document.getElementById('forgot-password');
        const formTitle = document.getElementById('form-title');
        const btnSubmit = document.getElementById('btn-submit');
        const footerText = document.getElementById('footer-text');
        const labelId = document.getElementById('label-identificador');
        const inputIdentificador = document.getElementById('identificador');
        const inputDni = document.getElementById('dni');
        const inputPasswordConfirm = document.getElementById('password_confirmation');
        const inputNombre = document.getElementById('nombre');

        // Lógica de tu compañero: Lee los parámetros de la URL (?action=register)
        const urlParams = new URLSearchParams(window.location.search);
        let isLogin = urlParams.get('action') !== 'register';

        // Función centralizada para renderizar el estado del formulario (Login o Registro)
        function updateFormUI(isLoginMode, isInitialLoad = false) {
            if (!isLoginMode) {
                // MODO REGISTRO
                groupNombre.classList.remove('hidden');
                groupDni.classList.remove('hidden');
                groupPasswordConfirm.classList.remove('hidden');
                forgotPassword.classList.add('hidden');

                if (isInitialLoad) {
                    // Si es carga inicial desde URL, mostramos sin esperar al timer de animación
                    groupNombre.classList.remove('opacity-0', '-translate-y-2');
                    groupNombre.classList.add('opacity-100', 'translate-y-0');
                    groupDni.classList.remove('opacity-0', '-translate-y-2');
                    groupDni.classList.add('opacity-100', 'translate-y-0');
                    groupPasswordConfirm.classList.remove('opacity-0', '-translate-y-2');
                    groupPasswordConfirm.classList.add('opacity-100', 'translate-y-0');
                } else {
                    // Si es por click, dejamos que actúe la transición css smoothly
                    setTimeout(() => {
                        groupNombre.classList.remove('opacity-0', '-translate-y-2');
                        groupNombre.classList.add('opacity-100', 'translate-y-0');
                        groupDni.classList.remove('opacity-0', '-translate-y-2');
                        groupDni.classList.add('opacity-100', 'translate-y-0');
                        groupPasswordConfirm.classList.remove('opacity-0', '-translate-y-2');
                        groupPasswordConfirm.classList.add('opacity-100', 'translate-y-0');
                    }, 10);
                }

                inputDni.required = true;
                inputPasswordConfirm.required = true;
                inputNombre.required = true;
                inputIdentificador.type = 'email'; // Validación nativa de email en registro

                formTitle.innerHTML = 'Nuevo <span class="text-blue-500">Cliente</span>';
                btnSubmit.innerText = 'Crear mi Cuenta';
                footerText.innerText = '¿Ya eres cliente?';
                toggleBtn.querySelector('span:last-child').innerText = 'Inicia Sesión';
                labelId.innerText = 'Correo Electrónico';
            } else {
                // MODO LOGIN
                groupNombre.classList.add('opacity-0', '-translate-y-2');
                groupDni.classList.add('opacity-0', '-translate-y-2');
                groupPasswordConfirm.classList.add('opacity-0', '-translate-y-2');
                forgotPassword.classList.remove('hidden');

                if (isInitialLoad) {
                    groupNombre.classList.add('hidden');
                    groupDni.classList.add('hidden');
                    groupPasswordConfirm.classList.add('hidden');
                } else {
                    setTimeout(() => {
                        groupNombre.classList.add('hidden');
                        groupDni.classList.add('hidden');
                        groupPasswordConfirm.classList.add('hidden');
                    }, 400);
                }

                inputDni.required = false;
                inputPasswordConfirm.required = false;
                inputNombre.required = false;
                inputIdentificador.type = 'text'; // Permite DNI o Email en Login

                formTitle.innerHTML = 'Talleres <span class="text-blue-500">R&C</span>';
                btnSubmit.innerText = 'Entrar al Taller';
                footerText.innerText = '¿No tienes cuenta?';
                toggleBtn.querySelector('span:last-child').innerText = 'Regístrate gratis';
                labelId.innerText = 'DNI o Email';
            }
        }

        // Ejecutar configuración inicial basada en la URL
        updateFormUI(isLogin, true);

        // Evento para alternar entre Login y Registro de forma dinámica haciendo click abajo
        toggleBtn.addEventListener('click', () => {
            isLogin = !isLogin;
            updateFormUI(isLogin, false);
        });

        // Gestión de la visibilidad de las contraseñas (Ojos)
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }

        document.getElementById('toggle-password').addEventListener('click', () => togglePasswordVisibility('password', 'eye-icon'));
        document.getElementById('toggle-password-confirm').addEventListener('click', () => togglePasswordVisibility('password_confirmation', 'eye-icon-confirm'));

        // Envío asíncrono del formulario a la API
        document.getElementById('auth-form').addEventListener('submit', async (e) => {
            e.preventDefault();

            const url = isLogin ? '/api/usuario/login' : '/api/usuario/newUser';

            const formData = isLogin ?
                {
                    identificador: inputIdentificador.value,
                    password: document.getElementById('password').value
                } :
                {
                    nombre: inputNombre.value,
                    email: inputIdentificador.value,
                    dni: inputDni.value,
                    password: document.getElementById('password').value,
                    password_confirmation: inputPasswordConfirm.value
                };

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (data.success) {
                    document.body.innerHTML = `
                    <div style="color:white; text-align:center; margin-top:30vh; font-family:'Inter', sans-serif; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem;">
                        <div style="font-size: 3.5rem; filter: drop-shadow(0 0 15px rgba(59,130,246,0.6));">🚗</div>
                        <h1 style="font-size: 2rem; font-weight: 900; letter-spacing: -0.05em; color: #fff; text-transform: uppercase;">¡Acceso Concedido!</h1>
                        <p style="color: rgba(255, 255, 255, 0.6); font-size: 0.95rem;">Hola, <strong style="color: #60a5fa;">${data.nombre || 'Usuario'}</strong>. Redirigiendo al taller...</p>
                    </div>`;
                    
                    setTimeout(() => {
                        window.location.href = "{{ route('welcome') }}";
                    }, 1200);
                } else {
                    alert(data.msg || JSON.stringify(data.errors));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error de conexión con el servidor.');
            }
        });
    </script>
</body>

</html>
