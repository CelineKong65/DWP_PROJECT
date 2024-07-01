<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="admin_home.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="charts.js" defer></script> <!-- Link to your JavaScript file -->
</head>
<body>
    <header>
        <h1>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            Admin Dashboard
        </h1>
        <nav>
            <ul>
                <li><a href="../Manage_staff/manage_staff.php">Manage staff</a></li>
                <li><a href="../Manage_member/manage_member.php">Manage member</a></li>
                <li><a href="../Manage_product/manage_product.php">Manage product</a></li>
                <li><a href="../Manage_category/manage_category.php">Manage category</a></li>
                <li><a href="../Manage_order/manage_order.php">Manage order</a></li>
            </ul>
        </nav>
    </header>

    <section id="overview">
        <div class="container">
            <h2>Overview</h2>
            <div class="chart-container">
                <!-- Bar Chart for Total Customers -->
                <div class="chart-box">
                    <h2>Total Customers Per Month</h2>
                    <canvas id="customersChart"></canvas>
                </div>

                <!-- Bar Chart for Total Orders -->
                <div class="chart-box">
                    <h2>Total Orders Per Month</h2>
                    <canvas id="ordersChart"></canvas>
                </div>

                <!-- Bar Chart for Total Products -->
                <div class="chart-box">
                    <h2>Total Products Sales Per Year (2019-2023)</h2>
                    <canvas id="productsChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <h2>Rating and Comment list</h2>
    <table class="comment-list">
        <thead>
            <tr>
                <th id="no">ID</th>
                <th>Name</th>
                <th>Rating (star)</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "okaydb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) 
                {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT * FROM comment_rating");
                if ($result->num_rows > 0) 
                {
                    $no = 1;
                    while($row = $result->fetch_assoc()) 
                    {
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['rating']}</td>
                                <td>{$row['comment']}</td>
                            </tr>";
                        $no++;
                    }
                } 
                $conn->close();
            ?>
        </tbody>
    </table>

    <h2>Contact Us list</h2>
    <table class="comment-list">
        <thead>
            <tr>
                <th id="no">ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "okaydb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT * FROM messages");
                if ($result->num_rows > 0) {
                    $no = 1;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['user_name']}</td>
                                <td>{$row['user_email']}</td>
                                <td>{$row['user_message']}</td>
                            </tr>";
                        $no++;
                    }
                } 
                $conn->close();
            ?>
        </tbody>
    </table>

    <script src="Admin_homepage.js"></script>
</body>
</html>
