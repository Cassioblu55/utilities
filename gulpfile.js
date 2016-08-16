var elixir = require('laravel-elixir');
elixir.config.publicPath = 'public_html';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.copy('node_modules/angular-ui-grid/ui-grid.ttf', 'public_html/build/css/');
    mix.copy('node_modules/angular-ui-grid/ui-grid.woff', 'public_html/build/css/');

    mix.browserify(['app.js'], 'public_html/js/app.js');

    mix.styles(['node_modules/angular-ui-grid/ui-grid.css',
        "node_modules/bootstrap/dist/css/bootstrap.css",
        "node_modules/bootstrap/dist/css/bootstrap-theme.css"
        ], 'public_html/css/app.css', './')

    mix.version(['css/app.css', 'js/app.js']);


});

