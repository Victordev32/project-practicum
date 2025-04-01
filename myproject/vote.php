<?php
session_start();
date_default_timezone_set("Africa/Nairobi");
include("constants/connect.php");
include("constants/cookie.php");
$pid;
if(!isset($_GET['id'])&& empty($_GET['id'])){
    header("location: index.html");
}
else{
    $pid=filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
}

$vote;
if(isset($_POST['submit'])){
    if(isset($_POST['poll'.$pid])){
        $vote=$_POST['poll'.$pid];
    }
    else{
        $_SESSION['vote']="<small class='error'>Please check an option</small>";
    }
    
if(isset($vote)){
    $ins_vote="INSERT INTO votes(optid,pollid,date_voted) VALUES('$vote','$pid',NOW())";
    $nres=mysqli_query($con,$ins_vote);

    if($nres){
        $SESSION['votes']="<small class='success'>Voted successfully!</small>";
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote |<?php echo $_SESSION['title'] ?> || Wiser</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
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
                <li><a class="reg" href="signup.php">Sign  up</a></li>
            </ul>
        </nav>
     <div class="searchbtn">
        <form action="search.php" method="get">
        <input type="search" name="search">
        <button type="submit" name="search">Search</button>
    </form>
   
     </div>    
        <div class="menu">

           <i class="fa fa-bars">i</i>
        </div>
       
    </header>
    <div class="main">
        <div class="vote-form">
           <?php
 if(isset($_SESSION['votes'])){
    echo $_SESSION['votes'];
    unset($_SESSION['votes']);
   }
           ?>
            <form action="" method="post">
            <h3 class="res">Vote</h3>
              <?php
                   $sepol="SELECT * FROM polls WHERE id='$pid'";
                   $res=mysqli_query($con,$sepol);
                   
                   
                   if(mysqli_num_rows($res)>0){
                         while($row=mysqli_fetch_assoc($res)){
                                 $title=str_replace('-',' ',$row['title']);
                            $_SESSION['title']=$title;
                            $cd=strtotime($row['closeon']);
                            if($cd-time()<0){
                            ?>
                             <b><?php echo $row['title'] ?></b>
                             <small>Added by: <?php
                             $se_user="SELECT username FROM users WHERE id={$row['userid']}";

                             $reuser=mysqli_query($con,$se_user);
                             $rowu=mysqli_fetch_assoc($reuser);
                             echo $rowu['username']
                             ?></small>
                             <p><?php if(!isset($row['details'])){echo '< no details >';}else{ echo $row['details'];} ?></p>
                             <small><?php echo date("l,F,D,Y h:i a",strtotime($row['datecreated'])) ?></small>
                            <small><?php echo "Was closed on ".date("l,F,D,Y h:i a",strtotime($row['closeon']))?></small>
                            
                             <div class="cand">
                                      <a href="res.php?id=<?php echo $row['id'] ?>">View results</a>
                            </div>
                            <?php
                            }
                            else{
                            ?>
                            
                           <b><?php echo $row['title'] ?></b>
                           <p><?php if(!isset($row['details'])){echo '< no details >';}else{ echo $row['details'];} ?></p>
                           <small>Added by: <?php
                             $se_user="SELECT username FROM users WHERE id={$row['userid']}";

                             $reuser=mysqli_query($con,$se_user);
                             $rowu=mysqli_fetch_assoc($reuser);
                             echo $rowu['username']
                             ?></small>
                           <small><?php echo date("l,F,D,Y h:i a",strtotime($row['datecreated'])) ?></small>
                            <small><?php echo "Closes on ".date("l,F,D,Y h:i a",strtotime($row['closeon']))?></small>
                           <div class="cand">
                            <div class="radio">
                                <?php
                                 $opt="SELECT * FROM options WHERE pollid='$pid'";
                                 $reopt=mysqli_query($con,$opt);

                                 if(mysqli_num_rows($reopt)>0){
                                    while($rowop=mysqli_fetch_assoc($reopt)){
                                ?>
                                <div class="item">

                                    <input type="radio" name="poll<?php echo $pid ?>" value="<?php echo $rowop['id'] ?>"> <span><?php echo $rowop['optio'] ?></span>
                                </div>
                                <?php
                                 }
                                 }
                                 else{
                                    echo "No options found";
                                 }
                                ?>
                            </div>
                           </div>
                           <?php
                         }
                        }
                   }else{
                    header('location: index.html');
                   }
                   if(isset($_SESSION['vote'])){
                    echo $_SESSION['vote'];
                    unset($_SESSION['vote']);
                   }
                   if(isset($_SESSION['votes'])){
                    echo $_SESSION['votes'];
                    //unset($_SESSION['votes']);
                   }
                  
              ?>
              
              <button type="submit" name="submit">Vote</button>
              <a href="res.php?id=<?php echo $pid?>">View results</a>
              <form/>
        </div>
    </div>
                  
<?php
 
include('components/footer.php');

?>
        
       
    <script src="script.js"></script>
</body>
</html>