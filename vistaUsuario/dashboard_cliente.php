<?php
session_start();

// Verificar si el cliente está autenticado y obtener su ID
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_cliente.php");
    exit();
}

$id_cliente = $_SESSION['user_id']; // Obtener el ID del cliente de la sesión
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Cliente</title>
</head>
<body>

<?php include 'tommic/header.php'; ?>


    <h1>Bienvenido, <?php echo $_SESSION['nombre_cliente']; ?>!</h1>
    <p>Este es tu panel de control.</p>
    
    <!-- Aquí puedes mostrar la información del cliente, pedidos, etc. -->

</body>
</html>
