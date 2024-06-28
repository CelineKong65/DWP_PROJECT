<?php
include 'db_connection.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle update cart
if (isset($_POST['update_cart'])) {
    $update_quantity = mysqli_real_escape_string($conn, $_POST['cart_quantity'] ?? 1);
    $update_id = mysqli_real_escape_string($conn, $_POST['cart_id'] ?? '');

    mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id' AND user_id = '$user_id'") or die(mysqli_error($conn));
    $_SESSION['message'] = 'Cart quantity updated successfully!';
}

// Handle remove item
if (isset($_GET['remove'])) {
    $remove_id = mysqli_real_escape_string($conn, $_GET['remove']);
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id' AND user_id = '$user_id'") or die(mysqli_error($conn));
    $_SESSION['message'] = 'Item removed from cart!';
    header('location:shopping_cart.php');
    exit;
}

// Handle delete all items
if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die(mysqli_error($conn));
    $_SESSION['message'] = 'All items deleted from cart!';
    header('location:shopping_cart.php');
    exit;
}

// Fetch cart items for the logged-in user
$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die(mysqli_error($conn));

// Calculate total price
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="shoppingcart.css">
</head>
<body>
    <header>
        <a id="back" href="../User_homepage/user_homepage.php"><b>BACK</b></a>
        <h1>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            SHOPPING CART
        </h1>
    </header>
    <main>
        <div class="cart">
            <?php
            if (mysqli_num_rows($cart_query) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
                    $total_price += $fetch_cart['price'] * $fetch_cart['quantity'];
                    ?>
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="../Manage_product/uploads/<?php echo htmlspecialchars($fetch_cart['image']); ?>" alt="<?php echo htmlspecialchars($fetch_cart['name']); ?>">
                        </div>
                        <div class="item-details">
                            <h2><?php echo htmlspecialchars($fetch_cart['name']); ?></h2>
                            <p class="price">RM<?php echo htmlspecialchars($fetch_cart['price']); ?></p>
                            <form action="" method="post" class="quantity-controls">
                                <input type="hidden" name="cart_id" value="<?php echo htmlspecialchars($fetch_cart['id']); ?>">
                                <button type="submit" name="update_cart" class="quantity-btn">Update</button>
                                <input type="number" name="cart_quantity" value="<?php echo htmlspecialchars($fetch_cart['quantity']); ?>" min="1" class="quantity">
                            </form>
                            <form method="GET" action="shopping_cart.php">
                                <input type="hidden" name="remove" value="<?php echo htmlspecialchars($fetch_cart['id']); ?>">
                                <button type="submit" class="remove-button">Remove</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p>Your cart is empty</p>';
            }
            ?>
        </div>
        <div class="cart-actions">
            <p>Total: RM <?php echo number_format($total_price, 2); ?></p>
            <a href="shopping_cart.php?delete_all" class="remove-btn">Delete All Items</a>
            <a href="../Product_list2/product_list2.php" class="checkout-btn">Continue Shopping</a>
            <a href="../Payment/payment.html" class="checkout-btn">Checkout</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2019-2024 OKAY Stationery Shop. All rights reserved. OKAY Company</p>
    </footer>
</body>
</html>
