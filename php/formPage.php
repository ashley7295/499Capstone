<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Details</title>
    <link rel="stylesheet" href="/499Capstone/html/Pretty.css">
</head>
<body>
    <div class="top-bar">
        <div class="words"><h1>Loach Votes</h1></div> 
        <div class="logo"> <a href="/499Capstone/html/dashboard.html"><img src="/499Capstone/JPG/empty_rec.jpg" alt="Find Logo"></a> </div>  
        <a href="/499Capstone/php/upcomingForms.php" class="button">Upcoming</a>
        <a href="/499Capstone/php/currentForms.php" class="button">Current</a>
        <a href="/499Capstone/php/previousForms.php" class="button">Past Results</a>
        <div class="dropdown">
            <button class="dropbtn">My Account</button>
            <div class="dropdown-content">
                <a href="/499Capstone/php/logout.php">Logout</a>
            </div>
        </div>
    </div>

    <div class="container">
        <?php

        if(isset($_GET['form_id'])) {
            $form_id = $_GET['form_id'];
            
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

            // Fetch form details from the database
            $sql = "SELECT Title, Description FROM Forms WHERE FormID = $form_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output form details
                $row = $result->fetch_assoc();
            
                // Initialize an array to store questions and their associated answer options
                $questions_with_answers = array();

                // Fetch questions with associated answer options for the selected form
                $sql_questions = "SELECT q.QuestionID, q.QuestionText, a.AnswerID, a.AnswerOption 
                                FROM Questions q 
                                LEFT JOIN Answers a ON q.QuestionID = a.QuestionID 
                                WHERE a.FormID = $form_id";
                $result_questions = $conn->query($sql_questions);

                // Group questions with their associated answer options
                while ($row_question = $result_questions->fetch_assoc()) {
                    // Check if the question already exists in the array
                    if (!isset($questions_with_answers[$row_question['QuestionID']])) {
                        // If not, initialize an array to store answer options for this question
                        $questions_with_answers[$row_question['QuestionID']] = array(
                            'QuestionText' => $row_question['QuestionText'],
                            'AnswerOptions' => array()
                        );
                    }
                    // Add the answer option to the array under the corresponding question
                    if ($row_question['AnswerID'] !== null) {
                        $questions_with_answers[$row_question['QuestionID']]['AnswerOptions'][] = array(
                            'AnswerID' => $row_question['AnswerID'],
                            'AnswerOption' => $row_question['AnswerOption']
                        );
                    }
                }

                // Output questions and answer options
                foreach ($questions_with_answers as $question_id => $question_data) {
                    echo "<h3>{$question_data['QuestionText']}</h3>";
                    foreach ($question_data['AnswerOptions'] as $answer_option) {
                        echo "<input type='radio' name='answer[$question_id]' value='{$answer_option['AnswerID']}' required>{$answer_option['AnswerOption']}<br>";
                    }
                }

                // Add form ID as hidden input
                echo "<input type='hidden' name='form_id' value='$form_id'>";

                // Add submit button
                echo "<input type='submit' value='Submit Answers'>";

                // Close the form
                echo "</form>";




            }}

