<?php
session_start();
error_reporting(0);
include("constants/connect.php");


if(isset($_POST['search'])){
    $email;
  
    $new;
    $ren;
    $re;
    $ne;
    if(isset($_POST['email'])&& trim($_POST['email'])){

  $e=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
 
  if(empty($e)){
    $_SESSION['e']="<small class='error'>Please enter a valid email</small>";
    $_SESSION['email']=$e;
  }
  else{
    $email=$e;
    $_SESSION['email']=$e;

  }
}
else{
    $_SESSION['e']="<small class='error'>Please enter a email</small>";
}
if(isset($_POST['new'])&&trim($_POST['new'])!=''){
  if(strlen($_POST['new'])<8){
    $_SESSION['new']="<small class='error'>Password should be atleast 8 characters</small>";
  }else{
  $ne=filter_input(INPUT_POST,'new',FILTER_SANITIZE_STRING);

  
  }

}else{
    $_SESSION['new']='<small class="error">Please enter a password</small>';
}

if(isset($_POST['renew'])&&trim($_POST['renew'])!=''){
  if(strlen($_POST['renew'])<8){
    $_SESSION['rnew']='<small class="error">Password should be atlest 8 characters</small>';
  }
  else{
  $re=filter_input(INPUT_POST,'renew',FILTER_SANITIZE_STRING);

  
  }

}else{
    $_SESSION['rnew']='<small class="error">Please enter a password</small>';
}


if($re!=$ne){
  $_SESSION['same']='<small class="error">Passwords do not match</small>';
}else{
  $new=$ne;
}


 if(isset($email)&&isset($new)){
    $che="SELECT * FROM users WHERE email='$email'";

    $emq=mysqli_query($con,$che);
    if(mysqli_num_rows($emq)==1){
      $row=mysqli_fetch_assoc($emq);
        $em=$row['email'];
        $new_id=$row['id'];

        $hashpass=password_hash($new,PASSWORD_DEFAULT);
        
        $respass="UPDATE users SET password='$hashpass' WHERE email='$em' AND id='$new_id'";

        $passreset=mysqli_query($con,$respass);
        if($passreset){
          $_SESSION['update']="<small class='success'>Your password has been reset successfully!</small>";
        }
        else{
          $_SESSION['update']="<small class='error'>Pasword reset failed!</small>";
          
        }
    
    }
    else{
        $_SESSION['notfound']="<small class='error'>The email address is not link with any account</small>";
    }
 }
 else{
  echo 7;
 }


}

 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password || Wiser</title>
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
      <h2 class="res">Reset your account's password</h2>
      <p class="res">Enter email for the account you want to reset password</p>
      <?php
        if(isset($_SESSION['notfound'])){
            echo $_SESSION['notfound'];
            unset($_SESSION['notfound']);
        }
        if(isset($_SESSION['update'])){
        
          echo $_SESSION['update'];
          unset($_SESSION['update']);
      }
           ?>
      <form action="" method="post">
        <div class="form-element">
           <label for="email">Email</label>
           <input type="text" name="email" id="email" value="<?php
        if(isset($_SESSION['email'])){
            echo $_SESSION['email'];
        }
           ?>">
           <?php
        if(isset($_SESSION['e'])){
            echo $_SESSION['e'];
            unset($_SESSION['e']);
        }
           ?>
        </div>
        
            <div class="form-element" >
              <label for="pass1">New password</label>
              <input type="text" name="new" id="pass1">
              <?php
        if(isset($_SESSION['new'])){
            echo $_SESSION['new'];
            unset($_SESSION['new']);
        }
           ?>
              <label for="pass2">Re enter new password</label>
              <input type="text" name="renew" id="pass2">
              <?php
        if(isset($_SESSION['rnew'])){
            echo $_SESSION['rnew'];
            unset($_SESSION['rnew']);
        }
           ?>
                 <?php
        if(isset($_SESSION['same'])){
            echo $_SESSION['same'];
            unset($_SESSION['same']);
        }
           ?>
             </div>
       
        <br>
        <br>
        <button type="submit" name="search">Reset</button>
      </form>
     
   </div>
   </div>
   <?php
   include('components/footer.php')
   ?>
   <script src="script.js"></script>
</body>
</html>