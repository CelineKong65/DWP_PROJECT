<?php
@include 'config.php';

if(isset($_POST['add_product'])){
   if (!empty($_POST['product_name']) && !empty($_POST['product_price']) && !empty($_FILES['product_image']['name'])) {
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_FILES['product_image']['name'];
      $tmp_name = $_FILES['product_image']['tmp_name'];
      $upload_path = "uploaded_img/";

      // Sanitize inputs
      $product_name = mysqli_real_escape_string($conn, $product_name);
      $product_price = mysqli_real_escape_string($conn, $product_price);
      $product_image = mysqli_real_escape_string($conn, $product_image);

      // Insert product into database
      $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$product_name', '$product_price', '$product_image')");

      if($insert_product){
         move_uploaded_file($tmp_name, $upload_path.$product_image);
         $message[] = 'Product added successfully';
      }else{
         $message[] = 'Failed to add product';
      }
   } else {
      $message[] = 'Please fill all the fields';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Panel</title>

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
   <section class="admin-panel">
      <h1 class="heading">Admin Panel - Add Products</h1>
      <?php
      if(isset($message)){
         foreach($message as $msg){
            echo '<div class="message"><span>'.$msg.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = \'none\';"></i> </div>';
         }
      }
      ?>
      <form action="" method="post" enctype="multipart/form-data">
         <label for="name">Product Name</label>
         <input type="text" id="name" name="product_name" required>
         <label for="price">Price</label>
         <input type="text" id="price" name="product_price" required>
         <label for="image">Product Image</label>
         <input type="file" id="image" name="product_image" accept="image/*" required>
         <input type="submit" class="btn" name="add_product" value="Add Product">
      </form>
   </section>
</div>

<!-- Custom JS -->
<script src="script.js"></script>

</body>
</html>
