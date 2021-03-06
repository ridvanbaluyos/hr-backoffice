const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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
    mix
        .styles([
            'bootstrap.min.css',
            'bootstrap-datetimepicker.css',
            'font-awesome.min.css',
            'sb-admin.css',
            'sweetalert2.min.css',
            'morris.css',
        ], 'public/assets/css/app.css')

        .scripts([
            'jquery.min.js',
            'app.js',
            'bootstrap.min.js',
            'plugins/moment/moment.min.js',
            'plugins/datetimepicker/bootstrap-datetimepicker.js',
            'plugins/chained/jquery.chained.min.js',
            'sweetalert2.min.js',
            'plugins/morris/raphael.min.js',
            'plugins/morris/morris.min.js'
        ], 'public/assets/js/app.js')

        .copy('resources/assets/fonts', 'public/build/assets/fonts')

        .version([
            'public/assets/css/app.css',
            'public/assets/js/app.js'
        ])
});