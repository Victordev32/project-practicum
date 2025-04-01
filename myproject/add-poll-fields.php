<?php
session_start();
error_reporting(0);
date_default_timezone_set("Africa/Nairobi");
include("constants/connect.php");
include("constants/cookie.php");

$id=null;
$id2=null;
$_SESSION['add']=null;
if(isset($_GET['id'])&&!empty($_GET['id'])){
    $id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);


}
else{
    header('location: index.html');
    
}

$field="single";

$data=array();
$data2=array();

$_SESSION['field'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add poll fields || Wiser</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
   <?php
   include('./components/header.php')
   ?>
   <div class="container">
   <?php
   include('./components/sidebar.php')
   ?>
   <main>
    <div class="form">
        <h2>Add poll query and its option</h2>
    <?php
    if($field=="multiple"){
        $fld=10;
        ?>
        <p>You have selected multi-query poll</p>
    
      
        <?php
       
       if(isset($_SESSION['not'])){
          echo $_SESSION['not'];
          unset($_SESSION['not']);
       }
       
        ?>
    
        
      <form action="" method="post">
        <?php
        $i=1;
        for($i=1;$i<=$fld;$i++){
        ?>
    
        <div class="form-element">
          <label for="query<?php echo $i ?>"><h4>Poll Query <?php echo $i ?></h4></label>
          <input type="text" name="query<?php echo $i ?>" id="query<?php echo $i ?>">
            
        </div>
        
        <div class="query">
        <h4 class="h">Poll options</h4>
        <?php
        $j=1;
        for($j=1;$j<=10;$j++){
           
            ?>
           <div class="form-element">
            <label for="options<?php echo $i.'.'.$j  ?>">Option <?php echo $i.'.'.$j ?></label>
            <input type="text" name="options<?php echo $i.'.'.$j  ?>" id="options<?php echo $i.'.'.$j  ?>">
           </div>
            <?php
        }

        ?>

          
      </div>
      <?php
        }
      ?>

      <button type="submit" name="submit">Submit</button>
      <?php
     if(isset($_SESSION['not'])){
        echo $_SESSION['not'];
        unset($_SESSION['not']);
     }
     if(isset($_SESSION['empty'])){
        echo $_SESSION['empty'];
        unset($_SESSION['empty']);
     }
     
      ?>
      </form>
      <?php
      
      if(isset($_POST['submit'])){
    
    $a=1;
    $b=1;
    $lists=array();
        for($a=1;$a<=10;$a++){
            
            $lists=array(); 
            for($b=1;$b<=10;$b++){
           $lists[]=$_POST['options'.$a.'.'.$b]; 
          
    echo $_POST['options'.$a.'.'.$b];
                    
                
       }
        
       print_r($lists);
      }
      
      }

   
  
   
      ?>


               <?php
           
        }
    else if($field=="single"){
        $t=1;
        $s=1
        ?>
        <p>You have selected single query poll</p>
        <form action="" method="post">
           <div class="form-element">
            <label for="query">Poll query</label>
            <input type="text" name="query" id="query">
            <?php
          if(isset($_SESSION['required'])){
             echo $_SESSION['required'];
             unset($_SESSION['required']);
          }

         ?>
           </div>
           <div class="query">
            <h4>options</h4>
           <?php
            $s=1;
          for($s=1;$s<=10;$s++){
        ?>
        
        <form action="" method="post">
           <div class="form-element">
            <label for="options<?php echo $s?>">Options <?php echo $s?></label>
            <input type="text" name="options<?php echo $s?>" id="options<?php echo $s?>">

           </div>
           <?php


     }
?>

    
    </div>



         <button type="submit" name="submit">Submit</button>
         <?php
          if(isset($_SESSION['empty'])){
             echo $_SESSION['empty'];
             unset($_SESSION['empty']);
          }

         ?>
        </form>
        <?php

        if(isset($_POST['submit'])){
            $list=array();
            $k=0;
            for($k=1;$k<=10;$k++){
            if(isset($_POST['options'.$k])&&!empty($_POST['options'.$k])){
             $list[]=$_POST['options'.$k];
             
            }
        }
              echo count($list);
            if(count($list)<2){
                $_SESSION['empty']="<p class='error'>Please add atleast two options</p>";
            }else{

            
            $query=filter_input(INPUT_POST,"query",FILTER_SANITIZE_SPECIAL_CHARS);
            $in="INSERT INTO polls (query,groupid) VALUES('$query','$id')";
            if(empty($query)){
                $_SESSION['required']="<p class='error'>Please enter something in this fields</p>";
            }
            else{
            $res=mysqli_query($con,$in);
            if($res){
                $newid="SELECT * FROM polls WHERE groupid='$id' AND query='$query'";

                $newres=mysqli_query($con,$newid);

              
                   $row=mysqli_fetch_assoc($newres);
                        $id2=$row['id'];
                    
                    
                
    
                    $id2=$row['id'];
                    echo "<script>console.log('rt'{$id2})</script>";
                 $j=0;
                 $res2;
                   echo count($list);
                   echo $id2;
             for($j=0;$j<count($list);$j++){
                
                $ins="INSERT INTO options (item,pollid) VALUES('$list[$j]','$id2')";
                $res2=mysqli_query($con,$ins);
                
                if($res2){
                    ?>
                    <div class="linker blurme">
                    <h4>Successful!</h4>
                    <?php
              echo $id2;

?>
             <p>Your query and options were added successfully.</p>
             <a href='poll.php'>View polls</a>
             
                    </div>
    
                    <?php
                 }   
             

           

                }
            }
        }
        }
        }
        }
    
    
else{
    header("location: index.html");
}
   ?>
    </div>
   </main>
   </div>
   <div class="mime"></div>
   <script src="script.js"></script>
</body>
</html>