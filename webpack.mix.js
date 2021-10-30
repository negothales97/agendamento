const mix = require("laravel-mix");
require("dotenv").config();

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.react("resources/js/src/index.js", "public/js")
    .js("resources/js/global.js", "public/js")
    .js("resources/js/agoraio-videocall.js", "public/js")
    // .sass('resources/sass/app.scss', 'public/css')
    .sass("resources/sass/admin.scss", "public/css")
    .copy("resources/css/bootstrap-grid.min.css", "public/css")
    .copy("resources/css/bootstrap.min.css", "public/css")
    .copyDirectory("resources/images", "public/images")
    .copyDirectory("resources/fontawesome", "public/fontawesome")
    .copyDirectory("resources/adminlte", "public/adminlte");

mix.version();
// if (mix.inProduction()) {
// }
