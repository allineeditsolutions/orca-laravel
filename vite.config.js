import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';
import removeConsole from 'vite-plugin-remove-console';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        tailwindcss(),
        // Remove console statements in production builds
        // Note: Our dev logger functions (devLog, devError, etc.) are safe because
        // they check import.meta.env.DEV before calling console methods
        removeConsole({
            includes: ['log', 'warn', 'error', 'info', 'debug'],
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
    optimizeDeps: {
        include: ['primevue/config', '@primevue/themes/aura'],
        force: true
    },
});
