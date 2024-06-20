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

    <h2 style="text-align: center; margin-top: 5%; margin-bottom: 5%;">Manage Members</h2>

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

    if (isset($_POST["add_staff"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];
        $address = $_POST["address"];
        $userpass = $_POST["userpass"];
        $birthday = $_POST["birthday"];

        $sql = "INSERT INTO user_register (username, userpass, email, phone_number, user_address, birthday)
                VALUES ('$username', '$userpass', '$email', '$phone_number', '$address', '$birthday')";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('New member added successfully');</script>";
            header("refresh:0.5; url=Manage_member.php"); // Redirect back to manage members page
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <table class="member-table">
        <thead>
            <tr>
                <th>ID</th>
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
            $sql = "SELECT id, username, userpass, email, phone_number, birthday, user_address FROM user_register";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["birthday"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["phone_number"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["user_address"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["userpass"]) . "</td>";
                    echo "<td><a href='member_delete.php?id=" . $row["id"] . "'>Delete</a></td>";
                    echo "<td><a href='update_member.php?id=" . $row["id"] . "'>Update</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No members found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <button id="addStaffBtn">Add Member</button>

    <div id="staffModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Member</h2>
            <form action="" method="post">
                <label for="staff_name"><b>Name:</b></label>
                <input type="text" id="staff_name" name="username" required>

                <label for="staff_birthday"><b>Day of Birth:</b></label>
                <input type="date" id="staff_birthday" name="birthday" required>

                <label for="staff_email"><b>Email:</b></label>
                <input type="email" id="staff_email" name="email" required>

                <label for="staff_phone_number"><b>Phone:</b></label>
                <input type="text" id="staff_phone_number" name="phone_number" required>

                <label for="staff_address"><b>Address:</b></label>
                <input type="text" id="staff_address" name="address" required>

                <label for="staff_password"><b>Password:</b></label>
                <input type="password" id="staff_password" name="userpass" required>

                <button type="submit" name="add_staff">Add Member</button>
            </form>
        </div>
    </div>

    <script>
        var modal = document.getElementById("staffModal");
        var btn = document.getElementById("addStaffBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>

