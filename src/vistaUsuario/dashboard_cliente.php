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

    <section class="contenedor h-[630px] text-white rounded-lg mt-16 slider" id="slider">
        <figure class="relative w-full h-full aspect-video slider-childs" data-active>
            <img src="../img/slider2.jpg" class="w-full h-full block object-cover">
            
           <!-- <div class="absolute inset-0 w-[90%] mx-auto h-max mt-auto space-y-4 py-8 hidden md:block">
                <h2 class="text-3xl font-bold">Imagen 1:</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi corrupti vitae odit, dolorem amet laborum enim minus? Sint, quos reprehenderit gergnsijgnjsdnfjgsndfjbnsñjdfbnjñoenbojsnbojsnrbsñjbañjkenjñvbabñjejñ.</p>
            </div>-->
        </figure>

        <figure class="relative w-full h-full aspect-video slider-childs">
            <img src="../img/slider1.jpg" class="w-full h-full block object-cover">
            
           <!-- <div class="absolute inset-0 w-[90%] mx-auto h-max mt-auto space-y-4 py-8 hidden md:block">
                <h2 class="text-3xl font-bold">Imagen 2:</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi corrupti vitae odit, dolorem amet laborum enim minus? Sint, quos reprehenderit.</p>
            </div>-->
        </figure>
        
        <figure class="relative w-full h-full aspect-video slider-childs">
            <img src="../img/slider3.jpg" class="w-full h-full block object-cover">
            
            <!--<div class="absolute inset-0 w-[90%] mx-auto h-max mt-auto space-y-4 py-8 hidden md:block">
                <h2 class="text-3xl font-bold">Imagen 3:</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi corrupti vitae odit, dolorem amet laborum enim minus? Sint, quos reprehenderit.</p>
            </div>-->
        </figure>
        
        <button class="slider-prev   ml-4" data-button="prev">
            <img src="../img/izquierda.png" class="w-8  md:w-12">
        </button>
        
        <button class="slider-next mr-4" data-button="next">
            <img src="../img/derecha.png" class="w-8  md:w-12">
        </button>

    </section>

    <br><br><br>
    <h1 class="text-center text-4xl font-bold">Menú</h1>
    <br>

 
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 p-8 contenedor">
<div class="w-full h-full bg-white shadow-lg rounded-lg overflow-hidden relative transition duration-300 transform hover:-translate-y-1 hover:shadow-lg">
        <img class="image object-cover rounded-lg w-full h-full origin-center transition-transform duration-300 ease-in-out imagen-producto-zoom" src="../img/hambu.jpg" alt="Hamburguesa">
        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-4">
            <h2 class="text-lg font-semibold text-white">Hamburguesa</h2>
        </div>
    </div>

    <div class="w-full h-full bg-white shadow-lg rounded-lg overflow-hidden relative transition duration-300 transform hover:-translate-y-1 hover:shadow-lg">
        <img class="image object-cover rounded-lg w-full h-full origin-center transition-transform duration-300 ease-in-out imagen-producto-zoom" src="../img/chuzo.jpg" alt="Hamburguesa">
        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-4">
            <h2 class="text-lg font-semibold text-white">Carnes</h2>
        </div>
    </div>

    <div class="w-full h-full bg-white shadow-lg rounded-lg overflow-hidden relative transition duration-300 transform hover:-translate-y-1 hover:shadow-lg">
        <img class="image object-cover rounded-lg w-full h-full origin-center transition-transform duration-300 ease-in-out imagen-producto-zoom" src="../img/empanada.jpg" alt="Hamburguesa">
        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-4">
            <h2 class="text-lg font-semibold text-white">Empanadas</h2>
        </div>
    </div>

    <div class="w-full h-full bg-white shadow-lg rounded-lg overflow-hidden relative transition duration-300 transform hover:-translate-y-1 hover:shadow-lg">
        <img class="image object-cover rounded-lg w-full h-full origin-center transition-transform duration-300 ease-in-out imagen-producto-zoom" src="../img/perro.jpg" alt="Hamburguesa">
        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-4">
            <h2 class="text-lg font-semibold text-white">Perro</h2>
        </div>
    </div>

    <div class="w-full h-full bg-white shadow-lg rounded-lg overflow-hidden relative transition duration-300 transform hover:-translate-y-1 hover:shadow-lg">
        <img class="image object-cover rounded-lg w-full h-full origin-center transition-transform duration-300 ease-in-out imagen-producto-zoom" src="../img/sand.jpg" alt="Hamburguesa">
        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-4">
            <h2 class="text-lg font-semibold text-white">Sándwich</h2>
        </div>
    </div>

    <div class="w-full h-full bg-white shadow-lg rounded-lg overflow-hidden relative transition duration-300 transform hover:-translate-y-1 hover:shadow-lg">
        <img class="image object-cover rounded-lg w-full h-full origin-center transition-transform duration-300 ease-in-out imagen-producto-zoom" src="../img/pollo.jpg" alt="Hamburguesa">
        <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 p-4">
            <h2 class="text-lg font-semibold text-white">Pastel de pollo</h2>
        </div>
    </div>
</div>
<br><br>    

    <section class="text-gray-600 bg-slate-400">
    <div class="mx-auto flex px-5 py-8 md:flex-row flex-col items-center">
        <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                Mejores ambientes <br class="hidden lg:inline-block">
            </h1>
            <p class="mb-8 leading-relaxed">
                En Call Food te tenemos los mejores platos de comida rápida, encuentra los lugares con mayores reseñas.
            </p>
            <div class="flex justify-center">
                <button class="inline-flex text-white bg-orange-500 border-0 py-2 px-6 focus:outline-none hover:bg-orange-600 rounded text-lg">Button</button>
                <button class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Button</button>
            </div>
        </div>
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
            <img class="object-cover object-center rounded" alt="hero" src="../img/pizza.jpg">
        </div>
    </div>
</section>


<section class="text-gray-700 body-font mt-10">
    <div class="container px-5 py-12 mx-auto">
        <div class="flex flex-wrap text-center justify-center">
            <div class="p-4 md:w-1/4 sm:w-1/2">
                <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                    <div class="flex justify-center">
                        <img src="https://image3.jdomni.in/banner/13062021/58/97/7C/E53960D1295621EFCB5B13F335_1623567851299.png?output-format=webp" class="w-32 mb-3">
                    </div>
                    <h2 class="title-font font-regular text-2xl text-gray-900">Latest Milling Machinery</h2>
                </div>
            </div>

            <div class="p-4 md:w-1/4 sm:w-1/2">
                <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                    <div class="flex justify-center">
                        <img src="https://image2.jdomni.in/banner/13062021/3E/57/E8/1D6E23DD7E12571705CAC761E7_1623567977295.png?output-format=webp" class="w-32 mb-3">
                    </div>
                    <h2 class="title-font font-regular text-2xl text-gray-900">Reasonable Rates</h2>
                </div>
            </div>

            <div class="p-4 md:w-1/4 sm:w-1/2">
                <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                    <div class="flex justify-center">
                        <img src="https://image3.jdomni.in/banner/13062021/16/7E/7E/5A9920439E52EF309F27B43EEB_1623568010437.png?output-format=webp" class="w-32 mb-3">
                    </div>
                    <h2 class="title-font font-regular text-2xl text-gray-900">Time Efficiency</h2>
                </div>
            </div>

            <div class="p-4 md:w-1/4 sm:w-1/2">
                <div class="px-4 py-6 transform transition duration-500 hover:scale-110">
                    <div class="flex justify-center">
                        <img src="https://image3.jdomni.in/banner/13062021/EB/99/EE/8B46027500E987A5142ECC1CE1_1623567959360.png?output-format=webp" class="w-32 mb-3">
                    </div>
                    <h2 class="title-font font-regular text-2xl text-gray-900">Expertise in Industry</h2>
                </div>
            </div>

        </div>
    </div>
</section>
<br><br>

    <?php include 'tommic/fother.php'; ?>

    <script src="../js/slider.js"></script>
</body>
</html>