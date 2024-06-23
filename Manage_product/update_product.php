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

// Fetch product details if ID is provided
if (isset($_GET["id"])) {
    $product_id = $_GET["id"];
    $sql = "SELECT * FROM products WHERE product_id='$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "No product ID provided.";
    exit();
}

// Update product details if form is submitted
if (isset($_POST["update_product"])) {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_quantity = $_POST["product_quantity"];
    $product_details = $_POST["product_details"];
    $category_id = $_POST["category_id"];
    $target_file = $product['product_image'];

    // Handle file upload if a new image is provided
    if (!empty($_FILES["product_image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check file size (5MB limit)
        if ($_FILES["product_image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Upload file
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["product_image"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update product in the database
    $sql = "UPDATE products SET 
            product_name='$product_name', 
            product_price='$product_price', 
            product_quantity='$product_quantity', 
            product_image='" . basename($target_file) . "',
            product_details='$product_details',
            category_id='$category_id' 
            WHERE product_id='$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Product updated successfully');</script>";
        header("refresh:0.5; url=manage_product.php"); // Redirect back to manage products page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="manage_product.css">
</head>
<body>
    <header>
        <a id="back" href="manage_product.php"><b>BACK TO MANAGE PRODUCT</b></a>
        <h1>OKAY STATIONERY SHOP</h1>
    </header>

    <h2 style="text-align: center; margin-top: 5%; margin-bottom: 5%;">Update Product</h2>

    <div class="modal-content">
        <h2>Edit Product Details</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="product_id"><b>ID:</b></label>
            <input type="text" id="product_id" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>" readonly>

            <label for="product_name"><b>Name:</b></label>
            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>

            <label for="product_price"><b>Price:</b></label>
            <input type="text" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product['product_price']); ?>" required>

            <label for="product_quantity"><b>Quantity:</b></label>
            <input type="number" id="product_quantity" name="product_quantity" value="<?php echo htmlspecialchars($product['product_quantity']); ?>" required>

            <label for="product_details"><b>Details:</b></label>
            <textarea id="product_details" name="product_details" required><?php echo htmlspecialchars($product['product_details']); ?></textarea>

            <label for="category_id"><b>Category:</b></label>
            <input type="text" id="category_id" name="category_id" value="<?php echo htmlspecialchars($product['category_id']); ?>" required>

            <label for="product_image"><b>Product Image:</b></label>
            <input type="file" id="product_image" name="product_image">
            <p>Current image: <img src="uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image" width="100" height="100"></p>

            <button type="submit" name="update_product">Update Product</button>
        </form>
    </div>
</body>
</html>
