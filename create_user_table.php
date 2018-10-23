<?php

$servername = "localhost";
$username = "new";
$password = "new";
$db = "Camagru";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "CREATE TABLE Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(30) NOT NULL,
    displayname VARCHAR(30) NOT NULL,
    passwd VARCHAR(MAX) NOT NULL,
    regdate TIMESTAMP
    )";
if (mysqli_query($conn, $sql))
    echo "Table Users created successfully\n";
else
    echo "Error creating table Users\n" . mysqli_error($conn);
mysqli_close($conn);
?>