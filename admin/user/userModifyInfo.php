<?php
/**
 * @desc 修改用户信息接口
 * @params
 * 
 * @return int|bool 成功返回0，失败返回1
 */
//require('../../../lib/interfaceAccess.php');
session_start();
$_SESSION['user_id']=1;                                            //测试使用
require('../../../lib/db.class.php');
$db = new DB();

if(!isset($_SESSION['user_id'])) {                                             //session中是否也用user_id
    echo json_encode(array('code' => 1,'msg' => '用户名未登录'));
    exit;
}
$userID     = $_SESSION['user_id'];                                            //session中是否也用user_id
$password1  = $_REQUEST['password1']    ? $_REQUEST['password1']    : '';
$password2  = $_REQUEST['password2']    ? $_REQUEST['password2']    : '';
$email      = $_REQUEST['email']        ? $_REQUEST['email']        : '';
$unit       = $_REQUEST['unit']         ? $_REQUEST['unit']         : '';
$realName   = $_REQUEST['real_name']    ? $_REQUEST['real_name']    : '';
$nickName   = $_REQUEST['nick_name']    ? $_REQUEST['nick_name']    : '';
$gender     = $_REQUEST['gender'] == 1  ? $_REQUEST['gender']       : 0;    //性别，1男0女
$address    = $_REQUEST['address']      ? $_REQUEST['address']      : '';
$contact    = $_REQUEST['contact']      ? $_REQUEST['contact']      : '';
//其余参数类似，有一些默认值可以不用传入参数，例如状态等等，



if(!$password1) {
    echo json_encode(array('code' => 1,'msg' => '请填写密码'));
    exit;
}
if(!$password2) {
    echo json_encode(array('code' => 1,'msg' => '请填写确认密码'));
    exit;
}
if($password1 != $password2) {
    echo json_encode(array('code' => 1,'msg' => '两次密码不一致'));
    exit;
}
//类似的其余参数判断

$updateData = array(
    'username' => $userName,
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
    echo json_encode(array('code' => 1,'msg' => '修改用户信息失败'));
}