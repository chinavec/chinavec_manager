<?php
	/**
	 *接口功能：返回业务列表
	 *参数：用户id（id）
	 */
	require('../../../lib/interfaceAccess.php');
	
	$id = $_POST['id'];
	$result['id'] = $id;
	$result['name'] = 'zhengwenping';
	$result['gender'] = 1;
	echo json_encode($result);	
?>