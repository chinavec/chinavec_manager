<?php
	/**
	  * 与接口相对应的request文件,给接口传递所学的参数.
	  */
	require('../../../config/config.php'); 
	require('../../../lib/http_client.class.php');
    //调用接口地址
	$interfaceAddress = 'http://' . $config['paymentServer'] . $config['root'] .
					    'admin/user/interface/userViewHistoryDB.php';
	$http = new Http_Client(); //给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交.
	$http->addPostField('username', 'admin'); //参数username的值为'liboran'.
	$http->addPostField('videoID', 2); //参数videoID的值为63.
	$http->addPostField('viewProgress', 20); //参数viewProgress的值为20.
	
	$result = json_decode($http->Post($interfaceAddress), true); //发起请求，返回值是接口返回的数据.
	print_r($result);
?>