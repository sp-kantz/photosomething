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
		<title>Change Password</title>
		<script src="../js/onload.js"></script>
		<script src="../js/validations.js"></script>	
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/forms.css">
	</head>
	<body>
		<?php
			include('lower/header.php');
			
			include('lower/update_pass.php');
		?>
		<div id="change_pass">
		<form name="change_pass_form" method="post" action="change_pass.php" onsubmit="return validate_ch_pass()">
			Current Password:
			<input  id="pass" type="password" name="password">
			<br>
			New Password:
			<input  id="pass" type="password" name="n_password">
			<br>
			Confirm Password:
			<input  id="pass" type="password" name="c_password">
			<br>
			<input id="press" type="submit" value="Change" name="submit">
		</form>
		</div>	
	</body>
</html>
