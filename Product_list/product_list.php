<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<body>

<?php
include 'db_connect.php';

$sql = "SELECT product_id, product_name, product_price, product_image FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery Products</title>
    <link rel="stylesheet" href="product_list.css">
</head>

<script>
function toggleWishlist(button) {
    button.classList.toggle('active');
}
</script>

<body>
    <header>
        <a id="back" href="../index.html"><b>BACK</b></a>
        <h1>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            OKAY STATIONERY PRODUCTS
            <input type="text" name="text" class="input" placeholder="Search" style="margin-left: 80px;padding:10px;position: absolute;top: 5%;right: 5%;">
        </h1>
        <nav>
            <ul>
                <li><a href="../Product_list/product_list.php">All</li>
                <li><a href="../Product_list/office_stationery.php">Office Stationery</a></li>
                <li><a href="../Product_list/drawing_painting.php">Drawing and Painting</a></li>
                <li><a href="../Product_list/pen.php">Pen</a></li>
                <li><a href="../Product_list/adhesive_tape.php">Adhesive Tape</a></li>
                <li><a href="../Product_list/others_stationery.php">Other Stationery</a></li>
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
                echo '<a href="../Product_list/' . strtolower(str_replace(' ', '_', $row["product_name"])) . '_details.html" class="detailButton">View Details</a>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </main>
    <footer>
        <nav>
            <ul>
                <li><a href="../About_us/aboutus.html">About</a></li>
                <li><a href="../Product_list/product_list.php">Services</a></li>
                <li><a href="../Contact_us/contact_us.php">Contact</a></li>
                <li><a href="../login/login.php">Account</a></li>
            </ul>
        </nav>
        <p>&copy; 2019-2024 OKAY Stationery Shop. All rights reserved. OKAY Company</p>
    </footer>
</body>
</html>
