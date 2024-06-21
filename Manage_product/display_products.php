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

// SQL query to fetch all products
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Display products as cards
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management Page</title>
    <style>
        body 
{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    margin: 0;
    padding: 0;
}

h1, p 
{
    margin: 0;
    padding: 0;
}

h2
{
    text-align: center;
}

header 
{
    background-color: #BED7DC;
    color: #fff;
    padding: 30px 0px;
    text-align: center;
    position: relative;
}

#back 
{
    position: absolute;
    top: 10px;
    left: 10px;
    color: #BED7DC;
    background-color: #fff;
    font-size: 20px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    border: solid #ffefe3;
    border-radius: 10px;
    text-decoration: none;
    padding: 5px;
}
        .product-card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .product-card img {
            width: 100%;
            height: 200px; /* Set a fixed height for uniformity */
            border-radius: 8px;
            object-fit: cover;
        }
        .product-info {
            margin-top: 10px;
        }
        .product-title {
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="product-card">
            <img src="uploads/<?= htmlspecialchars($row['product_image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>">
            <div class="product-info">
                <h3><?= htmlspecialchars($row['product_name']) ?></h3>
                <p><strong>Price:</strong> $<?= htmlspecialchars($row['product_price']) ?></p>
                <p><strong>Quantity:</strong> <?= htmlspecialchars($row['product_quantity']) ?></p>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>No products found.</p>";
}

// Close database connection
mysqli_close($conn);
?>
</body>
</html>
