let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .js('resources/js/card.js', 'js').vue()
  .sass('resources/sass/card.scss', 'css')
