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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');
mix.copyDirectory('public/frontend/build/js', 'public/js');
mix.copyDirectory('public/frontend/build/css', 'public/css');
mix.copyDirectory('public/frontend/build/fonts', 'public/fonts');
mix.copyDirectory('public/frontend/build/webfonts', 'public/webfonts');
mix.copyDirectory('public/frontend/build/img', 'public/img');
