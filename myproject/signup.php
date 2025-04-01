<?php
session_start();
include('constants/connect.php');

if(isset($_POST['submit'])){
$user;
$email;
$password;
$cpassword;
if(isset($_POST['username'])&&trim($_POST['username'])!==''){
   $user=filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
   $_SESSION['u']=$user;
}
else{
     $_SESSION['user']="<small class='error'>Please enter a name </small>";
}
if(isset($_POST['email'])&&trim($_POST['email'])!==''){
    $ema=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
    $_SESSION['e']=$_POST['email'];
    if(empty($ema)){

        $_SESSION['email']="<small class='error'>Please enter a valid email</small>";
    }
    else{ 
  $email=$ema;
    }
 }
 else{
      $_SESSION['email']="<small class='error'>Please enter an email </small>";
 }

if(isset($_POST['password'])&&trim($_POST['password'])!=''){
   $pass=filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
    if(strlen($_POST['password'])<8){
        $_SESSION['pass']="<small class='error'>Password must contain atleast 8 characters</small>";
        $_SESSION['p']=$_POST['password'];
    }else{
    $password=$_POST['password'];
    $_SESSION['p']=$password;
    }
 }
 else{
      $_SESSION['pass']="<small class='error'>Please enter password </small>";
    
 }

 if(isset($_POST['cpassword'])&&trim($_POST['cpassword'])!=''){

    if(strlen($_POST['cpassword'])<8){
$_SESSION['cpass']="<small class='error'>Password must comtain atleast 8 characters</small>";
$_SESSION['p']=$_POST['cpassword'];
    }else{
    $cpassword=$_POST['cpassword'];
    $_SESSION['cp']=$cpassword;
    }
 }
 else{
      $_SESSION['cpass']="<small class='error'>Please enter password </small>";
 }

if(isset($user)&&isset($password)&&isset($cpassword)&&isset($email)){
 $check_user="SELECT * FROM users WHERE username='$user' OR email='$email'";
//$psw=hash('sha256',$password);
 $insert_user="INSERT INTO users(username,email,password,register_date) VALUES('$user','$email','$password',NOW())";

$query=mysqli_query($con,$check_user);
if(mysqli_num_rows($query)>0){
    $_SESSION['exist']="<small class='error'>User already exist</small>";
 
}
else{
    if($password!=$cpassword){
        $_SESSION['same']='<small class="error">The passwords must be the same</small>';
    }
    else{
      
     $ins_query=mysqli_query($con,$insert_user);
     if($ins_query){
        header('location:verify.php');
     }
     else{
        $_SESSION['error']="<small class='error'>User not added</small>";  
     }
   
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
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sign up || Wiser</title>
</head>
<body>
<header>
        <div class="logo">
            <a href="index.html">Wiser</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About us</a></li>
                <li><a href="contact-us.html">Contact us</a></li>
                <li><a class="reg" href="login.php">Log in</a></li>
            </ul>
        </nav>
  
    
        <div class="menu">

           <i class="fa fa-bars">i</i>
        </div>
       
    </header>
    <div class="main">
        <div class="form signup">
            <h3>Register</h3>
            <p>Sign up to start adding polls</p>
            <form action="" method="post" class="newform">
                <div class="form-element">
                    <label for="user">Username</label>
                    <input type="text" name="username" id="user" value="<?php 
                      if(isset($_SESSION['u'])){
                        echo $_SESSION['u'];
                        unset($_SESSION['u']);
                      }
                    ?>">
                    <?php
                   if(isset($_SESSION['user'])){
                    echo $_SESSION['user'];
                    unset($_SESSION['user']);
                   }
                    
                    ?>
                </div>
                <div class="form-element">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php 
                      if(isset($_SESSION['e'])){
                        echo $_SESSION['e'];
                        unset($_SESSION['e']);
                      }
                    ?>">
                    <?php
                   if(isset($_SESSION['email'])){
                    echo $_SESSION['email'];
                    unset($_SESSION['email']);
                   }
                    
                    ?>
                </div>
                <div class="form-element">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php 
                      if(isset($_SESSION['p'])){
                        echo $_SESSION['p'];
                        unset($_SESSION['p']);
                      }
                    ?>">
                    <?php
                   if(isset($_SESSION['pass'])){
                    echo $_SESSION['pass'];
                    unset($_SESSION['pass']);
                   }
                    
                    ?>
                </div>
                <div class="form-element">
                    <label for="cpassword">Confirm password</label>
                    <input type="password" name="cpassword" id="cpassword" value="<?php 
                      if(isset($_SESSION['cp'])){
                        echo $_SESSION['cp'];
                        unset($_SESSION['cp']);
                      }
                    ?>">
                    <?php
                   if(isset($_SESSION['cpass'])){
                    echo $_SESSION['cpass'];
                    unset($_SESSION['cpass']);
                   }
                    
                    ?>
                </div>
                
                   <div class="radio">
                    
                    <input type="checkbox" id="show">
                    Show password
                    
                    </div>
                <button type="submit" name="submit">Sign up</button>
                <?php
                   if(isset($_SESSION['exist'])){
                    echo $_SESSION['exist'];
                    unset($_SESSION['exist']);
                   }

                   if(isset($_SESSION['same'])){
                    echo $_SESSION['same'];
                    unset($_SESSION['same']);
                   }
                    
                   if(isset($_SESSION['error'])){
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                   }
                    
                    ?>
                <div class="links">
                    <a href="forgot.php">Forgot Password</a>
                    <p>Already with account?<a href="login.php">Log in</a></p>
                </div>
            </form>
          
                  
        </div>
    </div>
    <?php
    include("./components/footer.php")
    ?>
    <script src="script.js"></script>
    <script src="pass.js"></script>
</body>
</html> 