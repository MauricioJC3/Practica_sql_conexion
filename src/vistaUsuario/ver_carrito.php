<?php
include '../conexion.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login_cliente.php');
}


if (isset($_POST['update_cart'])) {
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conexion, "UPDATE `tbl_cart` SET quantity = '$cart_quantity' WHERE id_cart = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conexion, "DELETE FROM `tbl_cart` WHERE id_cart = '$delete_id'") or die('query failed');
   header('location:ver_carrito.php');
}

if (isset($_GET['delete_all'])) {
   mysqli_query($conexion, "DELETE FROM `tbl_cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:ver_carrito.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>

   <link rel="stylesheet" href="../css/output.css">

</head>

<body class="bg-gray-100">

   <?php include 'tommic/header.php'; ?>

   <section class="shopping-cart mt-8">

      <h1 class="title text-2xl font-bold mb-4">Productos agregados</h1>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mx-auto">
         <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conexion, "SELECT tbl_cart.*, tbl_products.nombre_product, tbl_products.price_product, tbl_products.image FROM `tbl_cart` INNER JOIN `tbl_products` ON tbl_cart.name_products = tbl_products.nombre_product WHERE tbl_cart.user_id = '$user_id'") or die('query failed');
         if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
         ?>
               <div class="card bg-white rounded-lg shadow-md p-4">
                  <a href="cart.php?delete=<?php echo $fetch_cart['id_cart']; ?>" class="absolute top-2 right-2 text-red-500 hover:text-red-600"><i class="fas fa-times"></i></a>
                  <img src="data:image/jpeg;base64,<?= base64_encode($fetch_cart['image']); ?>" alt="" class="w-full h-auto">
                  <div class="name font-bold text-lg mt-2"><?php echo $fetch_cart['nombre_product']; ?></div>
                  <div class="price text-gray-700">$<?php echo $fetch_cart['price_product']; ?>/-</div>
                  <form action="" method="post" class="mt-2">
                     <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id_cart']; ?>">
                     <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>" class="w-20 border border-gray-300 rounded-md px-2 py-1">
                     <input type="submit" name="update_cart" value="Update" class="option-btn mt-2 block w-full bg-blue-500 text-white font-bold rounded-md py-2 px-4 transition duration-300 hover:bg-blue-600 cursor-pointer">
                  </form>
                  <div class="sub-total text-gray-500 mt-2">Subtotal: <span>$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price_product']); ?>/-</span> </div>
               </div>
         <?php
               $grand_total += $sub_total;
            }
         } else {
            echo '<p class="empty text-center text-gray-600">Your cart is empty</p>';
         }
         ?>
      </div>

      <div class="mt-8 text-center">
         <a href="ver_carrito.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?> bg-red-500 text-white font-bold rounded-md py-2 px-4 transition duration-300 hover:bg-red-600 cursor-pointer" onclick="return confirm('Delete all from cart?');">Delete All</a>
      </div>

      <div class="cart-total mt-8">
         <p class="font-bold">Grand Total: <span class="text-xl">$<?php echo $grand_total; ?>/-</span></p>
         <div class="flex justify-center mt-4">
            <a href="ver_productos.php" class="option-btn bg-blue-500 text-white font-bold rounded-md py-2 px-4 transition duration-300 hover:bg-blue-600 cursor-pointer">Continuar comprando</a>
            <a href="finalizar_compra.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?> option-btn bg-blue-500 text-white font-bold rounded-md py-2 px-4 transition duration-300 hover:bg-blue-600 cursor-pointer">finalizar compra</a>
         </div>
      </div>

   </section>

   <?php include 'tommic/fother.php'; ?>

   <!-- Custom JS file link -->
   <script src="js/script.js"></script>

</body>

</html>
