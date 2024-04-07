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
            <button class="dropbtn">My Account</button>
            <div class="dropdown-content">
              <a href="/499Capstone/php/logout.php">Logout</a>
            
            </div>
        </div>
        </div>
        </body>
</html>

    <form class = "cssform2" action="formPage.php" method="get">
        <label for="form_id">Select Form:</label>
        <ul>
            <?php

            // Start the session
            session_start();
            
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "Voting";
    
            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);
    
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            // Fetch form IDs from the database
            $sql = "SELECT FormID, dateAvailable FROM Forms WHERE DATE(dateAvailable) = CURDATE();";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                // Output list items for each form ID
                while ($row = $result->fetch_assoc()) {
                    echo '<input type="radio" name="form_id" value="' . $row["FormID"] . '"> Form ' . $row["FormID"] . '<br>';
                }
            } else {
                echo '<li>No forms available</li>';
            }
    
            // Close the database connection
            $conn->close();
            ?>
        </ul>
        <input type="submit" value="Submit">
    </form>