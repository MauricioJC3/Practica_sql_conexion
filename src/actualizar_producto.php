<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $nombre_producto = $_POST['nombre_producto'];
    $precio_producto = $_POST['precio_producto'];
    $descripcion = $_POST['descripcion'];

    // Obtener el nombre de la imagen anterior
    $query_imagen_anterior = "SELECT image FROM tbl_products WHERE id_product = $id_producto";
    $result_imagen_anterior = mysqli_query($conexion, $query_imagen_anterior);

    if ($result_imagen_anterior && mysqli_num_rows($result_imagen_anterior) > 0) {
        $row_imagen_anterior = mysqli_fetch_assoc($result_imagen_anterior);
        $imagen_anterior = $row_imagen_anterior['image'];

        // Procesar la imagen si se proporcionó una nueva
        if ($_FILES['imagen']['name']) {
            $nombre_archivo = $_FILES['imagen']['name'];

            // Carpeta de destino para guardar la imagen
            $ruta_destino = 'imagenes_productos/' . $nombre_archivo;

            // Mover el archivo cargado a la carpeta de destino
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
                // Eliminar la imagen anterior del sistema de archivos
                if ($imagen_anterior && file_exists('imagenes_productos/' . $imagen_anterior)) {
                    unlink('imagenes_productos/' . $imagen_anterior);
                }

                // Actualizar el campo de imagen en la base de datos con el nombre de archivo
                $query = "UPDATE tbl_products SET nombre_product = '$nombre_producto', price_product = '$precio_producto', description = '$descripcion', image = '$nombre_archivo' WHERE id_product = $id_producto";

                if (mysqli_query($conexion, $query)) {
                    echo "Producto actualizado exitosamente.";
                } else {
                    echo "Error al actualizar el producto: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al mover el archivo a la carpeta de destino.";
            }
        } else {
            // Si no se proporcionó una nueva imagen, actualizar solo los otros campos
            $query = "UPDATE tbl_products SET nombre_product = '$nombre_producto', price_product = '$precio_producto', description = '$descripcion' WHERE id_product = $id_producto";

            if (mysqli_query($conexion, $query)) {
                echo "Producto actualizado exitosamente.";
            } else {
                echo "Error al actualizar el producto: " . mysqli_error($conexion);
            }
        }
    } else {
        echo "No se encontró la imagen anterior del producto.";
    }

    // Redireccionar de regreso a la página de ver_productos.php
    header("Location: ver_productos.php");
    exit();
} else {
    echo "Acceso no permitido.";
}
?>
