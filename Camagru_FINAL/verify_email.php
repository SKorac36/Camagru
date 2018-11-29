<?php

include 'config/connect.php';
include 'error.php';
include 'send_email.php';
session_start();
$home = 'index.php';

if (isset($_GET['id']) && (isset($_GET['verify']))) 
{
    $id = $_GET['id'];
    $query = "SELECT * FROM Camagru.users WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->execute(['id'=> $id]);
    $user = $stmt->fetch();
    $uid = $id;
    $username = $user['username'];
    $email = $user['email'];
    $code = substr($user['passwd'], 0, 5);
    if (!$uid)
        alert_info("User not found, unable to verify");
    else if ($_GET['verify'] == 'true' && $_GET['reset'] == 'false')
    {
        $token = $_GET['token'];
        $query = "UPDATE Camagru.Users set verified=1 WHERE id=:uid";
        $stmt = $conn->prepare($query);
        $stmt->execute(['uid' => $id]);
        $_SESSION['uid'] = $uid;
        $_SESSION['username'] = $username;
        alert("Your account is now verified, you are now logged in", $home);

    }
    else if ($_GET['reset'] == 'true' && $_GET['verify'] == 'false')
    {
        $re = hash('whirlpool', uniqid());
        $new = substr($re, 0, 5);
        $hash = hash('whirlpool', $new);
        $query = "UPDATE Camagru.Users SET passwd=:new WHERE id=:uid";
        $stmt = $conn->prepare($query);
        $stmt->execute(['new'=>$hash, 'uid'=>$uid]);
        password_reset_email($email, $new);
        alert("You have successfully reset your password, check your email", $home);
    }
}
?>