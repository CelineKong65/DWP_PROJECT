<?php 
include "connection.php"; 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Images</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            min-height: 100vh;
            background-color: #f0f0f0;
        }
        .card {
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
        }
        .card-title {
            font-size: 18px;
            margin-bottom: 10px;
        }
        a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <a href="index.php">&#8592; Back</a>
    <div class="cards-container">
        <?php 
        $sql = "SELECT * FROM images ORDER BY id DESC";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($image = mysqli_fetch_assoc($res)) {
                $id = $image['id'];
                $image_url = htmlspecialchars($image['image_url']);
        ?>
                <div class="card">
                    <div class="card-title">Image ID: <?= $id ?></div>
                    <img src="uploads/<?= $image_url ?>" alt="Image <?= $id ?>">
                </div>
        <?php 
            } 
        } else {
            echo "<p>No images found.</p>";
        }
        ?>
    </div>
</body>
</html>
