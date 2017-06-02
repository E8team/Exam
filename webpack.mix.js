const { mix } = require('laravel-mix');

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
mix.webpackConfig({
    module: {
        loaders: [{
            test: /\.css$/,
            loader: 'style-loader!css-loader'
        }]
    }
});

mix.js('resources/assets/js/app.js', 'public/static/js')
    .less('resources/assets/less/app.less', 'public/static/css')
    .copy('resources/assets/images', 'public/static/images/')
    .copy('resources/assets/css', 'public/static/css/')
    .copy('node_modules/es5-shim/es5-shim.min.js', 'public/static/js')
    .copy('node_modules/es5-shim/es5-sham.min.js', 'public/static/js')
    .copy('node_modules/Respond.js/dest/respond.min.js', 'public/static/js')
    // ------------admin-------------
    .js('resources/assets/admin/js/app.js', 'public/static/admin/js')
    .copy('node_modules/admin-lte/dist/img', 'public/static/admin/img')
    //.version();