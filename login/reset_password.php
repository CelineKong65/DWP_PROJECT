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
    <style>
    body {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        background-image: url(pb.resetpass.png);
        background-repeat: no-repeat; 
        background-size: 1550px 730px;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    .container {
    
        padding: 50px 50px;
        border-radius: 20px;
        box-shadow: 0 5px 50px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
    }


    h2 {
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }
    

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    input[type="email"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .resetbtn 
{
    background-color: #FF9B50;
    width: 300px;
    padding: 10px;
    border: 0px;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}

.resetbtn:hover 
{
    background-color:#FFCF81;
    cursor: pointer;
}


    #back {
        position: absolute;
        top: 10px; 
        left: 10px; 
        color: #FF9B50;
        background-color: #fff;
        font-size: 20px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        border: #FF9B50 solid;
        border-radius: 10px;
        text-decoration: none;
        padding: 5px 5px;
    }

    </style>
</head>
<body>
<header>
    <a id="back" href="../index.php"><b>BACK TO HOME</b></a>
</header>

<div id="container">
    <div >
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
                <p><input type="submit" name="resetbtn" value="RESET PASSWORD" class="resetbtn"/></p>
            </form>
            <p><a href="../login/login.php">Back to Login</a></p>
            <p><a href="../Register/register.php">No Account? Register Now!</a></p>
        </div>
    </div>
</div>
</body>
</html>
</html>
