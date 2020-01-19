<!doctype html>
<?php
	session_start();
	if (isset($_SESSION['session_username']))
	{
		$user = $_SESSION['session_username'];
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
		<title>Edit</title>
		<script src="../js/onload.js"></script>
		<script src="../js/validations.js"></script>	
		<script src="../js/edit_geoloc.js"></script>
		<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/edit.css">
		<link rel="stylesheet" href="../css/tagcloud.css">
	</head>
	<body>
		<?php
			include('lower/header.php');
			include('lower/tagcloud.php');	
			include('lower/edit_info.php');
			include('lower/get_tags.php');
			mysqli_close($con);			
		?>
		<div id="location"></div>
		<div id="form1">
		<form name="edit_form" method="post" action="edit.php?id=<?php echo $photo;?>" onsubmit="return validate_edit()">
				Title:<br/><input type="text" name="title" value="<?php echo $title; ?>"/>
				<br/>
				Description:<br/><textarea name="description" rows="5" cols="20"><?php echo $dsc; ?></textarea>
				<br/>
				Tags: <em>(e.g.: Patras, λιμάνι,...)</em><br/><input type="text" name="tags" value="<?php echo $tags; ?>"/>
				<br/>
				Privacy:<br/>
				Private<input type="radio" name="Privacy" value="Private" <?php if($priv==0) echo 'checked="checked"'; ?> />
				
				Public<input type="radio" name="Privacy" value="Public" <?php if($priv==1) echo 'checked="checked"'; ?> />
				<br/>
				<input type="hidden" name="lat" value="<?php echo $latit;?>"/>
				<input type="hidden" name="long" value="<?php echo $longit;?>"/>

				<b>!</b><em>Change location by dragging the marker on the map!</em><br/>
				<input type="submit" value="Save changes" name="submit"/>
		</form>
	
		<a href="delete.php?id=<?php echo $photo;?>">Delete Photo</a>
		</div>
		</div>
		<div id="map">	
		</div>
	</body>
</html>
