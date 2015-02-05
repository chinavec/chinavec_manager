<?php
	/**
	 *接口功能：对用户登录进行验证
	 *参数：用户名（username），密码（password）
	 */
	require('../../../lib/db.class.php');
	require('../../../config/config.php');
		
	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	//$username = 'hello';
	//$password = 'world';
	
	if($username != '' && $password != ''){
		$db = new DB();
		$result = $db->select_condition_one('user', array('username' => $username, 'password' => $password));
		if(!empty($result)){
			$token = md5(microtime());
			$db->update('user', array('token' => $token, 'login_time' => strtotime('now')), array('id' => $result->id));
			$info = array('operation' => 1, 'info' => '登录成功', 'token' => $token, 'userID' => $result->id, 'userName' => $result->username);
		}else{
			$info = array('operation' => 0, 'info' => '用户名或密码错误');
		}
	}else{
		$info = array('operation' => 0, 'info' => '用户名或密码为空');
	}
	echo json_encode($info);
?>