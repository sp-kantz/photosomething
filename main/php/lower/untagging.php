<?php
	require_once('sql_connect.php');
	
	if($pr==1)
	{
		$q="select tag_id from Tagged where photo_id=$photo";

		$r=mysqli_query($con, $q);
	
		while($row=mysqli_fetch_array($r, MYSQLI_ASSOC))
		{			
			$temp=$row['tag_id'];	
			$q2="update Tags set count=count-1 where t_id='$temp'";
			$r2=mysqli_query($con, $q2);
		}
	}

	$q="delete from Tagged where Tagged.photo_id='$photo'";

	$r=mysqli_query($con, $q);
?>
