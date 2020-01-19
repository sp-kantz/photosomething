<?php
	$page=0;
	if(isset($_GET['page']))
		$page = $_GET['page'];	
		
	$pub_path = "/var/www/localhost/htdocs/webpage/uploads";
	
	$conds='';
	
	$tags=explode(' ', trim($input));
	
	for($i=0;$i<sizeof($tags);$i++)
	{
		if($tags[$i]!=='')
		{
			$conds=$conds.'Tags.tag=\''.$tags[$i].'\'';
			if($i!==(sizeof($tags)-1))
			{
				if($tags[$i]!=='')
					$conds=$conds.' or ';
			}
		}
	}

	$i=0;
	if($conds!=='')
	{
		if (isset($_SESSION['session_username']))
		{		
			$user = $_SESSION['session_username'];
		
			$priv_path = "/var/www/p_uploads";
	
			$q="select id, user, title, privacy from Photos inner join Tagged on Photos.id=Tagged.photo_id inner join Tags on Tagged.tag_id=Tags.t_id where (Photos.privacy=1 or Photos.user='$user') and ($conds) group by id order by likes desc";		
		}
		else
		{
			$q="select id, user, title, privacy from Photos inner join Tagged on Photos.id=Tagged.photo_id inner join Tags on Tagged.tag_id=Tags.t_id where Photos.privacy=1 and ($conds) group by id order by likes desc";	
		}
			
		include('render_results.php');
		if($i==0)
		{
			echo 'No photos found';
		}
		else
		{
			echo 'Page: ';
			for($i=1;$i<($paging+1);$i++)
			{
				echo '<a href="search.php?where=tags&search='.$input.'&page='.($i-1).'">'.$i.' </a>';
			}
		}
	}
?>
