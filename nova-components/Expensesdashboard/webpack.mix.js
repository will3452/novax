let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .js('resources/js/card.js', 'js')
  .postCss("resources/css/app.css", "public/css", [
    require("tailwindcss"),
  ])
  .vue(2)
