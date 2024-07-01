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
    

    .box{
    width: 275px;
    padding: 10px;
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
    <div>
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
                <p><input type="password" name="new_password" placeholder="Enter new password" class="box" required/></p>
                <p><input type="password" name="confirm_password" placeholder="Confirm new password" class="box" required/></p>
                <p><input type="submit" name="submit" value="RESET PASSWORD" class="resetbtn"/></p>
            </form>
            <p><a href="../login/login.php">Back to Login</a></p>
            <p><a href="../Register/register.php">No Account? Register Now!</a></p>
        </div>
    </div>
</div>
</body>
</html>
