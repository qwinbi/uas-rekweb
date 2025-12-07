import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    
    server: {
        host: true,
        hmr: {
            host: 'localhost',
        },
    },
    
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['vue', 'axios', 'lodash'],
                    tailwind: ['tailwindcss', 'autoprefixer'],
                },
            },
        },
        sourcemap: process.env.NODE_ENV !== 'production',
    },
    
    resolve: {
        alias: {
            '@': '/resources/js',
            '~': '/resources',
        },
    },
});