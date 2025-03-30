import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        https: true, // 🔹 Habilita HTTPS para evitar Mixed Content
        host: 'onlyhome-bpric.ondigitalocean.app', // 🔹 Usa tu dominio
        hmr: {
            host: 'onlyhome-bpric.ondigitalocean.app',
            protocol: 'wss', // 🔹 WebSockets seguros
        },
    },
});
