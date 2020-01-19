<?php
	$priv_path="/var/www/p_uploads";
	$pub_path="/var/www/localhost/htdocs/webpage/uploads";

	if(isset($_GET['id'])&&(is_numeric($_GET['id'])))
	{
		$photo=$_GET['id'];
	}
	elseif(isset($_POST['id'])&&(is_numeric($_POST['id'])))
	{
		$photo=$_POST['id'];
	}
	else
	{
		echo 'How did you get here?';		
		header("Location: index.php");
		exit();
	}
	
	require_once('sql_connect.php');

	$pr_path=$priv_path.'/'.$user.'/'.$photo;
	$pu_path=$pub_path.'/'.$user.'/'.$photo;

	$q="select title, user, description, privacy from Photos where Photos.id = '$photo'";

	$r=mysqli_query($con, $q);

	while($row=mysqli_fetch_array($r, MYSQLI_ASSOC))
	{
		if($row['user']==$user)
		{
			if(isset($_POST['submitted']))
			{
				if($_POST['sure']=="yes")
				{
					include('remove_photo_query.php');			
					mysqli_close($con);	
					header("Location: profile.php");
					exit();	
				}
				else
				{
					mysqli_close($con);	
					echo 'Going Back';	
					header("Location: edit.php?id=$photo");
					exit();
				}
			}

			$title=$row['title'];
			$dsc=$row['description'];
			$priv=$row['privacy'];

			if($priv==0)
			{	
				$fpath="lower/scale_image.php?image=$priv_path/$user/$photo";
			}
			else
			{
				$fpath="lower/scale_image.php?image=$pub_path/$user/$photo";
			}
			include('get_tags.php');
		}
		else
		{
			mysqli_close($con);		
			echo 'You are not supposed to be here...';		
			header("Location: index.php");
			exit();
		}
	}
	mysqli_close($con);			
?>
