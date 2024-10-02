<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // session_start();
    // if($_SESSION['userData']['user_type'] !== 1)
    // {
    //     header("Location: /homepage.php");
    //     exit();
    // }
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

    //FETCHING THE REQUIRED DATA
    $courseQuery = "SELECT * FROM courses";
    $courseResult = $QUIZ_conn->query($courseQuery);
    $giversQuery = "SELECT * FROM userTypes WHERE user_type>=20";
    $giversResult = $QUIZ_conn->query($giversQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a quiz</title>
</head>
<body>
    <div>
        <form name="create_quiz_form" action="create_quiz.php" method="post">
            
            <input type="text" name="quiz_name" id="quiz_name" placeholder="Enter the name of the quiz">
            
            <select name="course" id="course">
                <?php
                if($courseResult->num_rows > 0)
                {
                    while($row = $courseResult->fetch_assoc()) {
                        echo "<option value='" . $row['course_id'] . "'>" . $row['course_code'] . "</option>";
                    }
                }
                else
                {
                    echo "<option value=''>No options available</option>";
                }
                ?>
            </select>
            
            <select name="givers" id="givers">
                <?php
                if($giversResult->num_rows > 0)
                {
                    while($row = $giversResult->fetch_assoc())
                    {
                        echo "<option value='" . $row['user_type'] . "'>" . $row['description'] . "</option>";
                    }
                }
                else
                {
                    echo "<option value=''>No options available</option>";
                }
                ?>
            </select>
            
            <input type="submit" value="Create">
        
        </form>

    </div>
</body>
</html>