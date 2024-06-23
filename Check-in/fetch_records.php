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

// Prepare and execute SQL query to fetch check-in records for the user
$stmt = $conn->prepare("SELECT * FROM checkin_records WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Prepare the array to hold the records
$records = array();

if ($result->num_rows > 0) {
    // Fetch records and add to the array
    while ($row = $result->fetch_assoc()) {
        $records[] = array(
            'id' => $row['id'],
            'user_id' => $row['user_id'],
            'checkin_date' => $row['checkin_date']
        );
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($records);

// Close connections
$stmt->close();
$conn->close();
?>
