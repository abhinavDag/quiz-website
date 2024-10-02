<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

</head>
<body>
    <div id="center-box">
        <form name="login_form" action="login.php" method="post" onsubmit="return validateForm()">
            <input 
            type="text" 
            name="ldap_id" 
            id="ldap_id" 
            placeholder="LDAP ID"
            required><br>
            
            <input type="password"
            name="password"
            id="password"
            placeholder="Password"
            required><br>
            

            <input type="submit" value="Login">
        </form>
    </div>
    <script src="login.js"></script>
</body>
</html>