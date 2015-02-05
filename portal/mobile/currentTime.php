<?php
/*
	创建时间：		2013年5月28日
	编写人：			于鉴桐
	版本号：			v1.0
	
	修改记录：		原始版本v1.0
								
	主要功能点：		将前一个页面获取到的$currentTime以及用户ID、videoID传递给对方接口，即业务管理的“用户历史记录”接口。
	
	全局配置变量：		$config['root'] = '/cloudm/';
					$config['paymentServer'] = '222.31.73.204';	               
					$config['portalServer'] = '222.31.73.204';             
					$config['userServer'] = '222.31.73.204';				

*/

	session_start();
	
	require('../../config/config.php'); 
	require('config/portalConfig.php');
	require('../../lib/http_client.class.php');
	
	$currentTime = floor($_POST['currentTime']);
	$videoID = $_POST['videoID'];
	
	//判断用户是否已登录
	if(isset($_SESSION['username'])){
			$username = $_SESSION['username'];
		}
		else{
			echo '您还未登录，此功能需登录后使用';
			exit;	
		}

	
//******用户观看历史记录接口（业务管理子系统）***********************************************

	//与接口相对应的request文件,给接口传递所学的参数.
	$interfaceAddress =	'http://'.$config['paymentServer'].$config['root'].'portal/mobile/interface/userViewHistoryDB.php';
	$http = new Http_Client(); //给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交.
	$http->addPostField('username', $username); //参数username的值为'liboran'.
	$http->addPostField('videoID', $videoID); //参数videoID的值为63.
	$http->addPostField('viewProgress', $currentTime); //参数viewProgress的值为20.
	
	$result = json_decode($http->Post($interfaceAddress), true); //发起请求，返回值是接口返回的数据.
	//echo $result['state'];
//*********************************************************************************************	

	if($result['state']){
		echo '保存成功';
		}
	else{
		echo '保存失败，请稍后再试';
		}
?>