<?php
require_once("header.php");
 if (!isset($_SESSION) || empty($_SESSION['uid']))
 {
  alert("You need to be logged in to upload an image", "create_new_user.php");
}
?>
<html>
<title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="w3styles.css">
    <link rel="stylesheet" href="photo.css">    
<div>
    <form class="form" id="upload" method="POST" action="upload_image.php" enctype="multipart/form-data">
        Upload your own picture
        <input type="file" name="file" id="file"> <br>
        <input type="submit" value="Click to upload" name="submit">
    </form>
</div>

<div id="wrapper" align="center">
    <div id="photo" class="booth">
        <video id="video" height="300" width="400"></video>
        <a href="#" id="click" class="booth-capture-button">Click</a>
        <canvas id="canvas" style="display: none" height="300" width="400"></canvas>
        <canvas id="canvas2" style="display: none" height="300" width="400"></canvas>
        <img id="image" style="display: none" src="none" alt="Your webcam photo">
        <form id="save_form" action="save_image.php" method="POST">
            <button id="save" style="display: none" class="button">Save photo</button>
            <input id="input" name="input" value="none" style="display: none">
        </form>
    </div>
    <div id="stickers">
            <img id="yaboi" src ="stickers/GabeN.png" alt="GabeN" style="width:90px; height:90px;"/>
            <img id="locks" src ="stickers/Hair.png" alt="Hair" style="width:200px; height:200px;"/>             
            <img id="shades" src ="stickers/Glasses.png" alt="Glasses" style="width:200px; height:200px;"/>   
    </div>
    </div>
    <script src="photo.js"></script>
    <footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer>   
</html>