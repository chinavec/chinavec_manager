<?php
	require('../../config/config.php');
	//require('config/config.php');
	require('../../lib/db.class.php');
	require('class/right.class.php');
	require('../../lib/util.class.php');
	
	$u = new Util();	
	$db = new DB();		
	$b = new Right($db);		
	
	//print_r($_POST);exit;
	$name   = $u->inputSecurity($_POST['name']);
	//$access_array = $_POST['access'];
	//print_r($access_array);exit;
	//print_r(count($_POST['access']));exit;
	
	//print_r($name);exit;
	//$real_name = $u->inputSecurity($_POST['real_name']);
	//$password = $u->inputSecurity($_POST['password']);
	//$contact = $u->inputSecurity($_POST['contact']);
	//$admin_role_id = $u->inputSecurity($_POST['admin_role_id']);
	//print_r($password);exit;
	
	
	//$b->setValue(array('username' => $username, 'real_name' => $real_name, 'password' => $password, 'contact' => $contact,'admin_role_id' => $admin_role_id));
	$b->setValue(array('name' => $name));
	
	//$b->setValueaccess($access_array);
	//print_r($b->access_array);exit;
	$info = $b->create();
	
	
	if($info['operation']){
		//创建业务成功
		header('Location: userRight.php?info='.urlencode('新建角色信息成功'));
	}else{
		//跳转到错误信息页面
		$back = $config['root'] . 'admin/user/rightCreat.php';
		$errorURL =  "../../common/error.php?error=".urlencode($info['info'])."&back=".urlencode($back);
		header("Location: " . $errorURL);
	}
	
	$db->close();
?>