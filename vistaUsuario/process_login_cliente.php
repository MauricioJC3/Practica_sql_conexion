<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos del formulario están seteados y no están vacíos
    if (isset($_POST['correo_cli'], $_POST['contraseña'])) {
        // Incluir archivo de conexión
        include '../conexion.php';

        // Recibir datos del formulario
        $correo_cli = mysqli_real_escape_string($conexion, $_POST['correo_cli']);
        $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseña']);

        // Consulta para verificar las credenciales en la tabla tbl_cliente
        $query = "SELECT * FROM tbl_cliente WHERE correo_cli = '$correo_cli' AND contraseña = '$contraseña'";

        $resultado = mysqli_query($conexion, $query);

        if (mysqli_num_rows($resultado) == 1) {
            // Credenciales válidas, iniciar sesión
            $row = mysqli_fetch_assoc($resultado);

            // Guardar datos en la sesión
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['nombre_cliente'] = $row['nombre_cli'];

            // Redireccionar al dashboard del cliente o alguna otra página
            $_SESSION['success_login'] = "Inicio de sesión exitoso.";
            header("Location: dashboard_cliente.php");
            exit();
        } else {
            // Credenciales inválidas, redirigir al formulario de login con mensaje de error
            $_SESSION['error_login'] = "Correo o contraseña incorrectos.";
            header("Location: login_cliente.php");
            exit();
        }

        // Cerrar conexión
        mysqli_close($conexion);
    } else {
        // Campos no enviados, redirigir al formulario de login con mensaje de error
        $_SESSION['error_login'] = "Por favor, complete todos los campos.";
        header("Location: login_cliente.php");
        exit();
    }
} else {
    // Redirigir al formulario de login si se intenta acceder directamente al script
    header("Location: login_cliente.php");
    exit();
}
?>
