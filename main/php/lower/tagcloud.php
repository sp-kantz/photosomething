<?php
	require_once('sql_connect.php');
	
	$tags=array();
	$maximum=0;
	
	$q="select tag, count from Tags order by count desc limit 22";
	
	$r=mysqli_query($con, $q);
	
	while($row=mysqli_fetch_array($r, MYSQLI_ASSOC))
	{
		$tag=$row['tag'];
		$count= $row['count'];
		
		if($tag!=='TagMe')
		{
		
			if($count>$maximum)
				$maximum=$count;
 
			$tags[]=array('tag' => $tag, 'count' => $count);
		}
	}
?>
<div id="tagcloud">
		<h3>Tags</h3>
			<?php
				foreach($tags as $tg)
				{
					 $percent=floor(($tg['count'] / $maximum) * 100);

					if($percent<20)
						$class='smallest';
 					elseif ($percent >= 20 and $percent < 40)
						$class = 'small';
					elseif ($percent >= 40 and $percent < 60)
						$class = 'medium';
					elseif ($percent >= 60 and $percent < 80)
						$class = 'large';
					else
						$class = 'largest';
			
					echo '<span class="'.$class.'"> ';
					echo '<a href="search.php?search='.$tg['tag'].'&where=tags">'.$tg['tag'].'</a>'.'</span>';
				}
			?>
		</div>
