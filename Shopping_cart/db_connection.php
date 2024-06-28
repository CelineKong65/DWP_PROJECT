<?php
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your actual database password
$dbname = "okaydb"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
