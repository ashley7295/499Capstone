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

    $row = $result->fetch_assoc();

    if ($row) {
        // Verify the password
        $pass_check = password_verify($password, $row['Password']);
    
        // If the password verification is true, proceed with login
        if ($pass_check) {

        $user_id = $row['UserID'];


        // Set the session variable
        $_SESSION['UserID'] = $user_id;
        
        // Update UserID in the database
        $update_sql = "UPDATE users SET UserID = ? WHERE Username = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("is", $user_id, $username);
        $update_stmt->execute();
        $update_stmt->close();
          
          
		    header('Location: /499CAPSTONE/php/dashboard.php');
		    exit;
        } else {
            // Login failed
            ?>
            <html>
                Login failed. Please check your username and password.
                <br>
                <a href="/499CAPSTONE/html/login.html">Click Here</a> to return back to Login page
            </html>
            <?php
        }

    }
}

// Close the database connection
$conn->close();
exit;
?>