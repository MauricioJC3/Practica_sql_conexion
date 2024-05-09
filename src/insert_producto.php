<?php
session_start();

// Verificar si el usuario está autenticado y obtener el NIT de la MyPIME
if (!isset($_SESSION['id_mypime']) || empty($_SESSION['id_mypime'])) {
  // Si no está autenticado, redirigir al formulario de inicio de sesión
  header("Location: login_mypime.html");
  exit();
}

// Incluir archivo de conexión
include 'conexion.php';

// Obtener los datos del formulario
$id_mypime = $_SESSION['id_mypime'];
$nombre_producto = $_POST['nombre_producto'];
$precio_producto = $_POST['price_producto'];
$descripcion = $_POST['descripcion'];

// Procesar la imagen del producto
$imagen_nombre = $_FILES['imagen_producto']['name']; // Nombre del archivo
$imagen_temporal = $_FILES['imagen_producto']['tmp_name']; // Nombre temporal del archivo
$carpeta_destino = "imagenes_productos/"; // Carpeta donde se guardarán las imágenes

// Mover la imagen a la carpeta destino
if (move_uploaded_file($imagen_temporal, $carpeta_destino . $imagen_nombre)) {
    // La imagen se ha subido correctamente, ahora puedes insertar el producto en la base de datos
    // Query para insertar el producto en la base de datos (incluyendo el nombre de la imagen)
    $query = "INSERT INTO tbl_products (id_mypime,nombre_product, price_product, description, image) VALUES ('$id_mypime','$nombre_producto', '$precio_producto', '$descripcion', '$imagen_nombre')";

    if (mysqli_query($conexion, $query)) {
        // Producto insertado correctamente, redirigir a donde sea necesario
        header("Location: dashboard_mypime.php");
        exit();
    } else {
        // Error al insertar producto, manejar el error según sea necesario
        echo "Error al insertar el producto en la base de datos.";
    }
} else {
    // Error al subir la imagen, manejar el error según sea necesario
    echo "Error al subir la imagen del producto.";
}

// Cerrar conexión
mysqli_close($conexion);
?>
