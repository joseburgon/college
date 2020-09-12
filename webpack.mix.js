const mix = require("laravel-mix");

const tailwindcss = require("tailwindcss");

const path = require('path');

require("laravel-mix-purgecss");


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

// Javascript
mix.js("resources/js/main.js", "public/js");

// CSS
mix.sass("resources/sass/app.scss", "public/css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss("./tailwind.config.js")]
    }).purgeCss({
        enabled: mix.inProduction(),
        folders: ["src", "templates"],
        extensions: ["html", "js", "php", "vue"]
    });

mix.copyDirectory('resources/fonts', 'public/fonts');

mix.webpackConfig({
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js')
    },
  },
});

mix.browserSync('college.test');
