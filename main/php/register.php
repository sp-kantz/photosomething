<?php
	session_start();
	
	if (isset($_SESSION['session_username']))
	{
		echo 'Redirecting (User logged in)';
		header("Location: index.php");
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>PhotoSth - Register</title>
		<script src="../js/validations.js"></script>
		<script src="../js/onload.js"></script>
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/forms.css">
	</head>
	<body onload="setfocus()">
		<?php
			include('lower/header.php');
			include('lower/check_register.php');
		?>

		<div id="register">
		<form name="register_form" method="post" action="register.php" onsubmit="return validate_register()">
			Username:
			<input id="input" type="text" name="username">
			<br>
			Password:
			<input  id="pass" type="password" name="password">
			<br>
			Confirm Password:
			<input  id="pass" type="password" name="r_password">
			<br>
			E-mail:
			<input id="input" type="text" name="email">
			<br>
			<input id="press" type="submit" value="Register" name="submit">
		</form>
		</div>
	</body>
</html>
