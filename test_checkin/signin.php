<?php
// 连接数据库
$servername = "localhost";
$username = "root"; // 根据你的XAMPP MySQL设置修改
$password = ""; // 根据你的XAMPP MySQL设置修改
$dbname = "okaydb"; // 修改为你的数据库名

$conn = new mysqli($servername, $username, $password, $dbname);

// 检查数据库连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 处理用户签到请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 假设通过登录后获取用户ID，这里用硬编码的方式演示
    $user_id = 3; // 例如，用户ID为3
    $today = date("Y-m-d");

    // 检查用户今天是否已经签到
    $check_query = "SELECT * FROM user_checkin WHERE user_id = $user_id AND checkin_date = '$today'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "今天已经签到过了！";
    } else {
        // 执行签到操作
        $insert_query = "INSERT INTO user_checkin (user_id, checkin_date) VALUES ($user_id, '$today')";
        if ($conn->query($insert_query) === TRUE) {
            echo "签到成功！";
        } else {
            echo "签到失败：" . $conn->error;
        }
    }
}

// 关闭数据库连接
$conn->close();
?>
