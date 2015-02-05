<?php
	session_start();
	header("content-type:text/html;charset=utf-8");
	
	$username =  $_SESSION['username'] ;//用户名
	$password = $_POST['password'];//原密码
	$newPassword = $_POST['newPassword'];//新密码
	$newRePass = $_POST['newRePass'];//确认密码
	
	
	/*修改密码接口用户管理子系统*/
	require('lib/http_client.class.php');
	
	$interfaceAddress = 'http://localhost/cloudm/portal/mobile/interface/modifyPassword.php';//接口地址  问提供方
	$http = new Http_Client();//给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交
	$http->addPostField('user_name', $username);
	$http->addPostField('password', $password);
	$http->addPostField('password1', $newPassword);
	$http->addPostField('password2', $newRePass);
	
	
	$result = json_decode($http->Post($interfaceAddress), true);
	//echo  $http->Post($interfaceAddress); //接口文件中的输出.主要用于看数据请求数据有没有传过去
	//print_r($result);
	//echo $result['code'];					//调试用代码
	
////论坛同步/////////////////////////////////////////////////////
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
////////////////////////////////////////////////////////////

	
		if($result['code'] == 0){
			$msg = "修改成功!";
			$url = 'userInfo.php';
			
			//echo '修改成功';
			/*echo "
			<script>
			if(confirm('修改成功')){
			window.location.href='userInfo.php'
			}
			</script>";//window.location.href='.php'连接的文件切记用单引号括起来
			exit;
			echo "success";*/
			
		}else{
			$msg = $result['msg'];
			$url = 'modifyPassword.php';
		}

?>
<html>   
<head>   
<meta http-equiv="refresh" content="2; url=<?php echo $url; ?>">   
</head>   
<body>   
	<?php echo $msg;?>
    </br>
    2秒后将跳转....若未跳转，请<a href="<?php echo $url; ?>">点击此处</a>
</body> 
</html>