<?php
require_once('header.php');
if (isset($_POST['uname']))
    $uname = $_POST['uname'];
if (isset($_POST['passwd']))
    $password = $_POST['passwd'];
if (isset($_POST['uname2']))
    $uname2 = $_POST['uname2'];
if (empty($uname) || empty($password) || empty($uname2))
{
     if (isset($_POST['submit']))
        alert_info("One of the fields has been left blank");
}
if (isset($_POST['submit']) && !empty($uname) && !empty($password) && !empty($uname2))
{
    $unique = check_unique($uname, $conn);
    if (check_unique($uname2, $conn) != "OK")
    {
        alert_info("Username already taken!");
        header('Location:modif_username.php');
        die();
    }
    if ($unique != "OK")
    {
        if (check_passwd($uname, $password, $conn) == "OK")
        {
            $replace = $conn->prepare("UPDATE Camagru.Users SET username=:uname2 WHERE username=:uname");
            $replace->execute(['uname2'=> $uname2,'uname'=> $uname]);
            alert("Username succesfully changed", $index);
        }
        else
            alert_info("Password incorrect");
    }
    else
         alert_info("Username not found!");
}
?>
<html>
<head>
    <title>Change Username</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel= "stylesheet" href="style.css">
    <link rel="stylesheet" href="w3styles.css">
</head>

        <form class= "form" method="post" action="modif_username.php">
        <div class="reg_input">Enter username: <input type="text" name="uname"/><br/></div>
        <div class="reg_input">Enter password: <input type="password" name="passwd" /><br/></div>
        <div class="reg_input">Enter new username: <input type="text" name="uname2" /><br/></div>
        <input type="submit" class="btn" name="submit" value="OK"/>
        <a href="modif_username.php" style="float:right" class="btn">Cancel</a>   
       <br/>        
       </form> 
       <footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer>   
</html>