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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Productos en el Carrito</h2>
<table>
  <tr>
    <th>ID Producto</th>
    <th>Nombre Producto</th>
    <th>Precio Producto</th>
    <th>Cantidad</th>
    <th>Acciones</th>
  </tr>
  <?php
    foreach ($productos_carrito as $producto) {
        echo "<tr>";
        echo "<td>" . $producto['id_product'] . "</td>";
        echo "<td>" . $producto['nombre_product'] . "</td>";
        echo "<td>" . $producto['price_product'] . "</td>";
        echo "<td>" . $producto['quantity'] . "</td>";
        echo "<td><a href='eliminar_del_carrito.php?id=" . $producto['id_cart'] . "'>Eliminar</a></td>";
        echo "</tr>";
    }
  ?>
</table>

<p><a href="ver_productos.php">Seguir Comprando</a></p>
<br>
<p><a href="finalizar_compra.php">Finalizar Compra</a></p>

</body>
</html>
