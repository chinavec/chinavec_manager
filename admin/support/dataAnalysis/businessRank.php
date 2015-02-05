<?php
/*
 *业务排行接口
 *肖亚翠
 *V1.0
 *2013-5-20
 *V2.0
 *2013-5-29 在统计业务点击量联合查询语句中加上条件`business`.`label_id`=2，说明是电视剧类型
 */
	require('../../../lib/http_client.class.php');
	require('../../../lib/db.class.php');
	
	//定义数组变量
	$rank = array();
	//实例化数据库操作类
	$db = new DB();
	//统计过去一周的数据
	$time = strtotime('-1 week');
	//联合查询数据表只关于电视剧类型的点击量
	$sql = "SELECT SUM(`video_view_statistics`.`view_total`) AS `view_total`,`business`.`id`
			FROM `video_view_statistics`
			JOIN `business_video` ON `video_view_statistics`.`video_id` = `business_video`.`video_id`
			JOIN `business` ON `business`.`id` = `business_video`.`business_id`
			WHERE `business`.`state` =1 AND `business`.`label_id`=2 AND `video_view_statistics`.`s_time` > $time
			GROUP BY `business`.`id`
			ORDER BY `view_total` DESC
			LIMIT 20";
			
	//调用数据库查询类
	$rank = $db->select($sql);
	print_r($rank);
	//门户管理的接口地址222.31.73.176
	$interfaceAddress = 'http://222.31.73.176/cloudm/admin/support/dataAnalysis/businessRankInterface.php';
	//实例化http post请求类
	$http = new Http_Client();
	//设置传过去的数据
	$http->addPostField('rank', json_encode($rank));
	//用jason传数据
	$result = json_decode($http->Post($interfaceAddress),true);
	//关闭数据库
	$db->close();
?>