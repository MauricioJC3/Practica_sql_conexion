<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            font-size: 16px;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
        }
        .message.success {
            color: #28a745;
        }
        .message.error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión - Cliente</h2>
        <?php
        session_start();
        // Mostrar mensajes de éxito o error
        if (isset($_SESSION['success_login'])) {
            echo "<p class='message success'>" . $_SESSION['success_login'] . "</p>";
            unset($_SESSION['success_login']);
        }
        if (isset($_SESSION['error_login'])) {
            echo "<p class='message error'>" . $_SESSION['error_login'] . "</p>";
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
    </div>
<html>

