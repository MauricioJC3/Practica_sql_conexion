<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/output.css" rel="stylesheet">
</head>

<body class="h-full px-4 flex items-center justify-center bg-gris-100 bg-orange-50">
<?php
        session_start();
        // Mostrar mensajes de éxito o error
        if (isset($_SESSION['success_registro'])) {
            echo "<p style='color:green'>" . $_SESSION['success_registro'] . "</p>";
            unset($_SESSION['success_registro']);
          }
         if (isset($_SESSION['error_registro'])) {
            echo "<p style='color:red'>" . $_SESSION['error_registro'] . "</p>";
             unset($_SESSION['error_registro']);
         }
    ?>
    <div class="grid grid-cols-2 gap-4 mx-auto max-h-screen h-full w-full relative">
        <main class="flex items-center justify-center px-4">
            <form action="register_cliente.php" method="POST" class="flex flex-col justify-start gap-4 max-w-md w-full relative">
                <div class="flex flex-col gap-2">
                    <label for="nombre_cli" class="text-gray-700 mb-2 flex items-center"></label>
                    <input class="rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="text" id="nombre_cli" name="nombre_cli" autocomplete="off" placeholder="Nombre" required>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="apellidos_cli"></label>
                    <input class="rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="text" id="apellidos_cli" name="apellidos_cli" autocomplete="off" placeholder="Apellidos" required>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="direccion_cli"></label>
                    <input class="rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="text" id="direccion_cli" name="direccion_cli" autocomplete="off" placeholder="Dirección" required>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="telefono_cli"></label>
                    <input class="rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="text" id="telefono_cli" name="telefono_cli" autocomplete="off" placeholder="Teléfono" required>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="correo_cli"></label>
                    <input class="rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="email" id="correo_cli" name="correo_cli" autocomplete="off" placeholder="Correo electronico" required>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="contraseña"></label>
                    <input class="rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="password" id="contraseña" name="contraseña" placeholder="Contraseña" required>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="genero_cli" class="text-gray-500">Genero</label>
                    <select id="genero_cli" name="genero_cli" required class="rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="fecha_nac_cli" class="text-gray-500">Fecha de nacimiento</label>
                    <input class="rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="date" id="fecha_nac_cli" name="fecha_nac_cli" autocomplete="off" placeholder="Fecha de nacimiento" required>
                </div>
                <button  id="boton_registrarse" class="bg-primary border border-primary-light text-white whitespace-nowrap grid place-items-center mt-5 leading-9 text-base font-medium cursor-pointer w-full rounded-lg shadow-md bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" type="submit">
                    Registrarse
                </button>
            </form>
        </main>
        <aside class="flex justify-center items-center rounded-full bg-cover bg-no-repeat bg-center max-h-screen">
  <div class="w-full h-full rounded-lg overflow-hidden">
    <img src="../img/formu.jpg" alt="" class="w-full h-full object-cover">
  </div>
</aside>
    </div>

    <script src="../js/Validaciones/registerUsuario.js"></script>

</body>
</html>