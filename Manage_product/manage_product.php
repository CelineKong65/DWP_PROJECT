<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management Page</title>
    <link rel="stylesheet" href="manage_product.css">
    <style>
   
    input[type="text"], input[type="file"] {
        width: 590px;
        height: 40px;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .product-card {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px;
        width: 300px;
        display: inline-block;
    }

    .product-card img {
        max-width: 100%;
        height: auto;
    }

    .product-card .product-info {
        margin-top: 10px;
    }

    .product-card .product-quantity {
        margin-top: 10px;
    }

    .product-card button {
        padding: 5px 10px;
        margin-top: 5px;
        cursor: pointer;
    }
    </style>
</head>
<body>
    <header>
        <a id="back" href="../Admin_home.html"><b>BACK TO ADMIN PAGE</b></a>
        <div class="container">
            <h1>OKAY STATIONERY SHOP</h1>
        </div>
    </header>
    <h2>Manage Product</h2>
   
    <main>
        <?php include 'display_products.php'; ?>
    </main>

    <script>
    var productModal = document.getElementById("productModal");
    var productBtn = document.getElementById("addProductBtn");
    var span = document.getElementsByClassName("close")[0];

    productBtn.onclick = function() {
        productModal.style.display = "block";
    }

    span.onclick = function() {
        productModal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == productModal) {
            productModal.style.display = "none";
        }
    }
    </script>
</body>
</html>

<?php
// Database connection parameters
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "okaydb";

// Connect to MySQL database
$conn = mysqli_connect($sname, $uname, $password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to sanitize input
function sanitize($conn, $data) {
    return mysqli_real_escape_string($conn, $data);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if add_product button is clicked
    if (isset($_POST['add_product'])) {
        // Sanitize inputs
        $product_id = sanitize($conn, $_POST['product_id']);
        $product_name = sanitize($conn, $_POST['product_name']);
        $product_price = sanitize($conn, $_POST['product_price']);
        $product_quantity = sanitize($conn, $_POST['product_quantity']);

        // Handle file upload
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['product_image']['name']);
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadFile)) {
            $product_image = basename($_FILES['product_image']['name']);

            // SQL query to insert product into database
            $sql = "INSERT INTO products (product_id, product_name, product_price, product_quantity, product_image) 
                    VALUES ('$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')";

            if (mysqli_query($conn, $sql)) {
                echo "Product added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}

// Close database connection
mysqli_close($conn);
?>




