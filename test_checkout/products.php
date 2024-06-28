<?php
session_start(); // Start or resume session

// Include database connection file
include 'config.php';

// Check if Add to Cart button is clicked
if(isset($_POST['add_to_cart'])) {
    // Retrieve product details from the form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    // Sanitize and validate inputs if necessary
    // Example:
    // $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    // $product_price = floatval($_POST['product_price']); // Convert to float

    // Create an array to store product information
    $product_details = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'image' => $product_image,
        'quantity' => 1 // Default quantity when adding to cart
    ];

    // Initialize cart session if not already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in cart based on product id
    $product_in_cart = false;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id) {
            // If product already exists in cart, increment quantity
            $_SESSION['cart'][$key]['quantity']++;
            $product_in_cart = true;
            break;
        }
    }

    // If product is not in cart, add it
    if (!$product_in_cart) {
        $_SESSION['cart'][] = $product_details;
    }

    // Optionally, redirect to cart.php or show a message
    header('Location: cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
   <section class="products">
      <h1 class="heading">Latest Products</h1>
      <div class="box-container">
         <?php
         // Fetch products from database
         $select_products = mysqli_query($conn, "SELECT * FROM products");
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_products)){
         ?>
         <form action="cart.php" method="post"> <!-- Ensure the form action points to cart.php -->
            <div class="box">
               <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
               <h3><?php echo $fetch_product['name']; ?></h3>
               <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
               <!-- Hidden fields to pass product information -->
               <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
               <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
               <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
               <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
               <!-- Add to Cart button -->
               <button type="submit" class="btn" name="add_to_cart">Add to Cart</button>
            </div>
         </form>
         <?php
            }
         } else {
            echo "<p>No products found.</p>";
         }
         ?>
      </div>
   </section>
</div>

<!-- Custom JS -->
<script src="script.js"></script>

</body>
</html>
