<?php


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
   <div class="main">
    <h3 class="res">
        Update poll
    </h3>

    <form action="" method="post" class="update">
        <div class="form-element">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="">
        </div>
        <div class="opt-update">
             <div class="form-element">
                <label for="upt-opt">Option</label>
                <input type="text" name="option" id="upt-opt" value="">
             </div>
        </div>
        
        <button type="submit" name="update">Update</button>
    </form>
   </div>
   
   <script src="script.js"></script>
   <script src="new.js"></script>
</body>

</html> 