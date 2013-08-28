<?php
	session_start();
	require_once('thumb.php');  
	
	function generateGuid() {
	    mt_srand((double) microtime() * 10000);
	    $charid = strtoupper(md5(uniqid(rand(), true)));
	    $guid = substr($charid,  0, 8) . '-' .
	            substr($charid,  8, 4) . '-' .
	            substr($charid, 12, 4) . '-' .
	            substr($charid, 16, 4) . '-' .
	            substr($charid, 20, 12);
	    return $guid;
	}

	$directorio_original = 'uploads/thumb/';
	
	$last_id = generateGuid();
	imageProcess($last_id, $directorio_original, $_FILES['Filedata'], array(745,800), 'crop');	
	echo $last_id;
?>