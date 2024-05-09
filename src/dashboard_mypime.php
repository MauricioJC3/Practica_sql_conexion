<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_mypime']) || empty($_SESSION['id_mypime'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_mypime.html");
    exit();
}

// Incluir archivo de conexión
include 'conexion.php';

// Obtener el ID de la MyPIME de la sesión
$id_mypime = $_SESSION['id_mypime'];

// Consulta para obtener los productos vendidos por la MyPIME actual y sus precios
$queryProductosVendidos = "SELECT p.nombre_product, p.price_product, SUM(od.quantity) AS cantidad_vendida 
                           FROM tbl_order_details od 
                           INNER JOIN tbl_orders o ON od.id_order = o.id_order 
                           INNER JOIN tbl_products p ON od.id_product = p.id_product 
                           WHERE p.id_mypime = $id_mypime AND o.status = 'completado'
                           GROUP BY od.id_product";

$resultProductosVendidos = mysqli_query($conexion, $queryProductosVendidos);

// Arrays para almacenar los nombres de los productos y el dinero generado
$productos = [];
$dineroGenerado = [];

// Procesar los resultados y llenar los arrays
while ($row = mysqli_fetch_assoc($resultProductosVendidos)) {
    $productos[] = $row['nombre_product'];
    $dineroGenerado[] = $row['price_product'] * $row['cantidad_vendida'];
}

// Cerrar conexión
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard MyPIME</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .move {
            margin-top: 20px;
        }

        .grafica_de_barras {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php include 'tommic/header.php'; ?>

<div class="container">
    <h1 class="move">Bienvenido, <?php echo $_SESSION['nombre_mypime']; ?>!</h1>
    <p>Esta es tu página de dashboard.</p>

    <!-- Agregar gráfica de barras aquí -->
    <div class="grafica_de_barras">
        <canvas id="graficaDineroGenerado" width="400" height="200"></canvas>
    </div>

    <!-- Otro contenido del dashboard aquí -->
    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Animi fuga ipsa deserunt perspiciatis iste repellat, dicta
    esse reiciendis saepe, laboriosam, consequuntur dolore culpa odit ratione modi deleniti quam voluptate labore!
    <br>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, asperiores consequuntur similique perspiciatis, sit
    magni hic amet doloremque deserunt expedita nisi et voluptas deleniti aliquid unde animi non eaque doloribus.
    <br>
    <br>
</div>

<!-- Incluir la biblioteca Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Código JavaScript para configurar la gráfica
    document.addEventListener('DOMContentLoaded', function () {
        var ctxDineroGenerado = document.getElementById('graficaDineroGenerado').getContext('2d');
        var graficaDineroGenerado = new Chart(ctxDineroGenerado, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($productos); ?>,
                datasets: [{
                    label: 'Dinero Generado por Producto',
                    data: <?php echo json_encode($dineroGenerado); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>

</body>
</html>
