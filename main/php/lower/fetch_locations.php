<?php
	header('Content-type: text/xml; charset=ISO-8859-7');
	
	$q="select id, latitude, longitude from Photos where privacy=1 ";
	
	require_once('sql_connect.php');

	$r=mysqli_query($con, $q);
	
	echo '<data>';
	while($row=mysqli_fetch_array($r, MYSQLI_ASSOC))
	{
		echo '<mark ';
		echo 'id="' . $row['id'] . '" ';
		echo 'lat="' . $row['latitude'] . '" ';
		echo 'long="' . $row['longitude'] . '" ';
		echo '/>';
	}
	echo '</data>';
	
?>
