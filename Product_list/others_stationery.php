<?php
include 'db_connect.php'; // Include your database connection script

// SQL query to select products with category_id = 5 (Other Stationery)
$sql = "SELECT * FROM products WHERE category_id = 5";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Others Stationery</title>
    <link rel="stylesheet" href="others_stationery.css">
    <style>
        .Product button {
            display: block;
            margin: 10px auto 0;
            padding: 10px 20px;
            background-color: #FAAB78;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .Product button:hover {
            background-color: #B3A492;
        }

        .Product .details {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
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
        <a id="back" href="../User_homepage/index1.html"><b>BACK TO HOME</b></a>
        <h1>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            OTHER STATIONERY
            <input type="text" name="text" class="input" placeholder="Search" style="margin-left: 80px; padding: 10px; position: absolute; top: 5%; right: 5%;">
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
