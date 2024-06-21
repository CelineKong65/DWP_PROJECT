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

if (isset($_POST["add_product"])) {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_quantity = $_POST["product_quantity"];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $_FILES["product_image"]["name"];
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

    // Insert into database
    $sql = "INSERT INTO products (product_id, product_name, product_price, product_quantity, product_image)
            VALUES ('$product_id', '$product_name', '$product_price', '$product_quantity', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('New product added successfully');</script>";
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
    <title>Manage Products</title>
    <link rel="stylesheet" href="manage_product.css">
    <style>
        .product-table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        .product-table th, .product-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .product-table th {
            background-color: #f2f2f2;
        }

        .product-table img {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Other styles... */
    </style>
</head>
<body>
    <header>
        <a id="back" href="../Admin_home.html"><b>BACK TO ADMIN PAGE</b></a>
        <h1>OKAY STATIONERY SHOP</h1>
    </header>

    <h2 style="text-align: center; margin-top: 5%; margin-bottom: 5%;">Manage Products</h2>

    <table class="product-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT product_id, product_name, product_price, product_quantity, product_image FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["product_id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["product_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["product_price"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["product_quantity"]) . "</td>";
                    echo "<td><img src='uploads/" . htmlspecialchars($row["product_image"]) . "' alt='" . htmlspecialchars($row["product_name"]) . "'></td>";
                    echo "<td><a href='product_delete.php?id=" . $row["product_id"] . "'>Delete</a></td>";
                    echo "<td><a href='update_product.php?id=" . $row["product_id"] . "'>Update</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No products found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <button id="addProductBtn">Add Product</button>

    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Product</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="product_id"><b>ID:</b></label>
                <input type="text" id="product_id" name="product_id" required>

                <label for="product_name"><b>Name:</b></label>
                <input type="text" id="product_name" name="product_name" required>

                <label for="product_price"><b>Price:</b></label>
                <input type="text" id="product_price" name="product_price" required>

                <label for="product_quantity"><b>Quantity:</b></label>
                <input type="number" id="product_quantity" name="product_quantity" required>

                <label for="product_image"><b>Product Image:</b></label>
                <input type="file" id="product_image" name="product_image" required>

                <button type="submit" name="add_product">Add Product</button>
            </form>
        </div>
    </div>

    <script>
        var modal = document.getElementById("productModal");
        var btn = document.getElementById("addProductBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>