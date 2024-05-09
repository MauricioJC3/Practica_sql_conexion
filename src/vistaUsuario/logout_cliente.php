<?php
// Iniciar sesión
session_start();

// Destruir todas las variables de sesión
session_destroy();

// Redireccionar al formulario de login del cliente
header("Location: login_cliente.php");
exit();
?>
