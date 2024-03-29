<?php
// Verificar si el usuario está autenticado
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_cliente.php");
    exit();
}

// Incluir archivo de conexión
include '../conexion.php';

// Obtener el ID del usuario de la sesión
$user_id = $_SESSION['user_id'];

// Consulta para obtener los pedidos realizados por el usuario
$query_pedidos = "SELECT * FROM tbl_orders WHERE user_id = $user_id";
$result_pedidos = mysqli_query($conexion, $query_pedidos);

// Verificar si hay pedidos
if (mysqli_num_rows($result_pedidos) > 0) {
    // Si hay pedidos, mostrarlos en una tabla
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Historial de Pedidos</title>
    </head>
    <body>
        <h2>Historial de Pedidos</h2>
        <table border="1">
            <tr>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>productos</th>
                <th>estado</th>
                <!-- Otros encabezados de columnas según tu estructura de pedido -->
            </tr>
            <?php while ($pedido = mysqli_fetch_assoc($result_pedidos)) { ?>
                <tr>
                    <td><?php echo $pedido['id_order']; ?></td>
                    <td><?php echo $pedido['placed_on']; ?></td>
                    <td><?php echo $pedido['total_price']; ?></td>
                    <td><?php echo $pedido['product_names']; ?></td>
                    <td><?php echo $pedido['status']; ?></td>
                    <!-- Otras columnas según tu estructura de pedido -->
                </tr>
            <?php } ?>
        </table>

        <a href="dashboard_cliente.php">inicio</a>
    </body>
    </html>
    <?php
} else {
    // Si no hay pedidos, mostrar un mensaje indicando que no hay pedidos realizados
    echo "No hay pedidos realizados.";
}
?>
