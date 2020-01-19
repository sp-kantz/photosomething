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
<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Change E-mail</title>
		<script src="../js/onload.js"></script>
		<script src="../js/validations.js"></script>
		<link rel="stylesheet" href="../css/main.css">	
		<link rel="stylesheet" href="../css/forms.css">
	</head>
	<body>
		<?php
			include('lower/header.php');
			include('lower/update_email.php');
		?>
		<div id="change_email">
		<form name="change_email_form" method="post" action="change_email.php" onsubmit="return validate_ch_email()">
			Your new E-mail:
			<input id="input" type="text" name="email">
			<br>
			Confirm With Your Password:
			<input id="pass" type="password" name="password">
			<br>
			<input id="press" type="submit" value="Change" name="submit">
		</form>
		</div>
	</body>
</html>
