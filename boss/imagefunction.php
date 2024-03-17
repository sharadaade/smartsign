<?php
//$catImage = uploadImage('fleImage', SRV_ROOT . 'images/category/');
	function uploadImage($inputName, $uploadDir)
	{
	//echo $inputName;die;
    $image     = $_FILES[$inputName];
    $imagePath = '';
    
    // if a file is given
    if (trim($image['tmp_name']) != '') {
        // get the image extension
        $ext = substr(strrchr($image['name'], "."), 1); 

        // generate a random new file name to avoid name conflict
        $imagePath = md5(rand() * time()) . ".$ext";
        
		// check the image width. if it exceed the maximum
		// width we must resize it
		$size = getimagesize($image['tmp_name']);
		
		//if ($size[0] > MAX_CATEGORY_IMAGE_WIDTH) 
		if ($size[0] > 960) 
		{
     	  	//$imagePath = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_CATEGORY_IMAGE_WIDTH);
			//createThumbnail($image['tmp_name'],SRV_ROOT . 'images/category/big_img/'.$imagePath, $size[0]);
			//createThumbnail($image['tmp_name'],SRV_ROOT . 'images/category/middle_img/'.$imagePath, 400);
			//$imagePath = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, 120);
			$imagePath = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, 500);
			//createThumbnail($image['tmp_name'],$uploadDir .'/big_img/'.$imagePath, $size[0]);
			createThumbnail($image['tmp_name'],$uploadDir .'big_img/'.$imagePath,960);
			//createThumbnail($image['tmp_name'],$uploadDir .'/middle_img/'.$imagePath, 500);
			
			//$imagePath = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, 120);
			//createThumbnail($image['tmp_name'],$uploadDir .'/big_img/'.$imagePath, $size[0]);
			//createThumbnail($image['tmp_name'],$uploadDir .'/middle_img/'.$imagePath, 400);
			
		} else {
			// move the image to category image directory
			// if fail set $imagePath to empty string
			if($size[0]<500)
			{
				$imagePath = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, $size[0]);
			}
			else
			{
				$imagePath = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, 500);
			}
			createThumbnail($image['tmp_name'],$uploadDir .'big_img/'.$imagePath,$size[0]);
			/*if (!move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath)) {
				$imagePath = '';
			}*/
		}	
    }
	return $imagePath;
	}
	function createThumbnail($srcFile, $destFile, $width, $quality = 175)
	{
	$thumbnail = '';
	
	if (file_exists($srcFile)  && isset($destFile))
	{
		$size        = getimagesize($srcFile);
		$w           = number_format($width, 0, ',', '');
		$h           = number_format(($size[1] / $size[0]) * $width, 0, ',', '');
		$thumbnail =  copyImage($srcFile, $destFile, $w, $h, $quality);
	}
	
	// return the thumbnail file name on sucess or blank on fail
	return basename($thumbnail);
	}

/*
	Copy an image to a destination file. The destination
	image size will be $w X $h pixels
*/
	function copyImage($srcFile, $destFile, $w, $h, $quality = 75)
	{
    $tmpSrc     = pathinfo(strtolower($srcFile));
    $tmpDest    = pathinfo(strtolower($destFile));
    $size       = getimagesize($srcFile);

    if ($tmpDest['extension'] == "gif" || $tmpDest['extension'] == "jpg"|| $tmpDest['extension'] == "jpeg")
    {
       $destFile  = substr_replace($destFile, 'jpg', -3);
       $dest      = imagecreatetruecolor($w, $h);
       imageantialias($dest, TRUE);
    } elseif ($tmpDest['extension'] == "png") {
       $dest = imagecreatetruecolor($w, $h);
       imageantialias($dest, TRUE);
    } else {
      return false;
    }

    switch($size[2])
    {
       case 1:       //GIF
           $src = imagecreatefromgif($srcFile);
           break;
       case 2:       //JPEG
           $src = imagecreatefromjpeg($srcFile);
           break;
       case 3:       //PNG
           $src = imagecreatefrompng($srcFile);
           break;
       default:
           return false;
           break;
    }

    imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);

    switch($size[2])
    {
       case 1:
       case 2:
           imagejpeg($dest,$destFile, $quality);
           break;
       case 3:
           imagepng($dest,$destFile);
    }
    return $destFile;
	}
?>
