<?php
	header('Content-Type: text/html; charset=utf-8');
	require('../../lib/db.class.php');
	require('class/user.class.php');
	require('../../lib/util.class.php');
	//print_r($_POST);exit;
	
	$u = new Util();
	$db = new DB();
	$b = new User($db);
	
	$access_array = $_POST['access'];
	
	$name = $u->inputSecurity($_POST['name']);
	$password = md5($u->inputSecurity($_POST['password']));
	$real_name = $u->inputSecurity($_POST['real_name']);
	$mp = $u->inputSecurity($_POST['mp']);
	//$nick_name = $u->inputSecurity($_POST['nick_name']);
	$address = $u->inputSecurity($_POST['address']);
	$email = $u->inputSecurity($_POST['email']);
	$gender = $u->inputSecurity($_POST['gender']);
	$log_off = $u->inputSecurity($_POST['log_off']);
	
	$id = isset($_POST['userID']) ? $_POST['userID'] : 0;
	if(ctype_digit($id) && $id > 0){
		$info = $b->setUserID($id);
	
			$back = $config['root'] . 'admin/user/userUpdate.php?id=' . $id;
			
			$b->setValue(array('name' => $name, 'password' => $password,'real_name' => $real_name,  'mp' => $mp,'address' => $address,'email' => $email,'gender' => $gender,'log_off' => $log_off ));
			$b->setValueaccess($access_array);
			
			$result = $b->update();
			if($result['operation']){
			//print_r($result);
			//exit();
				//启动业务成功
				header("Location: user.php?info=".urlencode('修改管理员信息成功'));
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
