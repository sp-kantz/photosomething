<?php 
	if(isset($_POST['submit']))
	{
		require_once('lower/sql_connect.php');

		$data = array_map('trim', $_POST);

		$pass = mysqli_real_escape_string($con, $data['password']);

		$new_pass = mysqli_real_escape_string($con, $data['n_password']);
				
		$q="select username from Users where username='$user' and password=SHA1('$pass')";
				
		$r = mysqli_query($con, $q);

		if(@mysqli_num_rows($r)==1)
		{
			$q1="update Users set password=SHA1('$new_pass') where username='$user'";
					
			$r1 = mysqli_query($con, $q1);
					
			if(mysqli_affected_rows($con)==1)
			{
				echo 'Password changed</br>';
						
				echo '<a href=profile.php>Return to your profile</a></br>';
				mysqli_close($con);
				exit();
			}
			else
			{
				echo 'Error on update';
			}
		}
		else
		{
			echo 'Wrong password';
		}
		mysqli_close($con);
	}
?>
