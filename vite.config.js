import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import rtlcss from 'rtlcss';
import tailwindcss from '@tailwindcss/vite';
// import owlcarousel from '';
export default defineConfig({
    plugins: [
        laravel({
            //input: ["resources/sass/app.scss", "resources/js/app.js"],
            //input: ["resources/css/app.css", "resources/js/app.js"],
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/adminlte.css",     // أضف هذا السطر
                "resources/css/adminlte-rtl.css"  // وأضف هذا السطر أيضاً
            ],
            refresh: true,
        }),
        {
            name: "rtlcss",
            transform(code, id) {
                if (id.includes("adminlte-rtl.css")) {
                    return rtlcss.process(code);
                    // Convert CSS to RTL
                    // const rtlCode = code.replace(/left/g, 'right').replace(/right/g, 'left');
                    // return {
                    //     code: rtlCode,
                    //     map: null,
                    // };
                }
            },
        },
        tailwindcss(),

        // owlcarousel(),
    ],

    //  server: {
    //      host: '192.168.0.100',
    //      port: 8001,
    //      origin: 'http://192.168.0.100:8001',
    //      cors: {
    //          origin: 'http://192.168.0.100:8000',  // allow Laravel to access Vite
    //          credentials: true,
    //      },
    //  },
});
