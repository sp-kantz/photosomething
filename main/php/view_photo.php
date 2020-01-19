<!doctype html>
<?php
	session_start();
	if(isset($_SESSION['session_username']))
	{
		$user=$_SESSION['session_username'];
	}	
	
	$photo=$_GET['id'];

	$priv_path="/var/www/p_uploads";
	$pub_path="/var/www/localhost/htdocs/webpage/uploads";

	require_once('lower/sql_connect.php');	
	include('lower/get_photo_info.php');	
?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>PhotoSth - <?php echo $title; ?></title>
		<script src="../js/onload.js"></script>
		<script src="../js/validations.js"></script>
		<script src="../js/likes.js"></script>
		<script src="../js/view_geoloc.js"></script>
		<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<link rel="stylesheet" href="../css/tagcloud.css">
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/view_photo.css">
	</head>
	<body>
		<?php
			include('lower/header.php');
			include('lower/tagcloud.php');		
		?>
		<div id="info">
			<div id="title">
				<span class="tt"><?php echo $title; ?></span><br/> 
				<em>by</em>  <span class="usr"><?php echo $usr; ?></span> <em>on</em> <span class="dt"><?php echo $dt; ?></span> </div>

				<img src="<?php echo $fpath; ?>"/>
				<?php
					if(isset($_SESSION['session_username']))
					{
						if($usr==$user)
						{
							echo '<div id="user">';
							if($priv==0)
							{
								echo 'Private';
							}
							else
							{
								echo 'Public';
							}
							echo '<br/><a href="edit.php?id='.$photo.'">Edit</a> <br/>';
							echo '</div>';
						}
				
						echo '<input type="hidden" id="photo" value="'.$photo.'" name="photo"/>';
						echo '<div id="buttons">';
						if(isset($liked))
						{
							if($liked)
							{
								echo '<input type="submit" id="like" disabled="true" onclick="like(this.value)" value="Like" name="like"/>';
								echo '<input type="submit" id="dislike" onclick="dislike(this.value)" value="Dislike" name="dislike"/>';
							}
							else
							{
								echo '<input type="submit" id="like" onclick="like(this.value)" value="Like" name="like"/>';
								echo '<input type="submit" id="dislike" disabled="true" onclick="dislike(this.value)" value="Dislike" name="dislike"/>';
							}
						}
						else
						{
							echo '<input type="submit" id="like" onclick="like(this.value)" value="Like" name="like"/>';
							echo '<input type="submit" id="dislike" onclick="dislike(this.value)" value="Dislike" name="dislike"/>';
						}
						echo '</div>';
					}
				?>
			<div id="bars">
				Likes: <?php echo $likes; ?>
				<div id="lbar" style="width:<?php echo $like_per; ?>%"></div>
				Dislikes: <?php echo $dislikes; ?>
				<div id="dbar" style="width:<?php echo $dislike_per; ?>%"></div>
			</div>
			
			<div id="desc"><?php echo $dsc; ?></div>
			
			<input id="lat" type="hidden" name="lat" value="<?php echo $lat; ?>"/>
			<input id="long" type="hidden" name="long" value="<?php echo $long; ?>"/>
		
			<br/> <b> Tags: </b>
			<span class="tg">
				<?php include('lower/get_linked_tags.php'); ?>
			</span><br/>
			<div id="com_sec">
				<div class="add_com">
				<?php if(isset($_SESSION['session_username']))
				{	
				?>	
					<form name="comment_form" method="post" action="view_photo.php?id=<?php echo $photo; ?>" onsubmit="return validate_comment()">
						Add a comment:<br/>
						<textarea name="comment" rows="5" cols="20">Comment here</textarea>
						<br/>
						<input type="submit" value="Post" name="post"/>
					</form>
				<?php } ?>
				
				</div>

				<br/><b>Comments:</b>
				<?php
					include('lower/get_comments.php');
				?>
			</div>
		</div>
		<div id="location">
			<div id="map">
			</div>
		</div>	
	</body>
</html>
