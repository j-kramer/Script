import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import {defineConfig} from 'vite';
import vueDevTools from 'vite-plugin-vue-devtools';

import {resolve} from './vite/resolve.config';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),
        tailwindcss(),
        vue(),
        vueDevTools({
            appendTo: 'resources/js/app.ts',
        }),
    ],
    build: {target: 'esnext'},
    resolve,
});
