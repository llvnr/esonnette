import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import ViteImages from 'vite-plugin-vue-images';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        ViteImages({
            baseDir: 'public/assets/images',
            outputDir: 'assets/images'
        }),
    ],
});
