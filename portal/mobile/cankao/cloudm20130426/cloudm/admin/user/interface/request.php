<?php
	require('../../../config/config.php');
	require('../../../lib/http_client.class.php');

	$interfaceAddress = 'http://' . $config['paymentServer'] . $config['root'] .
					'admin/user/interface/interfaceExample.php';
	$http = new Http_Client();
	$http->addPostField('id', 45);
	$result = json_decode($http->Post($interfaceAddress), true);
	print_r($result);
?>