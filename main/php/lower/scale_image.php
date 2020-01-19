<?php
	header('Content-Type: image/jpeg');
	
	$path=$_GET['image'];
	
	$parts=explode('/', $path);

	if($parts[3]=="p_uploads")
	{
		session_start();
		if (isset($_SESSION['session_username']))
		{
			$user = $_SESSION['session_username'];
			if($parts[4]==$user)
			{
				include('simple_image.php');
				$image = new SimpleImage();
				$image->load($_GET['image']);
				$image->output();
			}
			else
			{
				echo 'No permission';
				exit();
			}
		}
		else
		{
			echo 'No permission';
			exit();
		}
	}
	
	include('simple_image.php');
	$image = new SimpleImage();
	$image->load($_GET['image']);
	$image->output();
?>

