<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el usuario está autenticado y obtener el ID de MyPIME
session_start();
if (!isset($_SESSION['id_mypime']) || empty($_SESSION['id_mypime'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login_mypime.html");
    exit();
}

// Obtener el ID de MyPIME de la sesión
$id_mypime = $_SESSION['id_mypime'];

// Consulta para obtener los productos asociados al ID de MyPIME
$query = "SELECT * FROM tbl_products WHERE id_mypime = $id_mypime";
$result = mysqli_query($conexion, $query);

// Cerrar conexión
mysqli_close($conexion);

// Verificar si hay productos
$productos = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $productos[] = $row;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Ver Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .product {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fff;
        }
        .product-info {
            display: flex;
            justify-content: space-between;
        }
        .product-actions {
            margin-top: 5px;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Productos de MyPIME</h1>
    
    <?php if (!empty($productos)): ?>
        <?php foreach ($productos as $producto): ?>
            <div class="product">
                <div class="product-info">
                    <strong>ID Producto:</strong> <?php echo $producto['id_product']; ?><br>
                    <strong>Nombre Producto:</strong> <?php echo $producto['nombre_product']; ?><br>
                    <strong>Precio Producto:</strong> <?php echo $producto['price_product']; ?><br>
                </div>
                <div class="product-actions">
                    <a href="editar_producto.php?id=<?php echo $producto['id_product']; ?>">Editar</a> | 
                    <a href="eliminar_producto.php?id=<?php echo $producto['id_product']; ?>">Eliminar</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay productos disponibles.</p>
    <?php endif; ?>

    <p><a href="dashboard_mypime.php">Volver al Dashboard</a></p>
    <p><a href="logout.php">Cerrar Sesión</a></p>
</body>
</html>
