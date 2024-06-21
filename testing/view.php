<?php 
include "connection.php"; 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            min-height: 100vh;
        }
        .alb {
            width: 200px;
            height: 200px;
            padding: 5px;
        }
        .alb img {
            width: 100%;
            height: 100%;
        }
        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
     <a href="index.php">&#8592;</a>
     <?php 
          $sql = "SELECT * FROM images ORDER BY id DESC";
          $res = mysqli_query($conn, $sql);

          if (mysqli_num_rows($res) > 0) {
              while ($images = mysqli_fetch_assoc($res)) {  
     ?>
             <div class="alb">
                <img src="uploads/<?= htmlspecialchars($images['image_url']) ?>">
             </div>
     <?php 
              } 
          } else {
              echo "<p>No images found</p>";
          }
     ?>
</body>
</html>
