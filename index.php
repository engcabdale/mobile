<?php

@include 'config.php';

session_start();

/*login_form.php*/

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $name = mysqli_real_escape_string($conn, $_POST['name']);   
   $email = mysqli_real_escape_string($conn, $_POST['email']);

   $pass = md5($_POST['password']);
   $cpass = md5($_POST['password']);
   $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : ''; // Added semicolon here

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      // Check if 'name' key exists before accessing it
      if(isset($row['name'])) {
         if($row['user_type'] == 'admin'){

            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');

         } elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            header('location:admin_page.php');

         }
      } else {
         $error[] = 'Name not found in database!'; // Handle error if 'name' key is not found
      }
   } else {
      $error[] = 'incorrect email or password!';
   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>

      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>
