<?php
	function imageProcess($name, $dir, $file, $size, $type='crop', $output = 'jpg'){
		$maxW = intval($size[0]);
		$maxH = intval($size[1]);
		$quality = 100;
		$uploadSize = @getimagesize($file['tmp_name']);
		$uploadWidth  = $uploadSize[0];
		$uploadHeight = $uploadSize[1];
		$uploadType = $uploadSize[2];
		
		switch ($uploadType) {
			case 1: $srcImg = imagecreatefromgif($file['tmp_name']); break;
			case 2: $srcImg = imagecreatefromjpeg($file['tmp_name']); break;
			case 3: $srcImg = imagecreatefrompng($file['tmp_name']); break;
			return false;
		}
		
		if(!isset($srcImg)){return false;}
		
		if($type == 'crop'){
			$ratioX = $maxW / $uploadWidth;
			$ratioY = $maxH / $uploadHeight;
	
			if ($ratioX < $ratioY) { 
				$newX = round(($uploadWidth - ($maxW / $ratioY))/2);
				$newY = 0;
				$uploadWidth = round($maxW / $ratioY);
				$uploadHeight = $uploadHeight;
			} else { 
				$newX = 0;
				$newY = round(($uploadHeight - ($maxH / $ratioX))/2);
				$uploadWidth = $uploadWidth;
				$uploadHeight = round($maxH / $ratioX);
			}
			
			$dstImg = imagecreatetruecolor($maxW, $maxH);
			imagecopyresampled($dstImg, $srcImg, 0, 0, $newX, $newY, $maxW, $maxH, $uploadWidth, $uploadHeight);
	
		}elseif($type == 'resize'){
			$maxScale = $maxW;
			
			if ($uploadWidth > $maxScale || $uploadHeight > $maxScale) {
				if ($uploadWidth > $uploadHeight) {
					$newX = $maxScale;
					$newY = ($uploadHeight*$newX)/$uploadWidth;
				} else if ($uploadWidth < $uploadHeight) {
					$newY = $maxScale;
					$newX = ($newY*$uploadWidth)/$uploadHeight;
				} else if ($uploadWidth == $uploadHeight) {
					$newX = $newY = $maxScale;
				}
			} else {
				$newX = $uploadWidth;
				$newY = $uploadHeight;
			}
			
			$dstImg = imagecreatetruecolor($newX, $newY);
			imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $newX, $newY, $uploadWidth, $uploadHeight);
		}else{
			$newX = $maxW;
			$newY = $maxH;
			$dstImg = imagecreatetruecolor($newX, $newY);
			imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $newX, $newY, $uploadWidth, $uploadHeight);
		}			
		
		switch ($output) {
			case 'jpg':
				$write = imagejpeg($dstImg, $dir. $name . '.jpg', $quality);
				break;
			case 'png':
				$write = imagepng($dstImg,  $dir.$name . '.png', $quality);
				break;
			case 'gif':
				$write = imagegif($dstImg, $dir.$name . '.gif', $quality);
				break;
		}
		
		imagedestroy($dstImg);
		
		if ($write) {
			return true;
		} else {
			return false;
		}
	}
?>