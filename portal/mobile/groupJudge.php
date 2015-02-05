<!--
    创建时间：		2013年5月31日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0				
                    
    主要功能点：		该页面用于判断用户是否属于集团用户，属于哪一个集团。该功能通过调用用户个人信息接口，根据group_status判断实现。
    
    全局配置变量：		$config['root'] = '/cloudm/';
					$config['paymentServer'] = '222.31.73.204';	               
					$config['portalServer'] = '222.31.73.204';             
					$config['userServer'] = '222.31.73.204';     
-->

<?php
session_start();
header("Content-type: text/html; charset=utf-8");
	
	//通过SESSION中是否记录用户名来判断用户是否已登录，没有登录应转到登陆界面
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
		header("Location: login.php");
		exit();
	}

	include('lib/connect.php');
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
	require('lib/http_client.class.php');
    
//--个人信息接口（认证计费子系统）---------------------------------------------------------------->
	$interfaceAddress = 'http://'.$config['paymentServer'].$config['root'].'portal/mobile/interface/userInfo.php';//接口地址  问提供方要
	$http = new Http_Client();								//给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交
	
	$http->addPostField('username', $_SESSION['username']); //参数para1的值为hello，例如参数username，值为admin.
	$http->addPostField('type', array('0'));				//type是一个数组，0代表需要显示基本个人信息，1代表需要显示已订购的业务信息，2代表需要显示充值和消费信息
	$http->addPostField('offset', 0);						//offset是列表的起始项
	$http->addPostField('nums', 5);							//nums是返回列表数
	
	
	//echo $http->Post($interfaceAddress); //这个是发起请求，返回值是接口返回的数据 		 json类型的，PHP不能直接用这种类型，所以json_decode反编码一下 转成PHP 数组
	$result = json_decode($http->Post($interfaceAddress), true);
	//print_r($result);
//------------------------------------------------------------------------------------------>
	
	
	//用户个人基本信息,赋值给变量后易于在界面显示
	$username	 = 	$_SESSION['username'];
	$email		 = 	$result['userBaseInfo']['email'];
	$money		 = 	$result['userBaseInfo']['money'];
	$realName	 = 	$result['userBaseInfo']['real_name'];
	$nickName	 = 	$result['userBaseInfo']['nick_name'];
	$gender		 = 	$result['userBaseInfo']['gender'];
	$address	 =	$result['userBaseInfo']['address'];
	$contact	 = 	$result['userBaseInfo']['contact'];
	$unit		 = 	$result['userBaseInfo']['unit'];
	$groupId	 = 	$result['userBaseInfo']['group_id'];
	$groupStatus = 	$result['userBaseInfo']['group_status'];
	

	
	//将以上个人信息赋值给数组$user，方便传递给申请集团的页面
	$user = array(
		'username' 	=> $username,
		'email' 	=> $email,
		'money' 	=> $money,
		'realName' 	=> $realName,
		'nickName' 	=> $nickName,
		'gender' 	=> $gender,
		'address' 	=> $address,
		'contact' 	=> $contact,
		'unit' 		=> $unit,
		'groupId' 	=> $groupId,
		'groupStatus' => $groupStatus
	);
	$parm = implode(";", $user);
	
	
	$db = new DB();
	$group = $db->select_condition_one('epg_group', array('epg_group_id' => $groupId));
		
		//判断用户是否属于集团，如果集团的字段为空，则用户不属于任何集团，点击加入
		//groupStatus= 0->没有申请状态，1->申请状态，2->没通过状态，31->通过且集团服务启动状态，30->通过但集团服务停止状态。
		if($groupStatus == 0){
			echo '您还未申请任何集团<a href="groupApply.php?parm='.$parm.'"><input name="join" type="button" value="加入集团"/></a>';
			echo '</br>返回<a href="index.php">主页面</a>逛逛';
			exit;	
		}
		if(isset($group->group_name) && $groupStatus !== 0){
			if($groupStatus == 1){
				echo '您已申请集团"'.$group->group_name.'"，管理员审批通过后，才可观看本集团节目';
				echo '</br>返回<a href="index.php">主页面</a>逛逛';
				exit;	
			}
			if($groupStatus == 1){
				echo '您申请的集团"'.$group->group_name.'"未通过管理员审批，请重新申请其他集团<br/><a href="groupApply.php?parm='.$parm.'"><input name="join" type="button" value="加入集团" /></a>';	
				echo '</br>返回<a href="index.php">主页面</a>逛逛';
				exit;	
			}
			if($groupStatus == 30){
				echo '抱歉'.$group->group_name.'集团服务暂停';	
				echo '</br>返回<a href="index.php">主页面</a>逛逛';
				exit;	
			}	
			if($groupStatus == 31){
				header("Location: group.php?groupId=$group->epg_group_id");	
				exit;	
			}
		}
		else{
			header("Location: index.php");	
			exit;
		}
?>