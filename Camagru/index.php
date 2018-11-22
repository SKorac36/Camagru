<?php
 require_once('header.php');

if(isset($_GET['pg_num']) && $_GET['pg_num']>1){
	$pg_num = $_GET['pg_num'];
} else {
	$pg_num = 1;
}
$img_per_page = 5;
$img_start = ($pg_num - 1) * $img_per_page;
$stmt = $conn->prepare("SELECT * FROM Camagru.Pics ORDER BY moddate DESC LIMIT $img_start,$img_per_page");
$stmt->execute();
$pics = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html><head>
<title>Camagru</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3styles.css">
<link rel="stylesheet" href="grid.css">
</head>
<body>

    <div class="items" align="center">
        <table>
                <?php
                if (!$pics)
                    echo "no more images found";
                else foreach($pics as $row)
                {
                    $img_loc = $row['picname'];
                    $img_id = $row['id'];
                    if (file_exists($img_loc)){
                        echo '<tr<td><a href="image.php?img_id='.$img_id.'"><img src="'.$img_loc.'" height="300" width="400"/></a></td>';
                        }
                    echo '</tr>';
                }
                ?>
        </table>
        <div id="pagination">
					<?php 

						$_GET['pg_num'] = $pg_num - 1;
						$get_array = array();
						foreach ($_GET as $key => $val){
							$str = $key . '=' . $val;
							array_push($get_array, $str);
						}
						if ($_GET['pg_num'] > 0)
							echo "<a href='index.php?" . implode('&', $get_array) . "'> previous page</a>";

						$_GET['pg_num'] = $pg_num + 1;
						$get_array = array();
						foreach ($_GET as $key => $val){
							$str = $key . '=' . $val;
							array_push($get_array, $str);
						}
						if (count($pics) >= 5)
							echo "<a href='index.php?" . implode('&', $get_array) . "'> next page</a>";
					?>
				</div>
    </div>
    </body>
    <footer class="w3-container w3-green">
	  <h5>skorac 2018</h5>
</footer>
</html>