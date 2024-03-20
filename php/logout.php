<?php
// Start session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page

header("Location: /499Capstone/html/login.html");

exit;
?>
