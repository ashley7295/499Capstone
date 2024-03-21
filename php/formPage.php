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
        <a href="/499Capstone/html/upcomingForms.html" class="button">Upcoming</a>
        <a href="/499Capstone/php/currentForms.php" class="button">Current</a>
        <a href="/499Capstone/html/previousForms.html" class="button">Past Results</a>
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
                echo "<h2>{$row['Title']}</h2>";
                echo "<p>{$row['Description']}</p>";

                // Fetch questions with associated answer options for the selected form
                $sql_questions = "SELECT q.QuestionID, q.QuestionText, a.AnswerID, a.AnswerOption 
                                  FROM Questions q 
                                  LEFT JOIN Answers a ON q.QuestionID = a.QuestionID AND a.FormID = $form_id";
                $result_questions = $conn->query($sql_questions);

                if ($result_questions->num_rows > 0) {
                    echo "<form action='submitAnswers.php' method='post'>";
                    // Output questions and answer options
                    while ($row_question = $result_questions->fetch_assoc()) {
                        echo "<h3>{$row_question['QuestionText']}</h3>";
                        if ($row_question['AnswerID'] !== null) {
                            echo "<input type='radio' name='answer[{$row_question['QuestionID']}]' value='{$row_question['AnswerID']}' required>{$row_question['AnswerOption']}<br>";
                        } else {
                            echo "<p>No answer options available.</p>";
                        }
                    }
                    echo "<input type='hidden' name='form_id' value='$form_id'>";
                    echo "<input type='submit' value='Submit Answers'>";
                    echo "</form>";
                } else {
                    echo "<p>No questions found for this form.</p>";
                }
            } else {
                echo "<p>No form found for the selected ID.</p>";
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "<p>Please select a form.</p>";
        }
        ?>
    </div>

</body>
</html>
