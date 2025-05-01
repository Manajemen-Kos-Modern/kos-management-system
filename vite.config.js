import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/new-page.css",
                "resources/js/new-page.js",
                "resources/css/register.css",
                "resources/js/register.js",
                "resources/css/login.css",
                "resources/js/login.js",
            ],
            refresh: true,
        }),
    ],
});
