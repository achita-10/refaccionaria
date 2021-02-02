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
mix.styles([
    'resources/plantilla/assets/css/bootstrap.min.css',
    'resources/plantilla/assets/css/atlantis.min.css',
    
    'resources/plantilla/assets/css/demo.css',
],'public/css/plantilla.css')

.scripts([
    /*Core JS Files */
    'resources/plantilla/assets/js/core/jquery.3.2.1.min.js',
    'resources/plantilla/assets/js/core/popper.min.js',
    'resources/plantilla/assets/js/core/bootstrap.min.js',
    /*jQuery UI */
    'resources/plantilla/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js',
    'resources/plantilla/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js',
    /*jQuery Scrollbar */
    'resources/plantilla/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js',
    /*Chart JS */
    'resources/plantilla/assets/js/plugin/chart.js/chart.min.js',
    /*jQuery Sparkline */
    'resources/plantilla/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js',
    /*Chart Circle */
    'resources/plantilla/assets/js/plugin/chart-circle/circles.min.js',
    /*Datatables */
    'resources/plantilla/assets/js/plugin/datatables/datatables.min.js',
    /*Bootstrap Notify */
    'resources/plantilla/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js',
    /*jQuery Vector Maps*/
    'resources/plantilla/assets/js/plugin/jqvmap/jquery.vmap.min.js',
    'resources/plantilla/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js',
    /*Sweet Alert 2*/
    'resources/plantilla/assets/js/plugin/sweetalert/sweetalert2.all.min.js',
    /*Atlantis JS*/
    'resources/plantilla/assets/js/atlantis.min.js',
    /*Atlantis DEMO methods, don't include it in your project!*/
    'resources/plantilla/assets/js/setting-demo.js',
    //'resources/plantilla/assets/js/demo.js',
    'resources/plantilla/assets/js/Chart.min.js',
    

],'public/js/plantilla.js')
.js('resources/js/app.js', 'public/js')
.js([
    'resources/plantilla/assets/js/plugin/webfont/webfont.min.js',
    'resources/plantilla/assets/css/fonts.min.css',
],'public/js/webfont.min.js');