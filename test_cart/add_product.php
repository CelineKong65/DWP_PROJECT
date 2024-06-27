<?php
include 'config.php';
session_start();

// Check if the user is an admin (add your own admin verification logic here)
if(!isset($_SESSION['admin'])){
   header('location:login.php');
   exit;
}

if(isset($_POST['add_product'])){
   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(!empty($product_name) && !empty($product_price) && !empty($product_image)){
      $insert = mysqli_query($conn, "INSERT INTO `products` (name, price, image) VALUES ('$product_name', '$product_price', '$product_image')") or die(mysqli_error($conn));
      if($insert){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'Product added successfully!';
      } else {
         $message[] = 'Failed to add product!';
      }
   } else {
      $message[] = 'Please fill out all fields!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Product</title>
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

<div class="form-container">
   <form action="" method="post" enctype="multipart/form-data">
      <h3>Add New Product</h3>
      <input type="text" name="product_name" required placeholder="Enter product name" class="box">
      <input type="text" name="product_price" required placeholder="Enter product price" class="box">
      <input type="file" name="product_image" required accept="image/*" class="box">
      <input type="submit" name="add_product" class="btn" value="Add Product">
   </form>
</div>

</body>
</html>
