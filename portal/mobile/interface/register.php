<?php
/**
 * @desc 创建用户接口
 * @params
 * 
 * @return int|bool 成功返回用户的id，失败返回null
 */
//require('../../../lib/interfaceAccess.php');

/*
修改日期：		2013年5月22日
于鉴桐修改记录：	user_name改为username,
				nick_name改为nickname,
				real_name改为realname
 *最后的json_encode里面，删掉了取回最后插入的id值一步，返回信息只有用户名。
 *用户名长度修改为不小于3
 *去掉$unit,$realName,$nickName,$gender,$address,$contact，注册时不需插入这些信息
*/



require('../../../lib/db.class.php');
$db = new DB();


$userName   = $_REQUEST['username']    ? $_REQUEST['username']    : '';
$password1  = $_REQUEST['password1']    ? $_REQUEST['password1']    : '';
$password2  = $_REQUEST['password2']    ? $_REQUEST['password2']    : '';
$email      = $_REQUEST['email']        ? $_REQUEST['email']        : '';

//其余参数类似，有一些默认值可以不用传入参数，例如状态等等

if(!$userName) {
    echo json_encode(array('code' => 1,'msg' => '缺少用户名'));
    exit;
}
if(strlen($userName) < 3) {
    echo json_encode(array('code' => 1,'msg' => '用户名长度必须大于等于3'));
    exit;
}
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

$insertData = array(
    'username' => $userName,
    'password'  => md5($password1), //加密措施，此处md5加密，注意登录时的密码也需要先加密
    'email'     => $email,
    'create_time' => time()
    //其余参数拼接
);
$insert=$db->insert('user', $insertData);
//$userId = $db->last_insert_id();
if($insert) {
    //成功
    echo json_encode(array('code' => 0,'data' => array('username' => $userName))); //注意返回的code的值，正常的结果为0
}  else {
    echo json_encode(array('code' => 1,'msg' => '创建用户失败'));
}