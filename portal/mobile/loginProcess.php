<!--
    创建时间：		2013年4月26日
    
    编写人：			于鉴桐
    
    版本号：			v1.0
    
    修改记录：		原始版本v1.0				
                    
    主要功能点：		该页面用于处理用户的登录信息    
    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';
-->
<?php
	session_start();
	header("Content-type: text/html; charset=utf-8");
	
	//包含数据库连接文件
	require('lib/connect.php');
	require('../../lib/http_client.class.php');
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文


	if(!isset($_POST['username'])){
		exit('非法访问!');
	}
	//htmlspecialchars(
	$username = $_POST['username'];
	$password = md5($_POST['password']);


//用户登录鉴权接口（认证计费子系统）*********************************************************************
	$interfaceAddress = 'http://'.$config['paymentServer'].$config['root'].'portal/mobile/interface/login.php';
	$http = new Http_Client();
	$http->addPostField('username', $username);
	$http->addPostField('password', $password);
	
	//echo $http->Post($url);
	$result = json_decode($http->Post($interfaceAddress), true);
	//print_r($result);
//*************************************************************************************************<br>
	
		if($result['operation'] == 1){
			//echo '修改成功';
			$_SESSION['username'] = $result['userName'];
			$_SESSION['userID'] = $result['userID'];
			$_SESSION['token'] = $result['token'];
			$url = "http://222.31.73.204/cloudm/portal/mobile/index.php"; 
			$msg = "登陆成功！";
			/*echo "
			<script>
			if(confirm('登录成功')){
			window.location.href='index.php'
			}
			</script>";//window.location.href='.php'连接的文件切记用单引号括起来
			exit;
			echo "success";*/
			
		}else{
			$url = "http://222.31.73.204/cloudm/portal/mobile/login.php"; 
			$msg = $result['info'];
			/*echo "
			<script>
			if(confirm('用户名或密码错误，请重新登录')){
			window.location.href='login.php'
			}
			</script>";//window.location.href='.php'连接的文件切记用单引号括起来
			exit;*/
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