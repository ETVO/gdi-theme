// webpack.mix.js

let mix = require('laravel-mix');

mix.disableSuccessNotifications();

// Compile
mix.js('src/js/main.js', 'js')
.sass('src/scss/main.scss', 'css')
.sass('src/scss/admin.scss', 'css')
.sass('src/scss/bootstrap.scss', 'css')
.setPublicPath('assets');

// Minify
mix.minify('assets/js/main.js');
mix.minify('assets/css/main.css');
mix.minify('assets/css/admin.css');
mix.minify('assets/css/bootstrap.css');

// Copy bootstrap-icons module
mix.copy('node_modules/bootstrap-icons/font/', 'assets/fonts/bootstrap-icons');