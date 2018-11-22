<?php
//include 'include.php';
function password_check($pass, $conpass)
{
    if ($pass != $conpass)
        return "Passwords do not match\n";
    if (strlen($pass) <= 6)
        return "Password too short, please make sure it is longer than 6 characters\n";
    if (!preg_match('/[^a-zA-Z\d]/', $pass)) 
        return "Password does not contain at least one special character"; 
    if (!preg_match('/[a-zA-Z]/', $pass)) 
        return"Password does not contain upper and lower case letters";
    if (!preg_match('/\d/', $pass)) 
        return "Password does not contain at least one digit";
    return "OK";
}
?>