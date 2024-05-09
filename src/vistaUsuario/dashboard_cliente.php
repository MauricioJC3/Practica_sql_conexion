<?php
session_start();

// Verificar si el cliente está autenticado y obtener su ID
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_cliente.php");
    exit();
}

$id_cliente = $_SESSION['user_id']; // Obtener el ID del cliente de la sesión
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../css/output.css">
</head>
<body class="bg-gradient-to-t from-[#fff] to-[#fff]">

<?php include 'tommic/header.php'; ?>

<!--"Bienvenido, <?php echo $_SESSION['nombre_cliente']; ?>!
    Aquí puedes mostrar la información del cliente, pedidos, etc. -->

    <section class="contenedor text-white rounded-lg mt-16 slider" id="slider">
        <figure class="relative w-full h-full aspect-video slider-childs" >
            <img src="../img/slider2.jpg" class="w-full h-full block object-cover">
            
            <div class="absolute inset-0 w-[90%] mx-auto h-max mt-auto space-y-4 py-8 hidden md:block">
                <h2 class="text-3xl font-bold">Imagen 1:</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi corrupti vitae odit, dolorem amet laborum enim minus? Sint, quos reprehenderit.</p>
            </div>
        </figure>

        <figure class="relative w-full h-full aspect-video slider-childs">
            <img src="../img/slider1.jpg" class="w-full h-full block object-cover">
            
            <div class="absolute inset-0 w-[90%] mx-auto h-max mt-auto space-y-4 py-8 hidden md:block">
                <h2 class="text-3xl font-bold">Imagen 2:</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi corrupti vitae odit, dolorem amet laborum enim minus? Sint, quos reprehenderit.</p>
            </div>
        </figure>
        
        <figure class="relative w-full h-full aspect-video slider-childs" data-active>
            <img src="../img/slider3.jpg" class="w-full h-full block object-cover">
            
            <div class="absolute inset-0 w-[90%] mx-auto h-max mt-auto space-y-4 py-8 hidden md:block">
                <h2 class="text-3xl font-bold">Imagen 3:</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi corrupti vitae odit, dolorem amet laborum enim minus? Sint, quos reprehenderit.</p>
            </div>
        </figure>
        
        <button class="slider-prev   ml-4" data-button="prev">
            <img src="../img/izquierda.png" class="w-8  md:w-12">
        </button>
        
        <button class="slider-next mr-4" data-button="next">
            <img src="../img/derecha.png" class="w-8  md:w-12">
        </button>

    </section>

    <br>
    <br>
    <br>

    <?php include 'tommic/fother.php'; ?>

    <script src="../js/slider.js"></script>
</body>
</html>
