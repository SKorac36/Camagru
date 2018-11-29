<?php
require_once('header.php');
if(isset($_GET['pg_num']) && $_GET['pg_num']>1){
	$pg_num = $_GET['pg_num'];
} else {
	$pg_num = 1;
}
$img_per_page = 10;
$img_start = ($pg_num - 1) * $img_per_page;
if (!isset($_SESSION) || !empty($_SESSION['uid']))
{
    $stmt = $conn->prepare("SELECT * FROM Camagru.Pics WHERE userid=? ORDER BY moddate DESC LIMIT $img_start,$img_per_page" );
    $stmt->execute([$_SESSION['uid']]);
    $pics = $stmt->fetchAll();
}
else
    alert("Not logged in", "create_new_user.php");
?>
<!DOCTYPE html>
<html><head>
<title>Camagru</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="items" align="center">
        <table padding="15px">
                <?php
                if (!$pics)
                    echo "<h1>Whoops nothing here, try uploading an image</h1>";
                else foreach($pics as $row)
                {
                    $img_loc = $row['picname'];
                    $img_id = $row['id'];
                    if (file_exists($img_loc))
                        echo '<tr<td><a href="image.php?img_id='.$img_id.'"><img src="'.$img_loc.'" height="50" width="50"/></a></td></tr>';
                }
                ?>
        </table>
        <div id="pagination">
					<?php 

						$_GET['pg_num'] = $pg_num - 1;
						$img_array = array();
						foreach ($_GET as $key => $val){
							$str = $key . '=' . $val;
							array_push($img_array, $str);
						}
						if ($_GET['pg_num'] > 0)
							echo "<a href='user_images.php?" . implode('&', $img_array) . "'> previous page</a>";
						$_GET['pg_num'] = $pg_num + 1;
						$img_array = array();
						foreach ($_GET as $key => $val){
							$str = $key . '=' . $val;
							array_push($img_array, $str);
						}
						if (count($pics) >= 5)
							echo "<a href='user_images.php?" . implode('&', $img_array) . "'> next page</a>";
					?>
				</div>
    </div>
    </body>
    <footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
</footer>
</html>
