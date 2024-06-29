<?php
include 'db_connect.php'; // Include your database connection script

// SQL query to select products with category_id = 5 (Pen)
$sql = "SELECT * FROM products WHERE category_id = 5";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pen</title>
    <link rel="stylesheet" href="pen.css">
    <style>
    body {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #FFD495;
        color: #fff;
        padding: 20px;
        text-align: center;
    }

    .logo {
        width: 100px;
        height: 80px;
        vertical-align: middle;
        margin-right: 10px;
    }

    nav ul {
        list-style-type: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 20px;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 20px;
    }

    nav ul li a:hover {
        text-decoration: underline;
    }

    main {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Define the number of columns */
        gap: 20px; /* Space between grid items */
        padding: 20px;
    }

    .Card {
        box-sizing: border-box;
    }

    .Product {
        border: 7px solid #D6C7AE;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        font-size: 14px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .Product img {
        height: 150px;
        width: 150px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .Product h2 {
        font-size: 16px;
        margin: 10px 0;
        color: #333;
    }

    .price {
        color: #333;
        font-weight: bold;
        font-size: 16px;
    }

    .Product:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    footer {
        background: #333;
        color: #fff;
        text-align: center;
        padding: 1rem;
        width: 100%;
        clear: both;
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
            PEN
            <input type="text" name="text" class="input" placeholder="Search" style="margin-left: 80px; padding:10px; position: absolute; top: 5%; right: 5%;">
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
            while ($row = $result->fetch_assoc()) {
                echo '<div class="Card">';
                echo '<div class="Product">';
                echo '<div>';
                echo '<img src="../Manage_product/uploads/' . htmlspecialchars($row["product_image"]) . '" alt="' . htmlspecialchars($row["product_name"]) . '">';
                echo '<h2>' . htmlspecialchars($row["product_name"]) . '</h2>';
                echo '<p class="price">RM' . htmlspecialchars($row["product_price"]) . '</p>';
                echo '<button onclick="toggleDetails(' . htmlspecialchars($row["product_id"]) . ')">View Details</button>';
                echo '<div id="details-' . htmlspecialchars($row["product_id"]) . '" style="display:none;">';
                echo '<p>' . htmlspecialchars($row["product_details"]) . '</p>';
                echo '</div>';
                echo '</div>';
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
