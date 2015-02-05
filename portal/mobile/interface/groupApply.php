<?php
session_start(); 
include('../../../lib/connect.php');                                       
require('../../../lib/db.class.php');

$db = new DB();
                                           
$userName   = $_REQUEST['user_name']    ? $_REQUEST['user_name']    : '';//用户名
$email      = $_REQUEST['email']        ? $_REQUEST['email']        : '';//邮箱
$unit       = $_REQUEST['unit']         ? $_REQUEST['unit']         : '';//单位
$realName   = $_REQUEST['real_name']    ? $_REQUEST['real_name']    : '';//真实姓名
$nickName   = $_REQUEST['nick_name']    ? $_REQUEST['nick_name']    : '';//昵称
$gender     = $_REQUEST['gender'] == 1  ? $_REQUEST['gender']       : 0; //性别，1男0女
$address    = $_REQUEST['address']      ? $_REQUEST['address']      : '';//地址
$contact    = $_REQUEST['contact']      ? $_REQUEST['contact']      : '';//电话
$groupId    = $_REQUEST['group_id']      ? $_REQUEST['group_id']      : '';
//其余参数类似，有一些默认值可以不用传入参数，例如状态等等，

$sql = "select * from `user` where `username` = '$userName'";
$result = $db->select_one($sql);
$userID = $result -> id;
//echo $userID;

if(!$email) {
    echo json_encode(array('code' => 1,'msg' => '0邮箱不可为空'));
    exit;
}
if(!$unit) {
    echo json_encode(array('code' => 1,'msg' => '1单位不可为空'));
    exit;
}
if(!$realName ) {
    echo json_encode(array('code' => 1,'msg' => '2真实姓名不可为空'));
    exit;
}

if(!$address) {
    echo json_encode(array('code' => 1,'msg' => '4地址不可为空'));
    exit;
}
if(!$contact) {
    echo json_encode(array('code' => 1,'msg' => '5电话不可为空'));
    exit;
}
if(!$groupId) {
    echo json_encode(array('code' => 1,'msg' => '6集团选择不可为空'));
    exit;
}
//类似的其余参数判断
$updateData = array(
    'email'     => $email,
    'unit'      => $unit,
    'real_name' => $realName,
    'nick_name' => $nickName,
    'gender'    => $gender,
    'address'   => $address,
    'contact'   => $contact,
	'group_id'  => $groupId,
	'group_status'  => 1 ,
    //其余参数拼接
);
$update = $db->update('user', $updateData,array('id' =>$userID ));
if($update) {
    //成功
    echo json_encode(array('code' => 0)); //注意返回的code的值，正常的结果为0
}  else {
    echo json_encode(array('code' => 1,'msg' => '7申请集团失败'));
}
