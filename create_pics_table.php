<?php

$servername = "localhost";
$username = "new";
$password = "new";
$db = "Camagru";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "CREATE TABLE Pics (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    displayname VARCHAR(30) NOT NULL,
    moddate TIMESTAMP,
    likes INT,
    comment INT
    )";
if (mysqli_query($conn, $sql))
    echo "Table Users created successfully\n";
else
    echo "Error creating table Pics\n" . mysqli_error($conn);
mysqli_close($conn);
?>