
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

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
    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];

    $stmt = $conn->prepare("SELECT * FROM user_register WHERE email = ? AND userpass = ?");
    $stmt->bind_param("ss", $user_email, $user_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Login successful!";
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<head>
    <a id="back" href="../index.html"><b>BACK TO HOME</b></a>
</head>
<div id="container">
    <div style="border: 1px solid #DDD; border-radius: 10px; width: 400px; padding: 0px">

        <div id="login-title">
            <h3 style="margin: 0px; padding: 12px 170px; color:white; font-family: Arial;">Login</h3>
        </div>

        <div id="login-form" method="post" action="">
            <form name="loginfrm">
                <p><input type="email" name="user_email" required/></p>
                <p><input type="password" name="user_password" required/></p>
                <p><input type="submit" name="loginbtn" value="LOGIN" /></p>
            </form>

            <p><a href="../login/reset_password.html">Forgot your password?</a></p>
            <p><a href="../Register/register.php">No Account? Register Now!</a></p>

        </div>

    </div>
</div>

</body>
</html>
