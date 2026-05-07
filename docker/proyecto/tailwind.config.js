/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class', // Esto es vital para que tu botón de Modo Claro/Oscuro funcione
  theme: {
    extend: {
      colors: {
        // Aquí podrías definir colores personalizados si los necesitas
      },
    },
  },
  plugins: [],
}