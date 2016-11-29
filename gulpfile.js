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

elixir(mix => {
    mix.sass('app.scss')
        .webpack('app.js')
        .styles([
            'index.css',
            'bootstrap-select.min.css',
            'toastr.min.css'
            //'main.css'
        ])
        .scripts([
            'toastr.min.js',
            //'forum.js'
        ])
;
});

//
//elixir(function(mix) {
//    mix.styles([
//        'normalize.css',
//        'main.css'
//    ]);
//});