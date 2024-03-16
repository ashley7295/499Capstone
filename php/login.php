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
    $hash = password_hash($password, PASSWORD_BCRYPT);

    // Prepare a SQL query to check if the username and password match
    // WE NEED TO MAKE ALL PASSWORDS USE HASH SINCE WE DONT HAVE ANY SIGNUP PAGE. 
    $sql = "SELECT * FROM Users WHERE Username = '$username' AND Password = '$password'";
    $result = $conn->query($sql);

    // Check if any row is returned
    if ($result->num_rows > 0) {
        // The username and password are correct, so set the session variable and redirect to the home page
		$_SESSION['username'] = $username;
		header('Location: /499CAPSTONE/html/availableForms.html');
		exit;
    } else {
        // Login failed
        echo "Login failed. Please check your username and password.";
    }
}

// Close the database connection
$conn->close();
exit;
?>
