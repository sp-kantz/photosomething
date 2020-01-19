<?php
	if(isset($_POST['post']))
	{
		if(!empty($_POST['comment']))
		{
			$c=trim($_POST['comment']);
		}

		$q3='insert into Comments (comment, user, photo_id, com_date) values (?, ?, ?, now())';
		$stmt = mysqli_prepare($con, $q3);
		mysqli_stmt_bind_param($stmt, 'ssi', $c, $user, $photo);
		mysqli_stmt_execute($stmt);

		if(mysqli_stmt_affected_rows($stmt)==1)
		{
			$id = mysqli_stmt_insert_id($stmt);

			mysqli_stmt_close($stmt);
		}
	}

	$q1 = "select user, privacy, title, description, likes, dislikes, latitude, longitude, upload_date from Photos where id = $photo";

	$r = mysqli_query($con, $q1);

	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

	$priv=$row['privacy'];
	$usr=$row['user'];
	$title=$row['title'];
	$dsc=$row['description'];	
	$dt=$row['upload_date'];
	$likes=$row['likes'];
	$dislikes=$row['dislikes'];
	$lat=$row['latitude'];
	$long=$row['longitude'];
	
	$total=$likes+$dislikes;
	$like_per=($likes*100)/$total;
	$dislike_per=($dislikes*100)/$total;
	
	if($priv == 0)
	{
		if($usr != $user)
		{
			echo 'How could you see that?';
			mysqli_close($con);
			header("Location: index.php");
			exit();
		}
	}
	
	if($priv==0)
	{	
		$fpath="lower/scale_image.php?image=$priv_path/$usr/$photo";
	}
	else
	{
		$fpath="lower/scale_image.php?image=$pub_path/$usr/$photo";
	}
	
	if (isset($_SESSION['session_uid']))
	{
		$uid=$_SESSION['session_uid'];
		$q2="select likes from Likes where user_id=$uid and photo_id=$photo";
	
		$r2 = mysqli_query($con, $q2);
		if(mysqli_num_rows($r2)==1)
		{
			$row2= mysqli_fetch_array($r2, MYSQLI_ASSOC);
			$liked=$row['likes'];
		}
	}
			
	
?>
