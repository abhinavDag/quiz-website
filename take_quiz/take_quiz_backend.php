<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*******************************************************************************************************/
//CONNECTING TO THE QUIZ DATABASE
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
//UPDATING THE DATABASE WITH ALL THE RESPONSES
$query = "INSERT INTO responses (question_id, user_id, response) VALUES (?,?,?)";
$statement = $QUIZ_conn->prepare($query);

foreach($_SESSION['questionIds'] as $questionId)
{
    $statement->bind_param('iii', $questionId, $_SESSION['userData']['user_id'], $_POST["resp_to_$questionId"]);
    $statement->execute();
}
$statement->close();

/*******************************************************************************************************/
//HEADING TO THE HOMEPAGE

header("Location: /homepage.php");


?>