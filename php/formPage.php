<!DOCTYPE html>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Form page</title>
  </head>

  <body>
    <fieldset>
      <legend>Form</legend>
      <form name="frmContact" method="post" action="formPage.php">
        <p>
          Some information pulled from database to get question from form id
        </p>
  
        <!-- Add some code in here that will populate shit from sql query into             the>se variables and give questions and answers. (Thinking of using .php 
        file and incorporating html into the file so its more fluid I believe) -->
        <input type="radio" id="radio1" name="fav_language" value="HTML">
        <label for="radio1">HTML</label><br>
        <input type="radio" id="radio2" name="fav_language" value="CSS">
        <label for="radio2">CSS</label><br>
        <input type="radio" id="radio3" name="fav_language" value="JavaScript">
        <label for="radio3">JavaScript</label>
        
        <p>
          <input type="submit" name="Submit" id="Submit" value="Submit">
        </p>
      </form>
    </fieldset>
  </body>

</html>
