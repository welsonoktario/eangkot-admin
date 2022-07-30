const mix = require("laravel-mix");
const path = require("path");

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

mix
  .js("resources/js/app.js", "public/js")
  .js("resources/js/bootstrap.js", "public/js")
  .sourceMaps()
  .vue()
  .postCss("resources/css/app.css", "public/css", [
    require("postcss-import"),
    require("tailwindcss"),
    require("autoprefixer"),
  ])
  .browserSync("eangkot.test")
  .webpackConfig(require("./webpack.config"))
  .alias({ ziggy: path.resolve("vendor/tightenco/ziggy/dist/vue") })
  .disableSuccessNotifications();

if (mix.inProduction()) {
  mix.version();
}
