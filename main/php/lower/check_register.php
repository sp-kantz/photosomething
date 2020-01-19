<?php
	if(isset($_POST['submit']))
	{		
		require_once('sql_connect.php');

		$data = array_map('trim', $_POST);

		$u = mysqli_real_escape_string($con, $data['username']);
		$p = mysqli_real_escape_string($con, $data['password']);
		$e = mysqli_real_escape_string($con, $data['email']);
				
		$space=50;

		$q1 = "select username from Users where username='$u'";
		$q2 = "select email from Users where email='$e'";
			
		$r1 = mysqli_query($con, $q1);

		if(mysqli_num_rows($r1)==0)
		{
			$r2 = mysqli_query($con, $q2);

			if(mysqli_num_rows($r2)==0)
			{
				$q = "insert into Users(username, password, email, space) values ('$u', SHA1('$p'), '$e', $space)";

				$r3 = mysqli_query($con, $q);

				if(mysqli_affected_rows($con)==1)
				{
					echo '<h4>Thank you for registering.</h4>';
			
					if (!mkdir("/var/www/localhost/htdocs/webpage/uploads/$u", 0777)) 
					{
						die('Failed to create folders...');
					}
					if (!mkdir("/var/www/p_uploads/$u", 0777)) 
					{
						die('Failed to create folders...');
					}
					if (!mkdir("/var/www/p_uploads/temp$u", 0777)) 
					{
						die('Failed to create folders...');
					}
					exit();	
				}
				else
				{
					echo 'register prob';
				}
			}
			else
			{
				echo 'email already used';
			}
		}
		else
		{
			echo 'name already exists';
		}		
		mysqli_close($con);
	}
?>
