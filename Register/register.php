<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="register.css">
</head>
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
