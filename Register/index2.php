

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="register.css">
</head>
<title>Registration</title>
</head>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 创建表（如果不存在）
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL
)";

$conn->query($sql);

// 处理表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];

    // 插入数据
    $stmt = $conn->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $email);

    if ($stmt->execute()) {
        echo "注册成功";
    } else {
        echo "注册失败: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<body>
    <head>
    <a id="back" href="../login/login.html"><b>BACK TO LOGIN</b></a>
    </head>
    <div id="container">
        <div id="register-title">
            <h3>Registration</h3>
        </div>
        <form name="registerform" method="post" action="">
            <p>Name: <input type="text" name="username" size="50" maxlength="55" placeholder="Type your name here" required></p>
            <p>Email: <input type="email" name="email" required></p>
            <p><input type="submit" name="loginbtn" value="Register" /></p>
        </p>
        
    </form>
</body>



