<?php
session_start();

// Verificar si el usuario está autenticado y obtener el NIT de la MyPIME
if (!isset($_SESSION['id_mypime']) || empty($_SESSION['id_mypime'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_mypime.html");
    exit();
}

$id_mypime = $_SESSION['id_mypime']; // Obtener el NIT de la MyPIME de la sesión
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario para Ingresar Productos</title>
</head>

        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #333;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</style>
<body>
<h1>Ingrese un nuevo producto</h1>
    <form action="insert_producto.php" method="POST" enctype="multipart/form-data">
        Mypime NIT: <input type="text" name="id_mypime" value="<?php echo $id_mypime; ?>" readonly><br><br>
        Nombre Producto: <input type="text" name="nombre_producto" required><br><br>
        Precio Producto: <input type="text" name="price_producto" required><br><br>
        Descripción: <textarea name="descripcion" rows="4" cols="50" required></textarea><br><br>
        Imagen del Producto: <input type="file" name="imagen_producto" accept="image/*" required><br><br>
        <input type="submit" value="Agregar Producto">
    </form>
    <a href="dashboard_mypime.php">volver a inicio</a>
</body>
</html>
