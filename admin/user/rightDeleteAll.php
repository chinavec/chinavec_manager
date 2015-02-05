<?php
	require('../../config/config.php');
	require('../../lib/db.class.php');
	require('class/right.class.php');
	
	$db = new DB();
	$b = new Right($db);
	//print_r($_POST);exit;
	$back = $config['root'] . 'admin/user/';
	$id = isset($_POST['id']) ? $_POST['id'] : array();
	$from = isset($_GET['from']) ? $_GET['from'] : $config['root']."admin/user/userRight.php";
	foreach($id as $_id){
		$info = $b->setRightID($_id);
		if($info['operation']){
			$result = $b->delete();
			if(!$result['operation']){
				//跳转到错误信息页面
				$errorURL =  "../../common/error.php?error=".urlencode($result['info'])."&back=".urlencode($from);
				header("Location: " . $errorURL);
				exit();
			}
		}else{
			$errorURL =  "../../common/error.php?error=".urlencode($info['info'])."&back=".urlencode($from);
			header("Location: " . $errorURL);
			exit();
		}
	
	}
	header("Location: " . $from);
	
	$db->close();  
?>