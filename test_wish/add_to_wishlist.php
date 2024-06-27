<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_wishlist'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    // Check if the product is already in the wishlist
    $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE product_id = '$product_id' AND user_id = '$user_id'") or die(mysqli_error($conn));

    if (mysqli_num_rows($select_wishlist) > 0) {
        $message[] = 'Product already added to wishlist!';
    } else {
        mysqli_query($conn, "INSERT INTO `wishlist` (user_id, product_id) VALUES ('$user_id', '$product_id')") or die(mysqli_error($conn));
        $message[] = 'Product added to wishlist!';
    }
    header('location:wishlist.php');
    exit;
}

if (isset($_GET['remove_wishlist'])) {
    $remove_id = mysqli_real_escape_string($conn, $_GET['remove_wishlist']);
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$remove_id' AND user_id = '$user_id'") or die(mysqli_error($conn));
    header('location:wishlist.php');
    exit;
}
?>
