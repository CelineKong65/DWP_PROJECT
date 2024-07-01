<?php
session_start(); // Start the session at the beginning of the file

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $userpass = $_POST["userpass"];

    $stmt = $conn->prepare("SELECT id FROM user_register WHERE email = ? AND userpass = ?");
    $stmt->bind_param("ss", $email, $userpass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id']; // Store the user ID in the session
        header("Location: ../User_homepage/user_homepage.php"); // Redirect to user profile page
        exit(); // Ensure no further code is executed after redirection
    } else {
        $error_message = "Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<header>
    <a id="back" href="../index.php"><b>BACK TO HOME</b></a>
</header>
<div id="container">
    <div style="border: 1px solid #DDD; border-radius: 10px; width: 400px; padding: 0px">
        <div id="login-title">
            <h3 style="margin: 0px; padding: 12px 170px; color:white; font-family: Arial;">Login</h3>
        </div>
        <div id="login-form">
            <?php
            if (isset($error_message)) {
                echo "<p style='color: red; text-align: center;'>$error_message</p>";
            }
            ?>
            <form name="loginfrm" method="post" action="">
                <p><input type="email" name="email" required/></p>
                <p><input type="password" name="userpass" required/></p>
                <p><input type="submit" name="loginbtn" value="LOGIN" /></p>
            </form>
            <p><a href="../login/reset_password.php">Forgot your password?</a></p>
            <p><a href="../Register/register.php">No Account? Register Now!</a></p>
        </div>
    </div>
</div>
</body>
</html>
