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
		<title>PhotoSth <?php echo $user; ?></title>
		<script src="../js/onload.js"></script>
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/profile.css">
	</head>
	<body>
		<?php
			include('lower/header.php');		
			require_once('lower/fetch_profile.php');
			if($width>=48)
				$color='#45a041';
			elseif(($width>24)&&($width<48))
				$color='#a09641';
			else
				$color='#a04141';
			echo '
		
				<style type="text/css">
					#space
					{
					width:'.$width.'%;
					position:relative;
					padding-top: 20px;
					margin-top: 0%;
					margin-left: 0%;
					margin-right: 0%;
					margin-bottom:0%;
					background-color:'.$color.';
					text-align:center;
					}
				</style> ';
		?>

		<div>
			<div id="table">
				<table>
					<tr>
						<td><a href="upload.php">Upload Image</a></td>
						<td><a href="change_pass.php">Change your Password</a></td>
						<td><a href="change_email.php">Change your E-mail</a></td>
					</tr>
				</table>
			</div>
			<div id="bar"><span>Space left: <?php echo $space; ?> MB</span>
				<div id="space">
		
				</div>
			</div>
			<span id="text">Your Gallery</span>
			<div id="gallery">
	
			<?php
				$page=0;
				if(isset($_GET['page']))
					$page=$_GET['page'];					

				$priv_path="/var/www/p_uploads";
				$pub_path="/var/www/localhost/htdocs/webpage/uploads";
				$th_path="/var/www/thumbnails";
			
				include('lower/render_results.php');
		
				if($i==0)
				{
					echo 'No photos uploaded';
				}
				else
				{
					echo 'Page: ';
					for($i=1;$i<($paging+1);$i++)
					{
						
						echo '<a href="profile.php?page='.($i-1).'">'.$i.' </a>';
					}
				}
			?>	
			</div>
		</div>
	</body>
</html>
