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
<html>
<head>
    <title>Finalizar Compra</title>
</head>
<body>
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

    <!-- Formulario para finalizar compra -->
    <form action="procesar_orden.php" method="POST">

<!-- Campo oculto para el ID del producto -->
<?php
// Verificar si el carrito tiene al menos un producto
if (!empty($productos_carrito)) {
    // Obtener el ID del primer producto en el carrito
    $producto_id = $productos_carrito[0]['id_product'];
    // Imprimir el campo oculto con el ID del producto
    echo '<input type="hidden" name="id_product" value="' . $producto_id . '">';
}
?>

<input type="hidden" name="nit_mypime" value="<?php echo $nit_mypime; ?>">


        <!-- Campos para detalles de envío y pago -->
        <label for="nombre">Nombre:</label>
<input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION['user_name'] . ' ' . $_SESSION['user_lastname']; ?>" required><br><br>

<label for="numero">Número de Teléfono:</label>
<input type="text" id="numero" name="numero" value="<?php echo $_SESSION['user_phone']; ?>" required><br><br>

<label for="email">Correo Electrónico:</label>
<input type="email" id="email" name="email" value="<?php echo $_SESSION['user_email']; ?>" required><br><br>


        <label for="direccion">Dirección de Envío:</label>
        <textarea id="direccion" name="direccion" required></textarea><br><br>

        <input type="submit" value="Finalizar Compra">
    </form>

</body>
</html>
