<?php
// Verificar si el usuario está autenticado
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_cliente.php");
    exit();
}

// Obtener los productos en el carrito (asumiendo que los IDs están en $_SESSION['carrito'])
$productos_carrito = []; // Aquí deberías obtener los detalles de los productos desde la base de datos usando los IDs guardados en $_SESSION['carrito']

// Calcular el total de la compra
$total = 0;
foreach ($productos_carrito as $producto) {
    $total += $producto['precio_producto'] * $producto['cantidad'];
}

// Aquí puedes procesar la orden y enviarla al MyPIME correspondiente
// Por ahora, simplemente mostraremos un resumen y el total
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
            <?php echo $producto['nombre_producto']; ?> -
            <?php echo $producto['precio_producto']; ?> -
            Cantidad: <?php echo $producto['cantidad']; ?>
        </li>
    <?php endforeach; ?>
    </ul>
    <p>Total: <?php echo $total; ?></p>

    <!-- Aquí puedes agregar un formulario para que el usuario ingrese detalles de envío y pago -->
<!-- finalizar_compra.php -->
<form action="procesar_orden.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="numero">Número de Teléfono:</label>
    <input type="text" id="numero" name="numero" required><br><br>

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="direccion">Dirección de Envío:</label>
    <textarea id="direccion" name="direccion" required></textarea><br><br>

    <input type="submit" value="Finalizar Compra">
</form>

</body>
</html>
