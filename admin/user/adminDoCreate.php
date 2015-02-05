<?php
	require('../../config/config.php');
	require('../../lib/db.class.php');
	require('class/admin.class.php');
	require('../../lib/util.class.php');
	
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
	
	
	$b->setValue(array('username' => $username, 'real_name' => $real_name, 'password' => $password, 'contact' => $contact, 'department' => $department, 'position' => $position, 'work_permit' => $work_permit, 'admin_role_id' => $admin_role_id));
	$info = $b->create();
	
	if($info['operation']){
		//创建业务成功
		header('Location: admin.php?info='.urlencode('新建管理员信息成功'));
	}else{
		//跳转到错误信息页面
		$back = $config['root'] . 'admin/user/adminCreat.php';
		$errorURL =  "../../common/error.php?error=".urlencode($info['info'])."&back=".urlencode($back);
		header("Location: " . $errorURL);
	}
	
	$db->close();
?>