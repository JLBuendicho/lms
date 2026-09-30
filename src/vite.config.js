import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({ command }) => ({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/filament/admin/theme.css",
            ],

            // Only refresh files during development.
            refresh: command === "serve",
        }),

        tailwindcss(),
    ],

    ...(command === "serve"
        ? {
              server: {
                  host: process.env.VITE_HOST || "0.0.0.0",
                  port: parseInt(process.env.VITE_PORT) || 5173,

                  cors: true,

                  watch: {
                      ignored: ["**/storage/framework/views/**"],
                  },

                  hmr: {
                      host: process.env.VITE_HMR_HOST || "localhost",
                      protocol: "ws",
                  },
              },
          }
        : {}),
}));
