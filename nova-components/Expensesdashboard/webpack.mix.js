let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .js('resources/js/card.js', 'js')
  .vue(2)
  .sass('resources/sass/card.scss', 'css')
