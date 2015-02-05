<?php
	require('../../lib/db.class.php');
	
	$db = new DB();
	if($db->insert('epg_live_programme', array('name'=>'包括', 'epg_live_channel_id'=>'1', 'abstract'=>'看各地奇闻异事，秀丽风景，人文景观', 'start_time'=>strtotime("-2hours"),'end_time'=>strtotime("now"),'date'=>strtotime("now"),'picture'=>'a2.jpg'))){
		echo 'OK';
	}else{
		echo 'ERROR';
	}
	/*if($db->update('news', array('title' => 'edf', 'content' => '345'), array('id' => 2))){
		echo 'Update Ok';
	}else{
		echo 'Update Error';
	}*/
	
	/*$news = $db->select_condition('news');
	foreach($news as $key => $item){
		echo $item->title . '<br />';
	}*/
	
	/*$news = $db->select_condition_one('news', array('id' => 2));
	echo $news->title;*/
	
	/*$sql = 'SELECT * FROM `news`
			  JOIN `news_type` ON `news`.`news_type_id`=`news_type`.`id`';
	print_r($db->select($sql));*/
	
	/*if($db->delete('news', array('id' => 2))){
		echo 'Delete OK';
	}else{
		echo 'Delete Error';
	}*/
	
	//$sql = 'SELECT COUNT(*) AS `total` FROM `news`';
	/*$result = $db->select_one($sql);
	echo $result->total;*/
	//echo $db->count($sql);
	//$result->
	//echo $news->title;
	//echo $db->last_insert_id();
	//print_r($db->last_insert_id());
	//$db->update('test', array('name'=>'zwp'), array('name'=>'zhengwenping'));
	//$db->delete('test', array('name'=>'zwp'));
	//echo $db->count("select count(*) from `test`", "");
	//print_r($db->select_condition("test", array('id'=>2, 'name'=>'123'), 'OR'));
	
?>