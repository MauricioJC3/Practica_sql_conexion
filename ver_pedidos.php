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
$result_detalles = mysqli_query($conexion, $query_detalles);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pedidos Realizados</title>
</head>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline-block;
        }
        select {
            margin-right: 10px;
        }
        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
    
<body>
    <h1>Pedidos Realizados por tu MyPIME</h1>
    <table border="1">
        <tr>
            <th>ID Pedido</th>
            <th>Nombre Cliente</th>
            <th>Dirección</th>
            <th>Total Productos</th>
            <th>Total Precio</th>
            <th>Fecha Pedido</th>
            <th>Estado</th>
            <th>Detalles Productos / Cambiar Estado</th>
        </tr>
        <?php while ($detalle = mysqli_fetch_assoc($result_detalles)) { ?>
            <tr>
                <td><?php echo $detalle['id_order']; ?></td>
                <td><?php echo $detalle['name_user']; ?></td>
                <td><?php echo $detalle['address_user']; ?></td>
                <td><?php echo $detalle['cantidad']; ?></td>
                <td><?php echo $detalle['total_price']; ?></td>
                <td><?php echo $detalle['placed_on']; ?></td>
                <td><?php echo $detalle['status']; ?></td>
                <td>
                    <?php
                    // Mostrar detalles del producto
                    echo "Producto: " . $detalle['nombre_product'] . " - Cantidad: " . $detalle['cantidad'] . "<br>";
                    // Agregar formulario para cambiar el estado del pedido
                    ?>
                    <form method="post"> <!-- Eliminado action -->
                        <input type="hidden" name="order_id" value="<?php echo $detalle['id_order']; ?>">
                        <select name="new_status">
                            <option value="pendiente">Pendiente</option>
                            <option value="en proceso">En Proceso</option>
                            <option value="completado">Completado</option>
                        </select>
                        <button type="submit">Cambiar Estado</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <p><a href="dashboard_mypime.php">Volver al Dashboard</a></p>
</body>
</html>
