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
		<title>PhotoSth - Login</title>
		<script src="../js/validations.js"></script>
		<script src="../js/onload.js"></script>
		<link rel="stylesheet" href="../css/forms.css">
		<link rel="stylesheet" href="../css/main.css">
	</head>
	<body onload="setfocus()">

		<?php
			include('lower/header.php');
			include('lower/check_login.php');
		?>

		<div id="login">
			<form name="login_form" method="post" action="login.php" onsubmit="return validate_login()">
				Username: <input id="input" type="text" name="username">
				<br>
				Password: <input  id="pass" type="password" name="password">
				<br>
				<input id="press" type="submit" value="Login" name="submit">
			</form>
		</div>
	</body>
</html>	
