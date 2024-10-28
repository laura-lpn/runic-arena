/** @type {import('tailwindcss').Config} */

const defaultTheme = require('tailwindcss/defaultTheme')
const forms = require('@tailwindcss/forms')


module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    colors: {
      'black': '#121212',
      'white': '#ffffff',
      'orange': '#edae64',
      'orange-light': '#ffe9cf',
      DEFAULT: '#121212'
    },
    fontFamily: {
      'main': ['Montserrat', 'sans-serif'],
      'second': ['Kodchasan', 'sans-serif'],
      'sans': ['Montserrat', 'sans-serif',
      defaultTheme.fontFamily.sans]
    },
    borderRadius: {
      'main': '16px',
      'input': '8px',
    },
    boxShadow: {
      'main': '0px 0px 15px #00000029',
    },
    fontSize: {
      xxs: '.5rem',
      xs: '.75rem',
      sm: '1rem',
      base: '1.2rem',
      lg: '1.3rem',
      xl: '1.5rem',
      '2xl': '1.8rem',
      '3xl': '2rem',
      '4xl': '3rem',
      '5xl': '4rem',
      '6xl': '4.5rem',
    }
  },
  plugins: [
    forms
  ],
}
