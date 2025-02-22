let mix = require('laravel-mix')
let tailwindcss = require('tailwindcss')

mix
  .setPublicPath('dist')
  .js('resources/js/tool.js', 'js')
  .postCss("resources/css/tool.css", "css", [
    tailwindcss
  ])
  .vue(2)
