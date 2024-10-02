<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//GATHERING USER SUBMITTED INFO
$ldap_id = htmlspecialchars($_POST['ldap_id']);
$password = htmlspecialchars($_POST['password']);

/*******************************************************************************************************/
//CHECKING IF THE GIVEN USER EXISTS IN OUR DATABASE
$QUIZ_server = "0.0.0.0";
$QUIZ_port = 1202;
$QUIZ_username = "root";
$QUIZ_password = "l";
$QUIZ_databaseName = "quiz";
$QUIZ_conn = new mysqli($QUIZ_server, $QUIZ_username, $QUIZ_password, $QUIZ_databaseName, $QUIZ_port);
if ($QUIZ_conn->connect_error) {
    die("Connection failed: " . $QUIZ_conn->connect_error);
}

$query = "SELECT * FROM users WHERE ldap_id = ?";
$statement = $QUIZ_conn->prepare($query);
$statement->bind_param("s", $ldap_id);
$statement->execute();
$result = $statement->get_result();

if ($result->num_rows == 0)
{
    echo "<h1>You are not registered with us. Please sign up.</h1>";
    die();
}
else
{
    $userData = $result->fetch_assoc();
    $passHash = hash('sha256', $password);
    if($passHash == $userData['pass_hash'])
    {
       $login_successful = true; 
    }
    else
    {
        $login_successful = false;
        die("The entered password is incorrect, please contact with the SysAds to reset your password.");
    }

}
//closing connection and freeing result
$result->free();
$statement->close();
$QUIZ_conn->close();

/*******************************************************************************************************/
//STARTING THE SESSION PROVIDED THE LDAP ID AND PASSWORD ARE VALID
session_start();
if($login_successful)
{
    $_SESSION['loggedin'] = true;
    $_SESSION['userData'] = $userData;
    header("Location: /homepage.php");
    exit();
}
?>