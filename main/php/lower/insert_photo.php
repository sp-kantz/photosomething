<?php

	function insert_photo($size)
	{
		require_once('sql_connect.php');
		$t = $_FILES['upload']['name'];
		$u = $_SESSION['session_username'];
		$d = "Description not available";
		$l = "Unknown";
		$p = 0;
		$tags='TagMe';
		$likes=0;
		$dislikes=0;

		if($size>0)
		{	
			$q="select space from Users where username='$u'";
			$r= mysqli_query($con, $q);
			while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
			{
				$space=$row['space'];
				$diff=$space-$size;
				echo $size;
				echo $diff;
				if($diff>0)
				{
					$q1="update Users set space=$diff where username='$u'";
	
					$r1 = mysqli_query($con, $q1);

					if(mysqli_affected_rows($con)==1)
					{
						$q3='insert into Photos (title, user, description, privacy, tags, likes, dislikes, upload_date) values (?, ?, ?, ?, ?, ?, ?, NOW())';
						$stmt = mysqli_prepare($con, $q3);
						mysqli_stmt_bind_param($stmt, 'sssisii', $t, $u, $d, $p, $tags, $p, $p);
						mysqli_stmt_execute($stmt);

						if(mysqli_stmt_affected_rows($stmt)==1)
						{
							$id = mysqli_stmt_insert_id($stmt);

							$q4="insert into Tagged (tag_id, photo_id) values (?, ?)";
							$dt=1;

							$stmt = mysqli_prepare($con, $q4);
							mysqli_stmt_bind_param($stmt, 'ii', $dt, $id);
							mysqli_stmt_execute($stmt);

							mysqli_stmt_close($stmt);
							mysqli_close($con);
							
							return $id;
						}	

						mysqli_stmt_close($stmt);
						mysqli_close($con);
						return 0;
					}
				}
				else
				{
					return -1;
				}
			}
		}
		return 0;
	}
?>
