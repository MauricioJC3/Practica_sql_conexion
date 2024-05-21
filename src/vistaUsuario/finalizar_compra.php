<?php
include '../conexion.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!isset($user_id)) {
   header('location:login_cliente.php');
}

if (isset($_POST['order_btn'])) {

   $name = mysqli_real_escape_string($conexion, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conexion, $_POST['email']);
   $method = mysqli_real_escape_string($conexion, $_POST['method']);
   $address = mysqli_real_escape_string($conexion, $_POST['address']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_total_quantity = 0; // Inicializa la variable para almacenar el total de productos en el carrito
   
   $cart_products = array();
   $cart_details = array(); // Almacena los detalles de la orden
   
   $cart_query = mysqli_query($conexion, "SELECT * FROM `tbl_cart` WHERE user_id = '$user_id'") or die('query failed');
   if (mysqli_num_rows($cart_query) > 0) {
       while ($cart_item = mysqli_fetch_assoc($cart_query)) {
           $cart_products[] = "{$cart_item['name_products']} ({$cart_item['quantity']})";
           $sub_total = $cart_item['price_product'] * $cart_item['quantity'];
           $cart_total += $sub_total;
           $cart_total_quantity += $cart_item['quantity']; // Suma las cantidades de todos los productos en el carrito
           
           // Guarda los detalles de la orden
           $cart_details[] = array(
               'id_product' => $cart_item['id_product'],
               'unit_price' => $cart_item['price_product'],
               'quantity' => $cart_item['quantity']
           );
       }
   }
   
   $total_products = implode(', ', $cart_products);
   
   $order_query = mysqli_query($conexion, "SELECT * FROM `tbl_orders` WHERE name_user = '$name' AND number_user = '$number' AND email_user = '$email' AND method = '$method' AND address_user = '$address' AND total_products = '$cart_total_quantity' AND total_price = '$cart_total'") or die('query failed');
   
   if ($cart_total == 0) {
       $message[] = 'your cart is empty';
   } else {
       if (mysqli_num_rows($order_query) > 0) {
           $message[] = 'order already placed!';
       } else {
           // Inserta la orden en tbl_orders
           mysqli_query($conexion, "INSERT INTO `tbl_orders`(user_id, name_user, number_user, email_user, method, address_user, total_products, total_price, placed_on, product_names) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$cart_total_quantity', '$cart_total', '$placed_on', '$total_products')") or die('query failed');
           
           // Obtiene el ID de la orden recién insertada
           $id_order = mysqli_insert_id($conexion);
           
           // Inserta los detalles de la orden en tbl_order_details
           foreach ($cart_details as $detail) {
               $id_product = $detail['id_product'];
               $unit_price = $detail['unit_price'];
               $quantity = $detail['quantity'];
               mysqli_query($conexion, "INSERT INTO `tbl_order_details`(id_order, id_product, unit_price, quantity) VALUES('$id_order', '$id_product', '$unit_price', '$quantity')") or die('query failed');
           }
           
           $message[] = 'order placed successfully!';
           
           // Elimina los productos del carrito
           mysqli_query($conexion, "DELETE FROM `tbl_cart` WHERE user_id = '$user_id'") or die('query failed');
       }
   }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <link rel="stylesheet" href="../css/output.css">
</head>

<body class="bg-gray-100">

   <?php include 'tommic/header.php'; ?>

   <div class="flex justify-between mb-6 max-w-4xl mx-auto px-6 py-4 bg-white rounded-lg shadow-xl mt-8">
      <section class="w-1/2">
         <h2 class="text-lg font-semibold mb-4">Total de Productos en el Carrito</h2>

         <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conexion, "SELECT * FROM `tbl_cart` WHERE user_id = '$user_id'") or die('query failed');
         if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
               $total_price = $fetch_cart['price_product'] * $fetch_cart['quantity'];
               $grand_total += $total_price;
         ?>
               <p class="mb-2 ml-3"><?php echo $fetch_cart['name_products']; ?> <span class="text-gray-500 text-center ml-2">(<?php echo '$' . $fetch_cart['price_product'] . '/-' . ' x ' . $fetch_cart['quantity']; ?>)</span></p>
         <?php
            }
         } else {
            echo '<p class="empty">El carrito está vacío</p>';
         }
         ?>
         <div class="font-bold mt-4">Total: <span class="text-xl text-green-600">$<?php echo $grand_total; ?></span></div>
      </section>

      <section class="w-1/2 p-2">
         <h2 class="text-lg font-semibold mb-4">Realizar Orden</h2>
         <form action="" method="post" class="space-y-4">
            <div class="flex flex-col">
               <label for="name" class="font-semibold"></label>
               <input type="text" name="name" id="name" class="input-box rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Nombre y Apellido">
            </div>
            <div class="flex flex-col">
               <label for="number" class="font-semibold"></label>
               <input type="number" name="number" id="number" class="input-box rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Telefono">
            </div>
            <div class="flex flex-col">
               <label for="email" class="font-semibold"></label>
               <input type="email" name="email" id="email" class="input-box rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Correo">
            </div>
            <div class="flex flex-col">
               <label for="method" class="font-semibold">Método de Pago:</label>
               <select name="method" id="method" class="input-box rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                  <option value="Efectivo">Efectivo</option>
                  <option value="Transferencia">Transferencia</option>
               </select>
            </div>
            <div class="flex flex-col">
               <label for="address" class="font-semibold"></label>
               <input type="text" name="address" id="address" class="input-box rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Direccion">
            </div>
            <input type="submit" value="Realizar Orden" class="btn mt-6 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md cursor-pointer" name="order_btn">
         </form>
      </section>
   </div>

   <?php include 'tommic/fother.php'; ?>

</body>

</html>

