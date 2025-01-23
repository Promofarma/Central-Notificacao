import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: true,
        hmr: {
            host: "localhost",
        },
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/notification/toast.css",
                "resources/notification/index.js",
            ],
            refresh: [...refreshPaths, "app/Livewire/**"],
        }),
    ],
});
