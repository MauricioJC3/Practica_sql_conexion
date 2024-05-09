<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si se ha proporcionado un ID de producto para eliminar
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Query para eliminar el producto
    $query = "DELETE FROM tbl_products WHERE id_product = $id_producto";

    if (mysqli_query($conexion, $query)) {
        echo "Producto eliminado exitosamente.";
    } else {
        echo "Error al eliminar el producto: " . mysqli_error($conexion);
    }

    // Redireccionar de regreso a la página de ver_productos.php
    header("Location: ver_productos.php");
    exit();
} else {
    echo "ID de producto no proporcionado.";
}

// Cerrar conexión
mysqli_close($conexion);
?>
