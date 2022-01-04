let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .js('resources/js/tool.js', 'js')
  .postCss('resources/css/tool.css', 'css', [
      require('tailwindcss')
  ])
  .vue()
