<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos del formulario están seteados y no están vacíos
    if (isset($_POST['nombre_cli'], $_POST['apellidos_cli'], $_POST['direccion_cli'], $_POST['telefono_cli'], $_POST['correo_cli'], $_POST['contraseña'], $_POST['genero_cli'], $_POST['fecha_nac_cli'])) {
        // Incluir archivo de conexión
        include '../conexion.php';

        // Recibir datos del formulario
        $nombre_cli = mysqli_real_escape_string($conexion, $_POST['nombre_cli']);
        $apellidos_cli = mysqli_real_escape_string($conexion, $_POST['apellidos_cli']);
        $direccion_cli = mysqli_real_escape_string($conexion, $_POST['direccion_cli']);
        $telefono_cli = mysqli_real_escape_string($conexion, $_POST['telefono_cli']);
        $correo_cli = mysqli_real_escape_string($conexion, $_POST['correo_cli']);
        $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseña']);
        $genero_cli = mysqli_real_escape_string($conexion, $_POST['genero_cli']);
        $fecha_nac_cli = mysqli_real_escape_string($conexion, $_POST['fecha_nac_cli']);

        // Consulta para verificar si el correo ya está registrado
        $query_verificar = "SELECT * FROM tbl_cliente WHERE correo_cli = '$correo_cli'";
        $resultado_verificar = mysqli_query($conexion, $query_verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {
            // Correo ya registrado, redirigir al formulario de registro con mensaje de error
            $_SESSION['error_registro'] = "El correo ya está registrado.";
            header("Location: registro_cliente.php");
            exit();
        } else {
            // Correo no registrado, proceder con el registro
            $query_registro = "INSERT INTO tbl_cliente (nombre_cli, apellidos_cli, direccion_cli, telefono_cli, correo_cli, contraseña, genero_cli, fecha_nac_cli) VALUES ('$nombre_cli', '$apellidos_cli', '$direccion_cli', '$telefono_cli', '$correo_cli', '$contraseña', '$genero_cli', '$fecha_nac_cli')";

            if (mysqli_query($conexion, $query_registro)) {
                // Registro exitoso, redirigir al login con mensaje de éxito
                $_SESSION['success_registro'] = "Cliente registrado exitosamente.";
                header("Location: login_cliente.php");
                exit();
            } else {
                // Error en el registro, redirigir al formulario de registro con mensaje de error
                $_SESSION['error_registro'] = "Error al registrar el cliente.";
                header("Location: registro_cliente.php");
                exit();
            }
        }

        // Cerrar conexión
        mysqli_close($conexion);
    } else {
        // Campos no enviados, redirigir al formulario de registro con mensaje de error
        $_SESSION['error_registro'] = "Por favor, complete todos los campos.";
        header("Location: registro_cliente.php");
        exit();
    }
} else {
    // Redirigir al formulario de registro si se intenta acceder directamente al script
    header("Location: registro_cliente.php");
    exit();
}
?>
