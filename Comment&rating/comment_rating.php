
<?php
require 'connection.php'; // Include database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $rating = isset($_POST['rating']) ? (float)$_POST['rating'] : 0; // Ensure rating is correctly cast to float
    $comment = $_POST['comment'];

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO comment_rating (username, rating, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $rating, $comment); // 's' for string, 'd' for double (decimal)

    if ($stmt->execute()) {
        echo "<p>Comment and rating submitted successfully.</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment and Rating Page</title>
    <link rel="stylesheet" href="comment_rating.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <style>
    #back 
    {
        position: fixed;
        top: 15px;
        left: 15px;
        color: #FFD4B2;
        background-color: #fff;
        font-size: 20px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        border:#ffefe3 solid ;
        border-radius: 10px;
        text-decoration: none;
        padding: 5px 5px;
    }
    .rating 
    {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .rating input {
        display: none;
    }

    .rating label {
        cursor: pointer;
        font-size: 50px; /* Adjust the size of the label font */
        color: #ddd;
        margin-left: 5px;
    }

    .rating input:checked ~ label {
        color: gold;
    }

    .rating label:before 
    {
    content: '★';
    font-size: 200px; /* Initial size */
    transition: all 0.2s ease-in-out; /* Smooth transition for size change */
    }

    .rating input:checked ~ label:before 
    {
        font-size: 300px; /* Larger size when checked */
    }

    </style>
</head>
<body>
    
    <header>
        <div id="back">
            <a id="back" href="../User_homepage/user_homepage.html"><b>BACK TO HOME</b></a>
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
        <div class="rateyo" id="rating"
             data-rateyo-rating="0"
             data-rateyo-num-stars="5"
             data-rateyo-score="0">
        </div>
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
                <input type="hidden" name="rating" id="rating_input">
                <button type="submit" name="submit">Submit</button>  
            </div>
        </form>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $('#rating_input').val(rating); // Set the rating value to the hidden input field
        });
    });
</script>

</body>
</html>
