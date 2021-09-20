// webpack.mix.js

let mix = require('laravel-mix');

mix.js('src/js/main.js', 'js')
.sass('src/scss/main.scss', 'css')
.setPublicPath('assets');

mix.minify('assets/js/main.js');
mix.minify('assets/css/main.css');

mix.copy('node_modules/bootstrap-icons/font/', 'assets/fonts/bootstrap-icons');