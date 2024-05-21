<?php
session_start();

// Verificar si la microempresa está autenticada y obtener su ID
if (!isset($_SESSION['id_mypime']) || empty($_SESSION['id_mypime'])) {
    // Si no está autenticada, redirigir al formulario de inicio de sesión
    header("Location: login_mypime.html");
    exit();
}

// Incluir archivo de conexión
include 'conexion.php';

// Obtener el ID de la microempresa de la sesión
$id_mypime = $_SESSION['id_mypime'];

// Si se envió el formulario para cambiar el estado del pedido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id']) && isset($_POST['new_status'])) {
    // Obtener los datos del formulario
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];

    // Consulta para actualizar el estado del pedido
    $query_update_status = "UPDATE tbl_orders SET status = '$new_status' WHERE id_order = $order_id";
    if (mysqli_query($conexion, $query_update_status)) {
        // Redireccionar a la misma página para evitar envío nuevamente del formulario
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error al actualizar el estado del pedido: " . mysqli_error($conexion);
    }
}

// Consulta para obtener los detalles de los productos asociados a la microempresa actual
$query_detalles = "SELECT d.id_order, d.id_product, SUM(d.quantity) as cantidad, p.nombre_product, o.name_user, o.address_user, o.total_products, SUM(d.quantity * p.price_product) as total_price, o.placed_on, o.status
                   FROM tbl_order_details d 
                   INNER JOIN tbl_orders o ON d.id_order = o.id_order 
                   INNER JOIN tbl_products p ON d.id_product = p.id_product 
                   WHERE p.id_mypime = $id_mypime
                   GROUP BY d.id_product, d.id_order";



// Ejecutar la consulta
$result_detalles = mysqli_query($conexion, $query_detalles);

// Verificar si la consulta fue exitosa
if (!$result_detalles) {
    // Mostrar mensaje de error
    echo "Error al obtener los detalles de los productos: " . mysqli_error($conexion);
    // Detener la ejecución del script
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Realizados</title>
    <link rel="stylesheet" href="./css/output.css">
</head>
<body class="bg-gray-100">
<?php include 'tommic/header.php'; ?>
    <h1 class="text-center text-3xl font-bold mt-8">Pedidos Realizados</h1>
    <div class="contenedor overflow-x-auto mx-auto mt-8">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID Pedido</th>
                    <th class="px-4 py-2">Nombre Cliente</th>
                    <th class="px-4 py-2">Dirección</th>
                    <th class="px-4 py-2">Total Productos</th>
                    <th class="px-4 py-2">Total Precio</th>
                    <th class="px-4 py-2">Fecha Pedido</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Detalles Productos / Cambiar Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($detalle = mysqli_fetch_assoc($result_detalles)) { ?>
                    <tr>
                        <td class="border px-4 py-2"><?php echo $detalle['id_order']; ?></td>
                        <td class="border px-4 py-2"><?php echo $detalle['name_user']; ?></td>
                        <td class="border px-4 py-2"><?php echo $detalle['address_user']; ?></td>
                        <td class="border px-4 py-2"><?php echo $detalle['cantidad']; ?></td>
                        <td class="border px-4 py-2"><?php echo $detalle['total_price']; ?></td>
                        <td class="border px-4 py-2"><?php echo $detalle['placed_on']; ?></td>
                        <td class="border px-4 py-2 <?php echo strtolower($detalle['status']); ?>"><?php echo $detalle['status']; ?></td>
                        <td class="border px-4 py-2">
                            <?php
                            // Mostrar detalles del producto
                            echo "Producto: " . $detalle['nombre_product'] . " - Cantidad: " . $detalle['cantidad'] . "<br>";
                            // Agregar formulario para cambiar el estado del pedido
                            ?>
                            <form method="post"> <!-- Eliminado action -->
                                <input type="hidden" name="order_id" value="<?php echo $detalle['id_order']; ?>">
                                <select name="new_status" class="border rounded px-2 py-1">
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="En proceso">En Proceso</option>
                                    <option value="Completado">Completado</option>
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded ml-2">Cambiar Estado</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="mt-8 text-center">
        <a href="dashboard_mypime.php" class="text-blue-500 hover:underline">Volver al Dashboard</a>
    </div>
</body>
</html>
