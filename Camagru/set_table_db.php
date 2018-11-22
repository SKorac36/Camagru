<?php
require_once('header.php');

$db = "CREATE DATABASE Camagru";
$usrs = "CREATE TABLE Camagru.Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(1000) NOT NULL,
    username VARCHAR(30) NOT NULL,
    passwd VARCHAR(255) NOT NULL,
    verified INT(1) NOT NULL,
    regdate TIMESTAMP 
    )";
$pics = "CREATE TABLE Camagru.Pics (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(30) NOT NULL,
    picname VARCHAR(100) NOT NULL,
    moddate TIMESTAMP,
    likes INT(255),
    comment INT
    )";
$comments = "CREATE TABLE Camagru.Comments (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ownerid INT(6) NOT NULL,
    commenterid INT(6) NOT NULL,
    comment VARCHAR(1000),
    img_id INT(6) NOT NULL,
    time TIMESTAMP)";
$likes = "CREATE TABLE Camagru.Likes (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    liker_id INT(6) NOT NULL,
    pic_id INT(6) NOT NULL,
    time TIMESTAMP)";
  $conn->query($db);
  $conn->query($usrs);
  $conn->query($pics);
 $conn->query($comments);
$conn->query($likes);
?>