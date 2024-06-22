<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission for adding new category
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
    $category_id = $_POST["category_id"];
    $category_name = $_POST["category_name"];

    if (!empty($category_id) && !empty($category_name)) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO category (category_id, category_name) VALUES (?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters and execute SQL statement
        $stmt->bind_param("ss", $category_id, $category_name);
        if ($stmt->execute()) {
            echo "<script>alert('Category added successfully');</script>";
        } else {
            echo "<script>alert('Error adding category: " . $stmt->error . "');</script>";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "<script>alert('Please fill in all fields');</script>";
    }
}

// Display categories
$categoryQuery = "SELECT * FROM category";
$categoryResult = $conn->query($categoryQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="manage_category.css">
    <style>
        /* Your existing styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal button {
            background-color: #B3C8CF;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal button:hover {
            background-color: #98B0B9;
        }

        #addCategoryBtn {
            background-color: #98B0B9;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin: 20px auto;
            display: block;
        }

        #addCategoryBtn:hover {
            background-color: #0056b3;
        }

        /* Other styles remain unchanged */
    </style>
</head>
<body>
    <header>
        <a id="back" href="../Admin_homepage/Admin_home.php"><b>BACK TO ADMIN PAGE</b></a>
        <div class="container">
            <h1>OKAY STATIONERY SHOP</h1>
        </div>
    </header>

    <h2 style="text-align: center; margin-top: 5%;">Manage Category</h2>
    
    <table class="category-list">
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>View Products</th>
                <th>Delete Category</th>
            </tr>
        </thead>
        <tbody>
    <?php
    if ($categoryResult->num_rows > 0) {
        while($categoryRow = $categoryResult->fetch_assoc()) {
            echo "<tr>
                    <td>{$categoryRow['category_id']}</td>
                    <td>{$categoryRow['category_name']}</td>
                    <td>
                        <a href='#' class='view-link' data-id='" . htmlspecialchars($categoryRow['category_id'], ENT_QUOTES) . "'>View Products</a>
                    </td>
                    <td>
                        <a href='category_delete.php?category_id={$categoryRow['category_id']}'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No categories found</td></tr>";
    }

    $conn->close();
    ?>
        </tbody>
    </table>

    <!-- Move the Add Category button here -->
    <button id="addCategoryBtn">Add Category</button>

    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Category</h2>
            <form action="manage_category.php" method="post">
                <label for="category_id"><b>Category ID:</b></label>
                <input type="text" id="category_id" name="category_id" required>

                <label for="category_name"><b>Category Name:</b></label>
                <input type="text" id="category_name" name="category_name" required>

                <button type="submit" name="add_category">Add Category</button>
            </form>
        </div>
    </div>

<!-- View Product Modal -->
<div id="viewProductModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Product Details</h2>
        <div id="productDetails">
        <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if category_id parameter is set
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Prepare and execute SQL query to fetch product details
    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $category_id); // 'i' because category_id is integer in this example
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the product details - Assuming there could be multiple rows
        while ($product = $result->fetch_assoc()) {
            echo "<p><b>Product ID:</b> " . htmlspecialchars($product['product_id'], ENT_QUOTES) . "</p>";
            echo "<p><b>Product Name:</b> " . htmlspecialchars($product['product_name'], ENT_QUOTES) . "</p>";
            echo "<p><b>Product Price:</b> RM" . htmlspecialchars($product['product_price'], ENT_QUOTES) . "</p>";
            echo "<p><b>Product Quantity:</b> " . htmlspecialchars($product['product_quantity'], ENT_QUOTES) . "</p>";
            echo "<p><b>Product Image:</b> <img src='uploads/" . htmlspecialchars($product['product_image'], ENT_QUOTES) . "' alt='" . htmlspecialchars($product['product_name'], ENT_QUOTES) . "' style='max-width: 200px;'></p>";
            // Display other product details as needed
        }
    } else {
        echo "<p>No products found in category with ID: $category_id</p>";
    }

    // Close statement
    $stmt->close();
} else {
    echo "<p>No category ID provided</p>";
}

$conn->close();
?>



        </div>
    </div>
</div>

<script>
    var modal = document.getElementById("categoryModal");
    var viewModal = document.getElementById("viewProductModal");
    var btn = document.getElementById("addCategoryBtn");
    var span = document.getElementsByClassName("close");

    btn.onclick = function() {
        modal.style.display = "block";
    }

    Array.prototype.forEach.call(span, function(element) {
        element.onclick = function() {
            modal.style.display = "none";
            viewModal.style.display = "none";
        }
    });

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        } else if (event.target == viewModal) {
            viewModal.style.display = "none";
        }
    }

    // JavaScript to handle view link click and display modal with product details
    var viewLinks = document.getElementsByClassName('view-link');
    Array.prototype.forEach.call(viewLinks, function(element) {
        element.onclick = function(event) {
            event.preventDefault();
            var productId = this.getAttribute('data-id');
            fetchProductDetails(productId);
            viewModal.style.display = "block";
        }
    });

    function fetchProductDetails(productId) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_product_details.php?product_id=" + productId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("productDetails").innerHTML = xhr.responseText;
            }
        }
        xhr.send();
    }
</script>

</body>
</html>




