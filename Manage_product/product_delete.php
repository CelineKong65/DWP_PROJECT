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

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("s", $product_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting product: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();

// Redirect to manage_product.php after deletion
header("Location: manage_product.php");
exit();
?>
