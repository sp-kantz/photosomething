<?php
	require_once('sql_connect.php');

	$q="select id, user, privacy from Photos where user='$user' order by upload_date desc";
	$r=mysqli_query($con, $q);
			
	$q2="select space from Users where username='$user'";		
	$r2=mysqli_query($con, $q2);
			
	while($row2=mysqli_fetch_array($r2, MYSQLI_ASSOC))
	{
		$space=$row2['space'];
				
		$width=(int)$space*2;
	}		
?>
