<!doctype html>
<?php
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>PhotoSth</title>
		<script src="../js/validations.js"></script>
		<script src="../js/onload.js"></script>
		<script src="../js/fetch_locations.js"></script>
		<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/tagcloud.css">
		<link rel="stylesheet" href="../css/index.css">
	</head>
	<body>
		<?php
			include('lower/header.php');
		?>	
		<?php
			include('lower/tagcloud.php');	
		?>
		
		<span class="sp">Popular Photos</span>
		<div id="famous">
			<?php
				include('lower/famous.php');	
			?>
		</div>
	
		<span class="sp">Photos Near You</span>
		<div id="map_index">
		
		</div>
		
	</body>

</html>
