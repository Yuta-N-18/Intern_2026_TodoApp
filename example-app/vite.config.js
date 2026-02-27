import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],

    server: {
        host: '0.0.0.0', // すべての接続を受け入れる
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost', // ブラウザからは localhost としてアクセスする
            protocol: 'ws',
        },

        watch: {
            usePolling: true,
        },
    },
});
