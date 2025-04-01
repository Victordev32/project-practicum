
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
 include('components/menu.php')
?>
<div class="main">

<h1 class="res">Results</h1>
<div class="vote-cont">
    <div class="results">
   
    <h3>77</h3>
    <p>poll description</p><br>
    <h3>vote per candidates</h3>
    <div class="votes">
          <div class="candidate">
            <p>Candidate</p>
            <p>0</p>
          </div>
          <div class="candidate">
            <p>Candidate</p>
            <p>0</p>
          </div>
          <div class="candidate">
            <p>Candidate</p>
            <p>0</p>
          </div>
          <div class="candidate">
            <p>Candidate</p>
            <p>0</p>
          </div>
       </div>
    </div>
    </div>
</div>
<?php
 include('components/footer.php');
?>
<script src="script.js"></script>
</body>
</html>