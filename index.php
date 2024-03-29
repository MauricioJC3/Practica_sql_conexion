<?php
session_start();

// Verificar si el usuario está autenticado y obtener el NIT de la MyPIME
if (!isset($_SESSION['id_mypime']) || empty($_SESSION['id_mypime'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_mypime.html");
    exit();
}

$id_mypime = $_SESSION['id_mypime']; // Obtener el NIT de la MyPIME de la sesión
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario para Ingresar Productos</title>
</head>
<body>
    <h1>Ingrese un nuevo producto</h1>
    <form action="insert_producto.php" method="POST">
        MyPIME NIT: <input type="text" name="id_mypime" value="<?php echo $id_mypime; ?>" readonly><br><br>
        Nombre Producto: <input type="text" name="nombre_producto" required><br><br>
        Precio Producto: <input type="text" name="price_producto" required><br><br>
        Descripción: <textarea name="descripcion" rows="4" cols="50" required></textarea><br><br>
        <input type="submit" value="Agregar Producto">
    </form>
    <a href="ingresar_mypimes.html">insert micro</a>

    <a href="dashboard_mypime.php">das</a>
</body>
</html>
