<?PHP
include_once "config/connect.php";
session_start();
$user_id    =    $_SESSION['uid'];
$img_dir = "./imgs/";
$name = substr(uniqid(), 0, 9).".png";;
$img_name = $img_dir.$name;
$original        =    $_POST['img'];
$ac1        =    $_POST['ac1'];
$ac2        =    $_POST['ac2'];
$ac3        =    $_POST['ac3'];
$submit        =    $_POST['submit'];
$sticker1    =    "./stickers/lightning.png";
$sticker2    =    "./stickers/snow.png";
$sticker3    =    "./stickers/xmas.png";
if ($submit != "OK"){
    echo 'No Submit!';
    exit();
}
if (empty($original || empty($ac1) || empty($ac2) || empty($ac3))){
    echo 'No data!';
    exit();
}

$original = str_replace(" ", "+", $original);
$original = str_replace("data:image/png;base64,", "", $original);
$original = base64_decode($original);
$original = imagecreatefromstring($original);
imagepng($original, 'tmp.png');


if ($ac1 == 1){
    $sticker = imagecreatefrompng($sticker1);
    $original = imagecreatefrompng('tmp.png');
    imagesavealpha($original, true);
    imagealphablending($original, true);
    $sticker = imagescale($sticker, 400, 300);
    imagesavealpha($sticker, true);
    imagecopy($original, $sticker, 0, 0, 0, 0, 400, 300);
    imagepng($original, 'tmp.png'); 
    imagedestroy($sticker);
}
if ($ac2 == 1){    
    $sticker = imagecreatefrompng($sticker2);
	$original = imagecreatefrompng('tmp.png');
	imagesavealpha($original, true);
	imagealphablending($original, true);
	$sticker = imagescale($sticker, 400, 300);
    imagealphablending($sticker, true);
    imagesavealpha($sticker, true);
	imagecopy($original, $sticker, 0, 0, 0, 0, 400, 300);
    imagepng($original, 'tmp.png');
    imagedestroy($sticker);
}
    
if ($ac3 == 1){
    $sticker = imagecreatefrompng($sticker3);
    $original = imagecreatefrompng('tmp.png');
    imagesavealpha($original, true);
    imagealphablending($original, true);
    $sticker = imagescale($sticker, 400, 300);
    imagealphablending($sticker, true);
    imagesavealpha($sticker, true);
    imagecopy($original, $sticker, 0, 0, 0, 0, 400, 300);
    imagepng($original, 'tmp.png');
    imagedestroy($sticker);
}

if (copy('tmp.png', $img_name)){
    $query = "INSERT INTO Camagru.Pics (userid,picname) VALUES (?,?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id, $img_name]);
    echo "File uploaded!\n";
    unlink("./tmp.png");
}
else {
    echo "Something Went Wrong!\n File failed to upload!";
    exit();
}