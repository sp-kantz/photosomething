<?php

	require_once('sql_connect.php');

	$tag_id=0;
	$def_count=0;

	$q="select t_id from Tags where Tags.tag='$tok'";
		
	$r = mysqli_query($con, $q);

	if(@mysqli_num_rows($r)==1)
	{
		$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
		$tag_id=$row['t_id'];	
	}
	else
	{
		$q="insert into Tags (tag, count) values (?, ?)";

		$stmt = mysqli_prepare($con, $q);
		mysqli_stmt_bind_param($stmt, 'si', $tok, $def_count);
		mysqli_stmt_execute($stmt);

		if(mysqli_stmt_affected_rows($stmt)==1)
		{	
			$stored_id = mysqli_stmt_insert_id($stmt);
			$tag_id=$stored_id;
		}
	}

	$q="insert into Tagged (tag_id, photo_id) values (?, ?)";
	$stmt = mysqli_prepare($con, $q);
	mysqli_stmt_bind_param($stmt, 'ii', $tag_id, $photo);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);	
	
	if($pr==1)
	{
		$q="update Tags set count=count+1 where t_id=$tag_id";
	
		$r = mysqli_query($con, $q);
	}
?>
