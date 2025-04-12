<?php
session_start();
include("constants/connect.php");

if(!isset($_SESSION['id'])){
    header('login.php');
}
$id=$_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account|| Wiser</title>
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   <?php
   include('./components/header.php')
   ?>
  <div class="main">
<h3 class="res">My account</h3><br>
<?php
$sele="SELECT * FROM users WHERE id='$id'";

$query=mysqli_query($con,$sele);

if(mysqli_num_rows($query)==1){
  while($row=mysqli_fetch_assoc($query)){
?>
<div class="account">
    <div class="big">
      
        <div class="picture">
               <i class="fa fa-circle-user"></i>
              
        </div>
        <div class="name">
          <b><?php echo $row['username']?></b>
        </div>
        <div class="no-votes">
          <?php
              $sev="SELECT * FROM polls where userid='$id'";

              $sql=mysqli_query($con,$sev);

              $count=mysqli_num_rows($sql);
              ?>
              <small>You have <?php echo $count ?> poll(s).</small>

              <?php

          ?>
        </div>
     </div>
        <div class="personal">
            <div class="email">
               <p><?php echo $row['email']?></p>
            </div>
        </div>
        <a href="update-account.php">Update account</a>
      <a class="logout" href="logout.php">Log out</a>
    
</div>
<?php
  }
}else{
  header("location:login.php");
}
?>
  </div>
   
    <?php
   include('./components/footer.php')
   ?>
   <script src="script.js"></script>
</body>
</html>