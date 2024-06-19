<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Members</title>
    <link rel="stylesheet" href="Manage_member.css">
</head>
<body>
    <header>
        <a id="back" href="../Admin_home.html"><b>BACK TO ADMIN PAGE</b></a>
        <h1>OKAY STATIONERY SHOP</h1>
    </header>

    <h2 style="text-align: center;">Manage Member</h2>

    <table class="member-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Password</th>
                <th>Delete</th>
                <th>Update</th>
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

                $sql = "SELECT id, username, userpass, email, phone_number, birthday, user_address FROM user_register";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["birthday"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["phone_number"] . "</td>";
                        echo "<td>" . $row["user_address"] . "</td>";
                        echo "<td>" . $row["userpass"] . "</td>";
                        echo "<td><a href='delete_user.php?id=" . $row["id"] . "'>Delete</a></td>";
                        echo "<td><a href='update_user.php?id=" . $row["id"] . "'>Update</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No members found</td></tr>";
                }

                $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Previous and Next Buttons -->
    <div class="PNbutton">
        <button id="prevBtn">&#9664;</button> <!-- Previous symbol -->
        <button id="nextBtn">&#9654;</button> <!-- Next symbol -->
    </div>
</body>
</html>