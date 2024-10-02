function validateForm()
{
    //INFO GATHERING
    var  ldap_id = document.forms["signup_form"]["ldap_id"].value;
    var set_password = document.forms["signup_form"]["set_password"].value;
    var confirm_password = document.forms["signup_form"]["confirm_password"].value;

    //PASSWORD VALIDATION
    if(set_password != confirm_password)
    {
        alert("The passwords do not match");
        return false;
    }
    return true;

}