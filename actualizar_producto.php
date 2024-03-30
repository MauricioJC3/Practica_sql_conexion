<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $nombre_producto = $_POST['nombre_producto'];
    $precio_producto = $_POST['precio_producto'];
    $descripcion = $_POST['descripcion'];

    // Query para actualizar el producto
    $query = "UPDATE tbl_products SET nombre_product = '$nombre_producto', price_product = '$precio_producto', description = '$descripcion' WHERE id_product = $id_producto";

    if (mysqli_query($conexion, $query)) {
        echo "Producto actualizado exitosamente.";
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($conexion);
    }

    // Redireccionar de regreso a la página de ver_productos.php
    header("Location: ver_productos.php");
    exit();
} else {
    echo "Acceso no permitido.";
}

// Cerrar conexión
mysqli_close($conexion);
?>
