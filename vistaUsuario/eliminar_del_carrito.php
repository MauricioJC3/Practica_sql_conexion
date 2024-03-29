<?php
session_start();

// Verificar si el ID del producto se ha pasado por GET
if (isset($_GET['id'])) {
    $id_cart = $_GET['id'];

    // Verificar si existe $_SESSION['carrito'] y es un array
    if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
        // Buscar el índice del producto en el carrito
        $index = array_search($id_cart, array_column($_SESSION['carrito'], 'id_cart'));

        // Si se encuentra, eliminar el producto del carrito
        if ($index !== false) {
            unset($_SESSION['carrito'][$index]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el array
        }
    }

    // Redirigir de vuelta a la página de carrito
    header("Location: ver_carrito.php");
    exit();
} else {
    // Si no se proporciona un ID de producto, redirigir a la página de carrito
    header("Location: ver_carrito.php");
    exit();
}
?>
