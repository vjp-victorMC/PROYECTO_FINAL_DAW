@vite(['resources/css/usuarios/welcome.css'])

@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="cita-section">
        <div class="cita-inner animate-up">
            <div class="cita-info">
                <span class="section-label" style="color:var(--primary-light)">Reserva online</span>
                <h2>Pide tu cita ahora</h2>
                <p>Reserva en menos de 2 minutos. Confirmamos tu cita por WhatsApp en menos de 1 hora.</p>
                <div class="cita-detail"><i class="ti ti-clock"></i> Lun–Vie: 8:00 – 19:00 | Sáb: 9:00 – 14:00</div>
                <div class="cita-detail"><i class="ti ti-map-pin"></i> Av. de España, 45 · Plasencia</div>
                <div class="cita-detail"><i class="ti ti-phone"></i> 924 000 000</div>
            </div>
            <form id="cita-form" class="cita-form">
                <input type="text" value="{{ $user->nombre ?? $user->name }}" readonly placeholder="Nombre completo">
                <input type="tel" value="{{ $user->telefono ?? '' }}" readonly placeholder="Teléfono WhatsApp">
                <div style="display:grid; grid-template-columns: 1fr; gap:10px;">
                    <select id="matricula-select" name="matricula" required>
                        <option style="color: black;" value="">Selecciona tu coche...</option>
                    </select>
                </div>
                <input type="text" name="asunto" maxlength="150" required placeholder="Asunto">
                <textarea name="mensaje" rows="4" required placeholder="Cuéntanos qué necesita tu coche..."></textarea>
                <button type="submit" class="btn-primary" style="width:100%; justify-content:center;">Confirmar
                    Reserva</button>
                <div id="cita-alert" class="mt-3"></div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const userId = @json($user->id_usuario ?? $user->id);
            const select = document.getElementById('matricula-select');
            // Cargar matrículas y modelos del usuario
            try {
                const res = await fetch(`/api/usuario/cars/${userId}`);
                if (res.ok) {
                    const coches = await res.json();
                    coches.forEach(coche => { 
                        const opt = document.createElement('option');
                        opt.value = coche.matricula;
                        opt.textContent = `${coche.matricula} - ${coche.modelo}`;
                        opt.style.color = 'black';
                        select.appendChild(opt);
                    });
                }
            } catch (e) {
                /* opcional: mostrar error */ }

            // Envío del formulario
            document.getElementById('cita-form').addEventListener('submit', async function(e) {
                e.preventDefault();
                const form = e.target;
                const data = {
                    usuario_envio: userId,
                    matricula: form.matricula.value,
                    asunto: form.asunto.value,
                    mensaje: form.mensaje.value
                };
                const alert = document.getElementById('cita-alert');
                alert.textContent = '';
                alert.className = '';
                console.log('Datos enviados:', data); // <-- DEBUG
                try {
                    // Si usas rutas API, elimina el header X-CSRF-TOKEN para evitar el error 419
                    const headers = {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            ?.getAttribute('content') || ''
                    };
                    // Si tu backend requiere el token, descomenta la siguiente línea:
                    // headers['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                    const resp = await fetch('/api/usuario/mensaje', {
                        method: 'POST',
                        headers,
                        body: JSON.stringify(data)
                    });
                    const result = await resp.json();
                    if (resp.ok) {
                        alert.textContent = 'Cita enviada correctamente.';
                        alert.className = 'alert alert-success';
                        form.reset();
                    } else {
                        alert.textContent = result.errors ? Object.values(result.errors).join(' ') :
                            'Error al enviar la cita.';
                        alert.className = 'alert alert-danger';
                    }
                } catch (err) {
                    alert.textContent = 'Error de red o servidor.';
                    alert.className = 'alert alert-danger';
                    console.error('Error al enviar cita:', err); // <-- DEBUG
                }
            });
        });
    </script>
@endsection
