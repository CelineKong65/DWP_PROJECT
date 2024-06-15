<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Check-in</title>
  <link rel="stylesheet" href="check-in.css">
</head>
<body>

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

$conn = new mysqli($servername, $username, $password, $dbname);


session_start();
// 这个代码段应该放在用户登录验证成功的地方
$_SESSION['user_id'] = $user_id; // 将用户 ID 存储在会话中


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'checkin') {
    $user_id = $_SESSION['user_id']; // 假设用户 ID 存储在会话中
    $checkin_date = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO user_checkin (user_id, checkin_date) VALUES (?, ?) ON DUPLICATE KEY UPDATE checkin_date = VALUES(checkin_date)");
    $stmt->bind_param("is", $user_id, $checkin_date);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Check-in successful!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "You have already checked in today."]);
    }

    $stmt->close();
}

$conn->close();
?>


<header>
    <a id="back" href="../index.html"><b>BACK TO HOME</b></a>
    <h1>Daily Check-in</h1>
    <img src="logo .png" alt="OKAY Stationery Shop Logo" class="logo">
</header>

<div class="check-in">
    <div class="calendar" id="calendar"></div>
    <br>
    <button id="checkInButton">Check-in</button>
    <div id="checkInMessage" style="display:none;"></div>
    <div id="couponMessage" style="display:none;"></div>
</div>

  <script src="check-in.js"></script>
</body>
</html>
