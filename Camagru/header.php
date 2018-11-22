<?php
 
require_once('include.php');
require_once('error.php');
include_once('check_passwd.php');
include_once('check_unique.php');
require_once('password.php');
require_once('send_email.php');
session_start();
$index = "index.php";

?>
<!DOCTYPE html>
<html>
<title>Camagru</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3styles.css">
<link rel="stylesheet" href="grid.css">
<body>
<div class="w3-container w3-green">
  <h1>Camagru</h1>
  <a href="index.php" class="w3-bar-item w3-button">Home</a>
<a href="user_images.php?pg_num=1" class="w3-bar-item w3-button">Your images</a>
  <a href="photo.php" class="w3-bar-item w3-button">Upload Image</a>
  <a href="settings.php" class="w3-bar-item w3-button">Settings</a>
  <a href="create_new_user.php" class="w3-bar-item w3-button">Login/Register</a>
 
  <a href="logout.php" style= "float:right" class="w3-bar-item w3-button">Logout</a>
  </div>
</div>
</body>
</html>