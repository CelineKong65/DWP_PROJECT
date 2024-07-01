<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/DWP_PROJECT/login/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/DWP_PROJECT/login/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/DWP_PROJECT/login/src/SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$reset_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["resetbtn"])) {
    $email = $_POST["email"];

    $sql = "SELECT email FROM user_register WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $token = bin2hex(random_bytes(50));

        $sql = "INSERT INTO password_resets (email, token) 
                VALUES (?, ?)
                ON DUPLICATE KEY UPDATE token = VALUES(token)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $token);

        if ($stmt->execute()) {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'siewjinstudent@gmail.com';
                $mail->Password = 'buwm rhzu mrbt llis';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('siewjinstudent@gmail.com', 'OKAY Stationery Shop');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = "Hello,<br><br>To reset your password, please click on the link below:<br>";
                $mail->Body   .= "<a href='http://localhost/DWP_PROJECT/login/reset_password_form.php?token=" . $token . "'>Reset Password</a>";
                $mail->Body   .= "<br><br>If you did not request this, please ignore this email.<br><br>Thank you,<br>OKAY Stationery Shop";

                $mail->send();
                $reset_message = "A reset password link has been sent to your email. Please check your inbox.";
            } catch (Exception $e) {
                $reset_message = "Failed to send reset link. Please contact support. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $reset_message = "Failed to process request. Please try again later.";
        }
    } else {
        $reset_message = "No account found with that email address.";
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
            <p><a href="../login/login.php">Back to Login</a></p>
            <p><a href="../Register/register.php">No Account? Register Now!</a></p>
        </div>
    </div>
</div>
</body>
</html>
