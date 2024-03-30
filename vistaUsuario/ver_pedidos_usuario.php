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
$query_pedidos = "SELECT o.placed_on, o.total_price, o.product_names, o.total_products, o.status,
                         GROUP_CONCAT(od.quantity SEPARATOR ',') AS product_quantities
                  FROM tbl_orders o
                  LEFT JOIN tbl_order_details od ON o.id_order = od.id_order
                  WHERE o.user_id = $user_id
                  GROUP BY o.id_order";
$result_pedidos = mysqli_query($conexion, $query_pedidos);

// Verificar si hay pedidos
if (mysqli_num_rows($result_pedidos) > 0) {
    // Si hay pedidos, mostrarlos en una tabla
    ?>
    <!DOCTYPE html>
<html>
<head>
    <title>Historial de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .card {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card h3 {
            margin-top: 0;
            color: #333;
        }
        .card p {
            margin-top: 5px;
            color: #666;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Historial de Pedidos</h2>
<div class="container">
    <?php while ($pedido = mysqli_fetch_assoc($result_pedidos)) { ?>
        <div class="card">
            <h3>Fecha: <?php echo $pedido['placed_on']; ?></h3>
            <p>Total: $<?php echo $pedido['total_price']; ?></p>
            <?php
                // Convertir la cadena de nombres de productos en un array
                $productos = explode(',', $pedido['product_names']);
                // Convertir la cadena de cantidades de productos en un array
                $cantidades = explode(',', $pedido['product_quantities']);
                
                // Combinar los nombres de productos con sus respectivas cantidades
                $productos_con_cantidad = array_combine($productos, $cantidades);
            ?>
            <p>Productos:</p>
            <ul>
                <?php foreach ($productos_con_cantidad as $producto => $cantidad) { ?>
                    <li><?php echo $producto; ?> - Cantidad: <?php echo $cantidad; ?></li>
                <?php } ?>
            </ul>
            <p>Total de Productos: <?php echo $pedido['total_products']; ?></p>
            <p>Estado: <?php echo $pedido['status']; ?></p>
        </div>
    <?php } ?>
</div>

<div class="footer">
    <p><a href="dashboard_cliente.php">Volver al Dashboard</a></p>
</div>

</body>
</html>

    <?php
} else {
    // Si no hay pedidos, mostrar un mensaje indicando que no hay pedidos realizados
    echo "No hay pedidos realizados.";
}
?>
