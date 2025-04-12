<?php

setcookie("name","victor",time()+3848484,'/');

if(isset($_COOKIE['hasvotedFor23'])){
    echo $_COOKIE['hasvotedFor23'];
}

?>