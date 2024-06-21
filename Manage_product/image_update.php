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


// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Manage Page</title>
    <style>
    /* Add your existing CSS styles here */
    </style>
</head>
<body>
    <h2>Add Product</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="product_id"><b>Product ID:</b></label>
        <input type="text" id="product_id" name="product_id" required><br><br>

        <label for="product_name"><b>Product Name:</b></label>
        <input type="text" id="product_name" name="product_name" required><br><br>

        <label for="product_price"><b>Product Price:</b></label>
        <input type="text" id="product_price" name="product_price" required><br><br>

        <label for="product_quantity"><b>Product Quantity:</b></label>
        <input type="text" id="product_quantity" name="product_quantity" required><br><br>

        <label for="product_image"><b>Product Image:</b></label>
        <input type="file" id="product_image" name="product_image" accept="image/*" required><br><br>

        <button type="submit" name="add_product">Add Product</button>
    </form>
</body>
</html>
