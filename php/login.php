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

// Start a session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    // Prepare a SQL query to check if the username and password match
    // WE NEED TO MAKE ALL PASSWORDS USE HASH SINCE WE DONT HAVE ANY SIGNUP PAGE. 
    $sql = "SELECT * FROM users WHERE Username = '$username'";
    $result = $conn->query($sql);

    // Runs through results
    foreach($result as $r) {
        // Using php function, we verify the hash that is on the DB
        $pass_check = password_verify($password, $r['Password']);

        // If the password verify is true we login
        if($pass_check) {
		    $_SESSION['username'] = $username;
		    header('Location: /499CAPSTONE/html/dashboard.html');
		    exit;
        } else {
            // Login failed
            ?>
            <html>
                Login failed. Please check your username and password.
                <br>
                <a href="login.php">Click Here</a> to return back to Login page
            </html>
            <?php
        }
    }
}

// Close the database connection
$conn->close();
exit;
?>