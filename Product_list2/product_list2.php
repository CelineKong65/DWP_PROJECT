<?php
include 'db_connection.php';
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
        $_SESSION['message'] = 'Product already added to wishlist!';
    } else {
        mysqli_query($conn, "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')") or die(mysqli_error($conn));
        $_SESSION['message'] = 'Product added to wishlist!';
    }
    header('location: product_list2.php');
    exit;
}

if (isset($_GET['remove_wishlist'])) {
    $remove_id = mysqli_real_escape_string($conn, $_GET['remove_wishlist']);
    mysqli_query($conn, "DELETE FROM wishlist WHERE id = '$remove_id' AND user_id = '$user_id'") or die(mysqli_error($conn));
    header('location:wishlist.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery Products</title>
    <link rel="stylesheet" href="product_list2.css">
    <script>
        function toggleWishlist(button) {
            button.classList.toggle('active');
        }

        function showMessage(message) {
            if (message) {
                alert(message);
            }
        }
    </script>
</head>
<body onload="showMessage('<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; unset($_SESSION['message']); ?>')">
    <header>
        <a id="back" href="../User_homepage/index2.html"><b>BACK</b></a>
        <h1>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            OKAY STATIONERY PRODUCTS
            <input type="text" name="text" class="input" placeholder="Search" style="margin-left: 80px; padding:10px; position: absolute; top: 5%; right: 5%;">
        </h1>
        <nav>
            <ul>
                <li><a href="product_list2.php">All</a></li>
                <li><a href="office_stationery2.html">Office Stationery</a></li>
                <li><a href="drawing_painting2.html">Drawing and Painting</a></li>
                <li><a href="pen2.html">Pen</a></li>
                <li><a href="adhesive_tape2.html">Adhesive Tape</a></li>
                <li><a href="others_stationery2.html">Other Stationery</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
        $sql = "SELECT product_id, product_name, product_price, product_image FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="Product">';
                echo '<img src="../Manage_product/uploads/' . htmlspecialchars($row["product_image"]) . '" alt="' . htmlspecialchars($row["product_name"]) . '">';
                echo '<h2>' . $row["product_name"] . '</h2>';
                echo '<p class="price">RM' . $row["product_price"] . '</p>';
                echo '<form method="POST" action="">';
                echo '<input type="hidden" name="product_id" value="' . $row["product_id"] . '">';
                echo '<button type="submit" name="add_to_wishlist" class="wishlist-heart" onclick="toggleWishlist(this)"></button>';
                echo '</form>';
                echo '<a href="../Product_list/' . strtolower(str_replace(' ', '_', $row["product_name"])) . '_details.html" class="detailButton">View Details</a>';
                echo '<button id="buttonOK">Add to Cart</button>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        <a href="../Shopping_cart/shopping_cart.php"><button class="shopping-cart-button">🛒</button></a>
        <a href="../Wishlist/Wishlist.php"><button class="wishlist-button">&#10084;</button></a>
    </main>
    <footer>
        <nav>
            <ul>
                <li><a href="../About_us/aboutus2.html">About</a></li>
                <li><a href="product_list2.php">Services</a></li>
                <li><a href="../Contact_us/contact_us2.php">Contact</a></li>
                <li><a href="../User/user_profile.php">Account</a></li>
            </ul>
        </nav>
        <p>&copy; 2019-2024 OKAY Stationery Shop. All rights reserved. OKAY Company</p>
    </footer>
</body>
</html>
