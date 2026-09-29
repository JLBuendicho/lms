import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/admin/theme.css'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    // -- uncomment for dev --
    // server: {
    //     cors: true,
    //     watch: {
    //         ignored: ['**/storage/framework/views/**'],
    //     },
    //     host: '0.0.0.0',  // allow external access
    //     port: parseInt(process.env.VITE_PORT) || 5173,
    //     origin: `http://${process.env.VITE_HOST}:${process.env.VITE_PORT || 5173}`,
    //     hmr: {
    //         // host: '127.0.0.1',
    //         host: process.env.VITE_HOST || 'localhost',
    //         port: parseInt(process.env.VITE_PORT) || 5173,
    //         protocol: 'ws',
    //     },
    // },
    // -- uncomment for dev --
});
