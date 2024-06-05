<?php
@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:index.php');
}

// Function to fetch registration data
function fetchRegistrationData() {
    global $conn; // Assuming $conn is your database connection variable
    
    $query = "SELECT * FROM user_form"; // Replace registration_table with your actual table name
    $result = mysqli_query($conn, $query);

    $data = array();
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

$data = fetchRegistrationData(); // Fetch registration data

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<style>
      .grid-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(138px, 5fr));
         gap: 2px;
      }
      .grid-item {
         border: 5px solid red;
         padding: 5px;
      }
   </style>
</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>Hi, <span>admin</span></h3>
      <h1>welcome Eng <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p>this is an admin page</p>
      <a href="index.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
      <table class="table table-hover  table-bordered  table-striped"> 
         <head>
            <th>name</th>
            <th>email</th>
            <th>user_type</th>
            <th>update</th>
            <th>Deleted</th>
          </head>

      </table>

      <!-- Grid view to display registration data -->

      <br>
     
      <div class="grid-container">
         <?php foreach ($data as $row): ?>
            <div class="grid-item"><?php echo $row['name']; ?></div>
            <div class="grid-item"><?php echo $row['email']; ?></div>
            <div class="grid-item"><?php echo $row['user_type']; ?></div>
            <div class="grid-container">
            <a href="update.php?name=<?php echo $row['name']; ?>" class="btn btn-success">Update</a>
         </div>
        <div class="grid-container">
            <a href="update.php?email=<?php echo $row['email']; ?>" class="btn btn-danger">Deleted</a>
   </div>



         <?php endforeach; ?>
      </br>
   </div>
    <!-- <footer> -->
      <footer>
      <p>&copy;<?php echo date("Y"); ?>  Eng cabdale :</p>

   </footer>
      </div
         </div>

</div>


</body>
</html>
