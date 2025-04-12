<?php
session_start();
include("constants/connect.php");
$id;

if(isset($_GET['id'])){
    $i=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
    echo $i;
   if(empty($i)){
    header('location: poll.php');
   }
   else{
    $id=$i;
   }
}
echo $id;
$del="DELETE FROM polls WHERE id='$id'";
$delete=mysqli_query($con,$del);
echo $del;
if($delete){
    $_SESSION['delete']="<small class='success res'>Poll deleted successfully</small>";
 
    header("location: poll.php");
}
else{
    echo mysqli_error($con);
}
    ?>