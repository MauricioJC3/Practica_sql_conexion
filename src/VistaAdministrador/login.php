<?php
// Iniciar la sesión
session_start();

include '../conexion.php';
// Obtener datos del formulario
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Consulta SQL para verificar las credenciales del usuario
$sql = "SELECT * FROM tbl_usuarios WHERE usuario = '$usuario' AND password = '$password'";
$resultado = $conexion->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Inicio de sesión exitoso, redirigir al panel de administración u otra página
    session_start();
    $_SESSION['usuario'] = $usuario;
    header("Location: panel_administracion.php");
} else {
    // Usuario o contraseña incorrectos, redirigir al formulario de inicio de sesión con un mensaje de error
    header("Location: index.php?error=1");
}

// Evitar el almacenamiento en caché
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Cerrar conexión (no es necesario aquí, ya que la conexión se cierra automáticamente al finalizar el script)
?>
