<?php
// Incluir archivo de conexión
include '../conexion.php';

// Iniciar sesión
session_start();

// Verificar si el cliente está autenticado y obtener su ID
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_cliente.php");
    exit();
}

// Consulta para obtener todos los productos
$query = "SELECT * FROM tbl_products";
$result = mysqli_query($conexion, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos</title>
  <link rel="stylesheet" href="../css/output.css">
</head>
<body>

<?php include 'tommic/header.php'; ?>

<h2 class="text-center mt-8 text-gray-700 font-bold">Productos Disponibles</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center mt-8 m-5">
  <?php
  // Iterar sobre los resultados y mostrar los productos
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='w-80 border border-gray-300 rounded-md m-4 p-4 bg-white shadow-md'>";
    // Verificar si hay una imagen para este producto
    if (!empty($row['image'])) {
      // Construir la URL de la imagen
      $image_url = "../imagenes_productos/" . $row['image'];
      // Mostrar la imagen
      echo "<img src='$image_url' alt='Producto' class='rounded-md w-96 h-80'>";
    } else {
      // Si no hay imagen, mostrar una imagen de marcador de posición
      echo "<img src='placeholder.jpg' alt='Producto' class='rounded-md w-96 h-80'>";
    }
    // Mostrar otros detalles del producto
    echo "<h3 class='mt-2 text-lg font-semibold text-gray-700'>" . $row['nombre_product'] . "</h3>";
    echo "<p class='text-gray-600'>$" . $row['price_product'] . "</p>";
    echo "<p class='text-gray-600'>" . $row['description'] . "</p>";
    echo "<a href='agregar_al_carrito.php?id=" . $row['id_product'] . "' class='block w-full mt-4 py-2 px-4 bg-blue-500 text-white text-center rounded-md transition duration-300 ease-in-out hover:bg-blue-600'>Agregar al Carrito</a>";
    echo "</div>";
  }
  ?>
</div>
<?php include 'tommic/fother.php'; ?>
</body>
</html>

<?php
// Cerrar conexión
mysqli_close($conexion);
?>

