<!--
    创建时间：		2013年5月30日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0
    								
	主要功能点：		该页面用于用户个人信息时，将信息传递给接口处理
    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';
            
-->

<?php
	session_start();
	header("content-type:text/html;charset=utf-8");
	
	include('lib/connect.php');
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
	require('lib/http_client.class.php');
	
	$username =  $_SESSION['username'] ;	//用户名
	$email = $_POST['email'];				//电子邮箱
	$realName = $_POST['realName'];			//真实姓名
	$nickName = $_POST['nickName'];			//昵称
	$address = $_POST['address'];			//联系地址
	$contact = $_POST['contact'];			//联系电话
	$unit = $_POST['unit'];					//单位
	$gender = $_POST['gender'];				//性别
	
	/*修改个人信息接口用户管理子系统*/
	
	$interfaceAddress = 'http://'.$config['userServer'].$config['root'].'portal/mobile/interface/modifyInfo.php';//接口地址  问提供方
	$http = new Http_Client();//给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交
	$http->addPostField('user_name', $username);
	$http->addPostField('email', $email);
	$http->addPostField('unit', $unit);
	$http->addPostField('real_name', $realName);
	$http->addPostField('nick_name', $nickName);
	$http->addPostField('gender', $gender);
	$http->addPostField('address', $address);
	$http->addPostField('contact', $contact);
	
	$result = json_decode($http->Post($interfaceAddress), true);
	//echo  $http->Post($interfaceAddress); //接口文件中的输出.主要用于看数据请求数据有没有传过去
	//print_r($result);
	//$result = json_decode($result, true);
	// $result['code'];
	
//**论坛*********************************************************************************
/*
mysql_close($conn);
$conn=mysql_connect("localhost","root","");//建立一个数据库联接对象
$db=mysql_select_db("ultrax",$conn);//选择一个特定数据库
mysql_query("SET NAMES utf8");//汉字编码转换
$password0 = MD5($newPassword);
//$email = $_POST['email'];
//include "conn.php";
$result=mysql_query("SELECT * FROM `pre_ucenter_members` WHERE `username`='$username'");	
$salt=mysql_fetch_assoc($result);
$password=md5($password0.$salt['salt']);
//////数据库连接

$sql = "UPDATE `pre_ucenter_members` SET `password`='$password' WHERE `username` = '$username'";
mysql_query($sql);
mysql_query("UPDATE `pre_common_member` SET `password`='$password' WHERE `username` = '$username'");
mysql_close($conn);*/
//****************************************************************************************
	
		if($result['code'] == 0){
			//echo '修改成功';
			echo "
			<script>
			if(confirm('修改成功')){
			window.location.href='userInfo.php'
			}
			</script>";//window.location.href='.php'连接的文件切记用单引号括起来
			exit;
			echo "success";
			
		}else{
			echo $result['msg'];
			exit;
		}

?>