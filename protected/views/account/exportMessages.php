<?php
	
	header("Content-type: application/vnd.ms-excel");
	header("Expires: 0"); 
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
	header("content-disposition: attachment;filename=messages.csv");

	ob_clean();
    flush();
	readfile($filename);
	
	exit;
?>