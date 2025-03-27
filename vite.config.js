import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import AutoImport from 'unplugin-auto-import/vite';
import { PrimeVueResolver } from '@primevue/auto-import-resolver';
import Components from 'unplugin-vue-components/vite';
import { purgeCss } from 'vite-plugin-tailwind-purgecss';
import viteCompression from 'vite-plugin-compression';

export default defineConfig({
    plugins: [
        viteCompression(),
        purgeCss(),

        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false
                }
            }
        }),
        Components({
            resolvers: [PrimeVueResolver()]
        }),
        AutoImport({
            eslintrc: {
                enabled: true,
                filepath: './.eslintrc-auto-import.json'
            },
            imports: ['vue', 'vue-router', 'pinia', '@vueuse/core'],
            vueTemplate: true
        })
    ],
    define: { 'process.env': {} },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@': '/resources/js'
        }
    },
    build: {
        chunkSizeWarningLimit: 5000
    },
    optimizeDeps: {
        noDiscovery: true,
        exclude: [''],
        include: ['crypto-js', 'pusher-js', 'gsap', 'qrcode-vue3'],
        entries: ['./resources/js/**/*.vue']
    },
    css: {
        preprocessorOptions: {
            scss: {
                silenceDeprecations: ['legacy-js-api']
            }
        }
    }
});
