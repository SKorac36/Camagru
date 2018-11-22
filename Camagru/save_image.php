<?php
    include 'include.php';
    include 'error.php';
    session_start();

    $image = explode(',', $_POST['input']);
    if (isset($_SESSION) && !empty($_SESSION['uid']))
    {
        $img_dir = "imgs/";
        $name = substr(uniqid(), 0, 9).".png";
        $img = base64_decode($image[1]);
        $picname = $img_dir.$name;
        $userid = $_SESSION['uid'];
        file_put_contents($img_dir.$name, $img);
        $query = $conn->prepare("INSERT INTO Camagru.Pics(userid,picname,likes, comment) VALUES (?,?,0,0)");
        $query->execute([$userid, $picname]);
        $stmt = $conn->prepare("SELECT * FROM Camagru.Pics WHERE picname=?");
        $stmt->execute([$img_dir.$name]);
        header("location: photo.php");
    }
?>