<?php
// Retrieve the form ID from the URL parameter
if (isset($_GET['form_id'])) {
    $id = $_GET['form_id'];
} 

$servername = "localhost";
$username = "root";
$password = "";
$database = "Voting";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the answer is selected
    if(isset($_POST['answer'])) {
        // Get the selected answer ID
        $selected_answer_id = $_POST['answer'];

        // Prepare and execute the update query
        $update_sql = "UPDATE user_answers SET AnswerID = ? WHERE FormID = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $selected_answer_id, $id);
        
        if ($update_stmt->execute()) {
            echo '<script>alert("Answer updated successfully.");</script>';
            echo '<script>window.location.href = "dashboard.html";</script>';
        } else {
            echo "Error updating answer: " . $conn->error;
        }

        $update_stmt->close();
    } else {
        echo '<script>alert("Please select an answer.");</script>';
    }
}

$sql = "SELECT QuestionID, QuestionText FROM questions WHERE FormID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . $row["QuestionText"] . "</p>";
    }
} else {
    echo "No questions found for FormID: " . $id;
}

$stmt->close();

$sql2 = "SELECT  AnswerOption, AnswerID FROM answers WHERE FormID = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $id);
$stmt2->execute();
$result2 = $stmt2->get_result();

if ($result2->num_rows > 0) {
    echo "<form id='answerForm' method='post' onsubmit='return confirmSubmission();'>"; // Added the form opening tag here with method='post' and onsubmit attribute
    while ($row2 = $result2->fetch_assoc()) {
        echo '<input type="radio" name="answer" value="' . $row2["AnswerID"] . '">' . $row2["AnswerOption"] . '<br>';
    }
    echo '<input type="submit" value="Submit Answer">'; // Added a submit button
    echo "</form>";
} else {
    echo "No answers found for FormID: " . $id;
}

$stmt2->close();
$conn->close();
?>

<script>
function confirmSubmission() {
    var answer = document.querySelector('input[name="answer"]:checked');
    if (!answer) {
        alert("Please select an answer.");
        return false;
    }
    return confirm("Are you sure you want your answer to be: " + answer.nextElementSibling.textContent.trim() + "?");
}
</script>
