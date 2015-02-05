<?php 
     /**
	  * 与接口相对应的request文件,给接口传递所需的参数.
	  * 徐磊
	  * 2013-5-5(时间)
	  * V1.0(版本)
	  */
	  
	require('../../config/config.php'); 
	require('config/portalConfig.php');
	require('../../lib/http_client.class.php');
	//调用接口地址.
	$interfaceAddress = 'http://localhost/cloudm/portal/mobile/interface/mulitScreenInteractive.php';
	//给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交.
	$http = new Http_Client();
	//参数username的值为'liboran'.
	$http->addPostField('username', 'admin'); 
	//参数videoID的值为51.
	$http->addPostField('videoID', 2); 
	//参数offset的值为0.
	$http->addPostField('offset', 0); 
	//参数nums的值为2.
	$http->addPostField('nums', 2); 
	//发起请求，返回值是接口返回的数据.
	//echo $http->Post($interfaceAddress);
	$result = json_decode($http->Post($interfaceAddress), true); 
	print_r($result);
?>