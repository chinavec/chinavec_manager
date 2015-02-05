<!--
    创建时间：		2013年5月9日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0
                	2013.5.31修改	调试集团申请接口
    
    主要功能点：		该页面用于处理用户申请加入集团时，填写、提交的个人详细信息（包含真实姓名、性别、住址、联系方式、所要申请的集团）
                	该页面将session中存储的用户名，以及用户填写的信息通过“申请加入集团接口”发送给用户管理子系统进行处理
                	获取到接口返回的结果$result，根据$result的值不同，页面中显示不同的结果

    全局配置变量：		$config['root'] = '/cloudm/';
					$config['paymentServer'] = '222.31.73.204';	               
					$config['portalServer'] = '222.31.73.204';             
					$config['userServer'] = '222.31.73.204'; 
         
-->
<?php
	session_start();
	header("Content-type: text/html; charset=utf-8");
	
	require('lib/connect.php');
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
	require('../../lib/util.class.php');
	
	//判断用户权限，登录之后的用户才可以查看申请加入集团，没有登录请先登录
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
		echo '没有权限，请<a href="login.php">登录</a>';
		exit();
	}
	
	$u = new Util();
	$username	= $_SESSION['username'];//接口传递session中储存的用户名，对方接口由用户名从user表中查找到该用户，以便更新以下内容
	$email 		= isset($_POST['email']) ? $u->inputSecurity($_POST['email']) : '';
	$unit 		= isset($_POST['unit']) ? $u->inputSecurity($_POST['unit']) : '';
	$realName 	= isset($_POST['realName']) ? $u->inputSecurity($_POST['realName']) : '';
	$nickName	= isset($_POST['nickName']) ? $u->inputSecurity($_POST['nickName']) : '';
	$gender		= isset($_POST['gender']) ? $u->inputSecurity($_POST['gender']) : '';
	$address 	= isset($_POST['address']) ? $u->inputSecurity($_POST['address']) : '';
	$contact 	= isset($_POST['contact']) ? $u->inputSecurity($_POST['contact']) : '';
	$groupId 	= isset($_POST['groupId']) ? $u->inputSecurity($_POST['groupId']) : '';

	
	
	/*与用户管理子系统的“申请加入集团接口”链接，将上述信息发给该接口，得到反馈信息：
		提交成功，等待申请；
		提交失败,要有失败返回的原因和处理方式：例如“提交失败，服务器繁忙，请稍后重试”等等。
		后台在连接时是否考虑失败后多次更新数据库的可能？
	*/
		
//--申请加入集团接口（用户管理子系统）---------------------------------------------------------------->
	
	require('lib/http_client.class.php');

	$interfaceAddress = 'http://'.$config['userServer'].$config['root'].'/portal/mobile/interface/groupApply.php';//接口地址  问提供方要
	$http = new Http_Client();//给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交
	$http->addPostField('user_name', $username);
	$http->addPostField('email', $email);
	$http->addPostField('unit', $unit);	
	$http->addPostField('real_name', $realName); //realname为参数，$username为值
	$http->addPostField('nick_name', $nickName); 
	$http->addPostField('gender', $gender);
	$http->addPostField('address', $address);
	$http->addPostField('contact', $contact);
	$http->addPostField('group_id', $groupId);
	
	$result = json_decode($http->Post($interfaceAddress), true);
	//echo  $http->Post($interfaceAddress); //接口文件中的输出.主要用于看数据请求数据有没有传过去
	
	//print_r($result);
	//echo $result['code'];
	
//申请加入集团接口（用户管理子系统）---------------------------------------------------------------->


//下面为接到接口结果之后的显示内容
		
		if($result['code'] == 0){
			$msg = "申请成功，请耐心等待审核!";
			$url = 'userInfo.php';
			
		}else{
			echo '2';
			$msg = $result['msg'];
			$url = 'groupApply.php';
			echo $msg;
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
	
	
