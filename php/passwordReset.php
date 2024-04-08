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

// Start a session
session_start();



// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get username and passwords from the user
    $username = $_POST['username'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    // Prepare a SQL query to check if the username and passwordHash match
    $sql = "SELECT * FROM users WHERE Username = '$username'";
    $result = $conn->query($sql);

    // Runs through results 
    foreach($result as $r) {
        // Using php function, we verify the hash that is on the DB
        $old_pass_check = password_verify($oldPassword, $r['Password']);

        // If the password verify is true
        if($old_pass_check) {
            // Create new hash with new password and store into DB under that username
            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET Password = '$newPasswordHash' WHERE Username = '$username'";
            $conn->query($sql);
            echo "Password Changed Succesful!";
            header('Location: /499CAPSTONE/html/login.html');
            exit;
        } else {
            // Login failed
            echo "Password Change failed. Check username or password";
            header('Location: /499CAPSTONE/html/passwordReset.html');
        }
    }
}

// Close the database connection
$conn->close();
exit;
?>
