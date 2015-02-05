<?php
    /**
     * 接口文件.
	 * 徐磊
	 * 2013-5-5(时间)
	 * V1.0(版本)
     */
	require('../../../lib/db.class.php');
	require('../../../lib/log.php');
	$db = new DB();
	
	//检查传递的username参数的有效性.
    if (isset($_POST['username']) && is_string($_POST['username']) == TRUE ){
	     $username = $_POST['username'];
    }
	else {
		 return false;
		 exit;
	}
	
	//查找传递的参数username对应的ID.
	  
	$sql = "select `user`.`id` from `user` where `user`.`username` = '$username'";
	$result = $db->select_one($sql);
	if ($result) {
	    $userID = $result->id;
	}
	else {
		return false;
		exit;
	}

	//检查videoID的有效性.
	if (isset($_POST['videoID'])){
	    if ( is_numeric($_POST['videoID']) == TRUE && $_POST['videoID'] > 0){
	        $videoID = $_POST['videoID'];
        }
	    else {
	        return false;
		    exit;
	    }
	}
	//检查返回起始项的有效性.
	if (isset($_POST['offset'])){
	    if (is_numeric($_POST['offset']) == TRUE && $_POST['offset'] >= 0){
		    $offset = $_POST['offset'];
		}
		else {
		    return false;
		    exit;
		}
	}
	else {
	    $offset = 0; 
	}

	//检查返回列表数的有效性.
	if (isset($_POST['nums'])){
	    if (is_numeric($_POST['nums']) == TRUE && $_POST['nums'] > 0){
		    $nums = $_POST['nums'];
		}
		else {
		    return false;
		    exit;
		}
	}
	else {
	    $nums = 5;
	}
	
	//从数据库中读取用户观看的具体视频的相关信息.
	function mulitScreenInteractiveM($userID,$videoID,$offset,$nums,$db){
		 //定义一个数组，用来存储所需的几组视频名字,观看时间和观看进度以及所读的以上信息的条数.
		 $mulitScreenInteractiveM = array();
		 //联合video表和user_view_history表，从中读出视频名字,观看时间和观看进度.
		 $mulMsql = "SELECT `video`.`title`,`user_view_history`.`video_position`,`user_view_history`.`view_time` 
		        FROM `video` JOIN `user_view_history` ON  `video`.`id` = `user_view_history`.`video_id` 
				WHERE `user_view_history`.`user_id` = $userID AND `user_view_history`.`video_id` = $videoID
				ORDER BY `user_view_history`.`view_time` DESC LIMIT $offset,$nums";
	     $mulMresult = $db->select($mulMsql);
		 //从数据库中获取读出信息的条数.
		 $sql = "SELECT count(*) FROM `user_view_history` WHERE `user_view_history`.`user_id` = $userID AND `user_view_history`.`video_id` = $videoID";
   		 $count = $db->count($sql);
		 //定义一个数组,用来存储所需的几组视频名字,观看时间和观看进度.
		 $mulitScreenM = array();
		 //从数据库中循环读取.
		 foreach ($mulMresult as $key => $item){
		     //定义一个数组,用来存储一组视频名字,观看时间和观看进度.
			 $mulitM = array();
			 $mulitM['title'] = $item -> title;
			 $mulitM['video_position'] = $item -> video_position;
			 $mulitM['view_time'] = $item -> view_time;
			 $mulitScreenM[] = $mulitM;
		 }
		 $mulitScreenInteractiveM['mulitScreenM'] = $mulitScreenM;
		 $mulitScreenInteractiveM['count'] = $count;
		 //返回数组值.
		 return $mulitScreenInteractiveM;
	}
	
	//从数据库中读取用户观看的最近的视频的相关信息.
	function mulitScreenInteractive($userID,$offset,$nums,$db) {
	     //定义一个数组，用来存储所需的几组视频名字,观看时间和观看进度以及所读的以上信息的条数.
		 $mulitScreenInteractive = array();
		 //联合video表和user_view_history表，从中读出视频名字,观看时间和观看进度.
		 $mulsql = "SELECT `video`.`title`,`user_view_history`.`video_position`,`user_view_history`.`view_time` 
		        FROM `video` JOIN `user_view_history` ON  `video`.`id` = `user_view_history`.`video_id` 
				WHERE `user_view_history`.`user_id` = $userID ORDER BY `user_view_history`.`view_time` DESC LIMIT $offset,$nums";
	     $mulresult = $db->select($mulsql);
		 //从数据库中获取读出信息的条数.
		 $sql = "SELECT count(*) FROM `user_view_history` WHERE `user_view_history`.`user_id` = $userID";
   		 $count = $db->count($sql);
		 //定义一个数组,用来存储所需的几组视频名字,观看时间和观看进度.
		 $mulitScreen = array();
		 //从数据库中循环读取.
		 foreach ($mulresult as $key => $item){
		     //定义一个数组,用来存储一组视频名字,观看时间和观看进度.
			 $mulit = array();
			 $mulit['title'] = $item -> title;
			 $mulit['video_position'] = $item -> video_position;
			 $mulit['view_time'] = $item -> view_time;
			 $mulitScreen[] = $mulit;
		 }
		 $mulitScreenInteractive['mulitScreen'] = $mulitScreen;
		 $mulitScreenInteractive['count'] = $count;
		 //返回数组值.
		 return $mulitScreenInteractive;
	}
	
	/**
     * 如果$videoID有值,则调用mulitScreenInteractiveM()函数.
	 * 如果$videoID没有值,则调用mulitScreenInteractive()函数.
     */
	if (isset($_POST['videoID'])) {
		 $info = mulitScreenInteractiveM($userID,$videoID,$offset,$nums,$db);
	     if($info){
			 $mulitScreenInteractiveM = $info;
		     echo json_encode($mulitScreenInteractiveM);
			 //用日志记录数据表执行成功.
			 systemLog('从数据库中读取数据成功', 1, 2, $db); 
		 }
		 else {
		     echo json_encode(array('state' => 0));
			 //用日志记录数据表执行失败.
			 systemLog('从数据库中读取数据失败', 1, 5, $db); 
		 }
	}
	else {
		 $info = mulitScreenInteractive($userID,$offset,$nums,$db);
	     if($info){
			 $mulitScreenInteractive = $info;
		     echo json_encode($mulitScreenInteractive);
			 //用日志记录数据表执行成功.
			 systemLog('从数据库中读取数据成功', 1, 2, $db);
		 }
		 else {
		     echo json_encode(array('state' => 0));
			 //用日志记录数据表执行失败.
			 systemLog('从数据库中读取数据失败', 1, 5, $db); 
		 }
	}	
?>