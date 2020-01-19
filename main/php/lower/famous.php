<?php	
	$q="select id, user, privacy from Photos where privacy=1 order by likes desc limit 10";
	
	$pub_path="/var/www/localhost/htdocs/webpage/uploads";
	$th_path="/var/www/thumbnails";
	
	require_once('sql_connect.php');
	$r=mysqli_query($con, $q);
	
	echo "<table border=\"0\"><tr>";
	
	for($i=0;$i<10;$i++)
	{
		$row=mysqli_fetch_array($r, MYSQLI_ASSOC);
		
		if($row['id']=='')
			break;

		echo '
			<td>
				<a href="view_photo.php?id='.$row['id'].'"><img src="lower/scale_image.php?image='.$th_path.'/'.$row['id'].'" /></a>
			</td>';
	
		if(($i+1)%5==0)
			echo '</tr><tr>';	
	}
	
	mysqli_close($con);
	echo "</tr></table>";
?>
