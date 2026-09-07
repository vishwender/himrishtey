import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/home/home.css',
                'resources/js/home.js',
            ],
            refresh: true,
        }),
    ],

    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,

        origin: 'http://himrishtey.ddev.site:5172',

        cors: {
            origin: 'http://himrishtey.ddev.site',
        },

        hmr: {
            host: 'himrishtey.ddev.site',
            protocol: 'ws',
            clientPort: 5172,
        },
    },
});