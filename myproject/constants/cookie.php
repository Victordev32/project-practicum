<?php
$randno=rand(1,6000);

$username="user{$randno}";

if(isset($_COOKIE['username'])){
   $user=$_COOKIE['username'];

}
else{
    $ck=setcookie('username',$username,time()+(864000*30),'/');
    if($ck){
        $_SESSION['cookie']='Success';
    }
}



?>