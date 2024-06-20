<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Member</title>
    <link rel="stylesheet" href="update_member.css">
</head>
<body>
    <header>
        <h1>
            <a id="back" href="../Manage_user/Manage_user.html"><b>BACK TO MANAGE MEMBER PAGE</b></a>
            OKAY STATIONERY SHOP
        </h1>
    </header>
    <div class="container">
        <h2>Update Member Profile</h2>

        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "okaydb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET["id"])) {
            $member_id = $_GET["id"];
            $result = mysqli_query($conn, "SELECT * FROM user_register WHERE id = $member_id");
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Include hidden member ID field -->
            <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($row['id']); ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone_number']); ?>" required placeholder="123-456-7890">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['user_address']); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($row['userpass']); ?>" required>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($row['birthday']); ?>" max="2005-12-12">
            </div>

            <button type="submit" name="updatebtn">Update Member Profile</button>
        </form>
        <?php 
            } else {
                echo "<p>No member found with the given ID.</p>";
            }
        }

        if (isset($_POST["updatebtn"])) {
            $member_id = $_POST["member_id"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $password = $_POST["password"];
            $birthday = $_POST["birthday"];

            $update_query = "UPDATE user_register SET 
                                username = '$username', 
                                userpass = '$password', 
                                email = '$email', 
                                phone_number = '$phone', 
                                user_address = '$address', 
                                birthday = '$birthday' 
                            WHERE id = $member_id";

            if (mysqli_query($conn, $update_query)) {
                echo "<script type='text/javascript'>alert('Member information updated');</script>";
                header("refresh:0.5; url=../Manage_member/Manage_member.php");
                // Comment out the header line to see if redirection is causing an issue
                // header("refresh:0.5; url=../Manage_user/Manage_user.html");
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
