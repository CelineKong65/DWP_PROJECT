<?php
session_start();

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

// Fetch the current user data
$sql = "SELECT * FROM user_register WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];

    // Handle file upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = "user_pic/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit();
        }

        // Check file size
        if ($_FILES["profile_picture"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            exit();
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
            exit();
        }

        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $profile_picture = basename($_FILES["profile_picture"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        $profile_picture = $user['profile_picture'];
    }

    // Update user data
    $sql = "UPDATE user_register SET username = ?, email = ?, phone_number = ?, user_address = ?, userpass = ?, birthday = ?, profile_picture = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssssi", $username, $email, $phone, $address, $password, $birthday, $profile_picture, $user_id);
        if ($stmt->execute()) {
            header("Location: user_profile.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile - Okay Stationery Shop</title>
    <link rel="stylesheet" href="edit_profile.css">
</head>
<body>
    <header>
        <h1>
            <a id="back" href="user_profile.php"><b>BACK TO USER PROFILE</b></a>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            OKAY STATIONERY SHOP
        </h1>
    </header>
    <div class="container">
        <h2>Edit Profile</h2>
        <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
            <div class="profile-picture">
                <img src="user_pic/<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" id="profilePic">
                <input type="file" id="profilePicInput" name="profile_picture" accept="image/*">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required placeholder="123-456-7890">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['user_address']); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($user['userpass']); ?>" required>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($user['birthday']); ?>" max="2005-12-12">
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
