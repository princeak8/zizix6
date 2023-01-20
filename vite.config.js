import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel(["resources/css/app.css", "resources/js/app.js"]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});

// import { defineConfig } from "vite";
// import tailwindcss from "tailwindcss";
// import autoprefixer from "autoprefixer";
// import vue from "@vitejs/plugin-vue";

// export default defineConfig({
//     plugins: [
//         vue({
//             // This is needed, or else Vite will try to find image paths (which it wont be able to find because this will be called on the web, not directly)
//             // For example <img src="/images/logo.png"> will not work without the code below
//             template: {
//                 transformAssetUrls: {
//                     includeAbsolute: false,
//                 },
//             },
//         }),
//     ],
// });
