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
    build: {
        rollupOptions: {
            output: {
                /* Isole GSAP dans son propre chunk — chargé en parallèle du bundle principal */
                manualChunks: {
                    gsap: ['gsap'],
                },
            },
        },
    },
});
