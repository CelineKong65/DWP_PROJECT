<?php
// Debugging line to check if the script is being called
// echo "Script called<br>";

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if order ID is set
if (isset($_GET['id'])) {
    // Debugging line to check the received order ID
    // echo "Order ID received: " . $_GET['id'] . "<br>";

    $order_id = intval($_GET['id']);

    // Fetch order details
    $sql = "SELECT * FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        echo "Order not found.";
        exit;
    }

    $stmt->close();
} else {
    echo "Invalid order ID.";
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Report</title>
    <link rel="stylesheet" href="print_report.css">
</head>
<body>
    <header>
        <h1>OKAY STATIONERY SHOP - Order Report</h1>
    </header>
    <main>
        <h2>Order Details</h2>
        <table>
            <tr>
                <th>Order ID:</th>
                <td><?php echo $order['id']; ?></td>
            </tr>
            <tr>
                <th>User ID:</th>
                <td><?php echo $order['user_id']; ?></td>
            </tr>
            <tr>
                <th>Customer Name:</th>
                <td><?php echo $order['name']; ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $order['email']; ?></td>
            </tr>
            <tr>
                <th>Order Date:</th>
                <td><?php echo $order['order_date']; ?></td>
            </tr>
            <tr>
                <th>Total Price:</th>
                <td>RM <?php echo number_format($order['total_price'], 2); ?></td>
            </tr>
            <tr>
                <th>Address:</th>
                <td><?php echo $order['address']; ?></td>
            </tr>
            <tr>
                <th>City:</th>
                <td><?php echo $order['city']; ?></td>
            </tr>
            <tr>
                <th>State:</th>
                <td><?php echo $order['state']; ?></td>
            </tr>
            <tr>
                <th>Payment Method:</th>
                <td><?php echo $order['method']; ?></td>
            </tr>
            <tr>
                <th>Card Number:</th>
                <td><?php echo $order['card_number']; ?></td>
            </tr>
            <tr>
                <th>Expiry Date:</th>
                <td><?php echo $order['card_expiry']; ?></td>
            </tr>
            <tr>
                <th>CVV:</th>
                <td><?php echo $order['card_cvv']; ?></td>
            </tr>
        </table>
        <button onclick="window.print()">Print Report</button>
    </main>
</body>
</html>
