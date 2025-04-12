<?php
session_start();
include('constants/connect.php');
$pid;

if(isset($_GET['id'])){
  $i=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
  if(empty($i)||$i==0){
    header('location: results.php');
  }
  else{
    $pid=$i;
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll result || Wiser</title>
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   
<?php
 include('./components/header.php');
 
?>
<div class="main">

<h1 class="res">Results</h1>
<div class="vote-cont">
  <div class="results">
   <?php 
     $sel="SELECT * FROM polls WHERE id=$pid";
     $res=mysqli_query($con,$sel);

     if(mysqli_num_rows(($res))>0){
      while($row=mysqli_fetch_assoc($res)){
   ?>
    <h3>Title: <?php echo $row['title'] ?></h3>
    <p>Description: <?php if(isset($row['details'])){
echo $row['details'];
    }else{
      echo "< NO DESCRIPTION >";
    }
      ?></p><br>
    <h3>vote per candidates</h3>
    <div class="votes">
      <?php
      $pd=$row['id'];
        $seoption="SELECT * FROM options WHERE pollid= '$pd'";
        $resp=mysqli_query($con,$seoption);
        if(mysqli_num_rows($resp)>0){
          $all="SELECT * FROM votes WHERE pollid='$pid'";
          $optall=mysqli_query($con,$all);
          $tl=mysqli_num_rows($optall);
         if(mysqli_num_rows($optall)==0){
          ?>
          <div class="candidate">
            This poll has 0 vote(s)
          </div>

          <?php
         }else{
         while($rowp=mysqli_fetch_assoc($resp)){
        
      ?>
          <div class="candidate" style="position: relative; text-align: center;">
          
            <?php 
            $optid=$rowp['id'];

            //totals votes for the  poll
          
            $tl=mysqli_num_rows($optall);
            //total votes for a particular option
            $opt="SELECT * FROM votes WHERE optid='$optid' AND pollid='$pid'";
            $optq=mysqli_query($con,$opt);
            $n=mysqli_num_rows($optq);
          
            ?>
            <span style="display:flex; justify-content: flex-end; align-items: center; color: black;
             position: absolute; opacity: 0.7;background-color:#000000; width: <?php echo ($n/$tl)*294?>px; left: 1%; top: 5%; bottom: 5%; right: 1%; border-radius: 20px;
             "></span>
               <p style="color: white; z-index: 1000; text-align: center;"><?php echo $rowp['optio'] ?></p>
         <p><?php $p=round(($n/$tl)*100,2); echo "{$n}({$p}%)"?></p>
          </div>
          
   
     <?php
         }
        }
      }
      
        else{
          
            header("location:results.php");
          
        }
     ?>
     <br>
     <i>Total votes <?php echo $tl ?></i>
     <br>
     <p>Percentages are rounded to 2 decimal palces</p>
       </div>
       <?php
      }
     }else{
      header("location:results.php");
     }
       ?>
    </div>
   </div>
 >
</div>
<?php
 include('components/footer.php');
?>
<script src="script.js"></script>
</body>
</html>