<?php
require_once('header.php');
if (isset($_POST['email']))
    $email = $_POST['email'];
if (isset($_POST['passwd']))
    $password = $_POST['passwd'];
if (isset($_POST['email2']))
    $email2 = $_POST['email2'];
if (empty($email) || empty($password) || empty($email2))
{
     if (isset($_POST['submit']))
        alert_info("One of the fields has been left blank");
}
if (isset($_POST['submit']) && !empty($email) && !empty($password) && !empty($email2))
{
    echo $email."<br>";
    echo $email2;
    if (check_email($email, $conn) == "OK")
    {
         if (check_email_passwd($email, $password, $conn) == "OK")
         {
             echo $email."<br>";
             echo $email2;
              $replace = $conn->prepare("UPDATE Camagru.Users SET email=:email2 WHERE email=:eml");
              $replace->execute(['email2'=> $email2,'eml'=> $email]);
            //   $do = $replace->fetch();          
            alert_info("email succesfully changed");
         }
         else
            alert_info("Password incorrect");
    }
    else
         alert_info("email not found!");
}
?>
<html>
<head>
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel= "stylesheet" href="style.css">
    <link rel="stylesheet" href="w3styles.css">
</head>
        <form class= "form" method="post" action="modif_email.php">
        <div class="reg_input">Enter email: <input type="email" name="email"/><br/></div>
        <div class="reg_input">Enter password: <input type="password" name="passwd" /><br/></div>
        <div class="reg_input">Enter new email:<input type="email" name="email2"/><br/></div>
        <input type="submit" class="btn" name="submit" value="OK"/> 
        <a href="modif_email.php" style="float:right" class="btn">Cancel</a>   
        <br/>        
       </form> 
       <footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer>
</html>