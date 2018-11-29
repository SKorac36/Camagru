<?php
require_once('header.php');
if (isset($_POST['submit']))
{
     if (empty($_POST['username']))
        alert("Please enter a username", "reset_passwd.php");
    $uname = htmlentities($_POST['username']);
    $query = "SELECT * FROM Camagru.Users WHERE username=:uname";
    $stmt = $conn->prepare($query);
    $stmt->execute(['uname' => $uname]);
    $user = $stmt->fetch();
    $email = $user['email'];
    $id = $user['id'];
    reset_password_email($email, $uname, $id);
    alert("We have sent an email with your password reset verification link", "reset_passwd.php");
}
?>
<html>
<head>
    <title>Forgotten Password?</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel= "stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>


    <form class= "form" method="post" action="reset_passwd.php">
        <div class="reg_input">Enter username: <input type="text" name="username"/><br/></div>
        <input type="submit" class="btn" name="submit" value="OK"/> 
        <br/>        
       </form> 
       <footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer>
  
</html>