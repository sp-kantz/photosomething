<?php
	header('Content-type: text/xml; charset=ISO-8859-7');

	$input = $_GET['tags'];

	$conds='';
	
	$tags=explode(' ', trim($input));
	
	for($i=0;$i<sizeof($tags);$i++)
	{
		if($tags[$i]!=='')
		{
			$conds=$conds.'tag like \''.$tags[$i].'%\'';
			if($i!==(sizeof($tags)-1))
			{
				if($tags[$i]!=='')
					$conds=$conds.' or ';
			}
		}
	}
	
	if($conds!=='')
	{
		$q="select tag from Tags where $conds order by count desc limit 6";
	
	
		require_once('sql_connect.php');

		$r=mysqli_query($con, $q);
		echo '<tags>';
		while($row=mysqli_fetch_array($r, MYSQLI_ASSOC))
		{

		echo '<tag>'.$row['tag'].'</tag>';
		}
	echo '</tags>';
	}
?>


