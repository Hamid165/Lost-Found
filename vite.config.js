import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '127.0.0.1',
    },
    // ====================================================================
    // PERBAIKAN ZAP: Menghapus Komentar & Console Log di Production
    // Mengatasi: "Information Disclosure - Suspicious Comments"
    // ====================================================================
    build: {
        minify: 'esbuild',
        esbuild: {
            // Hapus console.log dan debugger agar tidak terbaca hacker
            drop: ['console', 'debugger'], 
            // Hapus semua komentar (legal, TODO, dll) dari file output
            legalComments: 'none', 
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});