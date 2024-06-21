<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/output.css">
</head>

<body>
    <header class="bg-white">
        <nav class="flex justify-between items-center w-[92%] h-20 mx-auto">
            <div>
                <img class="w-40 h-10 cursor-pointer" src="../img/logocall.png" alt="...">
            </div>
            <div
                class="nav-links duration-500 md:static absolute bg-white md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto  w-full flex items-center px-5">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
                    <li>
                        <a class="hover:text-gray-500" href="dashboard_cliente.php">Inicio</a>
                    </li>
                    <li>
                        <a class="hover:text-gray-500" href="nosotros.php">Nosotros</a>
                    </li>
                    <li>
                        <a class="hover:text-gray-500" href="ver_productos.php">Productos</a>
                    </li>
                    <li>
                        <a class="hover:text-gray-500" href="ver_carrito.php">Carrito</a>
                    </li>
                    <li>
                        <a class="hover:text-gray-500" href="ver_pedidos_usuario.php">Pedidos</a>
                    </li>
                    <li>
                        <a class="hover:text-gray-500" href="perfil_usuario.php">Perfil</a>
                    </li>
                    <li>
                        <a class="hover:text-gray-500" href="logout_cliente.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
           <div class="flex items-center gap-6">
            <!--     <button class="bg-[#eea6a6] text-white px-5 py-2 rounded-full hover:bg-[#87acec]">Iniciar sesión</button>-->
                <img src="../img/menu.png" alt="menu" onclick="onToggleMenu(this)" name="menu" class="w-6 h-5 cursor-pointer md:hidden">
                <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
            
    </header>
    
    <script src="../js/header.js"></script>
</body>
</html>
