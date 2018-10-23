<?php
    
    $local_host = "localhost";
    $username = "new";
    $password = "new";

    $conn = mysqli_connect($local_host, $username, $password);
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "CREATE DATABASE Camagru";
    if (mysqli_query($conn, $sql)){
        echo "Database created\n";
    }
    else{
        echo "Error creating database: ". mysqli_error($conn);
    }
    mysqli_close($conn);
?>