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

if (isset($_GET['staff_id'])) {
    $category_id = $_GET['staff_id'];

    // Prepare the SQL statement to delete the category
    $stmt = $conn->prepare("DELETE FROM category WHERE category_id = ?");
    $stmt->bind_param("s", $category_id);

    if ($stmt->execute()) {
        echo "<script>alert('Category deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting category: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();

// Redirect back to the manage categories page
header("Location: manage_category.php");
exit;
?>
