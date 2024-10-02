<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

</head>
<body>
    <div id="center-box">
        <form name="signup_form" action="signup.php" method="post" onsubmit="return validateForm()">
            <input 
            type="text" 
            name="ldap_id" 
            id="ldap_id" 
            placeholder="LDAP ID"
            required><br>
            
            <input type="password"
            name="set_password"
            id="set_password"
            placeholder="Enter a password"
            required><br>
            
            <input
            type="password"
            name="confirm_password"
            id="confirm_password"
            placeholder="Re-enter the password"
            required><br>

            <input type="submit" value="Sign Up">
        </form>
    </div>
    <script src="signup.js"></script>
</body>
</html>