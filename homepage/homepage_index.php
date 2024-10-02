<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //temp code
    $_SESSION['userData']['user_type'] = 21;
    //temp code-

    // session_start();
    // if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
    // {
    //     header("Location: /login.php");
    //     exit();
    // }
    
    /*******************************************************************************************************/
    //CONNECTING TO THE DATABASE
    $QUIZ_server = "0.0.0.0";
    $QUIZ_port = 1202;
    $QUIZ_username = "root";
    $QUIZ_password = 'l';
    $QUIZ_databaseName = "quiz";
    $QUIZ_conn = new mysqli($QUIZ_server, $QUIZ_username, $QUIZ_password, $QUIZ_databaseName, $QUIZ_port);
    if ($QUIZ_conn->connect_error) {
        die("Connection failed: " . $QUIZ_conn->connect_error);
    }

    /*******************************************************************************************************/
    //FETCHING THE REQUIRED DATA FROM THE DATABASE
    $query = "SELECT * FROM quizzes WHERE active = 1 AND givers = ?";
    $statement = $QUIZ_conn->prepare($query);
    $statement->bind_param("i", $_SESSION['userData']['user_type']);
    $statement->execute();
    $result = $statement->get_result();

    /*******************************************************************************************************/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div>
        <p>Active quizzes</p>

        <form method="post" action="take_quiz.php">
        <?php
        if($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                echo "<button type=\"submit\" name=\"quiz_id_button\" value=\"{$row['quiz_id']}\">{$row['quiz_name']}</button>";
            }
        }
        else
        {
            echo "No acitve quizzes";
        }
        ?>    
        </form>

        
    </div>
    <div>
        <a href="quiz_history.php">View Past Quizzes</a>
    </div>
    <div>
        <a href="create_quiz.php">Create a Quiz</a>
    </div>
    <div>
        <a href="profile.php">View your profile</a>
    </div>
</body>
</html>