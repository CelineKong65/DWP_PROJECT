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
</head>

<style>

   
body 
{
    background-image:url(pb.login.png);
    background-size: cover; 
    background-repeat: no-repeat; 
    background-size: 1530px 750px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

#container 
{
    display: flex;
    justify-content: center; 
    align-items: center; 
    height: 100vh; 
}


#login-title 
{
    height: 50px;
    background-color: #FF9B50;
    background-repeat: no-repeat;
    background-position: 7px 7px;
    background-size: 25px 25px;
    border-radius: 8px 8px 0px 0px;
}

#login-form 
{
    padding: 10px;
    background-color: #FFFFFF;
    text-align: center;
}

#login-form input[type=email],[type=password] 
{
    width: 250px;
    border-radius: 5px;
    border: 1px solid #FF9B50;
    height: 25px;
    padding: 5px 10px 5px 40px;
}

#login-form input[type=email] 
{
    background-image: url(email.png);
    background-size: 26px;
    background-repeat: no-repeat;
    background-position: 10px 10px;
}

#login-form input[type=password] 
{
    background-image: url(lock.png);
    background-size: 24px;
    background-repeat: no-repeat;
    background-position: 10px 7px;
}

#login-form input[type=submit] 
{
    background-color: #FF9B50;
    width: 300px;
    padding: 10px;
    border: 0px;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}

#login-form input[type=submit]:hover 
{
    background-color:#FFCF81;
    cursor: pointer;
}

#login-form p a 
{
    text-decoration: none;
    text-align: center;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size: 0.8em;
}

#login-form p a:hover
{
    font-style: italic;
    color: red;
}

#back
{
    position: absolute;
    top: 10px; 
    left: 10px; 
    color: #FF9B50;
    background-color: #fff;
    font-size: 20px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    border:#FF9B50 solid ;
    border-radius: 10px;
    text-decoration: none;
    padding: 5px 5px;
}


    </style>


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
