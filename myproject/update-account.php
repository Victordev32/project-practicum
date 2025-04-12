<?php
session_start();
include("constants/connect.php");

if(!isset($_SESSION['id'])){
    header('login.php');
}
$id=$_SESSION['id'];

$user;
$email;
if(isset($_POST['submit'])){
  if(isset($_POST['username'])&& trim($_POST['username'])!==''){
  $u=filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
  if(!empty($u)){
    $user=$u;
  }else{
    $_SESSION['u']="<small class='error'>Please entera  valid  username</small>";
  }
}else{
  $_SESSION['u']="<small class='error'>Please enter a username</small>"; 
}

if(isset($_POST['email'])&& trim($_POST['email'])!==''){
  $e=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
  if(empty($e)){
    $_SESSION['e']= "<small class='error'>Please enter a valid email</small>";
  }
  else{
   $email=$e;
  }
}
else{
  $_SESSION['e']="<small class='error'>Please enter a email</small>";
}

if(isset($user)&&isset($email)){
  
   $check="SELECT * FROM users WHERE username='$user' AND email='$email' AND id!=$id";

   $cq=mysqli_query($con,$check);

   if(mysqli_num_rows($cq)>0){
    $_SESSION['ex']="<small class='error'>The details you have enter are already used for another account</small>";
   }else{
    $upd_user="UPDATE users SET username='$user',email='$email' WHERE id='$id'";

    $user_query=mysqli_query($con,$upd_user);
if($user_query){
  $_SESSION['updt']="<small class='success'>Your details have successfully been updated</small>";
}
   }



}


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update account details|| Wiser</title>
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   <?php
   include('./components/header.php')
   ?>
  <div class="main">
<h3 class="res">Update account</h3><br>
<form action="" method="post">
<?php
$sele="SELECT * FROM users WHERE id='$id'";

$query=mysqli_query($con,$sele);

if(mysqli_num_rows($query)==1){
  while($row=mysqli_fetch_assoc($query)){
?>
<div class="acc-upt">
<?php
        if(isset($_SESSION['updt'])){
                  echo $_SESSION['updt'];
                  unset($_SESSION['updt']);
               }
                ?>
        <div class="form-element">
         
             <label for="username">Username</label>
             <input type="text" name="username" id="username" value="<?php echo $row['username'] ?>">
             
             <?php
               if(isset($_SESSION['u'])){
                  echo $_SESSION['u'];
                  unset($_SESSION['u']);
               }
                ?>
        </div>
        <div class="form-element">
             <label for="email">Email</label>
             <input type="text" name="email" id="email" value="<?php echo $row['email'] ?>">
             <?php
               if(isset($_SESSION['e'])){
                  echo $_SESSION['e'];
                  unset($_SESSION['e']);
               }
                ?>
        </div>
        <?php
               if(isset($_SESSION['ex'])){
                  echo $_SESSION['ex'];
                  unset($_SESSION['ex']);
               }
                ?>
        <button type="submit" name="submit">Update</button>
   <a href="reset.php">Change password</a>
    
</div>
<?php
  }
}else{
  header("location:login.php");
}
?>

</form>
  </div>
   
    <?php
   include('./components/footer.php')
   ?>
   <script src="script.js"></script>
</body>
</html>