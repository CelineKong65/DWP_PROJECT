<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="AdminLogin.css">
</head>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff_email = $_POST["staff_email"];
    $staff_password = $_POST["staff_password"];


    $stmt = $conn->prepare("SELECT * FROM staff WHERE staff_email = ? AND staff_password = ?");
    $stmt->bind_param("ss", $staff_email, $staff_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../Admin_home.php");
        exit(); // Ensure no further code is executed after redirection
    } else {
        $error_message = "Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>



<body>
<head>
    <a id="back" href="../User_homepage/user_homepage.php"><b>BACK TO HOME</b></a>
</head>
<div id="container">
    <div class="login-box">
        <div id="login-title">
            <h3>Admin Login</h3>
        </div>

        <div id="login-form">
        <?php
            if (isset($error_message)) {
                echo "<p style='color: red; text-align: center;'>$error_message</p>";
            }
            ?>
            <form name="loginfrm" method="post" action="">
                <p><input type="email" name="staff_email" placeholder="Email" required /></p>
                <p><input type="password" name="staff_password" placeholder="Password" required /></p>
                <p><input type="submit" name="loginbtn" value="LOGIN" /></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>