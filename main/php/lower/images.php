<?php
	define('IMAGE_MAX_WIDTH', 1280);
	define('IMAGE_MAX_HEIGHT', 1024);
	
	define('THUMBNAIL_IMAGE_MAX_WIDTH', 250);
	define('THUMBNAIL_IMAGE_MAX_HEIGHT', 200);

	function generate_image_thumbnail($source_image_path, $mode)
	{
	
		if($mode==1)
		{
			$thumbnail_image_width=IMAGE_MAX_WIDTH;
			$thumbnail_image_height=IMAGE_MAX_HEIGHT;
		}
		else
		{
			$thumbnail_image_width=THUMBNAIL_IMAGE_MAX_WIDTH;
			$thumbnail_image_height=THUMBNAIL_IMAGE_MAX_HEIGHT;
		}
	
		list($source_image_width, $source_image_height, $source_image_type)=getimagesize($source_image_path);

		switch($source_image_type)
		{
			case IMAGETYPE_JPEG:
				$source_gd_image=imagecreatefromjpeg($source_image_path);
				break;

			case IMAGETYPE_PNG:
				$source_gd_image=imagecreatefrompng($source_image_path);
				break;
		}

		if($source_gd_image===false)
		{
			return 0;
		}

		$source_aspect_ratio=$source_image_width / $source_image_height;
		$thumbnail_aspect_ratio=$thumbnail_image_width / $thumbnail_image_height;

		if($source_image_width <= $thumbnail_image_width && $source_image_height <= $thumbnail_image_height)
		{
			return 1;
		}
		elseif($thumbnail_aspect_ratio > $source_aspect_ratio)
		{
			$thumbnail_image_width=(int)($thumbnail_image_height * $source_aspect_ratio);
		}
		else
		{
			$thumbnail_image_height=(int)($thumbnail_image_width / $source_aspect_ratio);
		}

		$thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);

		imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, 	$source_image_width, $source_image_height);

		imagejpeg($thumbnail_gd_image, $source_image_path, 100);

		imagedestroy($source_gd_image);
		imagedestroy($thumbnail_gd_image);

		return 2;
	}


	function process_image_upload()
	{
		list( , , $temp_image_type)=getimagesize($_FILES['upload']['tmp_name']);

		if($temp_image_type===NULL)
		{
			return false;
		}

		switch($temp_image_type)
		{
			case IMAGETYPE_JPEG:
				break;

			case IMAGETYPE_PNG:
				break;

			default:
				return false;
		}

		$temp_path='/var/www/p_uploads/temp'.$_SESSION['session_username'].'/'.md5($_FILES['upload']['name']);

		move_uploaded_file($_FILES['upload']['tmp_name'], $temp_path);

		$result=generate_image_thumbnail($temp_path, 1);

		include('insert_photo.php');
		if($result==0)
		{
			return 0;
		}
		else
		{
			$size=filesize($temp_path)/1000000;
			$photo=insert_photo($size);
			if($photo==-1)
			{
				unlink($temp_path);
				return -1;
			}

			$pr_path="/var/www/p_uploads/{$_SESSION['session_username']}/$photo";
			$v=copy($temp_path, $pr_path);
			
			$th_path="/var/www/thumbnails/$photo";
			$result=generate_image_thumbnail($temp_path, 2);

			$v=copy($temp_path, $th_path);
			if($v)
			{
				unlink($temp_path);
				return $photo;
			}
			return 0;		
		}

		return $result ? array($temp_path, $pr_path): false;
	}
?>
