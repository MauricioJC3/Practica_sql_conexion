<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Navbar</title>
<style>
        /* Estilos para el navbar vertical */
        .navbar {
            width: 200px;
            height: 100%;
            position: fixed;
            top: 0;
            left: -200px;
            background-color: #333;
            transition: 0.5s;
            padding-top: 60px; /* Ajuste para que el texto no se vea tapado */
        }

        .navbar.open {
            left: 0;
        }

        .navbar ul {
            list-style-type: none;
            padding: 0;
        }

        .navbar li {
            padding: 10px 0;
            text-align: center;
        }

        .navbar a {
            text-decoration: none;
            color: #fff;
            display: block;
        }

        .navbar a:hover {
            background-color: #555;
        }
</style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <ul>
            <li><a href="index.php">Ingresar Productos</a></li>
            <li><a href="ver_productos.php">Ver Productos</a></li>
            <li><a href="ver_pedidos.php">Ver Pedidos</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </div>

        <!-- Botón para abrir el navbar -->
        <div class="open-btn" onclick="toggleNavbar()">☰</div>


    <script>
    function toggleNavbar() {
        var navbar = document.querySelector('.navbar');
        if (navbar.classList.contains('open')) {
            navbar.classList.remove('open');
        } else {
            navbar.classList.add('open');
        }
    }
</script>

</body>
</html>
