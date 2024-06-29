<?php
include 'db_connect.php'; // Include your database connection script

// SQL query to select products with category_id = 2 (Drawing and Painting)
$sql = "SELECT * FROM products WHERE category_id = 2";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drawing and Painting</title>
    <style>
    /* Reset styles and basic layout */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        line-height: 1.6;
    }

    header {
        background-color: #333;
        color: #fff;
        padding: 10px 0;
        text-align: center;
    }

    header .logo {
        width: 50px; /* Adjust size as per your logo */
        height: auto;
        vertical-align: middle;
    }

    header .input {
        width: 200px;
        height: 30px;
        font-size: 14px;
        border: none;
        padding: 5px;
        border-radius: 3px;
    }

    nav ul {
        list-style-type: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 10px;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        padding: 10px;
    }

    nav ul li a:hover {
        background-color: #555;
    }

    main {
        max-width: 800px;
        margin: 20px auto;
        padding: 0 20px;
    }

    .Product {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .Product img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto 10px;
        border-radius: 5px;
    }

    .Product h2 {
        text-align: center;
        font-size: 1.2em;
        margin-bottom: 10px;
    }

    .Product .price {
        text-align: center;
        font-size: 1.1em;
        color: #333;
        margin-bottom: 10px;
    }


    footer {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    footer nav ul {
        margin-bottom: 0;
    }

    footer nav ul li {
        display: inline;
        margin-right: 10px;
    }

    footer nav ul li a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        padding: 5px 10px;
    }

    footer nav ul li a:hover {
        background-color: #555;
    }

    footer p {
        margin-top: 10px;
        font-size: 0.8em;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        header .input {
            width: 150px;
        }

        main {
            padding: 0 10px;
        }
    }

    </style>
    <script>
        // Function to toggle product details visibility
        function toggleDetails(id) {
            const details = document.getElementById('details-' + id);
            if (details.style.display === 'none') {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <header>
        <a id="back" href="../index.html"><b>BACK TO HOME</b></a>
        <h1>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            DRAWING AND PAINTING
            <input type="text" name="text" class="input" placeholder="Search" style="margin-left: 80px;padding:10px;position: absolute;top: 5%;right: 5%;">
        </h1>
        <nav>
            <ul>
                <li><a href="../Product_list/product_list.php">All</a></li>
                <li><a href="../Product_list/office_stationery.php">Office Stationery</a></li>
                <li><a href="../Product_list/drawing_painting.php">Drawing and Painting</a></li>
                <li><a href="../Product_list/pen.php">Pen</a></li>
                <li><a href="../Product_list/adhesive_tape.php">Adhesive Tape</a></li>
                <li><a href="../Product_list/others_stationery.php">Other Stationery</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="Product">';
                echo '<img src="../Manage_product/uploads/' . htmlspecialchars($row["product_image"]) . '" alt="' . htmlspecialchars($row["product_name"]) . '">';
                echo '<h2>' . htmlspecialchars($row["product_name"]) . '</h2>';
                echo '<p class="price">RM' . htmlspecialchars($row["product_price"]) . '</p>';
                echo '<button onclick="toggleDetails(' . htmlspecialchars($row["product_id"]) . ')">View Details</button>';
                echo '<div id="details-' . htmlspecialchars($row["product_id"]) . '" style="display:none;">';
                echo '<p>' . htmlspecialchars($row["product_details"]) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No products found in this category.</p>";
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
