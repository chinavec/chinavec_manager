<?php
	require('../../config/config.php');
	require('../../lib/db.class.php');
	require('class/right.class.php');
	
	$db = new DB();
	$b = new Right($db);
	
	$back = $config['root'] . 'admin/user/';
	$id = isset($_GET['id']) ? $_GET['id'] : 0;
	$from = isset($_GET['from']) ? $_GET['from'] : $config['root']."admin/user/userRight.php";
	
	if(ctype_digit($id) && $id > 0){
		$info = $b->setRightID($id);
		if($info['operation']){
			$result = $b->delete();
			if($result['operation']){
				//删除角色成功
				header('Location: ' . $from);
			}else{
				//跳转到错误信息页面
				$errorURL =  "../../common/error.php?error=".urlencode($result['info'])."&back=".urlencode($from);
				header("Location: " . $errorURL);
			}
		}else{
			$errorURL =  "../../common/error.php?error=".urlencode($info['info'])."&back=".urlencode($from);
			header("Location: " . $errorURL);
		}
	}else{
		$errorURL =  "../../common/error.php?error=".urlencode('没有找到对应的业务')."&back=".urlencode($from);
		header("Location: " . $errorURL);
	}
	
	$db->close();  
?>