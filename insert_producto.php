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

// Query para insertar el producto en la base de datos
$query = "INSERT INTO tbl_products (id_mypime, nombre_product, price_product, description) VALUES ('$id_mypime', '$nombre_producto', '$precio_producto', '$descripcion')";

if (mysqli_query($conexion, $query)) {
    // Producto insertado correctamente, redirigir al dashboard
    header("Location: dashboard_mypime.php");
    exit();
} else {
    // Error al insertar producto, redirigir al dashboard con mensaje de error
    $_SESSION['error_insert'] = "Error al insertar el producto.";
    header("Location: dashboard_mypime.php");
    exit();
}

// Cerrar conexión
mysqli_close($conexion);
?>
