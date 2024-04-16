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

    <div class = "cssform2">
        <table style="font-size: 18px;">
            <thead>
                <tr>
                    <th>Form ID</th>
                </tr>
            </thead>
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
    
                // Fetch form IDs from the database before today's date
                $current_date = date("Y-m-d");
                $sql = "SELECT FormID FROM forms WHERE dateAvailable > '$current_date'";
                $result = $conn->query($sql);
    
                if ($result->num_rows > 0) {
                    // Output table rows for each form ID
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr><td>' . $row["FormID"] . '</td></tr>';
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