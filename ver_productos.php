<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el usuario está autenticado y obtener el ID de MyPIME
session_start();
if (!isset($_SESSION['id_mypime']) || empty($_SESSION['id_mypime'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_mypime.html");
    exit();
}

// Obtener el ID de MyPIME de la sesión
$id_mypime = $_SESSION['id_mypime'];

// Consulta para obtener los productos asociados al ID de MyPIME
$query = "SELECT * FROM tbl_products WHERE id_mypime = $id_mypime";
$result = mysqli_query($conexion, $query);

// Verificar si hay productos
if (mysqli_num_rows($result) > 0) {
    // Mostrar la lista de productos en una tabla
    echo "<h1>Productos de MyPIME</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID Producto</th><th>Nombre Producto</th><th>Precio Producto</th><th>Descripción</th><th>Acciones</th></tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_product'] . "</td>";
        echo "<td>" . $row['nombre_product'] . "</td>";
        echo "<td>" . $row['price_product'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td><a href='editar_producto.php?id=" . $row['id_product'] . "'>Editar</a> | <a href='eliminar_producto.php?id=" . $row['id_product'] . "'>Eliminar</a></td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No hay productos disponibles.";
}

// Cerrar conexión
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ver Productos</title>
</head>
<body>
    <p><a href="dashboard_mypime.php">Volver al Dashboard</a></p>
    <p><a href="logout.php">Cerrar Sesión</a></p>
</body>
</html>
