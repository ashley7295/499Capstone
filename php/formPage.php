<!DOCTYPE html>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Form page</title>
  </head>

  <body>
    <fieldset>
      <legend>Form</legend>
      <form name="frmContact" method="post" >
        <p>
          Some information pulled from database to get question from form id
        </p>
  
        <!-- Add some code in here that will populate shit from sql query into             the>se variables and give questions and answers. (Thinking of using .php 
        file and incorporating html into the file so its more fluid I believe) -->
        <!-- <input type="radio" id="radio1" name="fav_language" value="HTML">
        <label for="radio1">HTML</label><br>
        <input type="radio" id="radio2" name="fav_language" value="CSS">
        <label for="radio2">CSS</label><br>
        <input type="radio" id="radio3" name="fav_language" value="JavaScript">
        <label for="radio3">JavaScript</label>
         -->

         <?php
         //<a href="form.php?id=1">Open Form</a> Use this if you want a link to display the form 
         //The link will also give us a form id which we need to hard code I believe
          //$id = $_GET['id'];
          $id = 1;
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
          
          // Prepare and execute SQL query to fetch data based on the ID
          $sql = "SELECT QuestionID, QuestionText FROM questions WHERE FormID = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("i", $id);
          $stmt->execute();
          $result = $stmt->get_result();

          // Check if any row is returned
        if ($result->num_rows > 0) {
          // Output data of each row
          while($row = $result->fetch_assoc()) {
            echo "<p>" . $row["QuestionText"] . "</p>";
          }
        } else {
            echo "No item found with ID: " . $id;
          }

        $stmt->close();
        
        //Displays answers
        $sql2 = "SELECT  AnswerOption, AnswerID FROM answers WHERE FormID = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

          // Check if any row is returned
          if ($result2->num_rows > 0) {
            // Output radio buttons for each answer option
            echo "<form>";
            while ($row2 = $result2->fetch_assoc()) {
                echo '<input type="radio" name="answer" value="' . $row2["AnswerID"] . '">' . $row2["AnswerOption"] . '<br>';
            }
            echo "</form>";
        } else {
            echo "No answers found for FormID: " . $id;
        }
          
         

          // Close the database connection
          $stmt2->close();
          $conn->close();
          exit;
          ?>

        <p>
          <input type="submit" name="Submit" id="Submit" value="Submit">
        </p>
      </form>
    </fieldset>
  </body>

</html>
