<?php
$reset_message = "";
$token = $_GET['token'] ?? '';

if (empty($token)) {
    die("Invalid or missing token.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    if ($new_password === $confirm_password) {
        // Plain text password (no hashing)
        $plain_text_password = $new_password;

        // Validate the token
        $sql = "SELECT email FROM password_resets WHERE token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($email);
            $stmt->fetch();

            // Update the user's password
            $update_sql = "UPDATE user_register SET userpass = ? WHERE email = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ss", $plain_text_password, $email);

            if ($update_stmt->execute()) {

                $reset_message = "Your password has been successfully changed.";
            } else {
                $reset_message = "Failed to reset your password. Please try again later.";
            }
        } else {
            $reset_message = "Invalid token.";
        }
    } else {
        $reset_message = "Passwords do not match.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="reset_password.css">
</head>
<body>
<header>
    <a id="back" href="../index.php"><b>BACK TO HOME</b></a>
</header>

<div id="container">
    <div style="border: 1px solid #DDD; border-radius: 10px; width: 400px; padding: 20px">
        <div id="reset-title">
            <h3 style="margin: 0px; padding: 12px; color:white; font-family: Arial;">Reset Password</h3>
        </div>
        <div id="reset-form">
            <?php
            if (!empty($reset_message)) {
                echo "<p style='text-align: center;'>$reset_message</p>";
            }
            ?>
            <form name="reset_password_form" method="post" action="">
                <p><input type="password" name="new_password" placeholder="Enter new password" required/></p>
                <p><input type="password" name="confirm_password" placeholder="Confirm new password" required/></p>
                <p><input type="submit" name="submit" value="RESET PASSWORD" /></p>
            </form>
            <p><a href="../login">Back to Login</a></p>
            <p><a href="../Register/register.php">No Account? Register Now!</a></p>
        </div>
    </div>
</div>
</body>
</html>
