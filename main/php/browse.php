<!doctype html>
<?php
	session_start();
	include('lower/header.php');	
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>PhotoSth - Browsing Photos</title>
		<script src="../js/onload.js"></script>
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/tagcloud.css">
		<link rel="stylesheet" href="../css/browse.css">
	</head>

	<body>
		<?php
			include('lower/tagcloud.php');	
		?>
		<div id="gallery">
		<?php
			$page=0;
			if(isset($_GET['page']))
				$page = $_GET['page'];	

			$priv_path = "/var/www/p_uploads";
			$pub_path = "/var/www/localhost/htdocs/webpage/uploads";
			require_once('lower/sql_connect.php');

			if (isset($_SESSION['session_username']))
			{
				$user = $_SESSION['session_username'];
				$q = "select id, user, privacy from Photos where Photos.privacy='1' or Photos.user = '{$user}' order by upload_date desc";
			}
			else
			{
				$q = "select  id, user, privacy  from Photos where Photos.privacy='1' group by id order by upload_date asc";				
			}
			
			include('lower/render_results.php');
			
			echo 'Page: ';
			for($i=1;$i<($paging+1);$i++)
			{
				echo '<a href="browse.php?page='.($i-1).'">'.$i.' </a>';
			}	
		?>	
		</div>
	</body>	
</html>
