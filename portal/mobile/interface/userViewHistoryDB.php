<?php
    /**
     * 接口文件.
	 * 徐磊
	 * 2013-5-5(时间)
	 * V1.0(版本)
     */
	require('../../../lib/db.class.php');
	require('../../../lib/log.php');
	$db=new DB();
	
	//检查username的有效性.
	if (isset($_POST['username']) && is_string($_POST['username']) == TRUE ){
	     $username = $_POST['username'];
    }
	else {
	     echo "[]";
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
	if (isset($_POST['videoID']) && is_numeric($_POST['videoID']) == TRUE && $_POST['videoID'] > 0){
	     $videoID = $_POST['videoID'];
    }
	else {
	     return false;
		 exit;
	}
    //得出id = $videoID的视频的总数.
	$videoSql = "SELECT COUNT(*) FROM `video` WHERE `video`.`id` = '$videoID'"; 
	$videoResult = $db->count($videoSql);
	
	//设置当前时间为观看时间.
	$viewTime = strtotime('NOW');
	
	//检查观看进度的有效性.
	if (isset($_POST['viewProgress']) && is_numeric($_POST['viewProgress']) == TRUE && $_POST['viewProgress'] > 0) {
	    $viewProgress = $_POST['viewProgress'];
	}
	else {
	     return false;
		 exit;
	}
	
	//将用户的观看历史信息插入数据库.
	function userViewHistoryInsert($userID,$videoID,$viewTime,$viewProgress,$db){
	    return $db->insert('user_view_history', array('user_id'=>$userID, 'video_id'=>$videoID, 'video_position' => $viewProgress, 'view_time' => $viewTime));
	}	
	
	//如果数据库中有用户的观看历史信息则去更新.
	function userViewHistoryUpdate($userID,$videoID,$viewTime,$viewProgress,$db){
	    return $db->update('user_view_history', array('user_id'=>$userID, 'video_id'=>$videoID, 'video_position' => $viewProgress, 'view_time' =>$viewTime), array('user_id' => $userID,'video_id' => $videoID));
	}
	
	//将用户的观看历史信息从数据库中删除.
	function userViewHistoryDelete($db) {
	    strtotime('-30 day');
        $sql = "delete from `user_view_history` where `view_time` <" . strtotime('-30 day');
        $result = $db->query($sql);
	    return $result;
	}
	
	 //从数据库中获取读出信息的条数.
	 $totalSql = "SELECT COUNT(*) FROM `user_view_history` WHERE `user_id` = $userID AND `video_id` = $videoID";
	 $totalResult = $db->count($totalSql);
	 
	 /**
	  * 如果result有值,则去更新对应的数据表.
	  * 如果result没值,而且video表中存有与videoID相对应的视频ID,则去插入数据表,否则不插入.
	  */
	if ($totalResult){
	    if(userViewHistoryUpdate($userID,$videoID,$viewTime,$viewProgress,$db)){
		    $userViewHistoryUpdate = array('state' => 1);
		    echo json_encode($userViewHistoryUpdate);   
            //用日志记录数据表执行成功.
			systemLog('更新数据库中user_view_history表成功', 1, 2, $db); 			 
		}
		else {
		    echo json_encode(array('state' => 0));
			//用日志记录数据表执行失败.
			systemLog('更新数据库中user_view_history表失败', 1, 5, $db); 
		}
	}
	else {
	    if ($videoResult) {
		    if (userViewHistoryInsert($userID,$videoID,$viewTime,$viewProgress,$db)) {
			    $userViewHistoryInsert = array('state' => 1);
		        echo json_encode($userViewHistoryInsert);
		        //用日志记录数据表执行成功.	
			    systemLog('插入数据库中user_view_history表成功', 1, 2, $db); 
			}
			else {
			    echo json_encode(array('state' => 0));
				//用日志记录数据表执行失败.
			    systemLog('插入数据库中user_view_history表失败', 1, 5, $db); 
			}
		}
		else {
		    echo json_encode(array('state' => 0));
            //用日志记录数据表执行失败.
			systemLog('插入数据库中user_view_history表失败', 1, 5, $db); 
		}
	}
?>