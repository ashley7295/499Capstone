<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .top-bar {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049;
        }
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="top-bar">
        Election selection section
        <a href="/499Capstone/html/upcomingForms.html" class="button">Upcoming</a>
        <a href="/499Capstone/html/currentforms.html" class="button">Current</a>
        <a href="/499Capstone/html/previousForms.html" class="button">Past Results</a>
        <a href="/499Capstone/php/logout.php" class="button">Logout</a>
      </div>


<div class="container">
    <!-- current available forms will display here -->
    
    <p>This is your dashboard content. You can add charts, tables, or any other relevant information here.</p>

    <form action="currentForms.php" method="get">
        <label for="form_id">Select Form ID:</label>
        <ul>
            <?php
            // Database connection parameters
            $servername = "localhost"; // Change if your MySQL server is on a different host
            $username = "root"; // Change to your MySQL username
            $password = ""; // Change to your MySQL password
            $database = "Voting";
    
            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);
    
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            // Fetch form IDs from the database
            $sql = "SELECT FormID FROM forms";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                // Output list items for each form ID
                while ($row = $result->fetch_assoc()) {
                    echo '<li><input type="radio" name="form_id" value="' . $row["FormID"] . '"> Form ' . $row["FormID"] . '</li>';
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

</div>