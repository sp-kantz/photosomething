<!doctype html>
<?php
	session_start();
	if(isset($_SESSION['session_username']))
	{
		$user=$_SESSION['session_username'];
	}
	else
	{
		echo 'Redirecting (User not logged in)';
		header("Location: index.php");
		exit();
	}
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>PhotoSth Upload</title>
		<script src="../js/onload.js"></script>
		<link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/forms.css">
	</head>
	<body>
		<?php
			include('lower/header.php');		

			if(isset($_POST['submitted']))
			{
				if(isset($_FILES['upload']))
				{
					$allowed=array('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
					if(in_array($_FILES['upload']['type'], $allowed))
					{
						include('lower/images.php');
						$result=process_image_upload();

 						if($result==0)
						{
							echo '<br>An error occurred while processing upload';
						}
						elseif($result==-1)
						{
							echo 'No space left to upload';
						}
						else
						{
							echo '<br/>image saved';
						}
					}
					else
					{
						echo 'filetype not allowed';
					}
				}

				if($_FILES['upload']['error']>0)
				{
					echo 'File could not be uploaded because: ';
					
					switch ($_FILES['upload']['error'])
					{
						case 1:
							print 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
							break;
						case 2:
							print 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
							break;
						case 3:
							print 'The uploaded file was only partially uploaded.';
							break;
						case 4:
							print 'No file was uploaded.';
							break;
						case 6:
							print 'Missing a temporary folder.';
							break;
						case 7:
							print 'Failed to write file to disk.';
							break;
						case 8:
							print 'A PHP extension stopped the file upload.';
						default:
							print 'A system error occurred.';
							break; 
					}
				}
				
				if(file_exists($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']))
				{
					unlink($_FILES['upload']['tmp_name']);
				}

				if($result>0)
				{
					header("Location: edit.php?id=$result");
					exit();
				}
			}
		?>
	<div id="upload">
		<form enctype="multipart/form-data" name="upload_form" action="upload.php" method="post">
			<input type="hidden" name="MAX_FILE_SIZE" value="52428800"/>
				<legent>Choose your file to upload</legent>
				<p>
				File:
				<input type="file" name="upload">
				</p>
			<input id="press" type="submit" name="submit" value="Upload" />
			<input type="hidden" name="submitted" value="TRUE" />
		</form>
	</div>	
	</body>
</html>
