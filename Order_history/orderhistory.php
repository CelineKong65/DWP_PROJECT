<?php
session_start();

// Check if the user is logged in and get the user_id
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // If the user is not logged in, redirect to login page
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery Shop - Order History</title>
    <link rel="stylesheet" href="orderhistory.css">
</head>
<body>
    <header>
        <div id="back">
            <a id="back" href="../User_homepage/user_homepage.php"><b>BACK TO HOME</b></a>
        </div>
        <div class="container">
            <h1>
                <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
                ORDER HISTORY
                <input type="text" name="text" class="input" placeholder="Search" style="margin-left: 80px; padding:10px; position: absolute; top: 5%; right: 5%;">
            </h1>
        </div>
    </header>
    <main>
        <div class="container">
            <section class="history">
                <?php
               $servername = "localhost";
               $username = "root";
               $password = "";
               $dbname = "okaydb";
       
               $conn = new mysqli($servername, $username, $password, $dbname);
       
               if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
               }
       

                // Query to get the order history for the specific user
                $sql = "SELECT name, address, total_price, order_date FROM orders WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Output data of each row as an order item card
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='order-item'>";
                        echo "<div class='item-details'>";
                        echo "<h2>Order for " . $row["name"] . "</h2>";
                        echo "<p class='address'>" . $row["address"] . "</p>";
                        echo "<p class='price'>Total Price: RM" . $row["total_price"] . "</p>";
                        echo "<p class='date'>Order Date: " . $row["order_date"] . "</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No orders found.</p>";
                }

                // Close connection
                $stmt->close();
                $conn->close();
                ?>
            </section>
        </div>
    </main>
</body>
</html>
