<?php
// Start a session
session_start();

// Check if the form has been submitted
if (isset($_POST['submit'])) {

	// Get the username and password from the form data
	$username = $_POST['username'];
	$password = $_POST['password'];

     // Create a new database connection
     $db = mysqli_connect('127.0.0.1', 'root', '', 'root');

     //db query to search for the inputted username and password
     $checkquery = "SELECT * FROM Users WHERE username ='$username' AND password ='$password'";
     $result = $db->query($checkquery); 

    echo $username;

	// Validate the username and password
	if ($result->num_rows > 0) {
		// The username and password are correct, so set the session variable and redirect to the home page
		$_SESSION['username'] = $username;
		header('Location: availableForms.html');
		exit;
	} else {
        echo '<script>alert("No User Found")</script>';
		// The username and password are incorrect, so show an error message
		$error = 'Invalid username or password';
	} 
    $db->close();
    exit;

}