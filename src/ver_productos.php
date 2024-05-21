<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el usuario está autenticado y obtener el ID de MyPIME
session_start();
if (!isset($_SESSION['id_mypime']) || empty($_SESSION['id_mypime'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_mypime.html");
    exit();
}

// Obtener el ID de MyPIME de la sesión
$id_mypime = $_SESSION['id_mypime'];

// Consulta para obtener los productos asociados al ID de MyPIME
$query = "SELECT * FROM tbl_products WHERE id_mypime = $id_mypime";
$result = mysqli_query($conexion, $query);

// Cerrar conexión
mysqli_close($conexion);

// Verificar si hay productos
$productos = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $productos[] = $row;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Ver Productos</title>
    <link rel="stylesheet" href="./css/output.css">
</head>
<?php include 'tommic/header.php'; ?>
<body class="bg-gray-100">
    <div class="contenedor mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mt-10 text-gray-800 mb-6">Tus productos</h1>
        <?php if (!empty($productos)): ?>
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    <?php foreach ($productos as $producto): ?>
                        <li class="p-4 flex flex-col md:flex-row justify-between items-center hover:bg-orange-50 transition duration-150 ease-in-out">
                            <div class="w-full md:w-auto mb-4 md:mb-0">
                                <p class="text-lg text-orange-500 font-semibold"><strong>ID Producto:</strong> <?php echo $producto['id_product']; ?></p>
                                <p class="text-lg font-semibold"><strong>Nombre Producto:</strong> <?php echo $producto['nombre_product']; ?></p>
                                <p class="text-lg font-semibold"><strong>Precio Producto:</strong> <?php echo $producto['price_product']; ?></p>
                            </div>
                            <div class="flex space-x-4">
                                <a href="editar_producto.php?id=<?php echo $producto['id_product']; ?>" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-150 ease-in-out">Editar</a>
                                <a href="eliminar_producto.php?id=<?php echo $producto['id_product']; ?>" class="inline-block bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition duration-150 ease-in-out">Eliminar</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-600">No hay productos disponibles.</p>
        <?php endif; ?>
        <div class="text-center mt-4">
            <a href="dashboard_mypime.php" class="text-blue-500 hover:text-blue-700 transition duration-150 ease-in-out">Volver al Dashboard</a>
        </div>
        <div class="text-center mt-2">
            <a href="logout.php" class="text-gray-600 hover:text-gray-800 transition duration-150 ease-in-out">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>
