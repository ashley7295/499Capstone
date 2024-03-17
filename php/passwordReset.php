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
    // Get username and passwords from the user
    $username = $_POST['username'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $oldPasswordHash = password_hash($oldPassword, PASSWORD_BCRYPT);

    // Prepare a SQL query to check if the username and passwordHash match
    $sql = "SELECT * FROM Users WHERE Username = '$username' AND Password = '$oldPassword'";
    $result = $conn->query($sql);

    // Check if any row is returned
    if ($result->num_rows > 0) {
        // If we have a username and password that match, we update the password 
        // $result -> free_result();
        $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
        $sql = "UPDATE Users SET Password = '$newPassword' WHERE Username = $username;";
        $conn->query($sql);
        echo "Password Changed Succesful!";
		header('Location: /499CAPSTONE/html/login.html');
		exit;
    } else {
        // Login failed
        echo "Password Change failed. Check username or Oldpassword";
        header('Location: /499CAPSTONE/html/passwordReset.html');
    }
}

// Close the database connection
$conn->close();
exit;
?>
