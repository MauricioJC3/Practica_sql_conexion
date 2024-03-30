<?php
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_cliente.php");
    exit();
}

// Incluir archivo de conexión
include '../conexion.php'; // Asegúrate de reemplazar 'conexion.php' con el nombre de tu archivo de conexión

// Obtener el ID de usuario de la sesión
$user_id = $_SESSION['user_id'];

// Consulta SQL para obtener los datos del usuario
$query = "SELECT * FROM tbl_cliente WHERE user_id = $user_id"; // Utiliza el nombre correcto de la tabla
$resultado = mysqli_query($conexion, $query);

// Verificar si se encontraron resultados
if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Obtener los datos del usuario
    $row = mysqli_fetch_assoc($resultado);
    // Almacenar los datos del usuario en las variables de sesión
    $_SESSION['user_name'] = $row['nombre_cli']; // Utiliza el nombre correcto de la columna
    $_SESSION['user_lastname'] = $row['apellidos_cli']; // Utiliza el nombre correcto de la columna
    $_SESSION['user_email'] = $row['correo_cli']; // Utiliza el nombre correcto de la columna
    $_SESSION['user_phone'] = $row['telefono_cli']; // Utiliza el nombre correcto de la columna
} else {
    // Manejar el caso en que no se encuentren datos del usuario
    echo "Error: No se encontraron datos del usuario.";
    exit();
}

// Verificar si la variable de sesión 'carrito' está definida y es un array
if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
    // Si no hay productos en el carrito, redirigir al usuario a la página de productos
    header("Location: ver_productos.php");
    exit();
}

// Obtener los productos en el carrito
$productos_carrito = $_SESSION['carrito'];

// Calcular el total de la compra
$total = 0;
foreach ($productos_carrito as $producto) {
    $total += $producto['price_product'] * $producto['quantity'];
}

// Ahora puedes mostrar los productos y el total en la página
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            max-width: 1000px;
            margin: 0 auto;
        }
        .summary {
            flex: 1;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
        }
        .summary h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .summary ul {
            list-style-type: none;
            padding: 0;
        }
        .summary ul li {
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .form-container {
            flex: 1;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            font-size: 16px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        textarea {
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
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Finalizar Compra</h2>
            <form action="procesar_orden.php" method="POST">
                <?php if (!empty($productos_carrito)): ?>
                    <input type="hidden" name="id_product" value="<?php echo $productos_carrito[0]['id_product']; ?>">
                <?php endif; ?>

                <input type="hidden" name="nit_mypime" value="<?php echo $nit_mypime; ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION['user_name'] . ' ' . $_SESSION['user_lastname']; ?>" required>

                <label for="numero">Número de Teléfono:</label>
                <input type="text" id="numero" name="numero" value="<?php echo $_SESSION['user_phone']; ?>" required>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="<?php echo $_SESSION['user_email']; ?>" required>

                <label for="direccion">Dirección de Envío:</label>
                <textarea id="direccion" name="direccion" required></textarea>

                <input type="submit" value="Finalizar Compra">
            </form>
        </div>
        <div class="summary">
            <h2>Resumen de la Compra</h2>
            <ul>
                <?php foreach ($productos_carrito as $producto): ?>
                    <li>
                        <?php echo $producto['nombre_product']; ?> -
                        <?php echo $producto['price_product']; ?> -
                        Cantidad: <?php echo $producto['quantity']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p>Total: <?php echo $total; ?></p>
        </div>
    </div>

</body>
</html>
