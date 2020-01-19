<?php
	DEFINE('USER', 'root');
	DEFINE('PASSWORD', 'trelaras_4more');
	DEFINE('HOST', 'localhost');
	DEFINE('NAME', 'Web');

	$con=@mysqli_connect(HOST, USER, PASSWORD, NAME);
	
	if(!$con)
	{
		die('Could not connect: ' . mysql_error());			
	}
?>
