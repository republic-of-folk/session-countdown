const mix = require('laravel-mix');

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

mix.js('resources/js/site.js', 'public/js');

mix.ts('resources/js/admin.ts', 'public/js')
    .vue()
    .sass('resources/scss/admin.scss', 'public/css/admin.min.css');

mix.version();
mix.sourceMaps(true, 'source-map');
