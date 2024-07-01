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

// Check if category_id parameter is set and is a valid integer
if (isset($_GET['category_id']) && filter_var($_GET['category_id'], FILTER_VALIDATE_INT)) {
    $category_id = $_GET['category_id'];

    // Prepare and execute SQL query to delete category
    $stmt = $conn->prepare("DELETE FROM category WHERE category_id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $category_id); // 'i' because category_id is an integer
    if ($stmt->execute()) {
        // Redirect back to the manage category page after successful deletion
        if (!headers_sent()) {
            header("Location: manage_category.php");
            exit();
        } else {
            echo "Category deleted successfully. <a href='manage_category.php'>Go back</a>";
        }
    } else {
        die("Error deleting category: " . $stmt->error);
    }

    // Close statement
    $stmt->close();
} else {
    die("Invalid or no category_id provided");
}

$conn->close();
?>
