<?php
	class SimpleImage
	{
		var $image;
		var $image_type;
 
		function load($filename) 
		{
			$image_info=getimagesize($filename);
			$this->image_type=$image_info[2];
			if($this->image_type==IMAGETYPE_JPEG ) 
			{
				$this->image=imagecreatefromjpeg($filename);
			} 
			elseif($this->image_type==IMAGETYPE_GIF ) 
			{
				$this->image=imagecreatefromgif($filename);
			} 
			elseif($this->image_type==IMAGETYPE_PNG) 
			{
			 	$this->image=imagecreatefrompng($filename);
			}
		}

		function output($image_type=IMAGETYPE_JPEG) 
		{
			if($image_type==IMAGETYPE_JPEG) 
			{
				imagejpeg($this->image);
			} 
			elseif($image_type==IMAGETYPE_GIF) 
			{
				imagegif($this->image);
			} 
			elseif($image_type==IMAGETYPE_PNG) 
			{
				imagepng($this->image);
			}
		}
	}
?>
