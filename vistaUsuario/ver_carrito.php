<?php
// Verificar si el cliente está autenticado
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_cliente.php");
    exit();
}

// Obtener los productos en el carrito del cliente
if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
    $productos_carrito = $_SESSION['carrito'];
} else {
    $productos_carrito = [];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ver Carrito</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .card {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card img {
            width: 100%;
            border-radius: 8px;
        }
        .card h3 {
            margin-top: 10px;
            color: #333;
        }
        .card p {
            margin-top: 5px;
            color: #666;
        }
        .remove-from-cart {
            display: block;
            width: 100%;
            background-color: #dc3545;
            color: #fff;
            padding: 8px 0;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .remove-from-cart:hover {
            background-color: #c82333;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Productos en el Carrito</h2>
<div class="container">
    <?php
        foreach ($productos_carrito as $producto) {
            echo "<div class='card'>";
            echo "<h3>" . $producto['nombre_product'] . "</h3>";
            echo "<p>$" . $producto['price_product'] . "</p>";
            echo "<p>Cantidad: " . $producto['quantity'] . "</p>";
            echo "<a class='remove-from-cart' href='eliminar_del_carrito.php?id=" . $producto['id_cart'] . "'>Eliminar del Carrito</a>";
            echo "</div>";
        }
    ?>
</div>

<div class="footer">
    <p><a href="ver_productos.php">Seguir Comprando</a></p>
    <p><a href="finalizar_compra.php">Finalizar Compra</a></p>
</div>

</body>
</html>