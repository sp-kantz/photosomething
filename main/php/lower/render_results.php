<?php

	$th_path="/var/www/thumbnails";
	$r=mysqli_query($con, $q);
				
	$paging=mysqli_num_rows($r)/10;
				
	$j=10;
	
	if(isset($page))
	{
		if(is_numeric($page))
		{				
			$j=$j+$page*10;
		}
	}
				
	$k=$j-10;
		
	echo "<table border=\"0\"><tr>";

	for($i=0;$i<$j;$i++)
	{
		$row=mysqli_fetch_array($r, MYSQLI_ASSOC);
		if($i<$k)
			continue;
			
		if($row['id']=='')
			break;

		echo '
			<td>
				<a href="view_photo.php?id='.$row['id'].'"><img src="lower/scale_image.php?image='.$th_path.'/'.$row['id'].'"/></a>	
			</td>';
	
		if(($i+1)%2==0)
			echo '</tr><tr>';
	}	
	mysqli_close($con);
	echo "</tr></table>";
?>
