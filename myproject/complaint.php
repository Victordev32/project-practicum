<?php
session_start();
include("constants/connect.php")
$email;
$comp;

if(isset($_POST['email'])&& trim($_POST['eamil'])){
 $e=

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints || Wiser</title>
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   <?php
   include('./components/header.php')
   ?>
  <div class="main">
    <h2 class="res">Account prefference</h2>
    <br>
<p class="res">Add a complaint you have with our services</p>
<div class="form">
    <form action="" method="post">
        <div class="form-element">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
        </div> 
        <div class="form-element">
            <label for="comp">Complaint</label>
            <input type="text" name="comp" id="comp">
        </div> 
        <button type="submit">Submit</button>
    </form>
</div>

  </div>
   
    <?php
   include('./components/footer.php')
   ?>
   <script src="script.js"></script>
   <script src="cookie.js"></script>
</body>
</html>