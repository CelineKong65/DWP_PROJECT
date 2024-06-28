<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur'); // Set your timezone

$servername = "localhost";
$username = "root";
$password = ""; // Replace with your MySQL password
$dbname = "okaydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['user_id'];

// Get all check-in dates for the current user
$sql = "SELECT checkin_date FROM user_checkin WHERE user_id = ? ORDER BY checkin_date ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$checkinDates = [];
{
    $checkinDates[] = $row['checkin_date'];
}

echo json_encode($checkinDates);

$conn->close();
?>
