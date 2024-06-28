<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
   header('location:login.php');
   exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['remove_wishlist'])) {
    $remove_id = mysqli_real_escape_string($conn, $_GET['remove_wishlist']);
    mysqli_query($conn, "DELETE FROM wishlist WHERE id = '$remove_id' AND user_id = '$user_id'") or die(mysqli_error($conn));
    header('location:wishlist.php');
    exit;
}

// Query to retrieve wishlist items
$wishlist_query = mysqli_query($conn, "SELECT w.id AS wishlist_id, p.product_name, p.product_price, p.product_image FROM wishlist w JOIN products p ON w.product_id = p.product_id WHERE w.user_id = '$user_id'") or die('Query failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - Okay Stationery Shop</title>
    <link rel="stylesheet" href="wishlist.css">
</head>
<body>
    <header>
        <h1>
            <a id="back" href="../Product_list2/product_list2.html"><b>BACK TO PRODUCT LIST</b></a>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            OKAY STATIONERY SHOP
        </h1>
    </header>
    <div class="container">
        <h2>Your Wishlist</h2>
        <div class="wishlist">

        <?php
        // Display messages if any
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<div class="message" onclick="this.remove();">'.$msg.'</div>';
            }
        }

        // Display wishlist items
        while ($row = mysqli_fetch_assoc($wishlist_query)) {
            echo '<div class="wishlist-item">';
            echo '<img class="wishlist-item-image" src="../Manage_product/uploads/' . htmlspecialchars($row['product_image']) . '" alt="' . htmlspecialchars($row['product_name']) . '">';
            echo '<div class="wishlist-item-details">';
            echo '<h3>' . htmlspecialchars($row['product_name']) . '</h3>';
            echo '<p>Price: RM' . htmlspecialchars($row['product_price']) . '</p>';
            echo '</div>';
            echo '<a class="remove-button" href="wishlist.php?remove_wishlist=' . $row['wishlist_id'] . '">Remove</a>';
            echo '</div>';
        }
        ?>

        </div>
    </div>
</body>
</html>
