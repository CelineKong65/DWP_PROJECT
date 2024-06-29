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
    $id = $_GET['id'];

    // Delete order
    $sql = "DELETE FROM orders WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Order deleted successfully";
    } else {
        echo "Error deleting order: " . $conn->error;
    }

    $conn->close();

    // Redirect back to manage_order.php
    header("Location: manage_order.php");
    exit();
} else {
    echo "No order ID provided";
}
?>
