<?php
	if(isset($_POST['submit']))
	{
		require_once('sql_connect.php');

		$data = array_map('trim', $_POST);

		$email = mysqli_real_escape_string($con, $data['email']);
		$pass = mysqli_real_escape_string($con, $data['password']);
				
		$q="select username from Users where username='$user' and password=SHA1('$pass')";
				
		$r = mysqli_query($con, $q);

		if(@mysqli_num_rows($r)==1)
		{
			$q1="select username from Users where email='$email'";
					
			$r1=mysqli_query($con, $q1);
					
			if(@mysqli_num_rows($r1)==0)
			{
				$q2="update Users set email='$email' where username='$user'";
					
				$r2 = mysqli_query($con, $q2);
					
				if(mysqli_affected_rows($con)==1)
				{
					echo 'E-mail changed</br>';
						
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
				echo 'E-mail already in use.';
			}
		}
		else
		{
			echo 'Wrong password';
		}
		mysqli_close($con);
	}
?>
