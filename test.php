<?php
$servername = "localhost";
$username = "root";  // XAMPP默认的MySQL用户名
$password = "";  // 默认没有密码
$dbname = "test";  // 你创建的数据库名称

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
echo "连接成功";
?>
