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
        <div class="words"><h1>Loach Votes</h1></div> 
        <div class="logo"> <a href="/499Capstone/php/dashboard.php"><img src="/499Capstone/JPG/logo.jpg" alt="Logo"></a> </div>  
        <a href="/499Capstone/php/upcomingForms.php" class="button">Upcoming Forms</a>
        <a href="/499Capstone/php/currentForms.php" class="button">Current Forms</a>
        <a href="/499Capstone/php/previousForms.php" class="button">Previous Forms</a>
        <div class="dropdown">
            <button class="dropbtn">My Account</button>
            <div class="dropdown-content">
              <a href="/499Capstone/php/logout.php">Logout</a>
            </div>
        </div>
    </div>

    <div class = "cssform2">
        <header>
            <h1> Upcoming Forms </h1>
        </header>
        <table style="font-size: 18px;">
            <tbody style="text-align: center;">
                <?php
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
    
                // Fetch form titles from the database with a date greater than today
                $current_date = date("Y-m-d");
                $sql = "SELECT Title, Description FROM forms WHERE dateAvailable > '$current_date'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output table rows for each form title
                    while ($row = $result->fetch_assoc()) {
                        echo '<h3>' . $row['Title'] . '</h3>';
                        echo '<p>' . $row['Description'] . '</p>';
                        echo '</ul>';
                        echo '</br>';
                    }
                } else {
                    echo '<tr><td colspan="1">No forms available after today\'s date</td></tr>';
                }
                    
                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

    </body>
    </html>    