<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
    include "connection.php";

    echo "<pre>";
    print_r($_FILES['my_image']);
    echo "</pre>";

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 125000) {
            $em = "Sorry, your file is too large.";
            header("Location: category_view.php?error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png"); 

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;

                // Check if the uploads directory exists, if not create it
                if (!file_exists('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                if (move_uploaded_file($tmp_name, $img_upload_path)) {
                    // Insert into Database
                    $sql = "INSERT INTO images(image_url) VALUES('$new_img_name')";
                    mysqli_query($conn, $sql);
                    header("Location: manage_product.php");
                } else {
                    echo "Failed to upload file.";
                }
            } else {
                $em = "You can't upload files of this type";
                header("Location: category_view?error=$em");
            }
        }
    } else {
        $em = "unknown error occurred!";
        header("Location: category_view.php?error=$em");
    }
} else {
    header("Location: category_view.php");
}
?>
