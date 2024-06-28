<?php
session_start(); // Start session for error messages or other session-related data

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$reset_message = "";

// Handle password reset request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["resetbtn"])) {
    $email = $_POST["email"];

    // Generate a random 6-digit OTP
    $otp = mt_rand(100000, 999999);

    // Update the database with the OTP and current time for expiry (30 minutes from now)
    $sql = "UPDATE user_register
            SET otp = ?,
                otp_expiry = DATE_ADD(NOW(), INTERVAL 30 MINUTE)
            WHERE email = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Failed to prepare statement: ' . $conn->error);
    }

    $stmt->bind_param("is", $otp, $email);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        // Store OTP in session for verification
        $_SESSION['otp'] = $otp;

        // Send the OTP to the user's email
        $to = $email;
        $subject = "Password Reset OTP";
        $message = "Hello,\n\nYour OTP for password reset is: " . $otp . "\n\nIf you did not request this, please ignore this email.\n\nThank you,\nOKAY Stationery Shop";
        $headers = "From: leeching2565@gmail.com\r\n";

        // Send email using Gmail SMTP (you can replace with your SMTP details)
        if (mail($to, $subject, $message, $headers)) {
            $reset_message = "OTP has been sent to your email. Please check your inbox and enter the OTP to proceed.";
        } else {
            $reset_message = "Failed to send OTP. Please try again later.";
        }
    } else {
        $reset_message = "Failed to update database. Please try again later.";
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
            <form name="resetfrm" method="post" action="">
                <p><input type="email" name="email" placeholder="Enter your email" required/></p>
                <p><input type="submit" name="resetbtn" value="RESET PASSWORD" /></p>
            </form>

            <p><a href="../login.php">Back to Login</a></p>
            <p><a href="../Register/register.php">No Account? Register Now!</a></p>

        </div>

    </div>
</div>

</body>
</html>
