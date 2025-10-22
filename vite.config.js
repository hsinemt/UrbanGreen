import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resource/css/app.css', 'resource/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
