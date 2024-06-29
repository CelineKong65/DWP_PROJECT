<?php
session_start(); // Start the session at the beginning of the file

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit();
}

$user_id = $_SESSION['user_id']; // Get the user ID from the session

$sql = "SELECT * FROM user_register WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER PROFILE</title>
    <link rel="stylesheet" href="user_profile.css">
</head>
<body>
    <header>
    <h1>
        <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
        OKAY STATIONERY SHOP
    </h1>
    </header>
    <a id="back" href="../User_homepage/user_homepage.php"><b>BACK TO HOME</b></a> 
    
    <div class="container">
        <h1>User Profile</h1>
        <div class="profile">
            <img src="user_pic/<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture">
            <h2><?php echo htmlspecialchars($user['username']); ?></h2>
            <p>Day of Birth: <?php echo htmlspecialchars(date('d-m-Y', strtotime($user['birthday']))); ?></p>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
            <p>Phone: <?php echo htmlspecialchars($user['phone_number']); ?></p>
            <p>Address: <?php echo htmlspecialchars($user['user_address']); ?></p>
            <a href="edit_profile.php" class="button">Edit Profile</a>
            <a href="../index.php" class="button">Log Out</a>

        </div>
    </div>
</body>
</html>
