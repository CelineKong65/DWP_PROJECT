<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Order</title>
    <link rel="stylesheet" href="manage_order.css">
</head>
<body>
    <header>
        <a id="back" href="../Admin_homepage/Admin_home.php"><b>BACK TO ADMIN PAGE</b></a>
        <div class="container">
            <h1>OKAY STATIONERY SHOP</h1>
        </div>
    </header>
    <h2>Manage Order</h2>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Total Price</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Payment Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
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

                // Fetch orders
                $sql = "SELECT * FROM orders";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['order_date'] . "</td>";
                        echo "<td>RM" . number_format($row['total_price'], 2) . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['city'] . "</td>";
                        echo "<td>" . $row['state'] . "</td>";
                        echo "<td>" . $row['method'] . "</td>";
                        echo '<td><button class="view-button" onclick="viewOrder(' . $row['id'] . ')">View</button>';
                        echo '<button class="delete-button" onclick="deleteOrder(' . $row['id'] . ')">Delete</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No orders found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>

    <!-- Previous and Next Buttons -->
    <div class="PNbutton">
        <button id="prevBtn">&#9664;</button> <!-- Previous symbol -->
        <button id="nextBtn">&#9654;</button> <!-- Next symbol -->
    </div>

    <script>
        function deleteOrder(id) {
            if (confirm("Are you sure you want to delete this order?")) {
                window.location.href = "delete_order.php?id=" + id;
            }
        }

        function viewOrder(id) {
            window.location.href = "../Print_report/print_report.php?id=" + id;
        }
    </script>
</body>
</html>
