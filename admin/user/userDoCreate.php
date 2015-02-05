<?php
	require('../../config/config.php');
	require('config/config.php');
	require('../../lib/db.class.php');
	require('class/user.class.php');
	require('../../lib/util.class.php');
	//print_r($_POST);exit;
	$u = new Util();
	$db = new DB();
	$b = new User($db);
	
	$name = $u->inputSecurity($_POST['name']);
	$password = md5($u->inputSecurity($_POST['password']));
	$real_name = $u->inputSecurity($_POST['real_name']);
	$mp = $u->inputSecurity($_POST['mp']);
	//$nick_name = $u->inputSecurity($_POST['nick_name']);
	$address = $u->inputSecurity($_POST['address']);
	$email = $u->inputSecurity($_POST['email']);
	$sex = $u->inputSecurity($_POST['sex']);
	$log_off = $u->inputSecurity($_POST['log_off']);
	
	$access_array = $_POST['access'];
		
	$b->setValue(array('name' => $name, 'password' => $password,'real_name' => $real_name,  'mp' => $mp,'address' => $address,'email' => $email,'gender' => $sex,'log_off' => $log_off ));
	$b->setValueaccess($access_array);
	
	$info = $b->create();
	
	if($info['operation']){
		//创建业务成功
		header('Location: user.php?info='.urlencode('新建用户信息成功'));
	}else{
		//跳转到错误信息页面
		$back = $config['root'] . 'admin/user/userCreat.php';
		$errorURL =  "../../common/error.php?error=".urlencode($info['info'])."&back=".urlencode($back);
		header("Location: " . $errorURL);
	}
	
	$db->close();
?>
