<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
   header('location:login.php');
   exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_wishlist'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    // Check if the product is already in the wishlist
    $select_wishlist = mysqli_query($conn, "SELECT * FROM wishlist WHERE product_id = '$product_id' AND user_id = '$user_id'") or die(mysqli_error($conn));

    if (mysqli_num_rows($select_wishlist) > 0) {
        $message[] = 'Product already added to wishlist!';
    } else {
        mysqli_query($conn, "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')") or die(mysqli_error($conn));
        $message[] = 'Product added to wishlist!';
    }
    header('location:index.php');
    exit;
}

// Example query to retrieve products
$select_product = mysqli_query($conn, "SELECT * FROM products") or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Listing</title>
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

<div class="products">

   <h1 class="heading">Latest Products</h1>

   <div class="box-container">
   <?php
   if (mysqli_num_rows($select_product) > 0) {
      while ($fetch_product = mysqli_fetch_assoc($select_product)) {
   ?>
         <form method="post" class="box" action="index.php">
            <img src="images/<?php echo $fetch_product['image']; ?>" alt="">
            <div class="name"><?php echo $fetch_product['name']; ?></div>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
            <input type="submit" value="Add to Wishlist" name="add_to_wishlist" class="btn">
         </form>
   <?php
      }
   } else {
      echo 'No products found.';
   }
   ?>
   </div>

</div>

</body>
</html>
