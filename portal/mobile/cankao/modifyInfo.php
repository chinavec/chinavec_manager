<?php
session_start(); 
include('../conn/connect.php');                                       
require('../lib/db.class.php');
$db = new DB();

//$userID     = $_SESSION['user_name'];                                            
$userName   = $_REQUEST['user_name']    ? $_REQUEST['user_name']    : '';//用户名
$password  = $_REQUEST['password']    ? $_REQUEST['password']    : '';//原密码
$password1  = $_REQUEST['password1']    ? $_REQUEST['password1']    : '';//新密码
$password2  = $_REQUEST['password2']    ? $_REQUEST['password2']    : '';//确认新密码
$email      = $_REQUEST['email']        ? $_REQUEST['email']        : '';//邮箱
$unit       = $_REQUEST['unit']         ? $_REQUEST['unit']         : '';//单位
$realName   = $_REQUEST['real_name']    ? $_REQUEST['real_name']    : '';//真实姓名
$nickName   = $_REQUEST['nick_name']    ? $_REQUEST['nick_name']    : '';//昵称
$gender     = $_REQUEST['gender'] == 1  ? $_REQUEST['gender']       : 0;  //性别，1男0女
$address    = $_REQUEST['address']      ? $_REQUEST['address']      : '';//地址
$contact    = $_REQUEST['contact']      ? $_REQUEST['contact']      : '';//电话
//其余参数类似，有一些默认值可以不用传入参数，例如状态等等，
//echo $userName;
//echo $password;
//echo $gender;

$sql = "select * from `user` where `username` = '$userName'";
$result = $db->select_one($sql);
$userID = $result -> id;
//echo $userID;

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
    'email'     => $email,
    'unit'      => $unit,
    'real_name' => $realName,
    'nick_name' => $nickName,
    'gender'    => $gender,
    'address'   => $address,
    'contact'   => $contact,
    //其余参数拼接
);
$update = $db->update('user', $updateData,array('id' =>$userID ));
if($update) {
    //成功
    echo json_encode(array('code' => 0)); //注意返回的code的值，正常的结果为0
}  else {
    echo json_encode(array('code' => 1,'msg' => '4修改用户信息失败'));
}
