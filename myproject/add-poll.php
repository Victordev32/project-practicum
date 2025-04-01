<?php
session_start();
include('constants/connect.php');
$id;
if(!isset($_SESSION['id'])){
   header('location:login.php');
}
else{
   $id=$_SESSION['id'];
}

if(isset($_POST['submit'])){
$query;
$details;
$datecloses;
$options=array();

if(isset($_POST['query'])&&trim($_POST['query'])!==""){
   $query=filter_input(INPUT_POST,'query',FILTER_SANITIZE_STRING);
   $_SESSION['qu']=$query;
  

}else{
   $_SESSION['qr']='<small class="error">Please enter a question</small>';
}

if(isset($_POST['details'])&&trim($_POST['details'])!==""){
   $details=filter_input(INPUT_POST,'details',FILTER_SANITIZE_STRING);
   $_SESSION['dl']=$details;
  

}else{
   $_SESSION['de']='<small class="error">Please enter details</small>';
}



if(isset($_POST['date'])&&trim($_POST['date'])!=''){
   $t=time();
   $d=strtotime($_POST['date']);
   if(($d-$t)<=(60*60)){
     $_SESSION['date']="<small class='error'>Voting period should be more 1 hr</small>";
   }else{
   $datecloses=$_POST['date'];
   $_SESSION['da']=$datecloses;
   }
  

}else{
   $_SESSION['d']='<small class="error">Please enter a valid date</small>';
}

if(count($_POST['options'])<2){
   $_SESSION['op']="<small class='error'>Please enter atleast two poll options";
   }
   else{
      $options=$_POST['options'];
   }


if(isset($datecloses)&&isset($query)&&isset($options)&&isset($details)){
$ins_poll="INSERT INTO polls(userid,title,details,datecreated,closeon) VALUES('$id','$query',''$details,NOW(),'$datecloses')";

$poll_query=mysqli_query($con,$ins_poll);

if($poll_query){


$ins_id=mysqli_insert_id($con);


$i=1;
$ins_op; //="INSERT INTO options(pollid,optio) VALUES('$ins_id','$options[$i]')";

for($i=0;$i<count($options);$i++){
   
  $options[$i]=mysqli_real_escape_string($con,$options[$i]);
  
if(!empty(trim($options[$i]))){
   $ins_op="INSERT INTO options(pollid,optio) VALUES('$ins_id','$options[$i]')";
  $option_query=mysqli_query($con,$ins_op);
 
}

if($option_query){
   $_SESSION['poll']="<p class='success'>Your poll has been added successfully</p>";
   header("location: view_details.php?id={$ins_id}");
}

}

}else{
   echo mysqli_error($con);
}

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add poll || Wiser</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="poll.css">
</head>
<body>
<?php
   include('./components/header.php')
   ?>
    <?php
   include('./components/menu.php')
   ?>
   
   <div class="main">
    
    
         <div class="form">
       
            <form action="" method="post">
            <h3 class="o">Add poll</h3>
            <div class="form-element query">
                <label for="query">Query</label>
                <input type="text" name="query" id="query" value="<?php
               if(isset($_SESSION['qu'])){
                  echo $_SESSION['qu'];
                  unset($_SESSION['qu']);
               }
                ?>">
                <?php
               if(isset($_SESSION['qr'])){
                  echo $_SESSION['qr'];
                  unset($_SESSION['qr']);
               }
                ?>
            </div>
            <div class="form-element query">
                <label for="details">Details</label>
                <input type="text" name="details" id="details" value="<?php
               if(isset($_SESSION['dl'])){
                  echo $_SESSION['dl'];
                  unset($_SESSION['dl']);
               }
                ?>">
                <?php
               if(isset($_SESSION['de'])){
                  echo $_SESSION['de'];
                  unset($_SESSION['de']);
               }
                ?>
            </div>
            <div class="form-element query">
               <label for="datecloses">Closes on</label>
               <input type="datetime-local" name="date" id="datecloses">
               <?php
               if(isset($_SESSION['date'])){
                  echo $_SESSION['date'];
                  unset($_SESSION['date']);
               }
                ?>
            </div>
            <div class="options">
             <div class="form-element optn">
                <label for="option1">Option 1</label>
                <input type="text" name="options[]" id="option1">
             </div>
             <div class="form-element optn">
                <label for="option2">Option 2</label>
                <input type="text" name="options[]" id="option2">
             </div>
             <?php
               if(isset($_SESSION['op'])){
                  echo $_SESSION['op'];
                  unset($_SESSION['op']);
               }
                ?>
            </div>
            
            <button type="submit" name="submit">Submit</button>
            </form>
            <div class="newinput">
            <button onclick="createInput()">Add new option</button>
            </div>
           
         </div>


   </div>
   <?php
   include('components/footer.php')
   ?>
   <script src="script.js"></script>
   <script src="options.js"></script>
  
</body>
</html>