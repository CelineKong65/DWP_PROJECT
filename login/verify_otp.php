<?php
session_start();

// Redirect to password reset page if no OTP in session (unauthorized access)
if (!isset($_SESSION['otp'])) {
    header("Location: forget_password.php");
    exit();
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["verifybtn"])) {
    $entered_otp = $_POST['otp'];

    if ($_SESSION['otp'] == $entered_otp) {
        // OTP matched, allow password reset
        // You can redirect to a password reset form here
        header("Location: reset_password_form.php");
        exit();
    } else {
        // Invalid OTP
        $error_message = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="reset_password.css">
</head>
<body>

<header>
    <a id="back" href="../User_homepage/index1.html"><b>BACK TO HOME</b></a>
</header>

<div id="container">
    <div style="border: 1px solid #DDD; border-radius: 10px; width: 400px; padding: 20px">

        <div id="reset-title">
            <h3 style="margin: 0px; padding: 12px; color:white; font-family: Arial;">Verify OTP</h3>
        </div>

        <div id="reset-form">
            <?php
            if (!empty($error_message)) {
                echo "<p style='color: red; text-align: center;'>$error_message</p>";
            }
            ?>
            <form name="otpfrm" method="post" action="">
                <p><input type="text" name="otp" placeholder="Enter OTP received via email" required/></p>
                <p><input type="submit" name="verifybtn" value="VERIFY OTP" /></p>
            </form>

            <p><a href="../login.php">Back to Login</a></p>
            <p><a href="../Register/register.php">No Account? Register Now!</a></p>
        </div>

    </div>
</div>

</body>
</html>
