<?php

	require('../../lib/http_client.class.php');
	
	$url = 'http://222.31.88.15/cloudm/admin/payment/interface/login.php';
	$http = new Http_Client();
	$http->addPostField('username', 'liboran');
	$http->addPostField('password', '123');
	print_r(json_decode($http->Post($url), true));
?>