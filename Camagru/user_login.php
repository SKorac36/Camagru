<?php
require_once "header.php";
if (isset($_POST['passwd']))
{
    $pass = $_POST['passwd'];
    $hash = hash('whirlpool', $pass);
}
if (isset($_POST['uname']))
    $uname = $_POST['uname'];
if (isset($_POST['submit']))
{
    if (!empty($uname) || !empty($pass))
    {
        $search = $conn->prepare("SELECT * FROM Camagru.Users WHERE username=:user AND passwd=:pwd");
        $search->execute(['user' => $uname, 'pwd'=> $hash]);
        $result = $search->fetch();
        $verif = $result['verified'];
        if ($result && $verif != 1)
            alert("Your account has not yet been verified, check your email for a link", $index);
        else if ($result['username'] != $uname || $result['passwd'] != $hash)
            alert("Incorrect username or password", "user_login.php");
        else
        {
            $_SESSION['uid'] = $result['id'];
		    $_SESSION['username'] = $result['username'];
            alert("Welcome to Camagru $uname",$index);
        }
    }
    else
        alert("Username or password has been left blank", "user_login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel= "stylesheet" href="style.css">
    <link rel="stylesheet" href="w3styles.css">
</head>
        <form class= "form" method="post" action="user_login.php" style="width:35%">
            <div class="reg_input">Enter username: <input type="text" name="uname"/><br/></div>
            <div class="reg_input">Enter password: <input type="password" name="passwd" /><br/></div>
            <input type="submit" class="btn" name="submit" value="OK"/> 
            <a href="reset_passwd.php">Forgotten password?</a>
            <a href="user_login.php" style="float:right" class="btn">Cancel</a>     
       </form> 
       <footer class="w3-container w3-green">
	    <h5>skorac 2018</h5>
    </footer> 
</html>