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
        .add-to-cart {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .add-to-cart.disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<h2>Productos Disponibles</h2>
<table>
  <tr>
    <th>ID Producto</th>
    <th>Nombre Producto</th>
    <th>Precio Producto</th>
    <th>Descripción</th>
    <th>Acciones</th>
  </tr>
  <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_product'] . "</td>";
        echo "<td>" . $row['nombre_product'] . "</td>";
        echo "<td>" . $row['price_product'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>";
        echo "<a class='add-to-cart' href='agregar_al_carrito.php?id=" . $row['id_product'] . "'>Agregar al Carrito</a>";
        echo "</td>";
        echo "</tr>";
    }
  ?>
</table>

<p><a href="ver_carrito.php">Ver Carrito</a></p>
<p><a href="logout_cliente.php">Cerrar Sesión</a></p>

</body>
</html>

<?php
// Cerrar conexión
mysqli_close($conexion);
?>
