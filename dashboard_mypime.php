<?php
session_start();

// Verificar si el usuario está autenticado y obtener el ID de MyPIME
if (!isset($_SESSION['id_mypime']) || empty($_SESSION['id_mypime'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_mypime.html");
    exit();
}

// Incluir archivo de conexión
include 'conexion.php';

// Obtener el ID de MyPIME de la sesión
$id_mypime = $_SESSION['id_mypime'];

// Consulta para obtener los productos asociados al ID de MyPIME
$query = "SELECT * FROM tbl_products WHERE id_mypime = $id_mypime";
$result = mysqli_query($conexion, $query);

// Cerrar conexión
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard MyPIME</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['nombre_mypime']; ?>!</h1>
    <p>Esta es tu página de dashboard.</p>
    
    <!-- Otro contenido del dashboard aquí -->
    
    <p><a href="index.php">ingresar productos</a></p>
    <br>
    <p><a href="logout.php">Cerrar Sesión</a></p>

    <a href="ver_productos.php">ver productos</a>
</body>
</html>
