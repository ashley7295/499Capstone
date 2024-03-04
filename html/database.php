<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to check if the username and password exist in the database
$sql = "SELECT * FROM Users WHERE Username='$username' AND Password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // User authenticated successfully
  echo "Login successful";
} else {
  // Invalid username or password
  echo "Invalid username or password";
}

$conn->close();?>
