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

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Historial de Pedidos</title>
        <link rel="stylesheet" href="../css/output.css">
    </head>
    <body class="font-sans bg-gray-100">
        <?php include 'tommic/header.php'; ?>
        <br>
        <h2 class="text-center text-2xl mt-8 mb-4">Historial de Pedidos</h2>
        <div class="container mx-auto flex flex-wrap justify-center">
            <?php while ($pedido = mysqli_fetch_assoc($result_pedidos)) { ?>
                <div class="card bg-white border border-gray-300 rounded-lg shadow-lg m-4 p-6 w-80 transform hover:scale-105 transition-transform duration-300 ease-in-out">
                    <h3 class="text-lg font-semibold text-indigo-600">Fecha: <?php echo $pedido['placed_on']; ?></h3>
                    <p class="text-gray-600">Total: $<?php echo $pedido['total_price']; ?></p>
                    <?php
                    // Convertir la cadena de nombres de productos en un array
                    $productos = explode(',', $pedido['product_names']);
                    // Convertir la cadena de cantidades de productos en un array
                    $cantidades = explode(',', $pedido['product_quantities']);
                    
                    // Verificar que ambos arrays tengan la misma longitud
                    if (count($productos) === count($cantidades)) {
                        // Combinar los nombres de productos con sus respectivas cantidades
                        $productos_con_cantidad = array_combine($productos, $cantidades);
                    } else {
                        $productos_con_cantidad = [];
                        echo "<p class='text-red-500'>Error: Los arrays de productos y cantidades no coinciden.</p>";
                    }
                    ?>
                    <p class="mt-2 font-semibold">Productos:</p>
                    <ul class="list-disc list-inside">
                        <?php foreach ($productos_con_cantidad as $producto => $cantidad) { ?>
                            <li><?php echo htmlspecialchars($producto); ?> - Cantidad: <?php echo htmlspecialchars($cantidad); ?></li>
                        <?php } ?>
                    </ul>
                    <p class="mt-2">Total de Productos: <?php echo htmlspecialchars($pedido['total_products']); ?></p>
                    <p class="mt-2">Estado: <span class="estado-label px-2 py-1 rounded"><?php echo htmlspecialchars($pedido['status']); ?></span></p>
                </div>
            <?php } ?>
        </div>
        <br>
        <br>
        <?php include 'tommic/fother.php'; ?>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const estados = document.querySelectorAll('.estado-label');
                estados.forEach(function (estado) {
                    const estadoTexto = estado.textContent.trim().toLowerCase();
                    switch (estadoTexto) {
                        case 'completado':
                            estado.classList.add('bg-green-200', 'text-green-800');
                            break;
                        case 'pendiente':
                            estado.classList.add('bg-red-200', 'text-yellow-800');
                            break;
                        case 'en proceso':
                            estado.classList.add('bg-yellow-200', 'text-yellow-800');
                            break;
                    }
                });
            });
        </script>
    </body>
</html>
