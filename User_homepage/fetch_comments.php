<?php
include 'db_connection.php';

$sql = "SELECT * FROM comment_rating";
$result = $conn->query($sql);

$comments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();
?>
