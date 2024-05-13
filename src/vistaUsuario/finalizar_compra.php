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
   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style3.css">
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f3f4f6;
         margin: 0;
         padding: 0;
         box-sizing: border-box;
      }

      .heading {
         background-color: #333;
         color: #fff;
         padding: 10px;
         text-align: center;
      }

      .heading h3 {
         margin: 0;
         padding: 0;
      }

      .heading p {
         margin: 5px 0 0;
         padding: 0;
      }

      .display-order {
         background-color: #fff;
         padding: 20px;
         margin-top: 20px;
      }

      .display-order .empty {
         color: #ff0000;
      }

      .display-order .grand-total {
         font-weight: bold;
         margin-top: 10px;
      }

      .checkout {
         background-color: #fff;
         padding: 20px;
         margin-top: 20px;
      }

      .checkout h3 {
         margin-bottom: 20px;
      }

      .checkout .flex {
         display: flex;
         flex-wrap: wrap;
         gap: 20px;
      }

      .inputBox {
         flex: 1 1 250px;
      }

      .inputBox span {
         font-weight: bold;
         display: block;
         margin-bottom: 5px;
      }

      .inputBox input[type="text"],
      .inputBox input[type="number"],
      .inputBox input[type="email"],
      .inputBox select {
         width: 100%;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
         outline: none;
      }

      .inputBox input[type="submit"] {
         background-color: #333;
         color: #fff;
         border: none;
         padding: 10px 20px;
         border-radius: 5px;
         cursor: pointer;
         font-size: 16px;
      }

      .inputBox input[type="submit"]:hover {
         background-color: #555;
      }

      .fother {
         background-color: #333;
         color: #fff;
         text-align: center;
         padding: 10px;
         position: fixed;
         bottom: 0;
         width: 100%;
      }
   </style>
</head>

<body>

   <?php include 'tommic/header.php'; ?>


   <section class="display-order">

      <?php
      $grand_total = 0;
      $select_cart = mysqli_query($conexion, "SELECT * FROM `tbl_cart` WHERE user_id = '$user_id'") or die('query failed');
      if (mysqli_num_rows($select_cart) > 0) {
         while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $total_price = $fetch_cart['price_product'] * $fetch_cart['quantity'];
            $grand_total += $total_price;
      ?>
            <p> <?php echo $fetch_cart['name_products']; ?> <span>(<?php echo '$' . $fetch_cart['price_product'] . '/-' . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>
      <?php
         }
      } else {
         echo '<p class="empty">Your cart is empty</p>';
      }
      ?>
      <div class="grand-total">Total Price: <span>$<?php echo $grand_total; ?>/-</span> </div>

   </section>

   <section class="checkout">

      <form action="" method="post">
         <h3>Make Your Order</h3>
         <div class="flex">
            <div class="inputBox">
               <span>Nombre y apellido :</span>
               <input type="text" name="name" required placeholder="Ingrese su nombre">
            </div>
            <div class="inputBox">
               <span>Teléfono :</span>
               <input type="number" name="number" required placeholder="Ingrese su teléfono">
            </div>
            <div class="inputBox">
               <span>Correo :</span>
               <input type="email" name="email" required placeholder="Ingrese su correo">
            </div>
            <div class="inputBox">
               <span>Método de Pago:</span>
               <select name="method">
                  <option value="Efectivo">Efectivo</option>
                  <option value="Transferencia">Transferencia</option>
               </select>
            </div>
            <div class="inputBox">
               <span>Dirección :</span>
               <input type="text" name="address" required placeholder="Ingrese la dirección">
            </div>
         </div>
         <input type="submit" value="Realizar Ordenar" class="btn" name="order_btn">
      </form>

   </section>

   <div class="fother">
      
   </div>
<?php include 'tommic/fother.php'; ?>
</body>

</html>