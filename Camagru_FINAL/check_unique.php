<?php

function check_unique($usr, $conn)
{
    $search = $conn->prepare("SELECT * FROM Camagru.Users WHERE username=?");
    $search->execute([$usr]);
    $check = $search->fetch();
    if ($check)
    {
        return "Sorry username already in use\n";
    }
    else
        return "OK";
}
function check_email($email, $conn)
{
    $search = $conn->prepare("SELECT * FROM Camagru.Users WHERE email=?");
    $search->execute([$email]);
    $check = $search->fetch();
    if (!$check)
        return "Sorry email not found\n";
    else
        return "OK";
}
?>