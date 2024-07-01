<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Order</title>
</head>


<style>

body 
{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f7f7f7;
}

h1, h2, p 
{
    margin: 0;
    padding: 0;
}

header 
{
    background-color:#B3C8CF ;
    color: #fff;
    padding: 5px;
    text-align: center;
    position: relative;
}

#back 
{
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

.container 
{
    max-width: 800px; 
    margin: 0 auto; 
    padding: 20px; 
    text-align: center;
}

h2 
{
    margin-top: 20px; 
    text-align: center;
}

.input 
{
    margin-left: 75%;
    height: 20px;
}

main 
{
    padding: 20px;
}

table 
{
    width: 100%;
    border-collapse: collapse;
}

thead th,tbody td 
{
    border: 1px solid #333;
    padding: 20px;
    text-align: left;
}

thead th 
{
    background-color: #BED7DC;
    color: #333;
}

.actions button 
{
    background-color: #BED7DC;
    border: none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    font-size: 14px;
    margin: 0 5px;
    padding: 10px 15px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

.actions button:hover
{
    background-color: #9FBEC3;
}

.delete-button 
{
    background-color: #fff;
}

.delete-button:hover 
{
    background-color: #989898;
}

.view-button 
{
    background-color: #fff;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

.view-button:hover 
{
    background-color: #989898;
}


</style>



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
