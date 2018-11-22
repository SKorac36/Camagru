<?php
require_once("header.php");
if (isset($_POST['passwd']))
    $passwd     =     $_POST['passwd'];
if (isset($_POST['conpasswd']))
    $conpasswd  =     $_POST['conpasswd'];
if (isset($_POST['email']))
    $email      =     $_POST['email'];
if (isset($_POST['username']))
    $uname      =     $_POST['username'];
if (isset($_POST['newpasswd']))
    $newpasswd  =     $_POST['newpasswd'];
if (isset($_POST['connewpasswd']))
    $newpasswd2 =     $_POST['connewpasswd'];
if (!empty($passwd) && !empty($conpasswd) && !empty($email) && !empty($username) && !empty($newpasswd) && !empty($newpasswd2) && $_POST['submit'] == "OK")
{
    $stmt = $conn->prepare("SELECT email FROM Camagru.Users WHERE email=:email");
    $stmt->execute(['email'=>$email]);
    $result=$stmt->fetch();
    if (!$result)
        alert_info("Sorry your email was not found");
    else {
        alert_info("Your email was found");
    if ($passwd === $conpasswd)
    {
        if ($newpasswd == $newpasswd2)
        {
            $hash = hash('whirlpool', $newpasswd);
            $replace = $conn->prepare("UPDATE Camagru.Users SET passwd=? WHERE email=?");
            $replace->execute([$hash, $email]);
         }
         else
            alert_info("New password do not match");
    }
    else
        alert_info("Please confirm email");
    }
}
?>
<html>
<head>
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel= "stylesheet" href="style.css">
    <link rel="stylesheet" href="w3styles.css">
</head>

        <form class= "form" method="post" action="modif_user.php">
        <div class="reg_input">Enter email: <input type="email" name="email"/><br/></div>
        <div class="reg_input">Enter password: <input type="password" name="passwd" /><br/></div>
        <div class="reg_input">Confirm password: <input type="password" name="conpasswd" /><br/></div> 
        <div class="reg_input">Enter new password: <input type="password" name="newpasswd"/><br/></div>
        <div class="reg_input">Confirm new password: <input type="password" name="connewpasswd" /><br/></div>
        <input type="submit" class="btn" name="submit" value="OK"/> 
        <a href="modif_user.php" style="float:right" class="btn">Cancel</a>   
        <br/>        
       </form> 
       <footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer>
</html>