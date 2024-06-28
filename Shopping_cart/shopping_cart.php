<?php
// shopping_cart.php

include 'db_connection.php';
session_start();

// Redirect if not logged in
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle add to cart
if(isset($_POST['add_to_cart'])){
    // Sanitize input data
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name'] ?? '');
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price'] ?? '');
    $product_image = mysqli_real_escape_string($conn, $_POST['product_image'] ?? '');
    $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity'] ?? 1);

    // Check if the product already exists in the cart
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die(mysqli_error($conn));

    if(mysqli_num_rows($select_cart) > 0){
        $message[] = 'Product already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart` (user_id, name, price, image, quantity) VALUES ('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die(mysqli_error($conn));
        $message[] = 'Product added to cart!';
    }
}

// Handle update cart
if(isset($_POST['update_cart'])){
    $update_quantity = mysqli_real_escape_string($conn, $_POST['cart_quantity'] ?? 1);
    $update_id = mysqli_real_escape_string($conn, $_POST['cart_id'] ?? '');

    mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id' AND user_id = '$user_id'") or die(mysqli_error($conn));
    $message[] = 'Cart quantity updated successfully!';
}

// Handle remove item
if(isset($_GET['remove'])){
    $remove_id = mysqli_real_escape_string($conn, $_GET['remove'] ?? '');
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id' AND user_id = '$user_id'") or die(mysqli_error($conn));
    header('location:shopping_cart.php');
    exit;
}

// Handle delete all items
if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die(mysqli_error($conn));
    header('location:shopping_cart.php');
    exit;
}

// Fetch cart items for the logged-in user
$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="shopping_cart.css">
</head>
<body>
    <h1>Shopping Cart</h1>
    <?php
    if(mysqli_num_rows($cart_query) > 0){
        while($fetch_cart = mysqli_fetch_assoc($cart_query)){
            ?>
            <div class="cart-item">
                <img src="../Manage_product/uploads/<?php echo htmlspecialchars($fetch_cart['image']); ?>" alt="<?php echo htmlspecialchars($fetch_cart['name']); ?>">
                <p><?php echo htmlspecialchars($fetch_cart['name']); ?></p>
                <p>$<?php echo htmlspecialchars($fetch_cart['price']); ?></p>
                <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?php echo htmlspecialchars($fetch_cart['id']); ?>">
                    <input type="number" name="cart_quantity" value="<?php echo htmlspecialchars($fetch_cart['quantity']); ?>" min="1">
                    <button type="submit" name="update_cart">Update</button>
                </form>
                <a href="shopping_cart.php?remove=<?php echo htmlspecialchars($fetch_cart['id']); ?>">Remove</a>
            </div>
            <?php
        }
    } else {
        echo '<p>Your cart is empty</p>';
    }
    ?>
    <a href="shopping_cart.php?delete_all">Delete All Items</a>
    <a href="../Product_list2/product_list2.php">Continue Shopping</a>
</body>
</html>
