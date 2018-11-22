<?php
require_once("header.php");
if (!isset($_SESSION) || empty($_SESSION['uid']))
{
        alert("You need to be logged in to access this", $index);
}
if (isset($_GET['img_id']))
{
    $img_id = $_GET['img_id'];
    $query = "SELECT * FROM Camagru.Pics WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->execute(['id' => $img_id]);
    $pic= $stmt->fetch();
    $img_loc = $pic['picname'];
    $owner_id = $pic['userid'];
    $like = $pic['likes'];

}
if (isset($_POST['comment_txt']) && isset($_POST['comment']))
{
    $comment = $_POST['comment_txt'];
    if (empty($comment))
        alert_info("Please comment something!");
    else
    {
        $query = "INSERT INTO Camagru.Comments(ownerid, commenterid, comment, img_id) VALUES (:ownerid, :commenterid, :comment, :img_id)";
        $insert = $conn->prepare($query);
        $insert->execute(['ownerid'=> $owner_id, 'commenterid'=> $_SESSION['uid'], 'comment'=> $comment, 'img_id' => $img_id]);
        unset($comment);
    }

}
if ($_SESSION['uid'] != $owner_id)
 {
    $query = "SELECT * FROM camagru.users WHERE id = :owner_id";
    $email = $conn->prepare($query);
    $email->execute(['owner_id' => $owner_id]);
    $owner_email = $email->fetch();
    $send = $owner_email['email'];
    comment_email($_SESSION['username'], $owner_email['username'], $send);
}
if (isset($_POST['like']))
{
    $check = $conn->prepare("SELECT * FROM Camagru.Likes WHERE liker_id=:liker_id AND pic_id=:pic_id");
    $check->execute(['liker_id' => $_SESSION['uid'], 'pic_id' => $img_id]);
    $ext = $check->fetch();
    if (!$ext)
    {
        $likes = $conn->prepare("INSERT INTO Camagru.Likes (liker_id, pic_id) VALUES (?,?)");
        $likes->execute([$_SESSION['uid'],  $img_id]);
        unset($likes);
        $likes = $conn->prepare("UPDATE Camagru.Pics SET likes=likes+1 WHERE id =:id");
        $likes->execute(["id"=> $img_id]);
    }
    header("Refresh:0");
} 
if (!empty($_POST['delete']))
    {
        if ($_SESSION['uid'] == $owner_id)
        {
            $del = $conn->prepare("DELETE FROM camagru.pics WHERE id=:img_id");
            $del->execute(['img_id' => $img_id]);
            alert("Succefully deleted image", "user_images.php");
        }
        alert("You can not delete someone elses photo", "user_images.php");
    }
$new = $conn->prepare("SELECT * FROM camagru.comments WHERE img_id = :img_id");
$new->execute(['img_id' => $img_id]);
$comments = $new->fetchAll();
$like = $pic['likes'];
var_dump($_POST);
?>
<!-- <!DOCTYPE html> -->
<html>
<head>
    <title>Image</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel= "stylesheet" href="style.css">
    <link rel="stylesheet" href="w3styles.css">
</head>
    <div id="over" style="position:relative; width:100%">
    <?php

        var_dump($img_loc);
        if (!$img_loc)
            alert("no image found", "#");
        else{
            echo '<img src="'.$img_loc.'" height="300" width="400"/> <br>';
        }
        ?>
        <div class="form">
        <table id="comments">
                <?php
                echo 'Likes:'.$like.'';
				foreach($comments as $comment)
				{
                    
                    $txt = $comment['comment'];
                    $user = $_SESSION['username'];
                    $time = $comment['time'];
					echo '<tr><td>
						<p> '.$user.' '.$txt .' '.$time.'</p>
						  </td></tr>';
                }
                ?>
	    </table>
        </div>
    </div>
    <form class="form" method="POST" id="image_form">
    
        <input type="submit" name="like" value="Like"></div> 
                       <br>
		<textarea name="comment_txt" ></textarea>
				        <br>
        <input type="submit" name="comment" value="comment"/>
        <input type="submit" name="delete" value="delete"/>
				</form>
       <footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
    </footer> 
</html>