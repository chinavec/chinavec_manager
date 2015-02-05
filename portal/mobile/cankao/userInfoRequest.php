<?php 
    require('../../../config/config.php');
	require('../../../lib/http_client.class.php');

	$interfaceAddress = 'http://' . $config['paymentServer'] . $config['root'] .
					'admin/user/interface/userInfo.php';
	$http = new Http_Client();
	$http->addPostField('username', 'liboran');
	//type是一个数组，0代表需要显示个人信息，1代表需要显示已订购的业务信息，2代表需要显示充值和消费信息
	$http->addPostField('type', array(0,1,2)); 
	//offset是列表的起始项
	$http->addPostField('offset', 0);
	//nums是返回列表数
	$http->addPostField('nums', 2);
	
	
	$result = json_decode($http->Post($interfaceAddress), true);
	print_r($result);

 
?>


