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

    // Prepare and execute SQL query to delete category
    $stmt = $conn->prepare("DELETE FROM category WHERE category_id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $category_id); // 's' because category_id is string in this example
    if ($stmt->execute()) {
        // Redirect back to the manage category page after successful deletion
        header("Location: manage_category.php");
        exit();
    } else {
        die("Error deleting category: " . $stmt->error);
    }

    // Close statement
    $stmt->close();
} else {
    die("No category_id provided");
}

$conn->close();
?>