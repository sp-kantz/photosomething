<?php
	if(isset($_POST['submit']))
	{
		require_once('sql_connect.php');

		$data = array_map('trim', $_POST);

		$u = mysqli_real_escape_string($con, $data['username']);

		$p = mysqli_real_escape_string($con, $data['password']);
	
		$q = "select uid, username from Users where username='$u' and password=SHA1('$p')";
	
		$r = mysqli_query($con, $q);

		if(@mysqli_num_rows($r)==1)
		{	
			$row=mysqli_fetch_array($r, MYSQLI_ASSOC);
			$_SESSION['session_username'] = $_POST['username'];
			$_SESSION['session_uid'] = $row['uid'];
			mysqli_free_result($r);
			mysqli_close($con);
			echo 'Redirecting (User logged in)';
			header("Location: index.php");
			exit();
		}		
		else
		{
			echo 'Wrong username or password';
		}
		mysqli_close($con);
	}
?>
