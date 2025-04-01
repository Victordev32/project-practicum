<?php
session_start();
include("constants/connect.php");
// $a=hash_algos();
// sha256();

//echo "<script>console.log('{$a[5]}')</script>";
if(isset($_POST['submit'])){
$email;
$pass;

if(isset($_POST['email'])&& trim($_POST['email'])!=''){
  $e=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
  $_SESSION['e']=$_POST['email'];
  if(empty($e)){
    $_SESSION['valid']="<small class='error'>Please enter a valid email</small>";
  
  }else{
    $email=$e;
  }
}
else{
    $_SESSION['valid']='<small class="error">Please enter your email</small>';
}

if(isset($_POST['password'])&& trim($_POST['password'])!=''){
    
    $_SESSION['p']=$_POST['password'];
    if(strlen($_POST['password'])<8){
        $_SESSION['pa']='<small class="error">Password should be atleast 8 characters</small>';
     
    }
    else{
   $pass=$_POST['password'];
    }
  }
  else{
      $_SESSION['pa']='<small class="error">Please enter your email</small>';
  }



if(isset($email)&&isset($pass)){
$valid="SELECT * FROM users WHERE email='$email' AND password='$pass'";

$res=mysqli_query($con,$valid);

if(mysqli_num_rows($res)==1){
    $row=mysqli_fetch_assoc($res);
  
   $_SESSION['id']=$row['id'];
   $_SESSION['username']=$row['username'];
   header('location:poll.php');


}
else{

    $_SESSION['not']="<small class='error'>Incorrect username or password</small>";
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
    <title>Log in || Wiser</title>
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
                <li><a class="reg" href="signup.php">Register</a></li>
            </ul>
        </nav>
  
    
        <div class="menu">

           <i class="fa fa-bars">i</i>
        </div>
       
    </header>
    <div class="main">
        <div class="form signup">
            <h3>Log in</h3>
            <p>Log in to add a poll</p>
            <form action="" method="post" class="newform">
               
                <div class="form-element">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php
                    if(isset($_SESSION['e'])){
                        echo $_SESSION['e'];
                        unset($_SESSION['e']);
                       }
                    ?>">
                    <?php
                   if(isset($_SESSION['valid'])){
                    echo $_SESSION['valid'];
                    unset($_SESSION['valid']);
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
                   if(isset($_SESSION['pa'])){
                    echo $_SESSION['pa'];
                    unset($_SESSION['pa']);
                   }
                    
                    ?>
                </div>
                
                   <div class="radio">
                    
                    <input type="checkbox" id="show">
                    Show password
                    
                    </div>
                <button type="submit" name="submit">Log in</button>
                <?php
                   if(isset($_SESSION['not'])){
                    echo $_SESSION['not'];
                    unset($_SESSION['not']);
                   }
                    
                    ?>
                <div class="links">
                    <a href="forgot.php">Forgot Password</a>
                    <p>Do not have an account?<a href="signup.php">Sign up</a></p>
                </div>
            </form>
        </div>
    </div>
    <?php
    include("./components/footer.php")
    ?>
    <script src="poll.js"></script>
    <script src="pass.js"></script>
    <script src="script.js"></script>
</body>
</html>