<?php
	require_once('db.class.php'); //ALWAYS KEEP THIS FIRST !!
	require_once('CategoryLister.class.php');
	require_once('User.class.php');
	
	
	
	
	
	
	
	function drawThumbnails($filename)
	{	
		//Get File Extension
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		
		//Setting thumbnail name
		$thumbname = $filename.'_thumb.'.$ext;
		
		if(!file_exists($thumbname))
		{	
			header('Content-type: image/'.$ext);
			$image = new Imagick($filename);

			// If 0 is provided as a width or height parameter,
			// aspect ratio is maintained
			$image->thumbnailImage(100, 100, true);

			$image->writeImage($thumbname);
		}
		
		echo('<img src="'.$thumbname.'">');	
	}
?>
