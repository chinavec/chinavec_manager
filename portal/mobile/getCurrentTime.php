<?php
/*
	创建时间：		2013年5月27日
	编写人：			于鉴桐
	版本号：			v1.0
	
	修改记录：		原始版本v1.0				写定breakTime数据，能够利用该数据控制播放器，是播放器选择由已写定的时间开始播放
					2013.5.28修改版本v1.1		添加接口的request请求
								
	主要功能点：		通过与业务管理子系统的“多屏互动接口”获得用户观看的当期视频的上次播放时间，传回给videoPlay.php页面，控制播放器的播放进度。	
	
	全局配置变量：		$config['root'] = '/cloudm/';
					$config['paymentServer'] = '222.31.73.204';	               
					$config['portalServer'] = '222.31.73.204';             
					$config['userServer'] = '222.31.73.204';	
*/
	session_start();
	
	require('../../config/config.php'); 
	require('config/portalConfig.php');
	require('../../lib/http_client.class.php');
	
	$videoID = $_POST['videoID'];
	
	//判断用户是否已登录
	if(isset($_SESSION['username'])){
			$username = $_SESSION['username'];
		}
		else{
			echo '您还未登录，此功能需登录后使用';
			exit;	
		}
	
	//$info = array('breakTime' => 10);
	//echo json_encode($info);
	
	$interfaceAddress = 'http://'.$config['paymentServer'].$config['root'].'portal/mobile/interface/mulitScreenInteractive.php';
	 //给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交.
	$http = new Http_Client();
	 //参数username的值.
	$http->addPostField('username', $username); 
	 //参数videoID的值.
	$http->addPostField('videoID', $videoID); 
	 //参数offset的值为0.
	$http->addPostField('offset', 0); 
	 //参数nums的值为1.
	$http->addPostField('nums', 1); 
	 //发起请求，返回值是接口返回的数据.
	 //echo $http->Post($interfaceAddress);
	$result = json_decode($http->Post($interfaceAddress), true); 
	//print_r($result);
	//echo '</br>';
	//print_r($result['mulitScreen']);
	$info = array('breakTime' => $result['mulitScreenM']['0']['video_position']);
	echo json_encode($info);
?>