/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    // Kode Untuk mengaktifkan plugin form
    require('@tailwindcss/forms'),
  ],

}
