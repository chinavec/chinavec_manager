<?php
	//Load Data InFile 'E:/xampp/htdocs/cloudm/research/loadfile/record.txt' Into Table `load_file`
	//windows
	$info = rand() . "	" . date('Y-m-d H:i:s') . "\r\n";
	//unix
	//$info = rand() . "	" . date('Y-m-d H:i:s') . "\n";
	if(error_log($info, 3, 'record.txt')){
		echo 'info: ' . $info .'recorded';
	}else{
		echo 'error';
	}
?>