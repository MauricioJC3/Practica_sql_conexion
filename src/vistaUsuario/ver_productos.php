<?php
include '../conexion.php';
session_start();


$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!isset($user_id)) {
   header('location:login_cliente.php');
}

if (isset($_POST['add_to_cart']) && $user_id !== null) {
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $product_id = $_POST['product_id'];

   $check_cart_numbers = $conexion->prepare("SELECT * FROM `tbl_cart` WHERE name_products = ? AND user_id = ?");
   $check_cart_numbers->bind_param("si", $product_name, $user_id);
   $check_cart_numbers->execute();
   $check_cart_numbers_result = $check_cart_numbers->get_result();

   if ($check_cart_numbers_result->num_rows > 0) {
      $message[] = 'already added to cart!';
   } else {
      $insert_to_cart = $conexion->prepare("INSERT INTO `tbl_cart` (user_id, name_products, price_product, quantity, image, id_product) VALUES (?, ?, ?, ?, ?, ?)");
      $insert_to_cart->bind_param("isissi", $user_id, $product_name, $product_price, $product_quantity, $product_image, $product_id);
      $insert_to_cart->execute();
      $message[] = 'product added to cart!';
   }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <link rel="stylesheet" href="../css/output.css">
</head>

<body>

<?php include 'tommic/header.php'; ?>

<section class="products">
   <h1 class="title text-center mt-8 text-gray-700 font-bold">Productos</h1>

   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center mt-8 m-5">
      <?php
      $query = "SELECT p.*
                FROM tbl_products p
                INNER JOIN tbl_mypimes m ON p.id_mypime = m.nit_mypime
                WHERE m.status = 'activo'";
      $select_products = mysqli_query($conexion, $query) or die('query failed');
      if (mysqli_num_rows($select_products) > 0) {
         while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            // Ruta de la imagen en la carpeta de imágenes
            $image_path = "../imagenes_productos/" . $fetch_products['image'];
      ?>
            <form action="" method="post" class="box">
               <img class="image rounded-md w-96 h-80" src="<?php echo $image_path; ?>" alt="">
               <div class="name mt-2 text-lg font-semibold text-gray-700"><?php echo $fetch_products['nombre_product']; ?></div>
               <div class="price text-gray-600">$<?php echo $fetch_products['price_product']; ?>/-</div>
               <?php if ($user_id !== null) { ?>
                  <input type="number" min="1" name="product_quantity" value="1" class="qty mt-2">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['nombre_product']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price_product']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $image_path; ?>">
                  <input type="hidden" name="product_id" value="<?php echo $fetch_products['id_product']; ?>">
                  <input type="submit" value="add to cart" name="add_to_cart" class="btn mt-2 block w-full py-2 px-4 bg-blue-500 text-white text-center rounded-md transition duration-300 ease-in-out hover:bg-blue-600">
               <?php } else { ?>
                  <p class="mt-2 text-center">Inicia sesión para agregar productos al carrito.</p>
               <?php } ?>
            </form>
      <?php
         }
      } else {
         echo '<p class="empty text-center">No hay productos disponibles.</p>';
      }
      ?>
   </div>

</section>

<?php include 'tommic/fother.php'; ?>

<!-- Custom JS file link -->
<script src="js/script.js"></script>

</body>

</html>

