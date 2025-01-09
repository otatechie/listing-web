import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue"; // Import Vue plugin
import laravel from "laravel-vite-plugin";
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
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
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js'),
            'laravel-medialibrary-pro': '/vendor/spatie/laravel-medialibrary-pro/resources/js',
            'media-library-pro-vue3-attachment': '/vendor/spatie/laravel-medialibrary-pro/resources/js/media-library-pro-vue3-attachment',
            'media-library-pro-vue3-collection': '/vendor/spatie/laravel-medialibrary-pro/resources/js/media-library-pro-vue3-collection',
            'media-library-pro-react-attachment': '/vendor/spatie/laravel-medialibrary-pro/resources/js/media-library-pro-react-attachment',
            'media-library-pro-react-collection': '/vendor/spatie/laravel-medialibrary-pro/resources/js/media-library-pro-react-collection',
            'vue': 'vue/dist/vue.esm-bundler.js',
        },
    },
    server: {
        host: "localhost",
        port: 3000,
    },
    build: {
        outDir: "public/build",
        manifest: true,
    },
});
