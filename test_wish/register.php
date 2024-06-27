<?php
include 'config.php';

if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM user_info WHERE email = '$email'") or die(mysqli_error($conn));

   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exists!';
   } else {
      $insert = mysqli_query($conn, "INSERT INTO user_info (name, email, password) VALUES ('$name', '$email', '$pass')") or die(mysqli_error($conn));
      if($insert){
         $message[] = 'Registered successfully!';
         header('location:login.php');
      } else {
         $message[] = 'Registration failed!';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<div class="message" onclick="this.remove();">'.$msg.'</div>';
   }
}
?>

<div class="form-container">
   <form action="" method="post">
      <h3>Register Now</h3>
      <input type="text" name="name" required placeholder="Enter Username" class="box">
      <input type="email" name="email" required placeholder="Enter Email" class="box">
      <input type="password" name="password" required placeholder="Enter Password" class="box">
      <input type="password" name="cpassword" required placeholder="Confirm Password" class="box">
      <input type="submit" name="submit" class="btn" value="Register">
      <p>Already have an account? <a href="login.php">Login Now</a></p>
   </form>
</div>

</body>
</html>
