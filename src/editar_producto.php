<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="./css/output.css">
</head>
<body class="bg-gray-100">
<div class="container mx-auto mt-8">
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
            ?>
            <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
                <h1 class="text-3xl font-bold text-center mb-8">Editar Producto</h1>
                <form action="actualizar_producto.php" method="POST" enctype="multipart/form-data">
                    <label class="block mb-2 font-semibold" for="id_producto">ID Producto:</label>
                    <input class="rounded-b-xl w-full border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="text" name="id_producto" value="<?php echo $row['id_product']; ?>" readonly>
                    
                    <label class="block mt-2 font-semibold" for="nombre_producto">Nombre Producto:</label>
                    <input class="rounded-b-xl w-full border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="text" name="nombre_producto" value="<?php echo $row['nombre_product']; ?>">

                    <label class="block mb-2 mt-2 font-semibold" for="precio_producto">Precio Producto:</label>
                    <input class="rounded-b-xl w-full border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" type="text" name="precio_producto" value="<?php echo $row['price_product']; ?>">

                    <label class="block mb-2 mt-2 font-semibold" for="descripcion">Descripción:</label>
                    <textarea class="w-full px-3 py-2 mb-4 border border-gray-300 rounded" name="descripcion" rows="4"><?php echo $row['description']; ?></textarea>

                    <label class="block mb-2 font-semibold" for="imagen">Imagen:</label>
                    <input class="w-full px-3 py-2 mb-4 border-none border-gray-300 rounded" type="file" name="imagen">

                    <input class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 cursor-pointer" type="submit" value="Actualizar Producto">
                </form>
            </div>
            <?php         
        } else {
            echo "<p class='text-center text-red-500'>No se encontró el producto.</p>";
        }
    } else {
        echo "<p class='text-center text-red-500'>ID de producto no proporcionado.</p>";
    }

    // Cerrar conexión
    mysqli_close($conexion);
    ?>
</div>

</body>
</html>
