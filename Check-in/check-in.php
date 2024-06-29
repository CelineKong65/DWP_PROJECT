<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: checkin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Check-in</title>
    <link rel="stylesheet" href="check-in.css">
</head>
<body>
    <header>
        <a id="back" href="../User_homepage/check-in.php"><b>BACK TO HOME</b></a>
        <h1>Daily Check-in</h1>
        <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
    </header>
    <div class="check-in">
        <div class="progress-bar">
            <div class="progress" id="progress"></div>
        </div>
        <div class="calendar" id="calendar"></div>
        <br>
        <button id="checkInButton">Check-in</button>
        <div id="checkInMessage" style="display:none;"></div>
        <div id="couponMessage" style="display:none;"></div>
    </div>

    <!-- Modal Popup -->
    <div id="checkinModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="check-in.js"></script>
</body>
</html>
