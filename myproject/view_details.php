<?php
session_start();
include("constants/connect.php");
$id;
$pid;
if(!isset($_SESSION['id'])){
    header('location:login.php');
}
else{
    $id=$_SESSION['id'];
}
if(isset($_GET['id'])){
    $pid=$_GET['id'];

}else{
    header('location:poll.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View details || Wiser</title>
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   <?php
   include('./components/header.php')
   ?>
  <div class="main">
      <h3 class="res o">View details for title</h3>
     <div class="container">
      <div class="view">
      <div class="mesg">
       <?php
       if(isset($_SESSION['poll'])){
        echo $_SESSION['poll'];
        unset($_SESSION['poll']);
       }
       ?>
       </div>
     <?php
      $sel_dtl="SELECT * FROM polls WHERE id='$pid' AND userid='$id'";
      $res=mysqli_query($con,$sel_dtl);
      if(mysqli_num_rows($res)==1){
      while($row=mysqli_fetch_assoc($res)){
      ?>
    
      <div class="detail">
        <b>Title: <?php echo $row['title']  ?></b>
        <p>Description: <?php 
        if(isset($row['details'])){
            echo $row['details'];
        }
        else{
            echo '< No description >';
        }
        ?></p>
        <small>Created On: <?php 
        $dc=strtotime($row['datecreated']);
        $cd=date("l,F,d,Y h:i a",$dc);
      
            echo "{$cd}";
        
        
        ?></small>
        <small>Closes on:<?php 
        $cc=strtotime($row['closeon']);
        
        $dcl=date("l,F,d,Y h:i a",$cc);
      if($cc-time()<0){
            echo "This poll was closed on {$dcl}";
        
      }else{
        echo "{$dcl}";
      }
        ?></small>
        <div class="opt">
            <h4>Options</h4>
            <ol>
            <?php
              $se_opt="SELECT * FROM options WHERE pollid='$pid'";
              $res=mysqli_query($con,$se_opt);

              if(mysqli_num_rows($res)>1){
                while($row2=mysqli_fetch_assoc($res)){
                    
            ?>
            
                <li><?php echo $row2['optio']?></li>
            
            <?php
            
                }
              }
            ?>
            </ol>
        </div>
     </div>
     <div class="copy">
        <p>Copy this link and share</p>
        <div class="form-element copyitem">
            <input type="text" id="copy" value="localhost/myproject/vote.php?id=<?php echo $row['id'] ?>">
          <button onclick="copyText()">Copy</button>
            </div>
     </div>
     <a href="single.php?id=<?php echo $row['id'] ?>">View results</a>
     <?php
      }
      }
      else{
        header("location:poll.php");
      }
     ?>
 
      
 
     </div>
     </div>

     </div>
    
     
     <?php
     include('./components/footer.php')
     ?>
     <script src="copy.js"></script>
     <script src="script.js"></script>
</body>
</html>