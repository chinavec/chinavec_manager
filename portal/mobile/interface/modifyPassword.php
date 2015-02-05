<?php
session_start(); 
	require('../../../lib/connect.php');                                    
	require('../../../config/config.php');
	require('../../../lib/db.class.php');
$db = new DB();

//$userID     = $_SESSION['user_name'];                                            
$userName   = $_REQUEST['user_name']    ? $_REQUEST['user_name']    : '';//用户名
$password 	= $_REQUEST['password']    ? $_REQUEST['password']    : '';//原密码
$password1  = $_REQUEST['password1']    ? $_REQUEST['password1']    : '';//新密码
$password2  = $_REQUEST['password2']    ? $_REQUEST['password2']    : '';//确认新密码

//echo $userName;


$sql = "select * from `user` where `username` = '$userName'";
$result = $db->select_one($sql);
$userID = $result -> id;
//echo $userID;

//密码检测
if(!$password1) {
    echo json_encode(array('code' => 1,'msg' => '0请填写密码'));
    exit;
}
if(!$password2) {
    echo json_encode(array('code' => 1,'msg' => '1请填写确认密码'));
    exit;
}
if($password1 != $password2) {
    echo json_encode(array('code' => 1,'msg' => '2两次密码不一致'));
    exit;
}
if(strlen($password1) < 6) {
    echo json_encode(array('code' => 1,'msg' => '3密码长度必须大于6'));
    exit;
}


//类似的其余参数判断
	$updateData = array(
		'password'  => md5($password1), //加密措施，此处md5加密，注意登录时的密码也需要先加密
	);
$update = $db->update('user', $updateData, array('id' =>$userID ));

if($update) {
    //成功
    echo json_encode(array('code' => 0)); //注意返回的code的值，正常的结果为0
}  else {
    echo json_encode(array('code' => 1,'msg' => '4修改密码失败'));
}
