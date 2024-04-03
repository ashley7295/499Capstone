<?php

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (!isset($_SESSION["UserID"])) {
        echo "User not logged in.";
        exit;
    }

    // Retrieve form ID and answers from the POST data
    $form_id = $_POST['form_id'];
    $answers = $_POST['answer']; // This will be an array with question ID as key and selected answer ID as value

    // Get the UserID of the current user from the session
    $user_id = $_SESSION["UserID"];

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

    // Insert user answers into UserAnswers table
    foreach ($answers as $question_id => $answer_id) {
        // Prepare and bind SQL statement
        $sql = "INSERT INTO UserAnswers (UserID, FormID, QuestionID, AnswerID) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $user_id, $form_id, $question_id, $answer_id);

        // Execute the statement
        if ($stmt->execute() !== TRUE) {
            echo "Error inserting user answer: " . $stmt->error;
        }
    }

    echo "Answers submitted successfully.";
    header('Location: /499CAPSTONE/php/dashboard.php');

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
