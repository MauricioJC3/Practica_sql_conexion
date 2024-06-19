/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{php,html,js}"],
  theme: { 
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
    },
  },
  plugins: [],
}

