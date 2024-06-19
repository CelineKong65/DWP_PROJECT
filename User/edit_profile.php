<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile - Okay Stationery Shop</title>
    <link rel="stylesheet" href="edit_profile.css">
</head>
<body>
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

    // Assume user_id is obtained from session or a similar mechanism
    session_start();
    $user_id = $_SESSION['user_id'];

    // Fetch user data
    $sql = "SELECT * FROM user_register WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $birthday = $_POST["birthday"];

        // Update user data
        $update_sql = "UPDATE user_register SET username = ?, email = ?, phone_number = ?, user_address = ?, userpass = ?, birthday = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssssi", $username, $email, $phone, $address, $password, $birthday, $user_id);

        if ($update_stmt->execute()) {
            echo "Profile updated successfully";
        } else {
            echo "Error updating profile: " . $update_stmt->error;
        }

        $update_stmt->close();
    }

    $stmt->close();
    $conn->close();
    ?>
    
    <header>
        <h1>
            <a id="back" href="../User/user_profile.php"><b>BACK TO USER PROFILE</b></a>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            OKAY STATIONERY SHOP
        </h1>
    </header>
    <div class="container">
        <h2>Edit Profile</h2>
        <form action="/update-profile" method="POST" enctype="multipart/form-data">
            <div class="profile-picture">
                <img src="profile_picture.jpg" alt="Profile Picture" id="profilePic">
                <input type="file" id="profilePicInput" name="profile_picture" accept="image/*">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required placeholder="123-456-7890">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" max="2005-12-12">
            </div>

            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
