import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        laravel({
            buildDirectory: 'vendor/eymer/laravelquotes',
            input: [
                'resources/js/app.js',
                'resources/css/app.css',
            ],
            refresh: false,
        }),
        tailwindcss(),
        vue(),
    ],
    build: {
        outDir: 'dist',
        manifest: false,
        rollupOptions: {
            output: {
                assetFileNames: 'assets/[name].[ext]',
                entryFileNames: 'assets/[name].js'
            }
        }
    }
});
