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
  .postCss("resources/css/app.css", "public/css", [
    require("postcss-import"),
    require("tailwindcss"),
    require("autoprefixer"),
  ])
  .ts("resources/js/app.ts", "public/js")
  .ts("resources/js/bootstrap.ts", "public/js")
  .vue({
    extractStyles: true,
  })
  .extract()
  .webpackConfig(require("./webpack.config"))
  .alias({ ziggy: path.resolve("vendor/tightenco/ziggy/dist/vue") })
  .disableSuccessNotifications();

if (mix.inProduction()) {
  mix.version();
} else {
  mix.sourceMaps().browserSync("eangkot.test");
}
