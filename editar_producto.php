<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        textarea {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Incluir archivo de conexión
    include 'conexion.php';

    // Verificar si se ha proporcionado un ID de producto para editar
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_producto = $_GET['id'];

        // Query para obtener la información del producto
        $query = "SELECT * FROM tbl_products WHERE id_product = $id_producto";
        $result = mysqli_query($conexion, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Formulario para editar el producto
            echo "<h1>Editar Producto</h1>";
            echo "<form action='actualizar_producto.php' method='POST'>";
            echo "<label for='id_producto'>ID Producto:</label>";
            echo "<input type='text' name='id_producto' value='" . $row['id_product'] . "' readonly>";
            echo "<label for='nombre_producto'>Nombre Producto:</label>";
            echo "<input type='text' name='nombre_producto' value='" . $row['nombre_product'] . "'>";
            echo "<label for='precio_producto'>Precio Producto:</label>";
            echo "<input type='text' name='precio_producto' value='" . $row['price_product'] . "'>";
            echo "<label for='descripcion'>Descripción:</label>";
            echo "<textarea name='descripcion'>" . $row['description'] . "</textarea>";
            echo "<input type='submit' value='Actualizar Producto'>";
            echo "</form>";
        } else {
            echo "No se encontró el producto.";
        }
    } else {
        echo "ID de producto no proporcionado.";
    }

    // Cerrar conexión
    mysqli_close($conexion);
    ?>
</div>

</body>
</html>
