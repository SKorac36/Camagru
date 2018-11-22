<?php
    include 'include.php';
    session_start();


if (isset($_SESSION) && !empty($_SESSION['uid']))
{
    $img_dir = "imgs/";
    $img_name = basename($_FILES['file']['name']);
    $new_name = uniqid();
    $img_file_type = ".". strtolower(pathinfo($img_dir . $_FILES['file']['name'], PATHINFO_EXTENSION));
    $target = $img_dir . $new_name . $img_file_type;
    move_uploaded_file($_FILES['file']['tmp_name'], $target);

    $query = $conn->prepare("INSERT INTO Camagru.Pics (userid, picname, likes, comment) VALUES (?,?,0,0)");
    $query->execute([$_SESSION['uid'],$target]);
    header("location: photo.php");
}
?>