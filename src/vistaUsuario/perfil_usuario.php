<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_cliente.php");
    exit();
}

// Incluir archivo de conexión
include '../conexion.php';

// Obtener el ID del usuario de la sesión
$user_id = $_SESSION['user_id'];

// Consulta SQL para seleccionar los datos del usuario
$query = "SELECT * FROM tbl_cliente WHERE user_id = $user_id";
$result = mysqli_query($conexion, $query);

// Verificar si se encontraron resultados
if (mysqli_num_rows($result) > 0) {
    // Obtener los datos del usuario
    $row = mysqli_fetch_assoc($result);

    // Guardar los datos del usuario en variables
    $nombre = $row['nombre_cli'];
    $apellidos = $row['apellidos_cli'];
    $direccion = $row['direccion_cli'];
    $telefono = $row['telefono_cli'];
    $correo = $row['correo_cli'];
    $genero = $row['genero_cli'];
    $fecha_nacimiento = $row['fecha_nac_cli'];
} else {
    // Si no se encontraron resultados, puedes manejarlo de alguna manera adecuada
    // Por ejemplo, redirigir al usuario a una página de error o mostrar un mensaje de que no se encontraron datos
}

// Cerrar conexión
mysqli_close($conexion);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/output.css">
</head>
<body class="">
<?php include 'tommic/header.php'; ?>

<div class="flex justify-center items-start mt-4 p-6">
    <div class="flex space-x-8 bg-white p-4 rounded-lg shadow-2xl w-full max-w-3xl">
        <nav class="self-start">
            <ul class="flex flex-col space-y-4 mt-2">
                <li id="tab-1" class="p-2 cursor-pointer bg-gray-200 hover:bg-gray-300 rounded-md w-52 text-center">Datos personales</li>
                <li id="tab-2" class="p-2 cursor-pointer hover:bg-gray-200 rounded-md w-52 text-center">Actualizar Datos</li>
                <li id="tab-3" class="p-2 cursor-pointer hover:bg-gray-200 rounded-md w-52 text-center">Cambio Contraseña</li>
            </ul>
        </nav>
        
        <div>
            <section id="content-1" class="tab-content">
                <div class="w-[450px] py-4 px-5 my-2 bg-white">
                    <div class="mb-4">
                        <label for="nombre" class="display-inline-block w-60 font-bold">Nombre:</label>
                        <p class="display-inline-block ml-0 text-gray-500"><?php echo isset($nombre) ? $nombre : ''; ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="apellidos" class="display-inline-block w-60 font-bold">Apellidos:</label>
                        <p class="display-inline-block ml-0 text-gray-500"><?php echo isset($apellidos) ? $apellidos : ''; ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="direccion" class="display-inline-block w-60 font-bold">Dirección:</label>
                        <p class="display-inline-block ml-0 text-gray-500"><?php echo isset($direccion) ? $direccion : ''; ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="telefono" class="display-inline-block w-60 font-bold">Teléfono:</label>
                        <p class="display-inline-block ml-0 text-gray-500"><?php echo isset($telefono) ? $telefono : ''; ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="correo" class="display-inline-block w-60 font-bold">Correo Electrónico:</label>
                        <p class="display-inline-block ml-0 text-gray-500"><?php echo isset($correo) ? $correo : ''; ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="genero" class="display-inline-block w-60 font-bold">Género:</label>
                        <p class="display-inline-block ml-0 text-gray-500"><?php echo isset($genero) ? $genero : ''; ?></p>
                    </div>
                    <div class="mb-4">
                        <label for="fecha_nacimiento" class="display-inline-block w-60 font-bold">Fecha de Nacimiento:</label>
                        <p class="display-inline-block ml-0 text-gray-500"><?php echo isset($fecha_nacimiento) ? $fecha_nacimiento : ''; ?></p>
                    </div>
                </div>
            </section>

            <section id="content-2" class="hidden tab-content">
                <div class="bg-white p-8  my-2  w-full max-w-2xl">
                    <form method="post" action="editar_Informacion_Usuario.php">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                        <div class="flex space-x-4 mb-4">
                            <div class="w-1/2">
                                <label for="nombre" class="block text-gray-700 font-medium mb-2">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required class="w-full rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="w-1/2">
                                <label for="apellidos" class="block text-gray-700 font-medium mb-2">Apellidos:</label>
                                <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" required class="w-full rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="direccion" class="block text-gray-700 font-medium mb-2">Dirección:</label>
                            <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" required class="w-full rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="telefono" class="block text-gray-700 font-medium mb-2">Teléfono:</label>
                            <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required class="w-full rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="correo" class="block text-gray-700 font-medium mb-2">Correo Electrónico:</label>
                            <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required class="w-full rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="genero" class="block text-gray-700 font-medium mb-2">Género:</label>
                            <select id="genero" name="genero" required class="w-full rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="Masculino" <?php echo $genero === "Masculino" ? 'selected' : ''; ?>>Masculino</option>
                                <option value="Femenino" <?php echo $genero === "Femenino" ? 'selected' : ''; ?>>Femenino</option>
                                <option value="Otro" <?php echo $genero === "Otro" ? 'selected' : ''; ?>>Otro</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="fecha_nacimiento" class="block text-gray-700 font-medium mb-2">Fecha de Nacimiento:</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" required class="w-full rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <button type="submit" class="w-full bg-blue-500 text-white font-medium rounded-md px-4 py-2 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">Actualizar</button>
                    </form>
                </div>
            </section>

            <section id="content-3" class="hidden tab-content">
                <div class="bg-white p-8  my-2 w-full max-w-md">
                    <form method="post" action="">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <div class="mb-4">
                            <label for="current_password" class="block text-gray-700 font-medium mb-2">Contraseña Actual:</label>
                            <input type="password" id="current_password" name="current_password" required class="w-full rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="new_password" class="block text-gray-700 font-medium mb-2">Nueva Contraseña:</label>
                            <input type="password" id="new_password" name="new_password" required class="w-full rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="block text-gray-700 font-medium mb-2">Confirmar Contraseña:</label>
                            <input type="password" id="confirm_password" name="confirm_password" required class="w-full rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <button type="submit" class="w-full bg-blue-500 text-white font-medium rounded-md px-4 py-2 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">Actualizar</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

<script src="../js/tabs.js"></script>
</body>
</html>