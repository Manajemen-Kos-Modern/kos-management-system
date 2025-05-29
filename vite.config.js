import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/chatboot.css",
                "resources/js/chatboot.js",
                "resources/css/dashboard.css",
                "resources/js/dashboard.js",
                "resources/css/detail-kamar.css",
                "resources/js/detail-kamar.js",
                "resources/css/form-keluhan.css",
                "resources/js/form-keluhan.js",
                "resources/css/keluhan.css",
                "resources/js/keluhan.js",
                "resources/css/login.css",
                "resources/js/login.js",
                "resources/css/pemesnana-kamar.css",
                "resources/js/pemesnana-kamar.js",
                "resources/css/profile.css",
                "resources/js/profile.js",
                "resources/css/register.css",
                "resources/js/register.js",
                "resources/css/welcome.css",
                "resources/js/welcome.js",
            ],
            refresh: true,
        }),
    ],
});
