<?php
    require_once('header.php');
    if (!isset($_SESSION) || empty($_SESSION['uid']))
    {
      alert("You need to be logged in to change your settings", "create_new_user.php");
    }
    else
        header("Redirect: settings.php");
?>
<html>
    <head>
    <title>Settings</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel= "stylesheet" href="style.css">
    </head>
    <body>
        <form class= "form">
            <h3>What would you like to change?</h3> <br>
                <a href="modif_username.php" class="w3-bar-item w3-button">Username</a> <br>
                <a href="settings_pass.php" class="w3-bar-item w3-button">Password</a> <br>
                <a href="modif_email.php" class="w3-bar-item w3-button">Email Address</a> <br>
                <a href="comment_disable.php" class="w3-bar-item w3-button">Disable comment emails</a>
                <br/>        
       </form>
</body> 
<footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer>
</html>