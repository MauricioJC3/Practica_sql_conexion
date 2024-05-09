<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
  <style>

  body {
    margin: 0;
    padding: 0;
  }

nav {
  background-color: #333;
  color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

nav ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
  display: flex;
}

nav ul li {
  margin-right: 20px;
}

nav ul li:last-child {
  margin-right: 0;
}

nav ul li a {
  color: #fff;
  text-decoration: none;
  padding: 10px 20px; /* Añadir padding para hacer los enlaces más grandes */
  transition: background-color 0.3s; /* Agregar transición para el cambio de color al pasar el mouse */
}

nav ul li a:hover {
  background-color: #555; /* Cambiar el color de fondo al pasar el mouse */
  text-decoration: none;
}

/* Estilos para el botón de perfil y cerrar sesión */
.dropdown {
  float: right;
  position: relative;
}

.dropdown .dropbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: white;
  padding: 10px 20px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #333;
  min-width: 160px;
  z-index: 1;
  right: 0;
}

.dropdown-content a {
  float: none;
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #555;
}

.dropdown:hover .dropdown-content {
  display: block;
}

@media screen and (max-width: 600px) {
  nav ul {
    display: none;
  }
  .icon {
    display: block;
  }
  .icon a {
    float: none;
    display: block;
    text-align: left;
  }
}

  </style>
</head>
<body>
  <!-- Navbar -->
  <nav>
    <ul>
      <li><a href="panel_administracion.php">Panel de Administración</a></li>
      <li><a href="estadisticas.php">Estadísticas</a></li>
      <li><a href="mypimes.php">MYPIMES</a></li>
      <li><a href="productos.php">Productos</a></li>
    </ul>
    <div class="dropdown">
      <button class="dropbtn">Perfil ▼</button>
      <div class="dropdown-content">
        <a href="#">Editar Perfil</a>
        <a href="borrar_sesion.php">Cerrar Sesión</a>
      </div>
    </div>
  </nav>

  <!-- Contenido de la página -->
  <div>
    <!-- Aquí colocarías el contenido específico de cada página -->
  </div>

  <!-- Script para hacer el navbar responsive -->
  <script>
    function myFunction() {
      var x = document.querySelector("nav ul");
      if (x.style.display === "block") {
        x.style.display = "none";
      } else {
        x.style.display = "block";
      }
    }
  </script>
</body>
</html>
