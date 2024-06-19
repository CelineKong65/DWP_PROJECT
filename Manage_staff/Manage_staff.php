<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <link rel="stylesheet" href="Manage_staff.css">
</head>
<body>
    <header>
        <a id="back" href="../Admin_home.html"><b>BACK TO ADMIN PAGE</b></a>
        <h1>OKAY STATIONERY SHOP</h1>
    </header>

    <h2 style="text-align: center; margin-top: 5%; margin-bottom: 5%;">Manage Staff</h2>

    <section>
    <div class="add-staff">
        <form action="#" method="post">
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

            <button type="submit">Add Staff</button>
        </form>
    </div>
    </section>

    <br>
    <br>
    <br>
    
    <table class="staff-table">
        <thead>
            <tr>
                <th>ID.</th>
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

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Detect connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle table
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["staff_name"];
            $password = $_POST["staff_password"];
            $email = $_POST["staff_email"];
            $phone_number = $_POST["staff_phone_number"];
            $birthday = $_POST["staff_birthday"];
            $address = $_POST["staff_address"];
            $position = $_POST["staff_position"];

            // Input data
            $stmt = $conn->prepare("INSERT INTO staff (staff_name, staff_password, staff_email, staff_phone_number, staff_birthday, staff_address, staff_position) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $name, $password, $email, $phone_number, $birthday, $address, $position);

            if ($stmt->execute()) {
                echo "Add successful";
            } else {
                echo "Add failed: " . $stmt->error;
            }

            $stmt->close();
        }

        // Fetch and display staff data
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
                        <td><a href='staff_delete.php?view&staff_id={$row['staff_id']}'>Delete</a></td>
                        <td><a href='staff_update.php?view&staff_id={$row['staff_id']}'>Update</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No staff found</td></tr>";
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

    <script src="Manage_staff.js"></script>
    
</body>
</html>