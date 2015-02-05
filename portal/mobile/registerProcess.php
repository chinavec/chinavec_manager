<!--
    创建时间：		2013年4月26日
    
    编写人：			于鉴桐
    
    修改记录：		原始版本 v1.0
            		版本v1.1   2013年5月21日修改（调试注册接口）
            		版本v1.2	  2013年5月22日修改（修改注册接口）
    
    主要功能点：		该页面用于注册时，提交个人基本信息（包含用户名、邮箱、密码）
              		注册时将该信息通过接口发送给用户管理子系统，用户管理子系统处理信息后返回处理结果。
    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';           
-->
<?php
	header("Content-type: text/html; charset=utf-8");
	//包含数据库连接文件
	require('lib/connect.php');
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
	require('../../lib/util.class.php');
	
	$u = new Util();
	$userName = isset($_POST['username']) ? $u->inputSecurity($_POST['username']) : '';
	$password1 = isset($_POST['password1']) ? $u->inputSecurity($_POST['password1']) : '';
	$password2 = isset($_POST['password2']) ? $u->inputSecurity($_POST['password2']) : '';
	$email = isset($_POST['email']) ? $u->inputSecurity($_POST['email']) : '';
		
	if($userName !== ''&&$password1 !== ''&&$password2 !== ''&&$email !== ''){
		
		/*与用户管理子系统的“用户注册接口”链接，将上述信息发给该接口，得到反馈信息：
			提交成功，等待申请；
			提交失败,要有失败返回的原因和处理方式：例如“提交失败，服务器繁忙，请稍后重试”等等。
			后台在连接时是否考虑失败后多次更新数据库的可能？
		*/
		
//--用户注册接口（用户管理子系统）---------------------------------------------------------------->
	
		require('lib/http_client.class.php');
	
		$interfaceAddress = 'http://'.$config['userServer'].$config['root'].'/portal/mobile/interface/register.php';//接口地址  问提供方要
		$http = new Http_Client();//给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交
		$http->addPostField('username', $userName);//username为参数，$username为值
		$http->addPostField('password1',$password1); 
		$http->addPostField('password2',$password2);
		$http->addPostField('email', $email);
		$result = json_decode($http->Post($interfaceAddress), true);
		
		//$http->Post($interfaceAddress) 这个是发起请求，返回值是接口返回的数据json类型的，PHP不能直接用这种类型，所以json_decode反编码一下 转成PHP 数组
		//print_r($result);
		
//用户注册接口（用户管理子系统）---------------------------------------------------------------->

//下面为接到接口结果之后的显示内容
	
			if($result['code'] == 0){
				header("Location:login.php");
				exit;
				
			}else{
				echo $result['msg'];
				exit;
			}
		}
		else{
			echo '输入参数有误，<a href="register.php">重新输入</a>';
	}

?>


