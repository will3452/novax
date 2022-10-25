let mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')
mix
  .setPublicPath('dist')
  .js('resources/js/card.js', 'js')
  .vue()
  .css('resources/css/app.css', 'css')
  .options({
    processCssUrls: false,
    postCss: [tailwindcss('./tailwind.config.js')]})
