<?php
require_once 'header.php';
if (isset($_POST['passwd']))
    $passwd     =     $_POST['passwd'];
if (isset($_POST['conpasswd']))
    $conpasswd  =     $_POST['conpasswd'];
if (isset($_POST['email']))
    $email      =     $_POST['email'];
if (isset($_POST['username']))
    $uname      =     $_POST['username'];
if (!empty($passwd) && !empty($conpasswd) && !empty($uname) && !empty($email) && $_POST['submit'] == "OK")
{
    $check = check_unique($uname, $conn);
    if ($check != "OK")
         echo "<script type='text/javascript'>alert('Sorry username already in use\n')</script>";
    else
     {
        $str = password_check($passwd, $conpasswd);
        if ($str == "OK"){
            $hash = hash('Whirlpool', $passwd);
            $stmt = $conn->prepare("INSERT INTO Camagru.Users(email,username,passwd ,verified) VALUES (:email,:username,:passwd,0)");
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':username', $uname);
            $stmt->bindParam(':passwd', $hash);
            $stmt->execute();
            send_verify_email($email, $uname, $hash);
           alert("Account successfully created, we have sent you a verification link in your email",$index);
        }
        else 
            echo "<script type='text/javascript'>alert('error occured: $str')</script>";
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
    <link rel= "stylesheet" href="w3styles.css">
</head>
        <form class= "form" method="post" action="create_new_user.php">
        <div class="reg_input">Enter email: <input type="email" name="email"/><br/></div>
        <div class="reg_input">Username: <input type="text" name="username"/><br/></div>
        <div class="reg_input">Enter password: <input type="password" name="passwd"/><br/></div>
        <div class="reg_input">Confirm password: <input type="password" name="conpasswd"/><br/></div>
        <input type="submit" class="btn" name="submit" value="OK"/> 
        <input style="float:right" type="submit" class="btn" name="cancel" value="Cancel"/><br>
         <a href="user_login.php">Already a user?</a>
        </form>
<footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer>
</html>