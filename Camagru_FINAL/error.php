<?php

function    alert_info($str)
{
    echo "<script type='text/javascript'>alert('$str')</script>";
}
function alert($str, $redirect)
{
	echo "<script type='text/javascript'>
	alert('$str');
	window.location.href = '$redirect'; 
	</script>";
	die();
}
?>