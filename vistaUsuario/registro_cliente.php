<!DOCTYPE html>
<html>
<head>
    <title>Registro Cliente</title>
</head>
<body>
    <h2>Registro Cliente</h2>
    <?php
    session_start();
    // Mostrar mensajes de éxito o error
    if (isset($_SESSION['success_registro'])) {
        echo "<p style='color:green'>" . $_SESSION['success_registro'] . "</p>";
        unset($_SESSION['success_registro']);
    }
    if (isset($_SESSION['error_registro'])) {
        echo "<p style='color:red'>" . $_SESSION['error_registro'] . "</p>";
        unset($_SESSION['error_registro']);
    }
    ?>
    <form action="register_cliente.php" method="POST">
        <label for="nombre_cli">Nombre:</label><br>
        <input type="text" id="nombre_cli" name="nombre_cli" required><br><br>

        <label for="apellidos_cli">Apellidos:</label><br>
        <input type="text" id="apellidos_cli" name="apellidos_cli" required><br><br>

        <label for="direccion_cli">Dirección:</label><br>
        <input type="text" id="direccion_cli" name="direccion_cli" required><br><br>

        <label for="telefono_cli">Teléfono:</label><br>
        <input type="text" id="telefono_cli" name="telefono_cli" required><br><br>

        <label for="correo_cli">Correo:</label><br>
        <input type="email" id="correo_cli" name="correo_cli" required><br><br>

        <label for="contraseña">Contraseña:</label><br>
        <input type="password" id="contraseña" name="contraseña" required><br><br>

        <label for="genero_cli">Género:</label><br>
        <select id="genero_cli" name="genero_cli" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
        </select><br><br>

        <label for="fecha_nac_cli">Fecha de Nacimiento:</label><br>
        <input type="date" id="fecha_nac_cli" name="fecha_nac_cli" required><br><br>

        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
