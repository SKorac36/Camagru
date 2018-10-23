<?php

$servername = "localhost";
$username = "new";
$password = "new";
$db = "Camagru";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn){
    die("Connection failed: " .mysqli_connect_error());
}
if ($_POST['email'] && $_POST['login'] && $_POST['passwd'] && $_POST['conpasswd'] && submit === "OK")
{
    if ($_POST['passwd'] === $_POST['conpasswd'])
        $hash = hash('whirpool', $_POST['passwd']);
    else
        echo "Please confirm password\n";
    $login = $_POST['login'];
    if (strstr($_POST['email'], '@'))
        $email = $_POST['email'];
    else
        echo "Please enter a viable email\n";
}
else if (submit === "OK" && ((!$_POST['email'] || !$_POST['login'] || !$_POST['passwd'] || !$_POST['conpasswd'])))
{
    if (!$_POST['email'])
        echo "Email cannot be blank\n";
    else if (!$_POST['login'])
        echo "Login cannot be blank\n";
    else if (!$_POST['passwd'])
        echo "Password cannot be blank\n";
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>New user</title>
</head>
    <body>
        <form method="post" action="/create_new_user.php">
            Email : <input type="text" name = "email" />
        <br/>
            Username: <input type="text" name="login" />
        <br/>
            Enter Password: <input type="password" name="passwd" />
        <br/>
            Confirm Password: <input type="password" name="conpasswd" />
        <br>
            <input type="submit" name="submit" value="OK" />
        <br/>
        </form>
    </body>
</html>