<?php
require_once('header.php');

if (!isset($_SESSION) || empty($_SESSION['uid']))
{
  alert("You need to be logged in to upload photos", "create_new_user.php");
}
else
	header("Redirect: index.php");
?>
<html>
<title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="photo.css">    
<div>

</div>
<div id="wrapper" align="center">
<div id="photo" class="booth">
    <video autoplay="true" id ="videoElement" width="400" height="300"></video>
    <a href="#" id ="capture" class="booth-capture-button">Capture</a>
    <canvas id="photoElement" style="display: none" width="400" height="300"></canvas>
    <canvas id="capturedElement" width="400" height ="300"> </canvas>
</div>
	<div id="stickers" style="background-color:lightgrey" height="100">Stickers
	<br> <img href="#" id="stick1" src= "stickers/lightning.png" width="150" height="150">
    <img href="#" id="stick2" src= "stickers/snow.png" width="150" height="150">
    <img href="#" id="stick3" src= "stickers/xmas.png" width="150" height="150">
	</div><br>
   
</div> 
<div align="center">
        <input class= "upload" type="file" id="img">
        <button id="btn">Save and Upload</button>
</div>
    <script>
    var video			=	document.getElementById('videoElement'),
	canvas			=	document.getElementById('capturedElement'),
	photo			=	document.getElementById('photoElement'),
	context_canvas	=	canvas.getContext('2d'),
	context_photo	=	photo.getContext('2d'),
	stick1			=	document.getElementById('stick1'),
	stick2			=	document.getElementById('stick2'),
	stick3			=	document.getElementById('stick3');
	save			=	document.getElementById('btn');
	ac1				=	0,
	ac2				=	0,
	ac3				=	0;
    xhr				=	new XMLHttpRequest();
	cansave			= 0;
document.getElementById('img').onchange = function() {
	cansave = 1;
  var img = new Image();
  img.onload = draw;
  img.onerror = failed;
  img.src = URL.createObjectURL(this.files[0]);
};
function draw() {
	context_canvas.drawImage(this, 0, 0, 400, 300);
	context_photo.drawImage(this, 0, 0, 400, 300);
	ac1 = 0;
	ac2 = 0;
	ac3 = 0;
}
function failed() {
  console.error("The provided file couldn't be loaded as an Image media");
}
if (navigator.mediaDevices.getUserMedia) {      
	 navigator.mediaDevices.getUserMedia({video: true})
   .then(function(stream) {
	 video.srcObject = stream;
   })
   .catch(function(error) {
	 console.log("Something went wrong!");
   });
 }
  document.getElementById('capture').addEventListener('click',function(){
	cansave = 1;
	context_canvas.drawImage(video, 0, 0, 400, 300);
	context_photo.drawImage(video, 0, 0, 400, 300);
	photoElement.setAttribute('src',canvas.toDataURL('image/png'));
	ac1 = 0;
	ac2 = 0;
	ac3 = 0;
});

stick1.addEventListener('click',function(){
	if (ac1 == 0){
		ac1 = 1;
		context_canvas.drawImage(stick1, 0, 0, 400, 300);
	}
	else{
		ac1 = 0;
		ac2 = 0;
		ac3 = 0;
		context_canvas.drawImage(photoElement, 0, 0, 400, 300)
	};
});
stick2.addEventListener('click',function(){
	if (ac2 == 0){
		ac2 = 1;
		context_canvas.drawImage(stick2, 0, 0, 400, 300);
	}
	else{
		ac1 = 0;
		ac2 = 0;
		ac3 = 0;
		context_canvas.drawImage(photoElement, 0, 0, 400, 300)
	};
});
stick3.addEventListener('click',function(){
	if (ac3 == 0){
		ac3 = 1;
		context_canvas.drawImage(stick3, 0, 0, 400, 300);
	}
	else{
		ac1 = 0;
		ac2 = 0;
		ac3 = 0;
		context_canvas.drawImage(photoElement, 0, 0, 400, 300)
	};
});
save.addEventListener('click',function(){
	if (cansave == 1){
	var Data	=	photo.toDataURL("image/png");
	xhr.open('POST','upload.php');
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.addEventListener("load", function(event){
		alert(this.response);
		window.location = "index.php";
	});
	xhr.send("img="+Data+"&ac1="+ac1+"&ac2="+ac2+"&ac3="+ac3+"&submit=OK");
	}
	else{
		alert("No Image!")
	}
})
    </script>
	      <footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer> 
</html>
