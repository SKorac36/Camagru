<?php
require_once('header.php');

// if (!isset($_SESSION) || empty($_SESSION['uid']))
//     alert("You are not logged in", $index);
// if (!isset($_GET['img_id']))
//     alert("Error, no image found contact an admin", $index);
// else
//     $img_id = $_GET['img_id'];
$img_id = 13;
$sql = $conn->prepare("SELECT * FROM Camagru.Pics WHERE id=:img_id");
$sql->execute(['img_id'=>$img_id]);
$img = $sql->fetch();
$img_loc = $img['picname'];
?>
<html>
<title>Edit image</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="w3styles.css">
    <link rel="stylesheet" href="photo.css">
<body>
    <div>
        
        <?php
           echo '<img id="original" src="'.$img_loc.'" style="display:none" height="300" width="400"/><br>'
        ?>
     </div>   
     <canvas id="photo" width="300" height="400" style="position: absolute; left: 0; top: 0; z-index: 0;"></canvas>
    <canvas id="sticker" width="300" height="400" style="position: absolute; left: 0; top: 0; z-index: 1;"></canvas>
    <!-- <img id="image" style="display: none" src="none" alt="Your webcam photo"> -->
    <!-- <form id="save_form" action="save_image.php" method="POST"> -->
        <button id="save" style="display: none" class="button">Save photo</button>
        <input id="input" name="input" value="none" style="display: none">
    </form>
</body>
    <script src="edit.js"></script>
    <footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer>   
</html>