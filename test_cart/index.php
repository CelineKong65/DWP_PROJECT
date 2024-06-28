<?php
include 'config.php';
session_start();

if(!isset($_SESSION['user_id'])){
   header('location:login.php');
   exit;
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['add_to_cart'])){
   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
   $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
   $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die(mysqli_error($conn));

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'Product already added to cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart` (user_id, name, price, image, quantity) VALUES ('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die(mysqli_error($conn));
      $message[] = 'Product added to cart!';
   }
}

if(isset($_POST['update_cart'])){
   $update_quantity = mysqli_real_escape_string($conn, $_POST['cart_quantity']);
   $update_id = mysqli_real_escape_string($conn, $_POST['cart_id']);
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id' AND user_id = '$user_id'") or die(mysqli_error($conn));
   $message[] = 'Cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = mysqli_real_escape_string($conn, $_GET['remove']);
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id' AND user_id = '$user_id'") or die(mysqli_error($conn));
   header('location:index.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die(mysqli_error($conn));
   header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<div class="message" onclick="this.remove();">'.$msg.'</div>';
   }
}
?>

<div class="container">
   <section class="products">
      <h1 class="heading">latest products</h1>
      <div class="box-container">
         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die(mysqli_error($conn));
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_products)){
         ?>
         <form action="" method="post" class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <div class="name"><?php echo $fetch_product['name']; ?></div>
            <div class="price">$<?php echo $fetch_product['price']; ?></div>
            <input type="number" min="1" name="product_quantity" value="1">
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
         </form>
         <?php
            }
         }
         ?>
      </div>
   </section>

   <section class="shopping-cart">
      <h1 class="heading">shopping cart</h1>
      <table>
         <thead>
            <th>image</th>
            <th>name</th>
            <th>price</th>
            <th>quantity</th>
            <th>total price</th>
            <th>action</th>
         </thead>
         <tbody>
            <?php
            $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die(mysqli_error($conn));
            $grand_total = 0;
            if(mysqli_num_rows($cart_query) > 0){
               while($fetch_cart = mysqli_fetch_assoc($cart_query)){
            ?>
            <tr>
               <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
               <td><?php echo $fetch_cart['name']; ?></td>
               <td>$<?php echo $fetch_cart['price']; ?></td>
               <td>
                  <form action="" method="post">
                     <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                     <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                     <input type="submit" name="update_cart" value="update" class="option-btn">
                  </form>
               </td>
               <td>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
               <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?');" class="delete-btn">remove</a></td>
            </tr>
            <?php
               $grand_total += $sub_total;
               }
            }
            ?>
            <tr class="table-bottom">
               <td colspan="4">grand total :</td>
               <td>$<?php echo $grand_total; ?></td>
               <td><a href="index.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">delete all</a></td>
            </tr>
         </tbody>
      </table>
      <div class="cart-btn">
         <a href="#" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
      </div>
   </section>
</div>

</body>
</html>
