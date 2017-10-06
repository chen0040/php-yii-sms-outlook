<?php	
	header("Content-type: application/octet-stream");
	header("Expires: 0"); 
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
	header("content-disposition: attachment;filename=dump.sql");

	ob_clean();
    flush();
	readfile($filename);
	
	exit;
?>