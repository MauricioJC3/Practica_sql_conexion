/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{php,html,js}"],
  theme: {
    fontFamily: {
      'bebas': ['Bebas Neue', 'sans-serif'],
    },
    extend: {
      backgroundImage: {
        "close-menu": "url('../img/cerrar.png')",
        "open-menu": "url('../img/menu.png')",
        'fondo': 'url("../img/fondoo.jpg")',
        'iconu': 'url("../img/usuario.png")',
        'iconp': 'url("../img/contraseña.png")',
        'fondom': 'url("../img/fondomy.png")',
        'hambu': 'url("../img/hambu.jpg")',
        'haamm': 'url("../img/haamm.jpg")',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0', transform: 'translateY(10px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        }
      },
      animation: {
        fadeIn: 'fadeIn 1s ease-out forwards',
      }
    },
  },
  plugins: [],
}