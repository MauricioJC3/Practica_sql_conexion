<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Navbar</title>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .navbar {
        background-color: #333;
        overflow: hidden;
    }

    .navbar a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }

    .navbar a.active {
        background-color: #04AA6D;
        color: white;
    }

    @media screen and (max-width: 600px) {
        .navbar a {
            float: none;
            display: block;
            text-align: left;
        }
    }
</style>
</head>
<body>

<div class="navbar">
    <a href="ver_productos.php">Ver Productos</a>
    <a href="perfil_usuario.php">Perfil</a>
    <a href="ver_pedidos_usuario.php">Ver Pedidos</a>
    <a href="logout_cliente.php">Cerrar Sesión</a>
</div>

</body>
</html>
