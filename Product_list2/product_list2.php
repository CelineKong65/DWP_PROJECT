<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<body>

<?php
include 'db_connection.php';

$sql = "SELECT product_id, product_name, product_price, product_image FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery Products</title>
    <link rel="stylesheet" href="product_list2.css">
</head>

<script>
function toggleWishlist(button) {
    button.classList.toggle('active');
}
</script>

<body>
    <header>
        <a id="back" href="../User_homepage/index2.html"><b>BACK</b></a>
        <h1>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            OKAY STATIONERY PRODUCTS
            <input type="text" name="text" class="input" placeholder="Search" style="margin-left: 80px;padding:10px;position: absolute;top: 5%;right: 5%;">
        </h1>
        <nav>
            <ul>
                <li><a href="../Product_list2/product_list2.php">All</a></li>
                <li><a href="../Product_list2/office_stationery2.html">Office Stationery</a></li>
                <li><a href="../Product_list2/drawing_painting2.html">Drawing and Painting</a></li>
                <li><a href="../Product_list2/pen2.html">Pen</a></li>
                <li><a href="../Product_list2/adhesive_tape2.html">Adhesive Tape</a></li>
                <li><a href="../Product_list2/others_stationery2.html">Other Stationery</a></li>
            </ul>
    </header>
    <main>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="Product">';
                echo "<td><img src='../Manage_product/uploads/" . htmlspecialchars($row["product_image"]) . "' alt='" . htmlspecialchars($row["product_name"]) . "'></td>";
                echo '<h2>' . $row["product_name"] . '</h2>';
                echo '<p class="price">RM' . $row["product_price"] . '</p>';
                echo '<div id="move"><button class="wishlist-heart" onclick="toggleWishlist(this)"></button></div>';
                echo '<a href="../Product_list/' . strtolower(str_replace(' ', '_', $row["product_name"])) . '_details.html" class="detailButton">View Details</a>';
                echo '<button id="buttonOK">Add to Cart</button>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        <a href="../Shopping_cart/shopping_cart.html"><button class="shopping-cart-button">🛒</button></a>
        <a href="../Wishlist/Wishlist.html"><button class="wishlist-button">&#10084;</button></a>
    </main>
    <footer>
        <nav>
            <ul>
                <li><a href="../About_us/aboutus2.html">About</a></li>
                <li><a href="../Product_list2/product_list2.html">Services</a></li>
                <li><a href="../Contact_us/contact_us2.html">Contact</a></li>
                <li><a href="../User/user_profile.php">Account</a></li>
            </ul>
        </nav>
        <p>&copy; 2019-2024 OKAY Stationery Shop. All rights reserved. OKAY Company</p>
    </footer>
</body>
</html>
