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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $producto_id = $_GET['id'];
    $cliente_id = $_SESSION['user_id'];

    // Obtener información del producto
    $query_producto = "SELECT * FROM tbl_products WHERE id_product = $producto_id";
    $resultado_producto = mysqli_query($conexion, $query_producto);

    if (mysqli_num_rows($resultado_producto) == 1) {
        $producto = mysqli_fetch_assoc($resultado_producto);

        // Agregar el producto al carrito
        $nuevo_producto = [
            'id_cart' => $producto['id_product'], // Usamos el ID del producto como ID del carrito (puede ajustarse según necesites)
            'id_product' => $producto['id_product'],
            'nombre_product' => $producto['nombre_product'],
            'price_product' => $producto['price_product'],
            'quantity' => 1, // Cantidad inicial
            'description' => $producto['description'] // Si necesitas la descripción en el carrito
        ];

        // Verificar si $_SESSION['carrito'] ya existe y es un array
        if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
            // Verificar si el producto ya está en el carrito, si lo está, aumentar la cantidad
            $index = array_search($producto_id, array_column($_SESSION['carrito'], 'id_product'));
            if ($index !== false) {
                $_SESSION['carrito'][$index]['quantity']++;
            } else {
                // Si no está en el carrito, agregarlo
                $_SESSION['carrito'][] = $nuevo_producto;
            }
        } else {
            // Si $_SESSION['carrito'] no existe o no es un array, crearlo y agregar el producto
            $_SESSION['carrito'] = [$nuevo_producto];
        }

        // Mensaje de éxito
        echo "Producto agregado al carrito.";

        // Redirigir de vuelta a la página de productos
        header("Location: ver_productos.php");
        exit();
    } else {
        echo "Producto no encontrado.";
    }
} else {
    echo "ID de producto no proporcionado.";
}

// Cerrar conexión
mysqli_close($conexion);
?>
