<div id="header">
		<a href="index.php"><img src="../items/banner.jpg" alt="banner" width="100%" height="120px" border="0" align="center" /></a>
		
		<table >
			<tr>
				<td><a href="index.php">Home</a></td>
				<?php
					if (isset($_SESSION['session_username']))
					{
						echo '<td><a href="profile.php">Profile</a></td><td><a href="logout.php">Logout</a></td>';
					}
					else
					{
						echo '<td><a href="login.php">Login</a></td><td><a href="register.php">Register</a></td>';
					}
				?>
				<td><a href="browse.php">Browse</a></td>
				<td><a href="search.php">Search</a></td>
			</tr>
		</table>
</div>
