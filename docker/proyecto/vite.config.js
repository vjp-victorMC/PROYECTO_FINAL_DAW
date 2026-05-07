import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        // PERMITIR CONEXIÓN EXTERNA
        host: '0.0.0.0', 
        port: 5173,
        strictPort: true,
        // ESTO ARREGLA EL EMPTY_RESPONSE EN WINDOWS
        hmr: {
            host: 'localhost',
        },
        // CONFIGURACIÓN DE WATCHER PARA DOCKER EN WINDOWS
        watch: {
            usePolling: true,
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
