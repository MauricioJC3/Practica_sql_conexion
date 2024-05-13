<?php
session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: login_cliente.php");
    exit();
}

include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $user_id = $_POST['user_id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $genero = $_POST['genero'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    // Preparar la consulta SQL para actualizar los datos del usuario
    $query = "UPDATE tbl_cliente SET 
              nombre_cli = '$nombre', 
              apellidos_cli = '$apellidos', 
              direccion_cli = '$direccion', 
              telefono_cli = '$telefono', 
              correo_cli = '$correo', 
              genero_cli = '$genero', 
              fecha_nac_cli = '$fecha_nacimiento' 
              WHERE user_id = $user_id";

    if (mysqli_query($conexion, $query)) {
        // Redirigir al usuario a su perfil después de actualizar la información
        header("Location: perfil_usuario.php");
        exit();
    } else {
        echo "Error al actualizar la información: " . mysqli_error($conexion);
    }

    // cerrar conexion
    mysqli_close($conexion);
} else {
    // Obtener datos del usuario para mostrar en el formulario
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM tbl_cliente WHERE user_id = $user_id";
    $result = mysqli_query($conexion, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nombre = $row['nombre_cli'];
        $apellidos = $row['apellidos_cli'];
        $direccion = $row['direccion_cli'];
        $telefono = $row['telefono_cli'];
        $correo = $row['correo_cli'];
        $genero = $row['genero_cli'];
        $fecha_nacimiento = $row['fecha_nac_cli'];
    } else {
        echo "Usuario no encontrado o se produjo un error.";
    }
    // cerrar conexion
    mysqli_close($conexion);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Informacion Personal</title>
</head>
<body>
    <h1>Editar Informacion</h1>

    <form method="post">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

        <div class="profile-info">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
        </div>

        <div class="profile-info">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" required>
        </div>

        <div class="profile-info">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" required>
        </div>

        <div class="profile-info">
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>
        </div>

        <div class="profile-info">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required>
        </div>

        <div class="profile-info">
            <label for="genero">Género:</label>
            <select id="genero" name="genero" required>
                <option value="Masculino" <?php echo $genero === "Masculino" ? 'selected' : ''; ?>>Masculino</option>
                <option value="Femenino" <?php echo $genero === "Femenino" ? 'selected' : ''; ?>>Femenino</option>
                <option value="Otro" <?php echo $genero === "Otro" ? 'selected' : ''; ?>>Otro</option>
            </select>
        </div>

        <div class="profile-info">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" required>
        </div>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>