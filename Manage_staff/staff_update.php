<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff</title>
    <link rel="stylesheet" href="staff_update.css">
</head>
<body>
    <header>
        <h1>
            <a id="back" href="../Manage_staff/Manage_staff.php"><b>BACK TO MANAGE STAFF PAGE</b></a>
            OKAY STATIONERY SHOP
        </h1>
    </header>

    <div class="container">
        <h2>Update Staff Profile</h2>
        
        <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okaydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["staff_id"])) { // Corrected parameter name
    $staff_id = $_GET["staff_id"]; // Corrected parameter name
    $result = mysqli_query($conn, "SELECT * FROM staff WHERE staff_id = $staff_id");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>
<form action="" method="POST" enctype="multipart/form-data">
    <!-- Include hidden staff ID field -->
    <input type="hidden" name="staff_id" value="<?php echo htmlspecialchars($row['staff_id']); ?>">
    <p>Username:<input type="text" name="staffname" size="80" value="<?php echo htmlspecialchars($row['staff_name']); ?>"></p>
    <p>Email:<input type="text" name="staffemail" size="80" value="<?php echo htmlspecialchars($row['staff_email']); ?>"></p>
    <p>Phone:<input type="text" name="staffphone" size="80" value="<?php echo htmlspecialchars($row['staff_phone_number']); ?>"></p>
    <p>Address:<input type="text" name="staffaddress" size="80" value="<?php echo htmlspecialchars($row['staff_address']); ?>"></p>
    <p>Birthday:<input type="text" name="staffbirthday" size="80" value="<?php echo htmlspecialchars($row['staff_birthday']); ?>"></p>
    <p>Password:<input type="text" name="staffpassword" size="80" value="<?php echo htmlspecialchars($row['staff_password']); ?>"></p>
    <p>Position:<input type="text" name="staffposition" size="80" value="<?php echo htmlspecialchars($row['staff_position']); ?>"></p>
    
    <button type="submit" name="updatebtn">Update Staff Profile</button>
</form>
<?php 
    } else {
        echo "<p>No staff found with the given ID.</p>";
    }
}

if (isset($_POST["updatebtn"])) {
    $staff_id = $_POST["staff_id"];
    $sname = $_POST["staffname"];
    $spassword = $_POST["staffpassword"];
    $semail = $_POST["staffemail"];
    $sbirthday = $_POST["staffbirthday"];
    $sphone_number = $_POST["staffphone"];
    $saddress = $_POST["staffaddress"];
    $sposition = $_POST["staffposition"];

    $update_query = "UPDATE staff SET 
                        staff_name = '$sname', 
                        staff_password = '$spassword', 
                        staff_email = '$semail', 
                        staff_birthday = '$sbirthday', 
                        staff_phone_number = '$sphone_number', 
                        staff_address = '$saddress', 
                        staff_position = '$sposition' 
                    WHERE staff_id = $staff_id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script type='text/javascript'>alert('Staff information Updated');</script>";
        header("refresh:0.5; url=../Manage_staff/Manage_staff.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

$conn->close();
?>

</body>
</html>
