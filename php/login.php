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
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a SQL query to check if the username exists
    $stmt = $conn->prepare("SELECT UserID, Password FROM users WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if username exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set the session variable
            $_SESSION['UserID'] = $user_id;

            // Update UserID in the database
            $update_sql = "UPDATE users SET UserID = ? WHERE Username = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("is", $user_id, $username);
            $update_stmt->execute();
            $update_stmt->close();

            // Redirect to dashboard
            header('Location: /499CAPSTONE/php/dashboard.php');
            exit;
        } else {
            // Login failed
            echo "Login failed. Please check your username and password.";
        }
    } else {
        // Username not found
        echo "Login failed. User not found.";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>