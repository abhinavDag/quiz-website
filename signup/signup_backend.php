<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//GATHERING USER SUBMITTED INFO
$ldap_id = htmlspecialchars($_POST['ldap_id']);
$set_password = htmlspecialchars($_POST['set_password']);
$confirm_password = htmlspecialchars($_POST['confirm_password']);

/*******************************************************************************************************/
//CHECKING IF THE GIVEN LDAP ID EXISTS IN OUR DATABASE
$LDAP_server = "0.0.0.0";
$LDAP_port = 1202;
$LDAP_username = "root";
$LDAP_password = "l";
$LDAP_databaseName = "ldap";
$LDAP_conn = new mysqli($LDAP_server, $LDAP_username, $LDAP_password, $LDAP_databaseName, $LDAP_port);
if ($LDAP_conn->connect_error) {
    die("Connection failed: " . $LDAP_conn->connect_error);
}

$sql = "SELECT * FROM ldap_table WHERE ldap_id = ?";
$statement = $LDAP_conn->prepare($sql);
$statement->bind_param("s", $ldap_id);
$statement->execute();
$result = $statement->get_result();

if ($result->num_rows == 0)
{
    echo "<h1>The entered LDAP ID does not exist.</h1>";
    die();
}
//closing connection and freeing result
$result->free();
$statement->close();
$LDAP_conn->close();
/**********************************************************************************************************/
//DETERMINING TYPE OF USER AND HASHING THE GIVEN PASSWORD

if((int)$ldap_id == 0){$userType = 2;}
else{$userType = 1;}

$passHash = hash('sha256', $set_password);

/***********************************************************************************************************/
//STORING THE SUBMITTED DATA IN OUR WEBSITE'S OWN DATABASE
$QUIZ_server = "0.0.0.0";
$QUIZ_port = 1202;
$QUIZ_username = "root";
$QUIZ_password = "l";
$QUIZ_databaseName = "quiz";
$QUIZ_conn = new mysqli($QUIZ_server, $QUIZ_username, $QUIZ_password, $QUIZ_databaseName, $QUIZ_port);
if ($QUIZ_conn->connect_error) {
    die("Connection failed: " . $QUIZ_conn->connect_error);
}

$statement=$QUIZ_conn->prepare("INSERT INTO users (ldap_id, user_type, pass_hash) VALUES (?,?,?)");
$statement->bind_param("sis", $ldap_id, $user_type, $pass_hash);

$user_type = $userType;
$pass_hash = $passHash;
if($statement->execute())
{
    echo "You have been signed up successfully!";
}
else
{
    echo "There seems to be an error:" . $statement->error;
}

$statement->close();
$QUIZ_conn->close();

?>