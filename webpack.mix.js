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

mix.react('resources/js/app.js', 'public/js')
    .js(['resources/js/script.js',
        'resources/js/postScroll.js',
        'resources/js/jquery.jscroll.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.js'
    ], 'public/js')
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
    })
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/blog.scss', 'public/css');
