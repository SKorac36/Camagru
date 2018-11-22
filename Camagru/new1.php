<?php
require_once('header.php');
$img_id = 13;
$sql = $conn->prepare("SELECT * FROM Camagru.Pics WHERE id=:img_id");
$sql->execute(['img_id'=>$img_id]);
$img = $sql->fetch();
$img_loc = $img['picname'];
?>
<html>
<main>
    <div align="center">
            <script>
            window.onload = function()
            {
                document.querySelector("#canvas-hold").style.display = "none";
            }
            </script>
            <div id="stickers">
                <img draggable="true" id="yaboi" src ="stickers/GabeN.png" alt="GabeN" style="width:90px; height:90px;"/>
                <img id="locks" src ="stickers/Hair.png" alt="Hair" style="width:170px; height:170px;"/>             
                <img id="shades" src ="stickers/Glasses.png" alt="Glasses" style="width:200px; height:200px;"/>   
            <?php
                echo '<img id="original" src="'.$img_loc.'" style="display:block" height="300" width="400"/><br>'
            ?>
            </div>   
            <canvas id="canvas-hold"></canvas>
    </div>
<script src="new1.js"></script>
</html>