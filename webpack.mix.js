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

mix.js('resources/js/app.js', 'public/assets/js/argon-dashboard.js')
    .sass('resources/assets/scss/argon-dashboard.scss', 'public/assets/css/argon-dashboard.css', [
        //
    ]);

mix.webpackConfig({
    stats: {
        children: true,
    },
});