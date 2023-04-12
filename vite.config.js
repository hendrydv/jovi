import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/images/jovi.png',
                'resources/images/jovi_background.jpg',
                'resources/images/jovi_favicon.png',
            ],
            refresh: true,
        }),
    ],
});
