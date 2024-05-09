<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}

// Incluir archivo de conexión
include '../conexion.php';

// Obtener el ID del usuario de la sesión
$user_id = $_SESSION['user_id'];

// Consulta SQL para seleccionar los datos del usuario
$query = "SELECT * FROM tbl_cliente WHERE user_id = $user_id";
$result = mysqli_query($conexion, $query);

// Verificar si se encontraron resultados
if (mysqli_num_rows($result) > 0) {
    // Obtener los datos del usuario
    $row = mysqli_fetch_assoc($result);

    // Guardar los datos del usuario en variables
    $nombre = $row['nombre_cli'];
    $apellidos = $row['apellidos_cli'];
    $direccion = $row['direccion_cli'];
    $telefono = $row['telefono_cli'];
    $correo = $row['correo_cli'];
    $genero = $row['genero_cli'];
    $fecha_nacimiento = $row['fecha_nac_cli'];
} else {
    // Si no se encontraron resultados, puedes manejarlo de alguna manera adecuada
    // Por ejemplo, redirigir al usuario a una página de error o mostrar un mensaje de que no se encontraron datos
}

// Cerrar conexión
mysqli_close($conexion);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }
        .profile-info p {
            display: inline-block;
            margin: 0;
            color: #555;
        }
        .btn-edit-profile {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .btn-edit-profile:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'tommic/header.php'; ?>
<br>
<br>
<h2>Perfil de Usuario</h2>
<div class="container">

        <div class="profile-info">
            <label for="nombre">Nombre:</label>
            <p><?php echo isset($nombre) ? $nombre : ''; ?></p>
        </div>
        <div class="profile-info">
            <label for="apellidos">Apellidos:</label>
            <p><?php echo isset($apellidos) ? $apellidos : ''; ?></p>
        </div>
        <div class="profile-info">
            <label for="direccion">Dirección:</label>
            <p><?php echo isset($direccion) ? $direccion : ''; ?></p>
        </div>
        <div class="profile-info">
            <label for="telefono">Teléfono:</label>
            <p><?php echo isset($telefono) ? $telefono : ''; ?></p>
        </div>
        <div class="profile-info">
            <label for="correo">Correo Electrónico:</label>
            <p><?php echo isset($correo) ? $correo : ''; ?></p>
        </div>
        <div class="profile-info">
            <label for="genero">Género:</label>
            <p><?php echo isset($genero) ? $genero : ''; ?></p>
        </div>
        <div class="profile-info">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <p><?php echo isset($fecha_nacimiento) ? $fecha_nacimiento : ''; ?></p>
        </div>
        <a href="editar_perfil.php" class="btn-edit-profile">Editar Perfil</a>
    </div>
</body>
</html>
