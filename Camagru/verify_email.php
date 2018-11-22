<?php

include 'include.php';
include 'error.php';
include 'send_email.php';
session_start();
$home = 'index.php';
if (isset($_GET['username']) && (isset($_GET['verify']))) 
{
    $username = $_GET['username'];
    $query = "SELECT * FROM Camagru.users WHERE username=:username";
    $stmt = $conn->prepare($query);
    $stmt->execute(['username'=>$username]);
    $user = $stmt->fetch();
    $uid = $user['id'];
    $email = $user['email'];
    $code = substr($user['passwd'], 0, 5);
    if (!$user)
        alert_info("User not found, unable to verify");
    else if ($_GET['verify'] == 'true' && $_GET['reset'] == 'false')
    {
        $token = $_GET['token'];
        $query = "UPDATE Camagru.Users set verified=1 WHERE id=:uid";
        $stmt = $conn->prepare($query);
        $stmt->execute(['uid' => $uid]);
        $_SESSION['uid'] = $uid;
       alert("Your account is now verified, you are now logged in", $home);
        var_dump($_SESSION);

    }
    else if ($_GET['reset'] == 'true' && $_GET['verify'] == 'false')
    {
        $re = hash('whirlpool', uniqid());
        $new = substr($re, 0, 5);
        var_dump($new);
        $hash = hash('whirlpool', $new);
        $query = "UPDATE Camagru.Users SET passwd=:new WHERE id=:uid";
        $stmt = $conn->prepare($query);
        $stmt->execute(['new'=>$hash, 'uid'=>$uid]);
        password_reset_email($email, $new);
        alert("You have successfully reset your password, check your emails", $home);
    }
}
?>