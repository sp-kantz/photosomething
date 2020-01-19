<?php
	if(!isset($_SESSION['session_username']))
	{
		echo ' (<a href="login.php">Login</a> or <a href="register.php">Register</a> to post a comment)';
	}
	echo '<br/>';
		
	$q4 = "select comment, user, com_date from Comments where Comments.photo_id = $photo order by com_date desc";

	$r3 = mysqli_query($con, $q4);

	while($row3=mysqli_fetch_array($r3, MYSQLI_ASSOC))
	{
		$comment=$row3['comment'];
		$u=$row3['user'];
		$cdat=$row3['com_date'];

		echo '<ul class="ul">
				<li><span class="usr">'.$u.'</span> <em>on</em> <span class="dt">'.$cdat.'</span><br/><div class="com">'.$comment.'</div></li>
			</ul>';
	}
	mysqli_close($con);
?>
