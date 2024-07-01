<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>

<style>

    
body 
{
    background-image: url(p.register.png);
    background-size: cover; 
    background-repeat: no-repeat; 
    background-position: center; 
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    flex-direction: column;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

#container 
{
    background-color: white;
    border: 1px solid #DDD;
    border-radius: 10px;
    width: 400px;
    padding: 0px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#register-title 
{
    background-color: #FF9B50;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

#register-title h3 
{
    margin: 0;
    padding: 12px 0;
    text-align: center;
    color: white;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

form 
{
    padding: 20px;
}


input[type=submit] 
{
    background-color: #FF9B50;
    width: 100px ;
    padding: 10px;
    border: none;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    margin-left: 125px;
}

input[type="text"], input[type="password"], input[type="email"],input[type="tel"], input[type="date"] 
{
    width: calc(100% - 22px); 
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #CCC;
    box-sizing: border-box;
}

input[type=submit]:hover 
{
    background-color: #FFCF81;
    cursor: pointer;
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

<?php
$servername = "localhost"; // the local place
$username = "root"; // auto username
$password = ""; // null password
$dbname = "okaydb"; // database name

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// detect connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// create table
$sql = "CREATE TABLE IF NOT EXISTS user_register (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    userpass VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    birthday DATE NOT NULL,
    user_address VARCHAR(100) NOT NULL
)";

$conn->query($sql);

// handle table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $userpass = $_POST["userpass"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $birthday = $_POST["birthday"];
    $user_address = $_POST["address"];

    // input data
    $stmt = $conn->prepare("INSERT INTO user_register (username, userpass, email, phone_number, birthday, user_address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $userpass, $email, $phone_number, $birthday, $user_address);

    if ($stmt->execute()) {
        echo "Registration successful";
    } else {
        echo "Registration failed: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<header>
    <a id="back" href="../login/login.php"><b>BACK TO LOGIN</b></a>
</header>
<div id="container">
    <div id="register-title">
        <h3>Registration</h3>
    </div>
    <form name="registerform" method="post" action="">
        <p>Name: <input type="text" name="username" size="50" maxlength="55" placeholder="Type your name here" required></p>
        <p>Password: <input type="password" name="userpass" size="20" required></p>
        <p>Email: <input type="email" name="email" required></p>
        <p>Phone Number: <input type="tel" name="phone_number" pattern="\d{3}-\d{3}-\d{4}" placeholder="123-456-7890" required></p>
        <p>Your Birthday: <input type="date" name="birthday" max="2005-12-12" required></p>
        <p>Address: <input type="text" name="address" maxlength="100" placeholder="Type your address here" required></p>
        <p><input type="submit" name="loginbtn" value="Register"></p>
    </form>
</div>
</body>
</html>
