let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .vue()
  .js('resources/js/tool.js', 'js')
  .sass('resources/sass/tool.scss', 'css')
