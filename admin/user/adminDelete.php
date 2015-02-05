<?php
	require('../../config/config.php');
	require('../../lib/db.class.php');
	require('class/admin.class.php');
	
	$db = new DB();
	$b = new Admin($db);
	
	$back = $config['root'] . 'admin/user/';
	$id = isset($_GET['id']) ? $_GET['id'] : 0;
	$from = isset($_GET['from']) ? $_GET['from'] : $config['root']."admin/user/admin.php";
	
	if(ctype_digit($id) && $id > 0){
		$info = $b->setAdminID($id);
		if($info['operation']){
			$result = $b->delete();
			if($result['operation']){
				//删除管理员成功
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