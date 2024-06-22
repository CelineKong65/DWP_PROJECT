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
                <th>View</th>
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
            $stmt->bind_param("ss", $category_id, $category_name);

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
                    <td><a href='category_view.php'>View</a></td>
                    <td><a href='category_delete.php?staff_id={$row['category_id']}'>Delete</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No category found</td></tr>";
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

    <script>
        var modal = document.getElementById("categoryModal");
        var btn = document.getElementById("addCategoryBtn");
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
