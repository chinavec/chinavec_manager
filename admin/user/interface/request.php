<?php
	require('../../../config/config.php');
	require('../../../lib/http_client.class.php');

	$interfaceAddress = 'http://' . $config['paymentServer'] . $config['root'] .
					'admin/user/interface/interfaceExample.php';
	$http = new Http_Client();
	$http->addPostField('para1', 'hello');
	$http->addPostField('para2', 'world');
	$result = json_decode($http->Post($interfaceAddress), true);
	print_r($result);
?>