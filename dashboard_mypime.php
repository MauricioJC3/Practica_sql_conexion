<?php
session_start();

// Verificar si el usuario está autenticado y obtener el ID de MyPIME
if (!isset($_SESSION['id_mypime']) || empty($_SESSION['id_mypime'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_mypime.html");
    exit();
}

// Incluir archivo de conexión
include 'conexion.php';

// Obtener el ID de MyPIME de la sesión
$id_mypime = $_SESSION['id_mypime'];

// Consulta para obtener los productos asociados al ID de MyPIME
$query = "SELECT * FROM tbl_products WHERE id_mypime = $id_mypime";
$result = mysqli_query($conexion, $query);

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


    </style>
</head>
<body>

<?php include 'tommic/header.php'; ?>

    <div class="container">
        <h1 class="move">Bienvenido, <?php echo $_SESSION['nombre_mypime']; ?>!</h1>
        <p>Esta es tu página de dashboard.</p>
        
        <!-- Otro contenido del dashboard aquí -->

        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Animi fuga ipsa deserunt perspiciatis iste repellat, dicta esse reiciendis saepe, laboriosam, consequuntur dolore culpa odit ratione modi deleniti quam voluptate labore!
        <br>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, asperiores consequuntur similique perspiciatis, sit magni hic amet doloremque deserunt expedita nisi et voluptas deleniti aliquid unde animi non eaque doloribus.
    </div>


</body>
</html>
