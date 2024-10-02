<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*******************************************************************************************************/
//GATHERING THE QUIZ PAPER DATA
$problems = [];
$options = array(array());
$tempOptions = [];
$correct = [];
$marks = [];

$iterator = 1;

while($iterator < 100)
{
    //ADDING THE PROBLEM TO THE ARRAY
    if(isset($_POST["problem_$iterator"]))
    {
        $problems[$iterator] = $_POST["problem_$iterator"]; 
    }
    else
    {
        $iterator+=1;
        continue;
    }
    
    //ADDING THE OPTIONS
    if(isset($_POST["option_1_$iterator"]))
    {
        $tempOptions[] = $_POST["option_1_$iterator"];
    }
    if(isset($_POST["option_2_$iterator"]))
    {
        $tempOptions[] = $_POST["option_2_$iterator"];
    }
    if(isset($_POST["option_3_$iterator"]))
    {
        $tempOptions[] = $_POST["option_3_$iterator"];
    }
    if(isset($_POST["option_4_$iterator"]))
    {
        $tempOptions[] = $_POST["option_4_$iterator"];
    }
    $options[$iterator] = $tempOptions;
    $tempOptions = [];
    
    //ADDING THE CORRECTS AS INTs INTO THE ARRAY
    if(isset($_POST["correct_$iterator"]))
    {
        $parts = explode('_', $_POST["correct_$iterator"]);
        $correct[$iterator] = (int)$parts[1];
    }
    
    //ADDING THE MARKS INTO ITS ARRAY
    if(isset($_POST["marks_$iterator"]))
    {
        $marks[$iterator] = $_POST["marks_$iterator"];
    }
    $iterator+=1;
}


/*******************************************************************************************************/
//CONNECTING WITH THE DATABASE
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
//ADDING THE DATA TO THE DATABASE
$query = "INSERT INTO questions 
        (quiz_id, problem, option_1, option_2,option_3, option_4, correct, marks) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$statement = $QUIZ_conn->prepare($query);

$i=1;
while($i<100)
{
    if( !empty($problems[$i]) )
    {
        $statement->bind_param("isssssid",
            $_SESSION['quizId'], 
            $problems[$i], 
            $options[$i][0],
            $options[$i][1],
            $options[$i][2],
            $options[$i][3],
            $correct[$i],
            $marks[$i]
        );
        $statement->execute();
    }
    $i+=1;
}

echo "<p>The questions have been added succesfully</p>";

/*******************************************************************************************************/
//CLOSING THE CONNECTION
$statement->close();
$QUIZ_conn->close();

/*******************************************************************************************************/
//REDIRECTING TO HOMEPAGE
header("Location: /homepage.php");

?>