<?php

// Start a session
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/499Capstone/html/Pretty.css">
       
</head>
<body>


<div class="top-bar">
    <div class = "words"><h1>Loach Votes</h1></div> 
    <div class = "logo"> <a href = "/499Capstone/php/dashboard.php"><img src="/499Capstone/JPG/empty.jpg" alt="Find Logo"></a> </div>  
    <a href="/499Capstone/php/upcomingForms.php" class="button">Upcoming</a>
    <a href="/499Capstone/php/currentForms.php" class="button">Current</a>
    <a href="/499Capstone/php/previousForms.php" class="button">Past Results</a>
    <div class="dropdown">
        <button class="dropbtn">My Account</button>
        <div class="dropdown-content">
          <a href="/499Capstone/php/logout.php">Logout</a>
        
        </div>
    </div>
    </div>


<div class="container">
    <!-- Your dashboard content goes here -->
    <div class = "words"><h1>Welcome to the Dashboard</h1>
    <p>To Begin, please click on the following. Rest assured that your privacy is protected. </p>
    </div>
</div>

<a ref="/499Capstone/php/upcomingForms.php"></a>
<div class = "dashboard">
    <br><div class = "words">View Upcoming Forms</div></br>
    <div class = "dash"><img src="/499Capstone/JPG/upcoming.jpg" alt="Find Logo"></div>
</div>
</a>


<div class = "dashboard">
    <br><div class = "words">Current Forms</div></br>
    <div class = "dash"><img src="/499Capstone/JPG/currentForms.jpg" alt="Find Logo"></div>
 </div>

 <div class = "dashboard">
    <br><div class = "words">Past Results</div></br>
    <div class = "dash"><img src="/499Capstone/JPG/previousforms.jpg" alt="Find Logo"></div>
 </div>

</body>
</html>


