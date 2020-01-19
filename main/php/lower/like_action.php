<?php
	header('Content-type: text/xml; charset=ISO-8859-7');
	session_start();
	if(isset($_SESSION['session_username']))
	{
		$user=$_SESSION['session_username'];
		$uid=$_SESSION['session_uid'];
		
		if(isset($_GET['action'])&&isset($_GET['id']))
		{	
			$action = $_GET['action'];
			$photo = $_GET['id'];
			
			require_once('sql_connect.php');
			
			$q="select likes from Likes where user_id=$uid and photo_id=$photo";
			
			$r = mysqli_query($con, $q);
			
			if(@mysqli_num_rows($r)==1)
			{
				if($action)
				{
					$q1="update Likes set likes=1 where user_id=$uid and photo_id=$photo";
					$q2="update Photos set likes=likes+1, dislikes=dislikes-1 where id=$photo";
				}
				else
				{
					$q1="update Likes set likes=0 where user_id=$uid and photo_id=$photo";
					$q2="update Photos set likes=likes-1, dislikes=dislikes+1 where id=$photo";
				}
			}
			else
			{
				if($action)
				{
					$q1="insert into Likes(user_id, photo_id, likes) values($uid, $photo, 1)";
					$q2="update Photos set likes=likes+1 where id=$photo";
				}
				else
				{
					$q1="insert into Likes(user_id, photo_id, likes) values($uid, $photo, 0)";
					$q2="update Photos set dislikes=dislikes+1 where id=$photo";
				}
			}

			$r1 = mysqli_query($con, $q1);
			$r2 = mysqli_query($con, $q2);
			
			echo '<ok>1</ok>';
		}
		else
			echo '<ok>2</ok>';
	}
	else
		echo '<ok>3</ok>';
?>
