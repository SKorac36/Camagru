<?php
function check_passwd($usr, $pass, $conn)
{
    $hash = hash('whirlpool', $pass);
    $search = $conn->prepare("SELECT * FROM Camagru.Users WHERE username=:user AND passwd=:pwd");
    $search->execute(['user' => $usr, 'pwd'=> $hash]);
    $result = $search->fetch();
    if ($result)
        return "OK";
    else
        return "Password incorrect\n";
}
function check_email_passwd($email, $pass, $conn)
{
    $hash = hash('whirlpool', $pass);
    $search = $conn->prepare("SELECT * FROM Camagru.Users WHERE email=:eml AND passwd=:pwd");
    $search->execute(['eml' => $email, 'pwd'=> $hash]);
    $result = $search->fetch();
    echo $result;
    if ($result)
        return "OK";
    else
        return "Password incorrect\n";
}
?>