<?php
    /**
     * 包含数据库操作工具类, 方便数据库操作.
     */
	require('../../../lib/db.class.php');
	$db = new DB();
	
	
	/**
	 * 检查传递的username参数的有效性.
	 */
    if (isset($_POST['username']) && is_string($_POST['username']) == TRUE ){
	     $username = $_POST['username'];
    }
	else {
		 return false;
		 exit;
	}
	
	/**
     * 查找传递的参数username对应的ID.
     */
	  
	$sql = "select `user`.`id` from `user` where `user`.`username` = '$username'";
	$result = $db->select_one($sql);
	if ($result) {
	    $userID = $result->id;
	}
	else {
		return false;
		exit;
	}
	
	
	/**
	 *检查videoID的有效性.
	 */
	if (isset($_POST['videoID']) && is_numeric($_POST['videoID']) == TRUE && $_POST['videoID'] > 0){
	    $videoID = $_POST['videoID'];
    }
	else {
	    return false;
		exit;
	}
	
	/**
	 * 检查返回起始项的有效性.
	 */
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

	/** 
	 * 检查返回列表数的有效性.
	 */
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
	
	 /**
     * 从数据库中读取用户观看的具体视频的相关信息.
     */
	function mulitScreenInteractiveM($userID,$videoID,$offset,$nums,$db){
		 $mulitScreenInteractiveM = array();
		 $mulMsql = "SELECT `video`.`title`,`user_view_history`.`video_position`,`user_view_history`.`view_time` 
		        FROM `video` JOIN `user_view_history` ON  `video`.`id` = `user_view_history`.`video_id` 
				WHERE `user_view_history`.`user_id` = $userID AND `user_view_history`.`video_id` = $videoID
				ORDER BY `user_view_history`.`view_time` DESC LIMIT $offset,$nums";
	     $mulMresult = $db->select($mulMsql);
		 
		 //从数据库中获取读出信息的条数.
		 $sql = "SELECT count(*) FROM `user_view_history` WHERE `user_view_history`.`user_id` = $userID AND `user_view_history`.`video_id` = $videoID";
   		 $count = $db->count($sql);
		 $mulitScreenM = array();
		 
		 /** 
		  * 从数据库中循环读取.
		  */
		 foreach ($mulMresult as $key => $item){
		     $mulitM = array();
			 $mulitM['title'] = $item -> title;
			 $mulitM['video_position'] = $item -> video_position;
			 $mulitM['view_time'] = $item -> view_time;
			 $mulitScreenM[] = $mulitM;
		 }
		 $mulitScreenInteractiveM['mulitScreenM'] = $mulitScreenM;
		 $mulitScreenInteractiveM['count'] = $count;
		 return $mulitScreenInteractiveM;
	}
	
	/**
     * 从数据库中读取用户观看的最近的视频的相关信息.
     */
	function mulitScreenInteractive($userID,$offset,$nums,$db) {
	     $mulitScreenInteractive = array();
		 $mulsql = "SELECT `video`.`title`,`user_view_history`.`video_position`,`user_view_history`.`view_time` 
		        FROM `video` JOIN `user_view_history` ON  `video`.`id` = `user_view_history`.`video_id` 
				WHERE `user_view_history`.`user_id` = $userID ORDER BY `user_view_history`.`view_time` DESC LIMIT $offset,$nums";
	     $mulresult = $db->select($mulsql);
		 $sql = "SELECT count(*) FROM `user_view_history` WHERE `user_view_history`.`user_id` = $userID";
   		 $count = $db->count($sql);
		 $mulitScreen = array();
		 foreach ($mulresult as $key => $item){
		     $mulit = array();
			 $mulit['title'] = $item -> title;
			 $mulit['video_position'] = $item -> video_position;
			 $mulit['view_time'] = $item -> view_time;
			 $mulitScreen[] = $mulit;
		 }
		 $mulitScreenInteractive['mulitScreen'] = $mulitScreen;
		 $mulitScreenInteractive['count'] = $count;
		 return $mulitScreenInteractive;
	}
	
	/**
     * 如果$videoID有值,则调用mulitScreenInteractiveM()函数.
	 * 如果$videoID没有值,则调用mulitScreenInteractive()函数.
     */
	if ($videoID) {
	     if(mulitScreenInteractiveM($userID,$videoID,$offset,$nums,$db)){
		     echo json_encode(mulitScreenInteractiveM($userID,$videoID,$offset,$nums,$db));
			 systemLog('从数据库中读取数据成功', 1, 2, $db); //用日志记录数据表执行成功.
		 }
		 else {
		     echo false;
			 systemLog('从数据库中读取数据失败', 1, 5, $db); //用日志记录数据表执行失败.
		 }
	}
	else {
	     if(mulitScreenInteractive($userID,$offset,$nums,$db)){
		     echo json_encode(mulitScreenInteractive($userID,$offset,$nums,$db));
			 systemLog('从数据库中读取数据成功', 1, 2, $db); //用日志记录数据表执行成功.
		 }
		 else {
		     echo false;
			  systemLog('从数据库中读取数据失败', 1, 5, $db); //用日志记录数据表执行失败.
		 }
	}
	
	
	
	
?>