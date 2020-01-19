<?php
	$q5 = "delete from Photos where Photos.id='$photo' limit 1";

	$r5 = mysqli_query($con, $q5);
			
	if(mysqli_affected_rows($con) == 1)
	{
		$priv=$row['privacy'];
		$size=filesize()/1000000;
		if($priv==0)
		{
			$size=filesize($pr_path)/1000000;
		}
		else
		{
			$size=filesize($pu_path)/1000000;
		}
		
		$q6="update Users set space=space+$size where username='$user'";
		$r6=mysqli_query($con, $q6);
		
		$th_path="/var/www/thumbnails/$photo";
		
		unlink($th_path);
		
		if($priv==0)
		{
			unlink($pr_path);
		}
		else
		{
			unlink($pu_path);
		}

		include('untagging.php');
	}							
?>
