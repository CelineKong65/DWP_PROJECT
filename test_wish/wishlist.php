<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
   header('location:login.php');
   exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['remove_wishlist'])) {
    $remove_id = mysqli_real_escape_string($conn, $_GET['remove_wishlist']);
    mysqli_query($conn, "DELETE FROM wishlist WHERE id = '$remove_id' AND user_id = '$user_id'") or die(mysqli_error($conn));
    header('location:wishlist.php');
    exit;
}

// Example query to retrieve wishlist items
$wishlist_query = mysqli_query($conn, "SELECT w.id AS wishlist_id, p.name, p.price, p.image FROM wishlist w JOIN products p ON w.product_id = p.id WHERE w.user_id = '$user_id'") or die('query failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wishlist</title>
   <link rel="stylesheet" href="style2.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<div class="message" onclick="this.remove();">'.$msg.'</div>';
   }
}
?>

<div class="container">
  
