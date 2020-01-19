<?php
	session_start();

	$input='';
	
	if(isset($_POST['submit']))
	{
		if(isset($_POST['search']))
		{
			$input=$_POST['search'];
		}
	}
	
	if(isset($_GET['search']))
	{
		$input=$_GET['search'];
	}

	$where=1;
	
	if(isset($_GET['where']))
	{
		if($_GET['where']=='all')
		{
			$where=1;
		}
		elseif($_GET['where']=='tags')
		{
			$where=0;
		}
		else
			;
	}		
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>PhotoSth - Search</title>
		<script src="../js/validations.js"></script>
		<script src="../js/onload.js"></script>
		<script src="../js/fetch_tags.js"></script>
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/tagcloud.css">
		<link rel="stylesheet" href="../css/forms.css">
		<link rel="stylesheet" href="../css/browse.css">
		<link rel="stylesheet" href="../css/search.css">
	</head>
	<body onload="<?php if($where==1) echo 'check0()'; else echo 'check1()'; ?>">
		<?php
			include('lower/header.php');
			include('lower/tagcloud.php');
		?>

		<div id="search">
		<form name="search_form" action="search.php?where=<?php if($where==1) echo 'all'; else echo 'tags' ?>&search=<?php echo $input; ?>" method="get">
			Everything <input onclick="check0()" type="radio" name="where" value="all" <?php if($where==1) echo 'checked="checked"'; ?>/>
			Tags Only<input onclick="check1()" type="radio" name="where" value="tags" <?php if($where==0) echo 'checked="checked"'; ?>/><br/>
			Search: <input onkeyup = "searcha( this.value )" type="text" name="search" value="<?php echo $input; ?>"/>
			<div id = "names">
			</div>			
		</form>
		</div>

		<div id="gallery">	
		<?php
			require_once('lower/sql_connect.php');
			
			if($where)
			{
				include('lower/search_all.php');
			}
			else
			{
				include('lower/search_tags.php');
			}	
		?>	
		</div>
	</body>
</html>
