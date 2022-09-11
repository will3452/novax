/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
  theme: {
    extend: {},
  },
  daisyui: {
    themes: [
        {
            mytheme: {

                    "primary": "#a3e635",

                    "secondary": "#166534",

                    "accent": "#fb923c",

                    "neutral": "#f3f4f6",

                    "base-100": "#FFFFFF",

                    "info": "#93E6FB",

                    "success": "#80CED1",

                    "warning": "#fcd34d",

                    "error": "#ef4444",
            },
        }
    ]
  },
  plugins: [(require('daisyui'))],
}
