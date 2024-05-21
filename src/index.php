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
    <title>Ingresar Productos</title>
    <link rel="stylesheet" href="./css/output.css">
</head>

<?php include 'tommic/header.php'; ?>

<body class="bg-gray-100">
    <h1 class="text-3xl font-bold text-center mt-10 text-gray-800">Ingrese un nuevo producto</h1>
    <form action="insert_producto.php" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-8 mt-6 rounded-lg shadow-md">
        <label class="block text-gray-700" for="id_mypime">Mypime NIT:</label>
        <input class="rounded-b-xl w-full border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Correo electronico" type="text" name="id_mypime" value="<?php echo $id_mypime; ?>" readonly>

        <label class="block mt-2 text-gray-700" for="nombre_producto">Nombre Producto:</label>
        <input class="rounded-b-xl w-full border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="text" name="nombre_producto" required>

        <label class="block mt-2 text-gray-700" for="price_producto">Precio Producto:</label>
        <input class="rounded-b-xl w-full border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="text" name="price_producto" required>

        <label class="block mt-2 text-gray-700" for="descripcion">Descripción:</label>
        <textarea class="w-full px-4 py-2 mb-4 border border-gray-300 rounded" name="descripcion" rows="4" required></textarea>

        <label class="block mb-2 text-gray-700" for="imagen_producto">Imagen del Producto:</label>
        <input class="rounded-b-xl mt-2 w-full border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="file" name="imagen_producto" accept="image/*" required>

        <input class="w-full rounded bg-orange-500 text-white py-2 px-4 hover:bg-orange-600 cursor-pointer" type="submit" value="Agregar Producto">
    </form>
    <a class="block text-center mt-4 text-gray-700 hover:underline" href="dashboard_mypime.php">Volver a inicio</a>
</body>
</html>
