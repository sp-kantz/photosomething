<!doctype html>
<?php
	session_start();
	if (isset($_SESSION['session_username']))
	{
		$user=$_SESSION['session_username'];
	}
	else
	{
		echo 'Redirecting (User not logged in)';
		header("Location: index.php");
		exit();
	}
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Delete</title>
		<script src="../js/onload.js"></script>
		<script src="../js/validations.js"></script>	
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/delete.css">
	</head>

	<body>

		<?php
			include('lower/header.php');
			include('lower/delete_photo.php');
		?>	
		
		<div id="info">
			<h4><?php echo $title; ?></h4>
		
			<img src="<?php echo $fpath; ?>"/>
		
			<div id="desc"><?php echo $dsc; ?></div>
		
			<span class="tg"><?php echo $tags; ?></span>
		</div>
		<br/>
		<span class="warn">Are you sure?</span>
		
		<form action="delete.php" method="post">
			Yes<input type="radio" name="sure" value="yes"/><br/>
			No<input type="radio" name="sure" value="no" checked="checked"/><br/>
			<input type="submit" name="submit" value="Delete"/>
			<input type="hidden" name="submitted" value="TRUE"/>
			<input type="hidden" name="id" value="<?php echo $photo?>"/>
		</form>
	</body>
</html>
