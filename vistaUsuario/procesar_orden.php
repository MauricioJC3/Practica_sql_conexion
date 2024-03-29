<?php
// Incluir archivo de conexión
include '../conexion.php';

// Verificar si el cliente está autenticado
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_cliente.php");
    exit();
}

// Verificar si se envió el formulario de finalizar compra
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['direccion'])) {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $id_product = $_POST['id_product']; // Obtener ID de producto desde el formulario

    // Obtener los productos en el carrito (asumiendo que los IDs están en $_SESSION['carrito'])
    $productos_carrito = $_SESSION['carrito'];

    // Calcular el total de la compra y la cantidad total de productos
    $total = 0;
    $total_productos = 0;
    $nombres_productos = array(); // Array para almacenar los nombres de los productos
    foreach ($productos_carrito as $producto) {
        $total += $producto['price_product'] * $producto['quantity'];
        $total_productos += $producto['quantity'];
        $nombres_productos[] = $producto['nombre_product']; // Agregar nombre del producto al array
    }

    // Construir la cadena de nombres de los productos separados por comas
    $product_names = implode(", ", $nombres_productos);

    // Insertar la orden en la base de datos del cliente
    $cliente_id = $_SESSION['user_id'];
    $placed_on = date("Y-m-d H:i:s"); // Fecha actual
    $query_insertar_orden = "INSERT INTO tbl_orders (user_id, name_user, number_user, email_user, method, address_user, total_products, total_price, placed_on, status, product_names, id_product) 
                             VALUES ('$cliente_id', '$nombre', '$numero', '$email', 'metodo_pago', '$direccion', '$total_productos', '$total', '$placed_on', 'pendiente', '$product_names', '$id_product')";

    if (mysqli_query($conexion, $query_insertar_orden)) {
        // Obtener el ID de la orden recién insertada
        $orden_id = mysqli_insert_id($conexion);

        // Ahora debes insertar los detalles de los productos en la tabla tbl_order_details
        foreach ($productos_carrito as $producto) {
            $producto_id = $producto['id_product'];
            $cantidad = $producto['quantity'];
            $precio = $producto['price_product'];

            $query_insertar_detalle = "INSERT INTO tbl_order_details (id_order, id_product, united_price, quantity) 
                                       VALUES ('$orden_id', '$producto_id', '$precio', '$cantidad')";
            mysqli_query($conexion, $query_insertar_detalle);
        }

        // Limpiar el carrito después de procesar la orden
        unset($_SESSION['carrito']);

        // Aquí podrías enviar notificaciones al cliente sobre la nueva orden

        // Redirigir a una página de confirmación o a donde desees
        header("Location: ver_productos.php");
        exit();
    } else {
        echo "Error al procesar la orden: " . mysqli_error($conexion);
    }
} else {
    // Si no se envió el formulario, redirigir a la página de finalizar compra
    header("Location: finalizar_compra.php");
    exit();
}

// Cerrar conexión
mysqli_close($conexion);
?>
