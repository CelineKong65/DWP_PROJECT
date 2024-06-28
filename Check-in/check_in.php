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
$today = date("Y-m-d");

// Check if the user has already checked in today
$sql = "SELECT * FROM user_checkin WHERE user_id = ? AND checkin_date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $userId, $today);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) 
{
    // User already checked in today
    echo "You have already checked in today.";
} 
else 
{
    // Insert the check-in record
    $sql = "INSERT INTO user_checkin (user_id, checkin_date) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userId, $today);
    $stmt->execute();

    // Get current streak information
    $sql = "SELECT * FROM checkin_streaks WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) 
    {
        // Update streak count if applicable
        $row = $result->fetch_assoc();
        $lastCheckinDate = $row['last_checkin_date'];
        $streakCount = $row['streak_count'];

        $daysDifference = (strtotime($today) - strtotime($lastCheckinDate)) / (60 * 60 * 24);

        if ($daysDifference == 1) 
        {
            $streakCount++;
        } else {
            $streakCount = 1;
        }

        // Update streak in the database
        $sql = "UPDATE checkin_streaks SET streak_count = ?, last_checkin_date = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isi", $streakCount, $today, $userId);
    } 
    else 
    {
        // Initialize streak count if no record found
        $streakCount = 1;
        $sql = "INSERT INTO checkin_streaks (user_id, streak_count, last_checkin_date) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $userId, $streakCount, $today);
    }

    $stmt->execute();

    echo "Check-in successful. Current streak: $streakCount days.";
}

$conn->close();
?>
