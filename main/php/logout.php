<?php
  session_start();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Logging out</title>
	</head>
	<?php 
		if(!isset($_SESSION['session_username']))
		{
			echo 'Redirecting (not logged in)';
			header("Location: index.php");
			exit();
		}
		else
		{
			$_SESSION = array();
			session_unset();
			session_destroy();
			setcookie(session_name(), '', time()-300);
			echo 'Redirecting (Logged out successfully)';
			header("Location: index.php");
			exit();
		}
	?>
	<body>
	</body>
</html>

