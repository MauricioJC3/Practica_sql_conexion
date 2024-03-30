<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos del formulario están seteados y no están vacíos
    if (isset($_POST['user_mypime']) && !empty($_POST['user_mypime']) && isset($_POST['password_mypime']) && !empty($_POST['password_mypime'])) {
        // Incluir archivo de conexión
        include 'conexion.php';

        // Recibir datos del formulario
        $user_mypime = mysqli_real_escape_string($conexion, $_POST['user_mypime']);
        $password_mypime = mysqli_real_escape_string($conexion, $_POST['password_mypime']);

        // Consulta para verificar las credenciales en la tabla tbl_mypimes
        $query = "SELECT * FROM tbl_mypimes WHERE user_mypime = '$user_mypime' AND password_mypime = '$password_mypime'";

        $resultado = mysqli_query($conexion, $query);

        if (mysqli_num_rows($resultado) == 1) {
            // Credenciales válidas
            $row = mysqli_fetch_assoc($resultado);

            // Guardar datos en la sesión
            $_SESSION['id_mypime'] = $row['nit_mypime'];
            $_SESSION['nombre_mypime'] = $row['name_mypime'];

            // Redireccionar al dashboard o alguna otra página
            header("Location: dashboard_mypime.php"); // Ruta actualizada
            exit();
        } else {
            // Credenciales inválidas, redirigir al formulario de inicio de sesión con mensaje de error
            $_SESSION['error_login'] = "Usuario o contraseña incorrectos.";
            header("Location: login_mypime.html"); // Ruta actualizada
            exit();
        }

        // Cerrar conexión
        mysqli_close($conexion);
    } else {
        // Campos no enviados, redirigir al formulario de inicio de sesión con mensaje de error
        $_SESSION['error_login'] = "Por favor, complete todos los campos.";
        header("Location: login_mypime.html"); // Ruta actualizada
        exit();
    }
} else {
    // Redirigir al formulario de inicio de sesión si se intenta acceder directamente al script
    header("Location: login_mypime.html"); // Ruta actualizada
    exit();
}
?>
