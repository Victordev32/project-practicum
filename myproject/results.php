<?php
session_start();
include("constants/connect.php");
$id;
if(!isset($_SESSION['id'])){
    header('location:login.php');
}
else{
    $id=$_SESSION['id'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll results || Wiser</title>
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   
<?php
 include('./components/header.php');
 include('components/menu.php')
?>
<div class="main">

<h3 class="res">View results for your polls</h3>
<div class="vote-cont">
    <div class="list">
<?php
$selpoll="SELECT * FROM polls WHERE userid ='$id'";

$res=mysqli_query($con,$selpoll);
if(mysqli_num_rows($res)>0){
    while($row=mysqli_fetch_assoc($res)){
?>
        <div class="resdiv">
            <h4>Title: <?php echo $row['title']?></h4>
            <p>Description: <?php 
            if(isset($row['details'])){
            echo $row['details'];
            }else{
                echo '< No description >';
            }
            ?></p>
            <a href="single.php?id=<?php echo $row['id'] ?>">View result</a>
        </div>
      
   <?php
    }
}else{
    ?>
<div class="resdiv">
    You have no polls to view results.
</div>
    <?php
}
   ?>
    </div>
</div>
</div>
<?php 
include('components/footer.php')
?>
<script src="script.js"></script>
</body>
</html>