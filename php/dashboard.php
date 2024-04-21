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
    <div class = "logo"> <a href = "/499Capstone/php/dashboard.php"><img src="/499Capstone/JPG/logo.jpg" alt="Logo"></a> </div>  
    <a href="/499Capstone/php/upcomingForms.php" class="button">Upcoming</a>
    <a href="/499Capstone/php/currentForms.php" class="button">Current</a>
    <a href="/499Capstone/php/previousForms.php" class="button">Past Results</a>
    <div class="dropdown">
    <button class="dropbtn">
            <?php 
            
            if(isset($_SESSION['Username'])) {
                $currentUsername = $_SESSION['Username']; // Get the UserID of the logged-in user
                echo "Hello, " . $currentUsername;
            } else {
                echo "My Account";
            }
            ?>
            </button>
            <div class="dropdown-content">
              <a href="/499Capstone/php/logout.php">Logout</a>
        </div>
    </div>
    </div>


<div class="container">
    <!-- dashboard intro -->
    <div class = "words"><h1>Welcome to the Dashboard</h1>
    <p>To Begin, please click on the following. Rest assured that your privacy is protected. </p>
    </div>
</div>

    <!-- button for upcoming forms -->
    <a href= "/499Capstone/php/upcomingForms.php">
        <div class="dashboard"> View Upcoming Forms<div class = "dash">
            <img src="/499Capstone/JPG/upcoming.jpg" alt="Find Logo">
        </div>
        </div>
    </a>


    <!-- button for current forms -->
    <a href= "/499Capstone/php/currentForms.php">
        <div class="dashboard"> View Current Forms<div class = "dash">
            <img src="/499Capstone/JPG/currentForms.jpg" alt="Find Logo">
        </div>
        </div>
    </a>


    <!-- button for previous forms -->
    <a href= "/499Capstone/php/previousForms.php">
        <div class="dashboard"> View Previous Forms<div class = "dash">
            <img src="/499Capstone/JPG/previousForms.jpg" alt="Find Logo">
        </div>
        </div>
    </a>

</body>
</html>


