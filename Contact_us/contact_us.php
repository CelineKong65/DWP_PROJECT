<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Stationery Shop</title>
    <link rel="stylesheet" href="contact_us.css">
</head>

<style>

.section3{
    background: #fff;
    color: #FFD4B2; 
    width: 300px; 
    height: 300px;
    border-radius: 100px;
    text-align: center;
    padding-top: 3.5%;
    font-size: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    position: absolute;
    top: 61.5%;
    right: 13%; /* Adjust as needed */
    margin-top:2%;
}

.section3 p{
    color: #FFD4B2;
}




</style>


<body>
    <header>
        <a id="back" href="../index.php"><b>BACK TO HOME</b></a>
        <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
        <h1>OKAY Stationery Shop</h1>
    </header>

    <section style="background-image: url(p.contact.png); background-repeat: no-repeat; background-size: 1600px 900px;">
        <div class="contact-icon">
            <br>
            <div style="overflow: hidden; display: inline-block; margin-top: 2%;">
                <img src="address.PNG" style="width: 200px; height: 200px;border-radius: 50%;">
                <img src="email.PNG" style="width: 200px; height: 200px;border-radius: 50%; margin: 0px 200px 0px 200px;">
                <img src="phone.PNG" style="width: 200px; height: 200px;border-radius: 50%;">
            </div>
            <br>
            <div class="contact-info1">
                <h2><b>Address:</b></h2>
                <h2><b>Email:</b></h2>
                <h2><b>Phone:</b></h2>
            </div>
            <br>
            <section class="section1">
                <h4><b>[ Melaka ]</b></h4>
                <p>123 Stationery Street 65, Ayer Keroh, </p>
                <p>Melaka, 75350, Malaysia</p>
                <h4><b>[ Kuala Lumpur ]</b></h4>
                <p>465 Stationery Street 33, Kuala Lumpur,</P>
                <P>Wilayah Persekutuan, 50000, Malaysia</p>
                <h4><b>[ Johor ]</b></h4>
                <p>789 Stationery Street 53, Johor Bahru,</p>
                <p>Johor, 81300, Malaysia</p>
            </section>                
            <section class="section2">
                <h4><b>Office Gmail</b></h4>
                <p>okay@stationeryshop.com</p>
                <h4><b>Hr Gmail</b></h4>
                <p>okayhr@stationeryshop.com</p>

            </section>            
            <section class="section3">
                <h4><b>Office Number</b></h4>
                <p> (07) 555-6799</p>
                <p> (012) 345-6789</p>
                <h4><b>Hr Number</b></h4>
                <p> (010) 888-5566</p>
            </section>
    </section>

    <section style="background-image: url(p.contact.png); background-repeat: no-repeat; background-size: 1600px 900px;">
        <main>
            <div class="message">
                <h2>Get In Touch</h2>
                <p style="margin-top: 20px;">We'd love to hear from you!</p>
                <p>Whether you have questions, suggestions, or just want to say hello,</p>
                <p>feel free to reach out to us using the contact information below.</p>
                <img src="get_in_touch.png">
            </div>

            <div style="padding: 5%;">
                <h2>Contact Us</h2>
                <form action="contact_us.php" method="POST" class="contact-form">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="4" required></textarea>

                    <button type="submit">Send Message</button>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $message = $_POST['message'];

                    // Prepare and bind
                    $stmt = $conn->prepare("INSERT INTO messages (user_name, user_email, user_message) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $name, $email, $message);

                    if ($stmt->execute()) {
                        echo "<p>Message sent successfully.</p>";
                    } else {
                        echo "<p>Error: " . $stmt->error . "</p>";
                    }

                    $stmt->close();
                    $conn->close();
                }
                ?>
            </div>
        </main>

        <div>
            <h2 class="map"><b>Online real time address</b></h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.7366635432413!2d102.27239867547486!3d2.2520662521811188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e56077ee9033%3A0x32b760229ad25d0f!2sIxora%20Apartment!5e0!3m2!1sen!2smy!4v1716647187425!5m2!1sen!2smy" width="1519" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <footer>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../About_us/aboutus.html">About</a></li>
                <li><a href="../Product_list/product_list.php">Services</a></li>
                <li><a href="../Contact_us/contact_us.php">Contact</a></li>
                <li><a href="../login/login.php">Account</a></li>
            </ul>
        </nav>
        <p>&copy; 2019-2024 OKAY Stationery Shop. All rights reserved. OKAY Comapany</p>
    </footer>
</body>
</html>
