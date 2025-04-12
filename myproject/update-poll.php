<?php
session_start();
include('constants/connect.php');
$pid;
$id;
if(isset($_GET['id'])){
    $d=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
    if(empty($d)||$d<=0){
        header('location: poll.php');
    }else{
        $pid=$d;
    }
}
else{
    header('poll.php'); 
}
$_SESSION['id'];
    if(!isset($_SESSION['id'])){
        header('location:login.php');
    }
    else{
        $id=$_SESSION['id'];
    }

    $title;
    $details;
    $options=array();
    $newoptions=array();
    $date;
if(isset($_POST['submit'])){
    echo $_POST['date'];
    if(isset($_POST['title'])&& trim($_POST['title'])!==''){
        $t=filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
      $title=$t;
    }else{
        $_SESSION['et']="<small class='error'>Please enter a title</small>";
    }
    if(isset($_POST['details'])&& trim($_POST['details'])!==''){
        $d=filter_input(INPUT_POST,'details',FILTER_SANITIZE_STRING);
      $details=$d;
    }
    else{
        $_SESSION['ed']="<small class='error'>Please enter details</small>"; 
    }

    if(isset($_POST['date'])&& trim($_POST['date'])!=''){
        $dt=strtotime($_POST['date']);
        $cd=strtotime($_SESSION['date']);
        $dctd=strtotime($_SESSION['created']);

        if($dt-$cd>(5*60*60)){
            $_SESSION['more']="<small class='error'>You cannot extend polling time by more than 5 hrs</small>";
        }else if($cd-$dt>(5*60*60)){
           $_SESSION['more']="<small class='error'>You cannot reduce polling time by less than 5hrs</small>";
        }
        else if($dt==time()){
            $_SESSION['more']="<small class='error'>Poll cannot close now</small>";
        }else if(
           $dt<$ctd
        ){
           $_SESSION['more']="<small class='error'>You cannot entered date less than date you created</small>";
        }
        else{
           $date=$_POST['date'];
        }
    }
    else{
        $date=$_SESSION['date'];
    }

    if(isset($_POST['options'])){
        
            $options=$_POST['options'];
        
    }

    
    if(isset($_POST['newoptions'])){
      $newoptions=$_POST['newoptions'];
    }
    $check=0;
    for($k=0;$k<count($newoptions);$k++){
        $se="SELECT * FROM options WHERE optio='$newoptions[$i]'";

        $c=mysqli_query($con,$se);

        $check=mysqli_num_rows($c);
       
    }
    if($check>1){
        $_SESSION['there']="<small class='error'>One of your poll options alresady exist</small>";
     }
else{
    if(isset($title)&&isset($details)&&isset($date)&&isset($options)){
          $poll_upt="UPDATE polls SET title='$title',details='$details',closeon='$date',lastupdate=NOW() WHERE id='$pid' AND userid='$id'";
         
             $res=mysqli_query($con,$poll_upt);
     
             
       if($res){ 
        $se="SELECT * FROM options WHERE pollid='$pid'";
        $sql=mysqli_query($con,$se);
$i=0;
    while($roe=mysqli_fetch_assoc($sql)){
        $opid=$roe['id'];
      
        $in="UPDATE options SET optio='$options[$i]' WHERE id='$opid' AND pollid='$pid'";
        $sel="SELECT * FROM options WHERE optio='$options[$i]'";
        $nres=mysqli_query($con,$sel);
        if(mysqli_num_rows($nres)>1){
            $_SESSION['there']="<small class='error'>One of your poll options alresady exist</small>";
        }else{
        $res3=mysqli_query($con,$in);
       
        }   
       $i++;
      
    }
    if($res3){
        $_SESSION['success']="<br><small class='success'>Your poll has been updated successfully</small>";
        if(isset($newoptions)&&count($newoptions)!==0){
           for($k=0;$k<count($newoptions);$k++){
           
            $newoptions[$k]=mysqli_escape_string($con,$newoptions[$k]);
            if(!empty($newoptions[$k])){
                
               $innew="INSERT INTO options(optio,pollid) VALUES('$newoptions[$k]','$pid')";
                $nres6=mysqli_query($con,$innew);
            echo "<script>alert('7')</script>";
            }
        }
        }
       
    }

  

       }else{
        $_SESSION['upd']='<small class="error">Fail to update</small>';
       }
          

    }
    else{
        echo $details;
        echo $title;
        echo $date;
    }

}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update poll || Wiser</title>
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   <?php
   include('./components/header.php');
   include('components/menu.php')
   ?>
   <div class="main update">
    <h3 class="res">
        Update poll
    </h3><br>
   <p>Note: You can only update once</p>
   <?php
              if(isset($_SESSION['success'])){
                echo $_SESSION['success'];
                unset($_SESSION['success']);
              }
            ?>
    <form action="" method="post" class="update">
        <?php
         $updse="SELECT * FROM polls WHERE userid='$id' AND id='$pid'";
         $upquery=mysqli_query($con,$updse);
        if(mysqli_num_rows($upquery)>0){

            while($row=mysqli_fetch_assoc($upquery)){
              
                $_SESSION['date']=$row['closeon'];
                $_SESSION['created']=$row['datecreated'];
        ?>
        <h3 class="res"><?php echo $row['title']?></h3><br>
        <div class="form-element">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?php echo $row['title'] ?>">
            <?php
              if(isset($_SESSION['et'])){
                echo $_SESSION['et'];
                unset($_SESSION['et']);
              }
            ?>
        </div>
        <div class="form-element">
          <label for="details">Details</label>
          <input type="text" name="details" id="details" value="<?php echo $row['details'] ?>">
          <?php
              if(isset($_SESSION['ed'])){
                echo $_SESSION['ed'];
                unset($_SESSION['ed']);
              }
            ?>
        </div>
        <div class="form-element">
          <label for="date">Extend date before closing</label>
          <p><?php echo date("l,F,d,Y H:i a",strtotime($row['closeon'])) ?></p>
          <input type="datetime-local" name="date" id="date" value="<?php echo date("d/m/Y H:i",strtotime($row['closeon'])) ?>">
          <?php
              if(isset($_SESSION['more'])){
                echo $_SESSION['more'];
                unset($_SESSION['more']);
              }
            ?> 
        </div>
          <div class="opt-update">
         <?php
         $nid=$row['id'];
          $upt_sel_opt="SELECT * FROM options WHERE pollid='$nid'";
          $upqueryopt=mysqli_query($con,$upt_sel_opt);
          if(mysqli_num_rows($upqueryopt)>0){
            $i=1;
            while($rown=mysqli_fetch_assoc(($upqueryopt))){
            
           ?>
             <div class="form-element">
                <label for="upt-opt<?php echo $i ?>">Option <?php echo $i?></label>
                <input type="text" name="options[]" id="upt-opt<?php echo $i ?>" value="<?php echo $rown['optio'];?>">
             </div>
       
        <?php
        $i++;
            }}
        ?>
         </div>
        <?php
            }
        }
        else{
            header("location: poll.php");
        }
        ?>
          <?php
              if(isset($_SESSION['options'])){
                echo $_SESSION['options'];
                unset($_SESSION['options']);
              }
            ?>
             <?php
              if(isset($_SESSION['upd'])){
                echo $_SESSION['upd'];
                unset($_SESSION['upd']);
              }
              if(isset($_SESSION['there'])){
                echo $_SESSION['there'];
                unset($_SESSION['there']);
              }
            ?>

        <button type="submit" name="submit">Update</button>
       
    </form>
    <div class="newinput">
       <button style="background-color: blue;" onclick="addnewupdateOption()">Add New Option</button>
    </div>
   </div>
   
   <script src="script.js"></script>
   <script src="new.js"></script>
</body>

</html>   