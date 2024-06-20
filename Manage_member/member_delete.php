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

// Check if ID is set in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM user_register WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Member deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting member: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();

// Redirect back to the Manage Members page
header("Location: manage_members.php");
exit();
?>
