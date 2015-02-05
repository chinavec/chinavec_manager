<?php
	//以二维数组的形式显示
	$userBaseInfo = array(
		'email' => 'a@163.com',
		'money' => '20.00',
		'realname' => '管理员',
		'nickname' => 'ad',
		'gender'=> '女',
		'unit'=>'中国传媒大学',
		'contact' => '13356242210',
		'address' => '北京市朝阳区',
		'group_id' => '1',
		'group_status' => '4'
	);
	
	$userBusiness = array(
		array('businessName'=>'欧美电影套餐','cost'=>'20.00','startTime'=>'2013.2.1','endTime'=>'2013.2.28'),
		array('businessName'=>'春节点播套餐','cost'=>'10.00','startTime'=>'2013.3.1','endTime'=>'2013.3.31'),
		array('businessName'=>'国产精品电视剧套餐','cost'=>'15.00','startTime'=>'2013.4.1','endTime'=>'2013.4.31')
	);
	
	$userHistory = array(
	array('viewTime'=>'
2013-03-10 15:22:13','videoName'=>'快乐大本营','videoPosition'=>'56分23秒'),
	array('viewTime'=>'
2013-03-18 16:23:33','videoName'=>'战马','videoPosition'=>'89分11秒'),
	array('viewTime'=>'
2013-03-16 10:53:46','videoName'=>'悲惨时间','videoPosition'=>'12分11秒')
	);
	
	$userAccount = array(
	array('consumerTime'=>'2013-03-14 13:24:53','fee'=>'20.00'),
	array('consumerTime'=>'2013-03-11 11:24:55','fee'=>'-10.00'),
	array('consumerTime'=>'2013-03-09 10:31:53','fee'=>'30.00'),
	array('consumerTime'=>'2013-03-02 08:54:22','fee'=>'-10.00')
	);
	
	$userInfo['userBaseInfo'] = $userBaseInfo;
	$userInfo['userBusiness'] = $userBusiness;
	$userInfo['userHistory'] = $userHistory;
	$userInfo['userAccount'] = $userAccount;
	
	
	echo json_encode($userInfo);//
?>