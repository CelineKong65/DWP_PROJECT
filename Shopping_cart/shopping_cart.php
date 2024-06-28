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
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #FFD495;
            color: #fff;
            padding: 25px 0;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        header h1 {
            margin: 0;
            font-size: 2em;
            display: flex;
            align-items: center;
        }

        .logo {
            width: 90px;
            height: 70px;
            margin-right: 10px; /* Adjust margin as needed */
        }

        main {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .cart-item {
            width: 100%;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            margin-bottom: 20px;
        }

        .item-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
        }

        .item-image img {
            max-height: 100%;
            max-width: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .item-details {
            flex: 2;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .item-details h2 {
            margin: 0;
            font-size: 1.5em;
            color: #333;
        }

        .price {
            font-size: 1.2em;
            color: #666;
            margin-bottom: 10px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .quantity-btn {
            background-color: #ddd;
            color: #333;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .quantity {
            width: 60px;
            padding: 8px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        .remove-btn {
            background-color: #c0392b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        .remove-btn:hover {
            background-color: #a93226;
        }

        .cart-actions {
            width: 100%;
            max-width: 600px;
            background-color: #FFD495;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
            margin-top: 20px;
        }

        .cart-actions p {
            font-size: 1.2em;
            color: #333;
            margin: 0;
        }

        .button-group {
            display: flex;
            gap: 20px;
        }

        .checkout-btn {
            background-color: #FAAB78;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Ensure inline display for padding */
        }

        .checkout-btn:hover {
            background-color: #B3A492;
        }

        /* Media query for responsive design */
        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
            }

            .item-image {
                height: auto;
            }
        }
        #back {
            position: absolute;
            top: 15px;
            left: 15px;
            color: #FFD4B2; /* Text color */
            background-color: #fff;
            font-size: 20px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            border: 1px solid #ffefe3;
            border-radius: 10px;
            padding: 5px 10px;
            text-decoration: none; /* Removes underline */
        }
    </style>
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
                    // Calculate total price for this item
                    $item_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                    $total_price += $item_total;
                    ?>
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="../Manage_product/uploads/<?php echo htmlspecialchars($fetch_cart['image']); ?>" alt="<?php echo htmlspecialchars($fetch_cart['name']); ?>">
                        </div>
                        <div class="item-details">
                            <h2><?php echo htmlspecialchars($fetch_cart['name']); ?></h2>
                            <p class="price">RM<?php echo htmlspecialchars($fetch_cart['price']); ?></p>
                            <p class="item-total">Total: RM<?php echo number_format($item_total, 2); ?></p>
                            <form action="" method="post" class="quantity-controls">
                                <input type="hidden" name="cart_id" value="<?php echo htmlspecialchars($fetch_cart['id']); ?>">
                                <button type="submit" name="update_cart" class="quantity-btn">Update</button>
                                <input type="number" name="cart_quantity" value="<?php echo htmlspecialchars($fetch_cart['quantity']); ?>" min="1" class="quantity">
                            </form>
                            <form method="GET" action="shopping_cart.php">
                                <input type="hidden" name="remove" value="<?php echo htmlspecialchars($fetch_cart['id']); ?>">
                                <button type="submit" class="remove-btn">Remove</button>
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
            <div class="button-group">
                <a href="shopping_cart.php?delete_all" class="checkout-btn">Delete All Items</a>
                <a href="../Product_list2/product_list2.php" class="checkout-btn">Continue Shopping</a>
                <a href="../Payment/payment.html" class="checkout-btn">Checkout</a>
            </div>
        </div>
    </main>
</body>
</html>