<?php
	$priv_path = "/var/www/p_uploads";
	$pub_path = "/var/www/localhost/htdocs/webpage/uploads";

	$photo = $_GET['id'];
			
	require_once('sql_connect.php');

	if(isset($_POST['submit']))
	{
		$def_desc="Description not available";
		$def_title="Untitled"+$photo;
		$def_tag="TagMe";

		if(!empty($_POST['title']))
		{
			$t=trim($_POST['title']);
		}
		else
		{
			$t=$def_title;
		}
				
		if(!empty($_POST['description']))
		{
			$d=trim($_POST['description']);
		}
		else
		{
			$d=$def_desc;
		}
		
		if(!empty($_POST['lat']))
		{
			$lat=trim($_POST['lat']);
		}
		if(!empty($_POST['long']))
		{
			$long=trim($_POST['long']);
		}
		
		$pr_path=$priv_path.'/'.$user.'/'.$photo;
		$pu_path=$pub_path.'/'.$user.'/'.$photo;
		if(isset($_POST['Privacy'])&&($_POST['Privacy']=="Private"))
		{
			$pr=0;
			if(is_file($pu_path))
			{
				$v = copy($pu_path, $pr_path);
				if($v)
				{
					unlink($pu_path);	
				}
			}
		}
		else
		{
			$pr=1;
			if(is_file($pr_path))
			{
				$v = copy($pr_path, $pu_path);
				if($v)
				{
					unlink($pr_path);	
				}
			}
		}

		$tg=trim($_POST['tags']);

		$q2="update Photos set title='$t', description='$d', privacy=$pr, tags='$tg', latitude='$lat', longitude='$long' where user='$user' and id=$photo";

		$r2=mysqli_query($con, $q2);
				
				
		include('untagging.php');

		$tok = strtok($tg, ", ");

		while ($tok !== false)
		{
			include('tagging.php');
			$tok = strtok(", ");
		}	

		echo "Changes have been saved<br>";
	}
		
	$q = "select title, user, description, privacy, latitude, longitude from Photos where id = $photo";

	$r = mysqli_query($con, $q);
	echo '<div id="info">';
	while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
	{
		if($row['user'] == $user)
		{
			$title=$row['title'];
			$dsc=$row['description'];
			$priv=$row['privacy'];
			$latit=$row['latitude'];
			$longit=$row['longitude'];

			if($priv == 0)
			{	
				echo '<a href="view_photo.php?id='.$photo.'"><img src="lower/scale_image.php?image='.$priv_path.'/'.$user.'/'.$photo.'" /></a>';
			}
			else
			{
				echo '<a href="view_photo.php?id='.$photo.'"><img src="lower/scale_image.php?image='.$pub_path.'/'.$user.'/'.$photo.'" /></a>';
			}
		}
		else
		{
			mysqli_close($con);
			echo 'You are not supposed to be here...';
			
			header("Location: index.php");
			exit();
		}
	}
?>
