<?php
require_once 'header.php';
if (isset($_SESSION) && !empty($_SESSION['uid']))
    alert("You are currently already logged in", $index);
if (isset($_POST['passwd']))
    $passwd     =     htmlentities($_POST['passwd']);
if (isset($_POST['conpasswd']))
    $conpasswd  =     htmlentities($_POST['conpasswd']);
if (isset($_POST['email']))
    $email      =     htmlentities($_POST['email']);
if (isset($_POST['username']))
    $uname      =     htmlentities($_POST['username']);
if (!empty($passwd) && !empty($conpasswd) && !empty($uname) && !empty($email) && isset($_POST['submit']))
{
    $check = check_unique($uname, $conn);
    if ($check != "OK")
         echo "<script type='text/javascript'>alert('Sorry username already in use')</script>";
    else
     {
        $str = password_check($passwd, $conpasswd);
        if ($str == "OK"){
            $hash = hash('Whirlpool', $passwd);
            $stmt = $conn->prepare("INSERT INTO Camagru.Users(email,username,passwd ,verified) VALUES (:email,:username,:passwd, 0)");
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':username', $uname);
            $stmt->bindParam(':passwd', $hash);
            $stmt->execute();
            $pull = $conn->prepare("SELECT * FROM Camagru.Users WHERE username=?");
            $pull->execute([$uname]);
            $user = $pull->fetch();
            $id = $user['id'];
            send_verify_email($email, $uname, $hash, $id);
           alert("Account successfully created, we have sent you a verification link to your email",$index);
        }
        else 
            alert($str, "create_new_user.php");
     }
}
else
{   
    if (isset($_POST['submit']))
        echo "<script type='text/javascript'>alert('One or more of the fields have been left empty')</script>";
}   
?>
<html>
<head>
    <title>Create new user</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel= "stylesheet" href="style.css">
    <link rel= "stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
        <form class= "form" method="post" action="create_new_user.php">
        <div class="reg_input">Enter email: <input type="email" name="email"/><br/></div>
        <div class="reg_input">Username: <input type="text" name="username"/><br/></div>
        <div class="reg_input">Enter password: <input type="password" name="passwd"/><br/></div>
        <div class="reg_input">Confirm password: <input type="password" name="conpasswd"/><br/></div>
        <input type="submit" class="btn" name="submit" value="OK"/> 
        <a href="create_new_user.php" style="float:right" class="btn">Cancel</a>    
         <a href="user_login.php">Already a user?</a>
        </form>
<footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer>
</html>