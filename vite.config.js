import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Main CSS file
                'resources/js/app.js'    // Main JS file
            ],
            refresh: true, // Auto reload on file change
        }),
    ],
});
