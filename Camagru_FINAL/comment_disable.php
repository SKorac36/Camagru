<?php
 require_once('header.php');

 if (isset($_POST['no']))
{
    $sql = $conn->prepare("UPDATE Camagru.Users SET comment=0 WHERE id=:uid");
    $sql->execute(['uid' => $_SESSION['uid']]);
    alert("You will no longer receive comment emails", "comment_disable.php");

}
else if (isset($_POST['yes']))
{
    $sql = $conn->prepare("UPDATE Camagru.Users SET comment=1 WHERE id=:uid");
    $sql->execute(['uid' => $_SESSION['uid']]);
    alert("You will continue receiving comment emails", "comment_disable.php");
}
?>
<html>
<head>
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel= "stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

        <form class= "form" method="post" action="comment_disable.php">
        <h3>Do you want an email for image comments?</h3>
        <input type="submit" class="btn" name="yes" value="YES"/>
        <input type="submit" class="btn" name="no" value="NO"/>
        <a href="settings.php" style="float:right" class="btn">Cancel</a>         
       </form> 
       <footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer>
</html>
