<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['staff_id'])) {
    $staff_id = $_GET['staff_id'];

    $stmt = $conn->prepare("DELETE FROM staff WHERE staff_id = ?");
    $stmt->bind_param("i", $staff_id);

    if ($stmt->execute()) {
        echo "<script>alert('Staff deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting staff: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();

header("Location: manage_staff.php");
exit();
?>
