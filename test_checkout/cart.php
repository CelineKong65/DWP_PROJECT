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
   <title>Shopping Cart</title>

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
   <section class="shopping-cart">
      <h1 class="heading">Shopping Cart</h1>
      <table>
         <thead>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
         </thead>
         <tbody>
            <?php 
            $grand_total = 0;
            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
               foreach ($_SESSION['cart'] as $key => $item) {
                  $sub_total = $item['price'] * $item['quantity'];
                  $grand_total += $sub_total;
            ?>
            <tr>
               <td><img src="uploaded_img/<?php echo $item['image']; ?>" height="100" alt=""></td>
               <td><?php echo $item['name']; ?></td>
               <td>$<?php echo $item['price']; ?>/-</td>
               <td>
                  <form action="" method="post">
                     <input type="hidden" name="update_quantity_id" value="<?php echo $item['id']; ?>">
                     <input type="number" name="update_quantity" min="1" value="<?php echo $item['quantity']; ?>">
                     <input type="submit" value="Update" name="update_update_btn">
                  </form>
               </td>
               <td>$<?php echo $sub_total; ?>/-</td>
               <td><a href="cart.php?remove=<?php echo $item['id']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"><i class="fas fa-trash"></i> Remove</a></td>
            </tr>
            <?php
               }
            } else {
               echo "<tr><td colspan='6'>Your cart is empty!</td></tr>";
            }
            ?>
            <tr class="table-bottom">
               <td><a href="products.php" class="option-btn">Continue Shopping</a></td>
               <td colspan="3">Grand Total</td>
               <td>$<?php echo $grand_total; ?>/-</td>
               <td><a href="cart.php?delete_all" onclick="return confirm('Are you sure you want to delete all items?');" class="delete-btn"><i class="fas fa-trash"></i> Delete All</a></td>
            </tr>
         </tbody>
      </table>
      <div class="checkout-btn">
         <a href="checkout.php" class="btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
      </div>
   </section>
</div>

<!-- Custom JS -->
<script src="script.js"></script>

</body>
</html>
