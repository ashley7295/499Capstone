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
        <div class="logo"> <a href="/499Capstone/php/dashboard.php"><img src="/499Capstone/JPG/logo.jpg"></a> </div>  
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

    <form class="cssform2" action="formPage.php" method="get">
        <header>
            <h1> Current Forms </h1>
        </header>

        <ul>
            
        <?php
// Start the session
session_start();

// Check if the user is logged in
if(isset($_SESSION['UserID'])) {
    $currentUserID = $_SESSION['UserID']; // Get the UserID of the logged-in user
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: /path/to/login.php");
    exit();
}

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

// SQL query to retrieve forms with the current date and voting status for the logged-in user
$sql = "SELECT Forms.FormID, Forms.Title, Forms.Description,
            IF(UserAnswers.UserID IS NULL, 0, 1) AS Voted
        FROM Forms
        LEFT JOIN UserAnswers ON Forms.FormID = UserAnswers.FormID
            AND UserAnswers.UserID = $currentUserID
        WHERE date(Forms.dateAvailable) = CURDATE()";

$result = $conn->query($sql);

// Track encountered form IDs
$encounteredFormIDs = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Check if the form ID has been encountered before
        if (!in_array($row['FormID'], $encounteredFormIDs)) {
            echo '</br>';
            echo '<div>';
            echo '<h3>' . $row['Title'] . '</h3>';
            echo '<p>' . $row['Description'] . '</p>';
            // Check if the user has voted for the form
            if ($row['Voted']) {
                echo '<FONT COLOR="#ff0000"><p>*You have already voted for this form*</p></FONT>';
                echo '</ul>';
            } else {
                echo '<input type="radio" name="form_id" value="' . $row["FormID"] . '"> Select "' . $row["Title"] . '".<br>';
            }
            echo '</div>';
            // Add the form ID to the encountered IDs list
            $encounteredFormIDs[] = $row['FormID'];
        }

    }
    echo '</br>';
    echo '</br>';
    echo '</ul>';
    echo '<input type="submit" value="Submit">'; 
} else {
    echo "0 results";
}
// Close the database connection
$conn->close();
?>
</form>
</body>
</html>
