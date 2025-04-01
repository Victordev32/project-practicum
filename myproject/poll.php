<?php
session_start();
date_default_timezone_set("Africa/Nairobi");
include("constants/connect.php");
include("constants/cookie.php");

if(!isset($_SESSION['id'])){
    header('location:login.php');
}
$id=$_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polls || Wiser</title>
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   <?php
   include('./components/header.php')
   ?>
    <?php
   include('./components/menu.php')
   ?>
   
   <div class="main">
   <h3 class="res">Your polls</h3>
   <br>
   <?php
if(isset($_SESSION['username'])){?>
<br>
<h4 class="res"> Welcome back,<?php echo $_SESSION['username'] ?></h4>
<?php
unset($_SESSION['username']);
}
?>
    <div class="poll-list">
        <?php 
        $retrieve_poll="SELECT * FROM polls WHERE userid='$id'";
         $res=mysqli_query($con,$retrieve_poll);
if(mysqli_num_rows($res)>0){
     while($row=mysqli_fetch_assoc($res)){
?>
        <div class="poll">
            <div class="title">
                <h3><?php echo $row['title']?></h3>
            
             
            </div>
             <div class="details">
                <i>You added this on:<?php
                $d=strtotime($row['datecreated']);
                $da=date('l,F,d,Y h:i a',$d);
                echo $da;
                ?></i>
                    <small><Details></Details><?php
                    if(isset($row['details'])){
                        echo $row['details'];
                    }else{
                        echo '< no details on this poll >';
                    }
                    ?></small>
                    <small>
                        <?php
                        $cd= date("l,F,d,Y H:i a",strtotime($row['closeon']));
                          if(strtotime($row['closeon'])-time()<0){
                           
                            echo "This poll was closed on {$cd}";
                          }
                          else{
                           echo "Closes on: {$cd}";
                          }
                        ?>
                    </small>                  
            </div>
            <div class="action">
                 
            <a href="view_details.php?id=<?php echo $row['id']?>">View details</a>
            <?php 
              $d=strtotime($row['datecreated']);

              if($d-time()>0){


              
            ?>
                
                <a href="single.php?id=<?php echo $row['id']?>">View results</a>
                <?php }
                else{

                    ?>
                     <a href="single.php?id=<?php echo $row['id']?>">View results</a>
                     <a href="update-poll.php?id=<?php echo $row['id']?>">Update</a>
                    <?php
                }
                ?>
                <a href="delete.php?id=<?php echo $row['id']?>">Delete</a>
            </div>
           
            
        </div>
        <?php
     }
}
else{

    ?>
<div class="poll">
    <p>You do not have any polls</p>
    <a href="add-poll.php">Add poll</a>
</div>
    <?php
}

?>
    
            
    </div>
</div>
<?php
   include('components/footer.php')
   ?>
   <script src="script.js"></script>
</body>
</html>