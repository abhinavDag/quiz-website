<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//GATHERING USER SUBMITTED INFO
$quizName = htmlspecialchars($_POST['quiz_name']);
$course = htmlspecialchars($_POST['course']);
$givers = htmlspecialchars($_POST['givers']);
$active = 1;

/*******************************************************************************************************/
//CREATING THE CONNECTION WITH THE QUIZ DATABASE
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
//EXECUTING A QUERY TO ADD THE QUIZ TO THE quizzes TABLE
$query = "INSERT INTO quizzes (conductor, givers, course_id, quiz_name, active) VALUES (?,?,?,?,?)";
$statement = $QUIZ_conn->prepare($query);
$statement->bind_param("iiisi", $_SESSION['userData']['user_id'], $givers, $course, $quizName, $active);

if($statement->execute())
{
    $_SESSION['quizName'] = $quizName;
    $_SESSION['course'] = $course;
    $_SESSION['givers'] = $givers;
    
    $query = "SELECT quiz_id FROM quizzes WHERE quiz_name = ? ORDER BY created DESC LIMIT 1";
    $statement = $QUIZ_conn->prepare($query); 
    $statement->bind_param("s", $quizName);
    
    $statement->execute();
    $result = $statement->get_result();    
    
    if ($row = $result->fetch_assoc())
    {
        $_SESSION['quizId'] = $row['quiz_id'];
    }
    
    header('Location: add_questions.php');
    exit();
}
else
{
    echo "There seems to be an error:" . $statement->error;
}

?>