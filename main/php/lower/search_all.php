<?php
	$page=0;
	if(isset($_GET['page']))
		$page = $_GET['page'];	
		
	$pub_path = "/var/www/localhost/htdocs/webpage/uploads";
	
	$conds='';
	
	$terms=explode(' ', trim($input));
	
	for($i=0;$i<sizeof($terms);$i++)
	{
		if($terms[$i]!=='')
		{
			$conds=$conds.' +'.$terms[$i];
		}
	}
	
	require_once('sql_connect.php');
	
	$i=0;
	if($conds!=='')
	{
		if (isset($_SESSION['session_username']))
		{
			$user = $_SESSION['session_username'];
			
			$priv_path = "/var/www/p_uploads";
		
			$q = "select id, user, privacy from Photos where match(title, description, tags) against ('$conds' IN BOOLEAN MODE) and (privacy=1 or user='$user') order by likes desc";
		}
		else
		{
			$q = "select id, user, privacy from Photos where match(title, description, tags) against ('$conds' IN BOOLEAN MODE) and privacy=1 order by likes desc";
		}
	
		include('render_results.php');
		
		if($i==0)
		{
			echo 'No photos found</br>';
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
