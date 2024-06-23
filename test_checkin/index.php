<?php
$servername = "localhost";
$username = "root"; // 根据你的XAMPP MySQL设置修改
$password = ""; // 根据你的XAMPP MySQL设置修改
$dbname = "okaydb"; // 修改为你的数据库名

// 连接数据库
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查数据库连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>30天签到</title>
</head>
<body>
    <h1>30天签到</h1>
    <form action="signin.php" method="post">
        <input type="submit" value="签到">
    </form>

    <!-- 显示签到记录 -->
    <?php
    // 查询用户的最近30天签到记录
    $user_id = 3; // 假设用户ID为3
    $show_query = "SELECT checkin_date FROM user_checkin WHERE user_id = $user_id ORDER BY checkin_date DESC LIMIT 30";
    $result = $conn->query($show_query);

    if ($result->num_rows > 0) {
        echo "<h2>签到记录：</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["checkin_date"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "还没有签到记录。";
    }

    // 关闭数据库连接
    $conn->close();
    ?>
</body>
</html>
