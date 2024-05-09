<?php
// Verificar si el cliente está autenticado
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
  // Si no está autenticado, redirigir al formulario de inicio de sesión
  header("Location: login_cliente.php");
  exit();
}

// Obtener los productos en el carrito del cliente
if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
  $productos_carrito = $_SESSION['carrito'];
} else {
  $productos_carrito = [];
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Carrito</title>
  <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<?php include 'tommic/header.php'; ?>

<h2 class="text-center text-3xl font-bold mt-8">Productos en el Carrito</h2>
<div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mx-auto mt-8">
  <?php
    foreach ($productos_carrito as $producto) {
      echo "<div class='card bg-white rounded-lg shadow-md p-4'>";
      echo "<h3>" . $producto['nombre_product'] . "</h3>";
      echo "<p class='text-gray-700'>$" . $producto['price_product'] . "</p>";
      echo "<p class='text-gray-500'>Cantidad: " . $producto['quantity'] . "</p>";
      echo "<a class='remove-from-cart block text-center text-white font-bold bg-red-500 hover:bg-red-600 rounded-md p-2 mt-4' href='eliminar_del_carrito.php?id=" . $producto['id_cart'] . "'>Eliminar del Carrito</a>";
      echo "</div>";
    }
  ?>
</div>
<div class="footer flex justify-center mt-8">
  <p><a href="ver_productos.php" class="text-blue-500 hover:underline">Seguir Comprando</a></p>
  <p><a href="finalizar_compra.php" class="text-blue-500 hover:underline">Finalizar Compra</a></p>
</div>
<?php include 'tommic/fother.php'; ?>
</body>
</html>