<?php
// Incluir archivo de conexión
include '../conexion.php';

// Iniciar sesión
session_start();

// Verificar si el cliente está autenticado y obtener su ID
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_cliente.php");
    exit();
}

// Consulta para obtener todos los productos
$query = "SELECT * FROM tbl_products";
$result = mysqli_query($conexion, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ver Productos</title>
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
        .add-to-cart {
            display: block;
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 8px 0;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .add-to-cart:hover {
            background-color: #0056b3;
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

<h2>Productos Disponibles</h2>
<div class="container">
    <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card'>";
            echo "<img src='imagen_producto.jpg' alt='Producto'>";
            echo "<h3>" . $row['nombre_product'] . "</h3>";
            echo "<p>$" . $row['price_product'] . "</p>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<a class='add-to-cart' href='agregar_al_carrito.php?id=" . $row['id_product'] . "'>Agregar al Carrito</a>";
            echo "</div>";
        }
    ?>
</div>

<div class="footer">
    <p><a href="ver_carrito.php">Ver Carrito</a></p>
    <p><a href="logout_cliente.php">Cerrar Sesión</a></p>
    <p><a href="dashboard_cliente.php">Inicio</a></p>
</div>

</body>
</html>

<?php
// Cerrar conexión
mysqli_close($conexion);
?>
