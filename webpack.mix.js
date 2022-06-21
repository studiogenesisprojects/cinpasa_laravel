const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

//Al hacer algun cambio relacionado con news, hacer los siguiente:
// 1.Npm run dev en local
// 2.Subir la compilación al repo
// 3.Hacer pull en el servidor

// IMPORTANTE NO HACER NPM RUN PROD EN EL SERVIDOR

mix.js('resources/js/front/app.js', 'public/js/front');

mix.js(
    "resources/js/components/admin/pages/news/index.js",
    "public/back/news/js/news.js"
);
