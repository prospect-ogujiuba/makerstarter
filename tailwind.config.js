/** @type {import('tailwindcss').Config} */
module.exports = {
  corePlugins: {
    preflight: true,
  },
  content: [
    './*.{html,js,cjs,php}',
    './src/**/*.{html,js,cjs,php}',
    './templates/**/*.{html,js,cjs,php}',
  ],
  theme: {
    extend: {
   
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/container-queries'),
  ],
}
