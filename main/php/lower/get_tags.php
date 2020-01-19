<?php
	$tags="";

	$q="select tag from Tags inner join Tagged on Tags.t_id=Tagged.tag_id where Tagged.photo_id=$photo";

	$r = mysqli_query($con, $q);

	while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
	{	
		$tags=$tags.$row['tag'].', ';		
	}
?>
