/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      './resources/views/**/*.blade.php',
      './resources/js/components/**/*.vue',
  ],
  theme: {
      extend: {
          container: {
              center: true,
          },
          screens: {
              'xl': '1200px',
          },
          colors: {
              'secondary': '#7688b3',
              'light-gray': '#f1f1f1',
              'page': '#22272e',
          },
      },
  },
  plugins: [],
}

