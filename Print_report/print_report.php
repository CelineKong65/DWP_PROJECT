<?php
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
    $order_id = intval($_GET['id']);

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 50px;
        }

        #back {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #BED7DC;
            background-color: #fff;
            font-size: 20px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            border: solid #BED7DC;
            border-radius: 5px;
            text-decoration: none;
            padding: 5px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 50px;
            text-align: center;
        }

        .r1 {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            border: #333 solid;
            margin-top: 5%;
        }

        h1 {
            background-color: #BED7DC;
            color: #fff;
            padding: 5px;
            text-align: center;
            position: relative;
            margin-bottom: 20px;
        }

        .report {
            margin-bottom: 30px;
        }

        .user-info {
            margin-bottom: 10px;
        }

        .user-info h2 {
            margin-bottom: 5px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .report-table th, .report-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .report-table th {
            background-color: #f2f2f2;
        }

        .print-button {
            display: block;
            width: 150px;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #BED7DC;
            color: #333;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .total {
            text-align: right;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1, h2 {
            text-align: center;
        }

        main {
            padding: 20px;
        }
    </style>
</head>
<body>
    <header>
        <a id="back" href="../Manage_order/manage_order.php">BACK TO MANAGE ORDER</a>
        <div class="container">
            <h1>View/Print Order Report</h1>
        </div>
    </header>
    <main>
        <h2>Order Details</h2>
        <div class="r1">
            <table class="report-table">
                <tr>
                    <th>Order ID:</th>
                    <td><?php echo htmlspecialchars($order['id']); ?></td>
                </tr>
                <tr>
                    <th>User ID:</th>
                    <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                </tr>
                <tr>
                    <th>Customer Name:</th>
                    <td><?php echo htmlspecialchars($order['name']); ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo htmlspecialchars($order['email']); ?></td>
                </tr>
                <tr>
                    <th>Order Date:</th>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                </tr>
                <tr>
                    <th>Total Price:</th>
                    <td>RM <?php echo number_format($order['total_price'], 2); ?></td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td><?php echo htmlspecialchars($order['address']); ?></td>
                </tr>
                <tr>
                    <th>City:</th>
                    <td><?php echo htmlspecialchars($order['city']); ?></td>
                </tr>
                <tr>
                    <th>State:</th>
                    <td><?php echo htmlspecialchars($order['state']); ?></td>
                </tr>
                <tr>
                    <th>Payment Method:</th>
                    <td><?php echo htmlspecialchars($order['method']); ?></td>
                </tr>
            </table>
            <button class="print-button" onclick="window.print()">Print Report</button>
        </div>
    </main>
</body>
</html>
