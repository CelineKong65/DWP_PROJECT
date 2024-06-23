<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "okaydb"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID (You should implement proper user authentication to get user ID)
$user_id = 1; // Replace with the actual user ID, fetched securely

// Current date
$checkin_date = date("Y-m-d");

// Check if the user has already checked in today
$stmt = $conn->prepare("SELECT * FROM checkin_records WHERE user_id = ? AND checkin_date = ?");
$stmt->bind_param("is", $user_id, $checkin_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User has already checked in today
    $response = array('status' => 'error', 'message' => 'You have already checked in today.');
} else {
    // Record the check-in
    $stmt = $conn->prepare("INSERT INTO checkin_records (user_id, checkin_date) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $checkin_date);

    if ($stmt->execute()) {
        // Check-in recorded successfully
        $response = array('status' => 'success', 'message' => 'Check-in recorded successfully.');
    } else {
        // Error recording check-in
        $response = array('status' => 'error', 'message' => 'Error recording check-in.');
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close connections
$stmt->close();
$conn->close();
?>
