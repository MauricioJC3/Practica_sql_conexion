<?php
session_start();

// Destruir todas las variables de sesión
session_destroy();

// Redireccionar al formulario de login
header("Location: login_mypime.html"); // Ruta actualizada
exit();
?>
