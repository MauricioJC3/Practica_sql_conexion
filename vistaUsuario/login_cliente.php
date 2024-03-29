<!DOCTYPE html>
<html>
<head>
    <title>Login Cliente</title>
</head>
<body>
    <h2>Login Cliente</h2>
    <?php
    session_start();
    // Mostrar mensajes de éxito o error
    if (isset($_SESSION['success_login'])) {
        echo "<p style='color:green'>" . $_SESSION['success_login'] . "</p>";
        unset($_SESSION['success_login']);
    }
    if (isset($_SESSION['error_login'])) {
        echo "<p style='color:red'>" . $_SESSION['error_login'] . "</p>";
        unset($_SESSION['error_login']);
    }
    ?>
    <form action="process_login_cliente.php" method="POST">
        <label for="correo_cli">Correo:</label><br>
        <input type="email" id="correo_cli" name="correo_cli" required><br><br>

        <label for="contraseña">Contraseña:</label><br>
        <input type="password" id="contraseña" name="contraseña" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
