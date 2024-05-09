<?php
// Iniciar sesión
session_start();

// Verificar si la sesión del administrador está iniciada
if(isset($_SESSION['usuario'])) {
    $nombre_administrador = $_SESSION['usuario'];
} else {
    // Si la sesión no está iniciada, redirigir al usuario al formulario de inicio de sesión
    header("Location: index.php");
    exit();
}
// Incluir archivo de conexión
include '../conexion.php';

// Consulta SQL para obtener la cantidad de dinero generada por cada MYPIME en pedidos completados
$sql = "SELECT m.name_mypime, SUM(p.price_product * od.quantity) AS total_generado 
        FROM tbl_order_details od
        INNER JOIN tbl_orders o ON od.id_order = o.id_order
        INNER JOIN tbl_products p ON od.id_product = p.id_product
        INNER JOIN tbl_mypimes m ON p.id_mypime = m.nit_mypime
        WHERE o.status = 'completado'
        GROUP BY m.name_mypime";
$resultado = $conexion->query($sql);

// Arreglo para almacenar los datos
$datos_mypimes = [];
while ($fila = $resultado->fetch_assoc()) {
    $datos_mypimes[] = $fila;
}

// Convertir los datos a formato JSON
$datos_json = json_encode($datos_mypimes);

// Consulta SQL para obtener la cantidad de personas registradas por mes
$sqlUsuariosRegistrados = "SELECT MONTH(fecha_registro) AS mes, COUNT(*) AS total_usuarios
                           FROM tbl_cliente
                           GROUP BY MONTH(fecha_registro)";
$resultadoUsuariosRegistrados = $conexion->query($sqlUsuariosRegistrados);

// Arreglo para almacenar los datos de usuarios registrados por mes
$datosUsuariosRegistrados = [];
while ($filaUsuariosRegistrados = $resultadoUsuariosRegistrados->fetch_assoc()) {
    $datosUsuariosRegistrados[$filaUsuariosRegistrados['mes']] = $filaUsuariosRegistrados['total_usuarios'];
}

// Generar un array con la cantidad de usuarios registrados por cada mes
$cantidadUsuariosPorMes = [];
for ($i = 1; $i <= 12; $i++) {
    $cantidadUsuariosPorMes[$i] = isset($datosUsuariosRegistrados[$i]) ? $datosUsuariosRegistrados[$i] : 0;
}

// Convertir los datos de usuarios registrados por mes a formato JSON
$datosJsonUsuariosRegistrados = json_encode(array_values($cantidadUsuariosPorMes));

// Cerrar conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas</title>
    <!-- Incluir Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<style>

    .bienvenido {
            text-align: center; /* Centrar el texto */
            font-size: 40px; /* Tamaño de fuente */
            font-weight: bold; /* Negrita */
            margin-top: 20px; /* Espacio superior */
            font-family: 'Courier New', Courier, monospace;
        }

    .container {
            max-width: 800px; /* Establecer el ancho máximo del contenedor */
            margin: 0 auto; /* Centrar el contenedor en la página */
        }

        canvas {
            width: 100% !important; /* Asegurar que la gráfica ocupe todo el ancho del contenedor */
            height: auto !important; /* Permitir que la altura se ajuste automáticamente */
        }
</style>

<body>

<?php include 'tommic/header_admin.php'; ?>

<br>

<p class="bienvenido">Bienvenido administrador: <?php echo $nombre_administrador; ?></p>

<br>
<div class="container">
    <!-- Primer gráfico -->
    <div style="height: 400px;">
        <canvas id="grafico"></canvas>
    </div>

    <!-- Segundo gráfico -->
    <div style="height: 400px;">
        <canvas id="grafico_usuarios_registrados"></canvas>
    </div>
</div>

<script>
    // Obtener datos del PHP y decodificarlos
    var datosMypimes = <?php echo $datos_json; ?>;
    var datosUsuariosRegistrados = <?php echo $datosJsonUsuariosRegistrados; ?>;

    // Preparar datos para el primer gráfico
    var nombresMypimes = datosMypimes.map(function (item) {
        return item.name_mypime;
    });
    var montosGenerados = datosMypimes.map(function (item) {
        return item.total_generado;
    });

    // Crear el primer gráfico
    var ctx = document.getElementById('grafico').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nombresMypimes,
            datasets: [{
                label: 'Cantidad de dinero generada',
                data: montosGenerados,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
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

    // Preparar datos para el segundo gráfico
    var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var cantidadUsuariosPorMes = Object.values(datosUsuariosRegistrados);

    // Crear el segundo gráfico
    var ctxUsuariosRegistrados = document.getElementById('grafico_usuarios_registrados').getContext('2d');
    var graficoUsuariosRegistrados = new Chart(ctxUsuariosRegistrados, {
        type: 'line',
        data: {
            labels: meses,
            datasets: [{
                label: 'Usuarios Registrados por Mes',
                data: cantidadUsuariosPorMes,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
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
</script>
</body>

</html>
