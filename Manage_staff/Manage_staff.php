<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <link rel="stylesheet" href="Manage_staff.css">
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 40%; /* Could be more or less, depending on screen size */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal button {
            background-color: #B3C8CF;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal button:hover {
            background-color: #98B0B9;
        }

        #addStaffBtn {
            background-color: #98B0B9;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin: 20px auto;
            display: block;
        }

        #addStaffBtn:hover {
            background-color: #0056b3;
        }

         /* General styles for input and button */
        input[type="text"], input[type="email"], input[type="password"], input[type="date"] 
        {
            width: 565px; 
            height: 40px; /* Fixed height */
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }
    </style>
</head>
<body>
    <header>
        <a id="back" href="../Admin_home.html"><b>BACK TO ADMIN PAGE</b></a>
        <h1>OKAY STATIONERY SHOP</h1>
    </header>

    <h2 style="text-align: center; margin-top: 5%; margin-bottom: 5%;">Manage Staff</h2>

    <table class="staff-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Password</th>
                <th>Position</th>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_staff'])) {
            $name = $_POST["staff_name"];
            $password = $_POST["staff_password"];
            $email = $_POST["staff_email"];
            $phone_number = $_POST["staff_phone_number"];
            $birthday = $_POST["staff_birthday"];
            $address = $_POST["staff_address"];
            $position = $_POST["staff_position"];

            $stmt = $conn->prepare("INSERT INTO staff (staff_name, staff_password, staff_email, staff_phone_number, staff_birthday, staff_address, staff_position) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $name, $password, $email, $phone_number, $birthday, $address, $position);

            if ($stmt->execute()) {
                echo "<script>alert('Add successful');</script>";
            } else {
                echo "<script>alert('Add failed: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        }

        $result = $conn->query("SELECT * FROM staff");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['staff_id']}</td>
                        <td>{$row['staff_name']}</td>
                        <td>{$row['staff_birthday']}</td>
                        <td>{$row['staff_email']}</td>
                        <td>{$row['staff_phone_number']}</td>
                        <td>{$row['staff_address']}</td>
                        <td>{$row['staff_password']}</td>
                        <td>{$row['staff_position']}</td>
                        <td><a href='staff_delete.php?staff_id={$row['staff_id']}'>Delete</a></td>
                        <td><a href='staff_update.php?staff_id={$row['staff_id']}'>Update</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No staff found</td></tr>";
        }

        $conn->close();
        ?>
        
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "okaydb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['staff_id'])) {
            $staff_id = $_GET['staff_id'];

            $stmt = $conn->prepare("DELETE FROM staff WHERE staff_id = ?");
            $stmt->bind_param("i", $staff_id);

            if ($stmt->execute()) {
                echo "<script>alert('Staff deleted successfully');</script>";
            } else {
                echo "<script>alert('Error deleting staff: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        }

        $conn->close();

        header("Location: manage_staff.php");
        exit();
        ?>

        </tbody>
    </table>

    <!-- Button moved below the table -->
    <button id="addStaffBtn">Add Staff</button>

        <!-- Modal for adding staff -->
        <div id="staffModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Add Staff</h2>
                <form action="" method="post">
                    <label for="staff_name"><b>Name:</b></label>
                    <input type="text" id="staff_name" name="staff_name" required>

                    <label for="staff_birthday"><b>Day of Birth:</b></label>
                    <input type="date" id="staff_birthday" name="staff_birthday" required>

                    <label for="staff_email"><b>Email:</b></label>
                    <input type="email" id="staff_email" name="staff_email" required>

                    <label for="staff_phone_number"><b>Phone:</b></label>
                    <input type="text" id="staff_phone_number" name="staff_phone_number" required>

                    <label for="staff_address"><b>Address:</b></label>
                    <input type="text" id="staff_address" name="staff_address" required>

                    <label for="staff_password"><b>Password:</b></label>
                    <input type="password" id="staff_password" name="staff_password" required>

                    <label for="staff_position"><b>Position:</b></label>
                    <input type="text" id="staff_position" name="staff_position" required>

                    <button type="submit" name="add_staff">Add Staff</button>
                </form>
            </div>
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
