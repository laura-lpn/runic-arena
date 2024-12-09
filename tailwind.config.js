/** @type {import('tailwindcss').Config} */

const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        'black': '#121212',
        'white': '#d9e6eb',
        'green': '#34d399',
        'dark-blue': '#111827',
      },
      fontFamily: {
        'main': ['Montserrat', 'sans-serif'],
        'second': ['Faculty Glyphic', 'sans-serif'],
        'sans': ['Montserrat', 'sans-serif',
        defaultTheme.fontFamily.sans]
      },
      boxShadow: {
        'green': '0px 0px 15px #34d399',
        'green-2xl': '0px 0px 30px #34d399',
      },
      gridTemplateColumns: {
        // Simple 16 column grid
        'radio': '1fr 2fr'
      }
    }
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}
