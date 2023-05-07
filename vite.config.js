import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/aside_bar.css',
                'resources/js/aside_bar.js',
                'resources/css/crud.css',
                'resources/js/crud.js',
                'resources/css/nav_bar.css',
                'resources/js/nav_bar.js',
                'resources/css/playlistTable.css',
            ],
            refresh: true,
        }),
    ],
});
