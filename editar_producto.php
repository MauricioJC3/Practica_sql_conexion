<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si se ha proporcionado un ID de producto para editar
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Query para obtener la información del producto
    $query = "SELECT * FROM tbl_products WHERE id_product = $id_producto";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Formulario para editar el producto
        echo "<h1>Editar Producto</h1>";
        echo "<form action='actualizar_producto.php' method='POST'>";
        echo "ID Producto: <input type='text' name='id_producto' value='" . $row['id_product'] . "' readonly><br><br>";
        echo "Nombre Producto: <input type='text' name='nombre_producto' value='" . $row['nombre_product'] . "'><br><br>";
        echo "Precio Producto: <input type='text' name='precio_producto' value='" . $row['price_product'] . "'><br><br>";
        echo "Descripción: <textarea name='descripcion'>" . $row['description'] . "</textarea><br><br>";
        echo "<input type='submit' value='Actualizar Producto'>";
        echo "</form>";
    } else {
        echo "No se encontró el producto.";
    }
} else {
    echo "ID de producto no proporcionado.";
}

// Cerrar conexión
mysqli_close($conexion);
?>
