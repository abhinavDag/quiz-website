<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

//tempcode
$quizId = 3;

/*******************************************************************************************************/
//CONNECTING TO THE DATABASE
$QUIZ_server = "0.0.0.0";
$QUIZ_port = 1202;
$QUIZ_username = "root";
$QUIZ_password = "l";
$QUIZ_databaseName = "quiz";
$QUIZ_conn = new mysqli($QUIZ_server, $QUIZ_username, $QUIZ_password, $QUIZ_databaseName, $QUIZ_port);
if ($QUIZ_conn->connect_error) {
    die("Connection failed: " . $QUIZ_conn->connect_error);
}

/*******************************************************************************************************/
//GATHERING THE QUIZ ID
//$quizId = $_POST['quiz_id_button'];

/*******************************************************************************************************/
//GATHERING THE DATA RRELATED TO EACH QUESTION WITH THE QUIZ ID
$query = "SELECT
        question_id,
        quiz_id,
        problem,
        option_1,
        option_2,
        option_3,
        option_4,
        marks
        FROM questions WHERE quiz_id = ?";
$statement = $QUIZ_conn->prepare($query);
$statement->bind_param("i", $quizId);
$statement->execute();
$result = $statement->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz</title>
</head>
<body>
    
    <form action="response_sender.php" method="post">
            
            <?php
            //HERE I AM CREATING A SESSION VARIABLE OF QUESTION IDS SO THAT 
            //I CAN USE IT WHILE SENDING THE DATA TO THE DATABASE
            $_SESSION['questionIds']= [];
            foreach($result as $row)
            {
                $_SESSION['questionIds'][] = $row['question_id'];
                echo "<legend>{$row['problem']}</legend>";
                
                echo "<label><input type=\"radio\" name=\"resp_to_{$row['question_id']}\" value=\"1\">{$row['option_1']}</label>";
                echo "<label><input type=\"radio\" name=\"resp_to_{$row['question_id']}\" value=\"2\">{$row['option_2']}</label>";
                echo "<label><input type=\"radio\" name=\"resp_to_{$row['question_id']}\" value=\"3\">{$row['option_3']}</label>";
                echo "<label><input type=\"radio\" name=\"resp_to_{$row['question_id']}\" value=\"4\">{$row['option_4']}</label>";
            }
            ?>
        </fieldset>
        <input id="quizSubmitButton" type="submit" value="Submit">
    </form>
    

</body>
</html>