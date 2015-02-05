<?php
	include('../conn/connect.php');
	require('../lib/db.class.php');
	$db=new DB();
	
	//$username=$_POST['username'];
	//$type=$_POST['type'];
	//$offset=$_POST['offset'];
	//echo $username;
	//echo $type;
	//echo $offset;
	if (isset($_POST['username']) && is_string($_POST['username']) == TRUE ){
	     $username = $_POST['username'];
    }
	else {
	     echo "[]";
		 exit;
	}
	$sql="select `user`.`id` from `user` where `user`.`username` = '$username'";
	$result= $db->select_one($sql);
	$userID=$result->id;
	
	//type是一个数组
	$type = array();
	if (isset ($_POST['type'])){
	     $type = $_POST['type'];
	}
	else {
	     echo "[]";
		 exit;
	}
   
    //$offset = 0;
   //检查返回起始项的有效性
	if (isset($_POST['offset']) && is_numeric($_POST['offset']) == TRUE && $_POST['offset'] > 0){
	     $offset = $_POST['offset'];
    }
	else {
	     $offset = 0; 
	}

	//$nums = 5;
	//检查返回列表数的有效性
	if (isset($_POST['nums']) && is_numeric($_POST['nums']) == TRUE && $_POST['nums'] > 0){
	   $nums = $_POST['nums'];
	}
	else {
	   $nums = 5;
	}
	
	
	//显示个人基本信息
    function userBaseInfo($userID,$db){
	     $userBaseInfoSql = "SELECT `user`.`username`,`user`. `email`,`user`.`unit`,`user`.`real_name`,`user`.`nick_name`,`user`.`gender`,
		                  `user`.`address`,`user`.`contact`,`user`.`group_status`,`user`.`group_id`,`user_account`.`money` 
	                        FROM `user` JOIN `user_account` ON `user`. `id` = `user_account`.`user_id` WHERE `user`.`id` = $userID";

         $userBaseInfoResult = $db->select_one($userBaseInfoSql);
		 return $userBaseInfoResult;
    }
 
 
	//显示已订购的业务信息
	function userBusiness ($userID,$offset,$nums,$db) {
	     $u = array();
		 $userBusinessSql = "SELECT `business`.`name`,`user_business`.`cost`,`user_business`.`start_time`,`user_business`.`end_time` 
	                         FROM `business` JOIN `user_business` ON `business`.`id` = `user_business`.`business_id` WHERE `user_business`.`user_id` = $userID  
						     ORDER BY `user_business`.`subscribe_time` DESC LIMIT $offset,$nums";
		 $userBusinessResult = $db->select($userBusinessSql);
		 //记录总数
		 $sql = "SELECT count(*) FROM `user_business` WHERE `user_business`.`user_id` = $userID";
   		 $count = $db->count($sql);
		 $userBus = array();
	     foreach ($userBusinessResult as $key => $item){
             $user = array();
			 $user['name'] = $item->name;
		     $user['cost'] = $item->cost;
		     $user['start_time'] = $item->start_time;
		     $user['end_time'] = $item->end_time;
			 $userBus[] = $user;
		 }
		 $u['userBus'] = $userBus;
		 $u['count'] = $count;
		 return  $u;
		 
	}

	
	//显示充值和消费记录信息
	 function userAccount ($userID,$type,$offset,$nums,$db){
			 $userAccount = array();
			 $userAccountSql = "SELECT `user_financial`.`consumer_time`,`user_financial`.`type`,`user_financial`.`fee`
								FROM `user_financial` WHERE `user_financial`.`user_id` = $userID
								ORDER BY `user_financial`.`consumer_time` DESC LIMIT $offset,$nums";
			 $userAccountResult = $db->select($userAccountSql);
			 $sql = "SELECT count(*) FROM `user_financial` WHERE `user_financial`.`user_id` = $userID";
			 $count = $db->count($sql);
			 //定义一个数组
			 $userAcc = array();
			 foreach($userAccountResult as $key => $item){
				$temp = array();
				$temp['consumer_time'] = $item->consumer_time;
				if($item->type == 0){
				//充值
					$temp['fee'] = '+' . $item->fee;
					$temp['type'] = '充值';
				}else{
					$temp['fee'] = '-' . $item->fee;
					$temp['type'] = '消费';
				}
				$userAcc[] = $temp;
			 }
			 $userAccount['userAcc'] = $userAcc;
			 $userAccount['count'] = $count;
			 return $userAccount;
		}

	$info = array();	
	if (in_array(0,$type)){
		$info['userBaseInfo'] = userBaseInfo($userID,$db) ;
	}
    if (in_array(1,$type)){
	    $info['userBusiness'] = userBusiness ($userID,$offset,$nums,$db) ;
	} 
	if (in_array(2,$type)){
        $info['userAccount'] = userAccount ($userID,$type,$offset,$nums,$db);		
	}
	
	//print_r($info); 
	echo json_encode($info);
?>