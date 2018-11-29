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
    $pic = $stmt->fetch();
    $img_loc = $pic['picname'];
    $owner_id = $pic['userid'];
    $like = $pic['likes'];

}
if (isset($_POST['comment']))
{
    if (!empty($_POST['comment_txt']))
    {
        $comm= htmlentities($_POST['comment_txt']);
        $query = "INSERT INTO Camagru.Comments(ownerid, commenterid, comm, img_id) VALUES (:ownerid, :commenterid, :comment, :img_id)";
        $insert = $conn->prepare($query);
        $insert->execute(['ownerid'=> $owner_id, 'commenterid'=> $_SESSION['uid'], 'comment'=> $comm, 'img_id' => $img_id]);
    }
    else
        alert_info("Please comment something!");
}
if ($_SESSION['uid'] != $owner_id && isset($_POST['comment']) && isset($_POST['comment_txt']))
 {
    $query = "SELECT * FROM camagru.users WHERE id = :owner_id";
    $email = $conn->prepare($query);
    $email->execute(['owner_id' => $owner_id]);
    $owner_email = $email->fetch();
    $send = $owner_email['email'];
    if ($owner_email['comment'] != 0)
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
            alert("Successfully deleted image", "user_images.php");
        }
        alert("You can not delete someone elses photo", "user_images.php");
    }
$new = $conn->prepare("SELECT * FROM Camagru.comments JOIN Camagru.users ON Camagru.comments.commenterid=Camagru.users.id WHERE img_id = :img_id");
$new->execute(['img_id' => $img_id]);
$comments = $new->fetchAll();
$like = $pic['likes'];
?>
<html>
<head>
    <title>Image</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel= "stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
    <div id="over" style="position:relative; width:100%">
    <?php
        if (!$img_loc)
            alert("no image found", "#");
        else{
            echo '<img src="'.$img_loc.'" height="300" width="400"/> <br>';
        }
        ?>
        <div class="form">
        <table id="comments">
                <?php
                echo 'Likes:'.$like.'<br>';
                echo '<h4>Comments:</h4>';
                foreach($comments as $comment)
				{
                    $txt = $comment['comm'];
                    $user = $comment['username'];
                    $time = $comment['time'];
                    echo '<tr><td>
                        <h4>'.$user.'</h4>
						<p> '.$txt .' '.$time.'</p>
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