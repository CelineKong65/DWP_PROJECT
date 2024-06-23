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
            display: inline-block; /* Changed to inline-block */
            margin-right: 10px; /* Added margin for spacing */
        }

        #addCategoryBtn:hover {
            background-color: #0056b3;
        }

        #viewCategoryBtn {
            background-color: #98B0B9;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: inline-block; /* Changed to inline-block */
        }

        #viewCategoryBtn:hover {
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
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "okaydb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
        $category_id = $_POST["category_id"];
        $category_name = $_POST["category_name"];

        if (!empty($category_id) && !empty($category_name)) {
            $stmt = $conn->prepare("INSERT INTO category (category_id, category_name) VALUES (?, ?)");
            $stmt->bind_param("is", $category_id, $category_name);

            if ($stmt->execute()) {
                echo "<script>alert('Category added successfully');</script>";
            } else {
                echo "<script>alert('Error adding category: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Please fill in all fields');</script>";
        }
    }
    

    $result = $conn->query("SELECT * FROM category");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['category_id']}</td>
                    <td>{$row['category_name']}</td>
                    <td><a href='category_delete.php?category_id={$row['category_id']}'>Delete</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No category found</td></tr>";
    }

    $conn->close();
    ?>
        </tbody>
    </table>

    <!-- Add Category and View Details buttons in the same line -->
    <div style="text-align: center; margin-top: 20px;">
        <button id="addCategoryBtn">Add Category</button>
        <button id="viewCategoryBtn" class="modal-button">View Details</button>
    </div>

    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Category</h2>
            <form action="manage_category.php" method="post">
                <label for="category_id"><b>Category ID:</b></label>
                <input type="number" id="category_id" name="category_id" required>

                <label for="category_name"><b>Category Name:</b></label>
                <input type="text" id="category_name" name="category_name" required>

                <button type="submit" name="add_category">Add Category</button>
            </form>
        </div>
    </div>

    <div id="viewCategoryModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Category Details</h2>
            <div id="categoryDetails">
            <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch products with category names
$sql = "SELECT p.product_id, p.product_name, p.product_price, c.category_name 
        FROM products p
        INNER JOIN category c ON p.category_id = c.category_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>";

    while ($product = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$product['product_id']}</td>
                <td>{$product['product_name']}</td>
                <td>{$product['product_price']}</td>
                <td>{$product['category_name']}</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No products found</p>";
}

$conn->close();
?>

            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById("categoryModal");
        var viewModal = document.getElementById("viewCategoryModal");
        var btn = document.getElementById("addCategoryBtn");
        var viewBtn = document.getElementById("viewCategoryBtn");
        var span = document.getElementsByClassName("close");

        btn.onclick = function() {
            modal.style.display = "block";
        }

        viewBtn.onclick = function() {
            viewModal.style.display = "block";
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
    </script>
</body>
</html>
