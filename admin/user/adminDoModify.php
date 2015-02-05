<?php
	require('../../config/config.php');
	require('config/config.php');
	require('../../lib/db.class.php');
	require('class/admin.class.php');
	require('../../lib/util.class.php');
	//print_r($_POST);exit;
	$u = new Util();
	$db = new DB();
	$b = new Admin($db);
	
	$username = $u->inputSecurity($_POST['username']);
	$real_name = $u->inputSecurity($_POST['real_name']);
	$password = $u->inputSecurity($_POST['password']);
	$contact = $u->inputSecurity($_POST['contact']);
	$department = $u->inputSecurity($_POST['department']);
	$position = $u->inputSecurity($_POST['position']);
	$work_permit = $u->inputSecurity($_POST['work_permit']);
	$admin_role_id = $u->inputSecurity($_POST['admin_role_id']);
	
	$id = isset($_POST['adminID']) ? $_POST['adminID'] : 0;
	if(ctype_digit($id) && $id > 0){
		$info = $b->setAdminID($id);
	
			$back = $config['root'] . 'admin/user/adminUpdate.php?id=' . $id;
			
			$b->setValue(array('username' => $username, 'real_name' => $real_name, 'password' => $password, 'contact' => $contact,'department' => $department, 'position' => $position, 'work_permit' => $work_permit,'admin_role_id' => $admin_role_id));
			$result = $b->update();
			if($result['operation']){
				//启动业务成功
				header("Location: admin.php?info=".urlencode('修改管理员信息成功'));
			}else{
				//跳转到错误信息页面
				$errorURL =  "../../common/error.php?error=".urlencode($result['info'])."&back=".urlencode($back);
				header("Location: " . $errorURL);
			}
		
	}else{
		//跳转到错误信息页面
			$back = $config['root'] . 'admin/user/';
			$errorURL =  "../../common/error.php?error=".urlencode("没有找到对应的管理员")."&back=".urlencode($back);
			header("Location: " . $errorURL);
	}
	$db->close();
?>