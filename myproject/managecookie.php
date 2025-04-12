<?php
session_start();
include("constants/connect.php")


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage preferences || Wiser</title>
    <link rel="stylesheet" href="poll.css" type="text/css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   <?php
   include('./components/header.php')
   ?>
  <div class="main">
    <h2 class="res">Account prefference</h2>
    <br>
<p class="res"><b>Select your cookie prefference </b></p><br>
<div class="pref">
    <div class="pre">
        <span>Accept all essential cookies</span>
        <input type="checkbox" name="cookie" id="cookie">
    </div>
    <div class="pre">
        <span>Accept performance  cookies</span>
        <input type="checkbox" name="pcookie" id="pcookie">
    </div>
    <div class="pre">
        <span>Accept third party cookies</span>
        <input type="checkbox" name="tcookie" id="tcookie">
    </div>
    <button id="apply">Apply</button>
    <p>Read cookie policy here.<a href="">Cookie policy</a></p>
</div>

  </div>
   
    <?php
   include('./components/footer.php')
   ?>
   <script src="script.js"></script>
   <script src="cookie.js"></script>
</body>
</html>