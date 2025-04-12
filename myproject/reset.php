<?php
session_start();
error_reporting(0);
include("constants/connect.php");
$id;
if(!isset($_SESSION['id'])){
    header('location: login.php');
}
else{
    $id=$_SESSION['id'];
}

if(isset($_POST['change'])){
   $old;
   $new;
   $renew;
   $o;
   $n;
   $r;

   if(isset($_POST['old'])&&trim($_POST['old'])!=''){
    $o=filter_input(INPUT_POST,'old',FILTER_SANITIZE_STRING);
    
   }else{
  $_SESSION['o']="<small class='error'>Please enter your old password</small>";
   }

   if(isset($_POST['new'])&& trim($_POST['new'])!=''){
    if(strlen($_POST['new'])<8){
        $_SESSION['chn']="<small class='error'>Password should atleast 8 characters</small>";
    }
    else{
        $n=filter_input(INPUT_POST,'new',FILTER_SANITIZE_STRING);
    }
   }else{
    $_SESSION['chn']="<small class='error'>Please enter a password</small>";
}
   
   if(isset($_POST['renew'])&& trim($_POST['renew'])!=''){
    if(strlen($_POST['renew'])<8){
        $_SESSION['chn2']="<small class='error'>Password should atleast 8 characters</small>";
    }
    else{
        $r=filter_input(INPUT_POST,'renew',FILTER_SANITIZE_STRING);
    }
   }else{
    $_SESSION['chn2']="<small class='error'>Please enter a password</small>";
   }

   if($n!=$r){
    $_SESSION['match']="<small class='error'>Passwords should match</small>";
   }else{
    $new=$n;
    $renew=$r;
    $old=$o;
   }
 
   if(isset($new)&&isset($old)&&isset($renew)){
    
    $checkpass="SELECT * FROM users WHERE id='$id'";
      $res=mysqli_query($con,$checkpass);
    
          $row=mysqli_fetch_assoc($res);
          $em=$row['email'];
          $pass=password_verify($old,$row['password']);
          if($pass){    
           $changepass="UPDATE users SET password='$hashpw' WHERE id='$id' AND email='$em'";

           $uppass=mysqli_query($con,$changepass);

           if($uppass){
             $_SESSION['success']="<small class='success'>Your pasword has been changed</small>";
           }
      }
      else{
        $_SESSION['wrong']="<small class='error'>You have entered a wrong password</small>";
      }
   }

} 
   

 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password || Wiser</title>
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   <?php
   include('./components/header.php')
   ?>
   <div class="main">
       <div class="upd-pass">
      <h2 class="res">Change your account's password</h2>
      <?php
           if(isset($_SESSION['success'])){
             echo $_SESSION['success'];
             unset($_SESSION['success']);
           }
         ?>
      <form action="" method="post">
       
            <div class="form-element">
            <label for="old">Old password</label>
            <input type="text" name="old" id="old">
            <?php
           if(isset($_SESSION['o'])){
             echo $_SESSION['o'];
             unset($_SESSION['o']);
           }
         ?>
            <?php
           if(isset($_SESSION['wrong'])){
             echo $_SESSION['wrong'];
             unset($_SESSION['wrong']);
           }
         ?>
              <label for="pass1">New password</label>
              <input type="text" name="new" id="pass1">
              <?php
           if(isset($_SESSION['chn'])){
             echo $_SESSION['chn'];
             unset($_SESSION['chn']);
           }
         ?>
              <label for="pass2">Re enter new password</label>
              <input type="text" name="renew" id="pass2">
              <?php
           if(isset($_SESSION['chn2'])){
             echo $_SESSION['chn2'];
             unset($_SESSION['chn2']);
           }
         ?>
         <?php
           if(isset($_SESSION['match'])){
             echo $_SESSION['match'];
             unset($_SESSION['match']);
           }
         ?>
             </div>
       
        <br>
        <br>
        <button type="submit" name="change">Change</button>
      </form>
     
   </div>
</div>
   <?php
  include('components/footer.php')
   ?>
   <script src="script.js"></script>
</body>
</html>