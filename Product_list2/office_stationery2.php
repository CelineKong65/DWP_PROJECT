

<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = 'Please log in to add items to wishlist or cart.';
    header('Location: ../login/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle add to wishlist
if (isset($_POST['add_to_wishlist'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    // Check if the product is already in the wishlist
    $select_wishlist = mysqli_query($conn, "SELECT * FROM wishlist WHERE product_id = '$product_id' AND user_id = '$user_id'");
    
    if (mysqli_num_rows($select_wishlist) > 0) {
        $_SESSION['message'] = 'Product already added to wishlist!';
    } else {
        if (mysqli_query($conn, "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')")) {
            $_SESSION['message'] = 'Product added to wishlist!';
        } else {
            $_SESSION['message'] = 'Failed to add product to wishlist: ' . mysqli_error($conn);
            error_log('Failed to add product to wishlist: ' . mysqli_error($conn));
        }
    }
    header('Location: office_stationery2.php');
    exit;
}

// Handle add to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']);

    // Retrieve product details from products table
    $product_query = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '$product_id'");
    if ($product_query && mysqli_num_rows($product_query) > 0) {
        $product = mysqli_fetch_assoc($product_query);
        
        // Insert into cart table
        $sql = "INSERT INTO cart (user_id, name, price, image, quantity) 
                VALUES ('$user_id', '" . mysqli_real_escape_string($conn, $product['product_name']) . "', '" . mysqli_real_escape_string($conn, $product['product_price']) . "', '" . mysqli_real_escape_string($conn, $product['product_image']) . "', '$product_quantity')";
        
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = 'Product added to cart!';
        } else {
            $_SESSION['message'] = 'Failed to add product to cart: ' . mysqli_error($conn);
            error_log('Failed to add product to cart: ' . mysqli_error($conn));
        }
    } else {
        $_SESSION['message'] = 'Product not found!';
        error_log('Product not found: ' . mysqli_error($conn));
    }
    header('Location: office_stationery2.php');
    exit;
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office Stationery</title>
    <link rel="stylesheet" href="office_stationery2.css">
    <style>
    input[type=number] {
        width: 40px; /* Adjust width as needed */
        padding: 8px; /* Adjust padding for better appearance */
        font-size: 14px; /* Adjust font size */
        text-align: center; /* Center-align text */
        margin-top:10px;
    }
    #buttonOK
    {
        background-color: #FFDBAA;
        border: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        margin-top: 20px;
        padding: 10px 20px;
        transition: background-color 0.3s;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; 
        margin: 20px 30px 10px 30px;
    }

    #buttonOK:hover 
    {
        background-color: #FAAB78;
    }

    </style>
    <script>
        function toggleWishlist(button) {
            button.classList.toggle('active');
        }

        function showMessage(message) {
            if (message) {
                alert(message);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const message = "<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?>";
            if (message) {
                showMessage(message);
                <?php unset($_SESSION['message']); ?>
            }
        });
    </script>
</head>
<body>
    <header>
        <a id="back" href="../User_homepage/user_homepage.php"><b>BACK TO HOME</b></a>
        <h1>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            ADHESIVE TAPE
            <input type="text" name="text" class="input" placeholder="Search" style="margin-left: 80px;padding:10px;position: absolute;top: 5%;right: 5%;">
        </h1>
        <nav>
            <ul>
                <li><a href="../Product_list2/product_list2.php">All</a></li>
                <li><a href="../Product_list2/office_stationery2.php">Office Stationery</a></li>
                <li><a href="../Product_list2/drawing_painting2.php">Drawing and Painting</a></li>
                <li><a href="../Product_list2/pen2.php">Pen</a></li>
                <li><a href="../Product_list2/adhesive_tape2.php">Adhesive Tape</a></li>
                <li><a href="../Product_list2/others_stationery2.php">Other Stationery</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
        include 'db_connection.php';
        
        // SQL query to select products with category_id = 1 
        $sql = "SELECT * FROM products WHERE category_id = 1";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="Product">';
                echo '<img src="../Manage_product/uploads/' . htmlspecialchars($row["product_image"]) . '" alt="' . htmlspecialchars($row["product_name"]) . '">';
                echo '<h2>' . htmlspecialchars($row["product_name"]) . '</h2>';
                echo '<p class="price">RM' . htmlspecialchars($row["product_price"]) . '</p>';
                echo '<a href="product_details.php?id=' . htmlspecialchars($row["product_id"]) . '" class="detailButton">View Details</a>';
                echo '<form method="POST" action="">';
                echo '<input type="hidden" name="product_id" value="' . $row["product_id"] . '">';
                echo '<button type="submit" name="add_to_wishlist" class="wishlist-heart"></button>';
                echo '</form>';
                echo '<form method="post" action="">
                    <input type="hidden" name="product_id" value="' . $row["product_id"] . '">
                    <input type="number" name="product_quantity" value="1" min="1">
                    <button type="submit" name="add_to_cart" id="buttonOK">Add to Cart</button>
                </form>';
                echo '</div>';
            }
        } else {
            echo "<p>No products found in this category.</p>";
        }
        $conn->close();
        ?>
    </main>

    <!-- Shopping Cart and Wishlist Buttons -->
    <a href="../Shopping_cart/shopping_cart.php"><button class="shopping-cart-button">🛒</button></a>  
    <a href="../Wishlist/Wishlist.php"><button class="wishlist-button">&#10084;</button></a>

    <footer>
        <nav>
            <ul>
                <li><a href="../About_us/aboutus.html">About</a></li>
                <li><a href="../Product_list/product_list2.php">Services</a></li>
                <li><a href="../Contact_us/contact_us2.php">Contact</a></li>
                <li><a href="../User/user_profile.php">Account</a></li>
            </ul>
        </nav>
        <p>&copy; 2019-2024 OKAY Stationery Shop. All rights reserved. OKAY Company</p>
    </footer>
</body>
</html>
