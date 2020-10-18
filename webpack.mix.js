const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const webpack = require('webpack');

mix.js('resources/js/app.js', 'public/assets/js')
    .sass('resources/scss/app.scss', 'public/assets/css')
    .vue()
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('tailwind.config.js')],
        uglify: {
            comments: false,
        }
    })
    .webpackConfig({
        plugins: [
            new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),
        ]
    })
    .extract([
        '@fortawesome/fontawesome-svg-core',
        '@fortawesome/free-brands-svg-icons',
        '@fortawesome/free-regular-svg-icons',
        '@fortawesome/free-solid-svg-icons',
        '@fortawesome/vue-fontawesome',
        'axios',
        'portal-vue',
        'vanilla-lazyload',
        'vue',
        'vue-toasted',
    ])
    .version();

if (!mix.inProduction()) {
    mix.sourceMaps();
}
