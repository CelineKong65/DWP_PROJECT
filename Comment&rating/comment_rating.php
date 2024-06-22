<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment and Rating Page</title>
    <link rel="stylesheet" href="comment_rating.css">
</head>
<body>
    
    <header>
        <div id="back">
            <a id="back" href="../index.html"><b>BACK TO HOME</b></a>
        </div>
        <div class="container">
            <h1>
                <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
                Comment and Rating
            </h1>
        </div>
    </header>
        
    <h2 style="text-align: center; margin-top: 60px"><b>Rating</b></h2>
    <p style="text-align: center;margin-top: 20px;margin-bottom: 30px;">Rating for our product and service!</p>
    <div class="rating">
        <input type="radio" id="star5" name="rating" value="5">
        <label for="star5"></label>
        <input type="radio" id="star4" name="rating" value="4">
        <label for="star4"></label>
        <input type="radio" id="star3" name="rating" value="3">
        <label for="star3"></label>
        <input type="radio" id="star2" name="rating" value="2">
        <label for="star2"></label>
        <input type="radio" id="star1" name="rating" value="1">
        <label for="star1"></label>
    </div>
    
    <br>
    <br>
    <hr class="line">
    <br>
    <br>

    <h2 style="text-align: center;"><b>Add Comments or Testimonials</b></h2>
    <div class="add-comment">
        <form action="comment_rating.php" method="post">
            <div>
                <label for="name"><b>Name:</b></label>
                <input type="text" id="name" name="name" required>
            </div>
            <label for="comment"><b>Add any comment or testimonials for our product and service:</b></label>
            <textarea id="comment" name="comment" placeholder="Enter Your Comment" required></textarea>
            
            <div>
                <button type="submit" name="submit">Submit</button>  
            </div>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
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
            $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
            $comment = $_POST['comment'];

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO rating_comments (user_name, rating, comment) VALUES (?, ?, ?)");
            $stmt->bind_param("sis", $name, $rating, $comment);

            if ($stmt->execute()) {
                echo "<p>Comment and rating submitted successfully.</p>";
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </div>

</body>
</html>
