import vue from '@vitejs/plugin-vue';
import autoprefixer from 'autoprefixer';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import tailwindcss from 'tailwindcss';
import { resolve } from 'node:path';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/bootstrap.min.css',
                'resources/css/bootstrap-icons.css',
                'resources/css/swiper-bundle.min.css',
                'resources/css/glightbox.min.css',
                'resources/css/main.css',
                'resources/js/app.ts',
                'resources/js/assets/bootstrap.bundle.min.js',
                'resources/js/assets/validate.js',
                'resources/js/assets/swiper-bundle.min.js',
                'resources/js/assets/purecounter_vanilla.js',
                'resources/js/assets/glightbox.min.js',
                'resources/js/assets/main.js',
            ],
            ssr: 'resources/js/ssr.ts',
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
    ],
    build: {
        rollupOptions: {
            output: {
                globals: {
                    jquery: 'jQuery',
                    moment: 'moment',
                    '@popperjs/core': 'Popper',
                    KTUtil: 'KTUtil',
                },
            },
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js'),
            '@@': path.resolve(__dirname, './public'),
            'ziggy-js': resolve(__dirname, 'vendor/tightenco/ziggy'),
        },
    },
    css: {
        postcss: {
            plugins: [tailwindcss, autoprefixer],
        },
    },
});
