<!--
    创建时间：		2013年4月26日
    编写人：			于鉴桐
    版本号：			v1.1
    
    修改记录：		原始版本v1.0
    				2013.5.29修改v1.1	调试与“认证计费子系统”的“用户个人基本信息接口”，能够从该接口拿到要显示的数据				
                    
    主要功能点：		该页面用于用户修改个人信息。
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';        
-->
<?php
	session_start();
	header("Content-type: text/html; charset=utf-8");
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
		echo '没有权限，请<a href="login.php">登录</a>';
		exit();
	}
	
	$parm= $_GET['parm'];
	$user=explode(";", $parm);
	
	/*$user = json_decode($_GET['user']); 
	print_r($user);*/
	
	require('lib/connect.php');
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
	
	//用户个人基本信息
	$username	 = 	$user['0'];
	$email		 = 	$user['1'];
	$money		 = 	$user['2'];
	$realName	 = 	$user['3'];
	$nickName	 = 	$user['4'];
	$gender		 = 	$user['5'];
	$address	 =	$user['6'];
	$contact	 = 	$user['7'];
	$unit		 = 	$user['8'];
	$groupId	 = 	$user['9'];
	$groupStatus = 	$user['10'];
	
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>修改用户信息</title>
</head>
<style>
body {
	background-image: url(img/stbg.jpg);
	margin:0 auto;
	background-repeat: repeat;
	background-position: left top;
}
#panel{
	width:100%;
	margin: auto;
	margin-top: 20px;
}
#panel h1{
    margin-top: 100px;
	background-image: url(img/title.png);
	background-repeat: no-repeat;
	background-color: #00b7de;
	height: 79px;
	border-radius:10px 10px 0 0;
}
#panel h1 span{
	color: #FFF;
	font-size: 18px;
	padding-top: 30px;
	padding-left: 20px;
	display: block;
}
#panel form{
	border-radius: 0 0 10px 10px;
	background-color: #FFF;
	padding:20px 40px;
}
#panel label{
	color:#000000;
	margin-bottom: 5px;
	display: block;
}
.button {
	display: inline-block;
	outline: none;
	cursor: pointer;
	text-align: center;
	font: 14px/100% Arial, Helvetica, sans-serif;
	padding: .5em 2em .55em;
	text-shadow: 0 1px 1px rgba(0,0,0,.3);
	border-radius: .5em;
	box-shadow: 0 1px 2px rgba(0,0,0,.2);
	border: solid 1px #c6c5c5;
	background: -webkit-gradient(linear, left top, left bottom, from(#a5a3a4), to(#7f7f80));
	color: #FFF;
}
</style>


<body>
 <!--个人信息接口（认证计费子系统）---------------------------------------------------------------->
	<?php
	//require('config/config.php');
	require('lib/http_client.class.php');

	$interfaceAddress = 'http://'.$config['paymentServer'].$config['root'].'android/interface/userInfo.php';//接口地址  问提供方要
	$http = new Http_Client();//给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交
	$http->addPostField('username', 'admin'); //参数para1的值为hello，例如参数username，值为admin.
	$result = json_decode($http->Post($interfaceAddress), true);
	//$http->Post($interfaceAddress) 这个是发起请求，返回值是接口返回的数据 		 json类型的，PHP不能直接用这种类型，所以json_decode反编码一下 转成PHP 数组
	//print_r($result);
	?>
<!--个人信息接口（认证计费子系统）---------------------------------------------------------------->

    <form method="post" action="modifyUserinfoProcess.php">
        <fieldset>
            <label for="name">用户名：</label>
            <?php echo $username; ?>
        </fieldset>
        <fieldset>
            <span class="font1">电子邮箱：</span>
		<input type="text" name="email" id="email" value="<?php echo $email; ?>" />
        </fieldset>
          <fieldset>
            <span class="font1">真实姓名：</span>
			<input type="text" name="realName" id="realName" value="<?php echo $realName; ?>" />
        </fieldset>
        <fieldset>
            <span class="font1">昵称：</span>
			<input type="text" name="nickName" id="nickName" value="<?php echo $nickName; ?>" />
        </fieldset>
        <fieldset>
            <span class="font1">性别：</span>
			<select name="gender" id="gender" title="选择性别">
				<?php 
					if($gender == 0){
						echo '<option value="0" selected="selected">女</option>
                			  <option value="1">男</option>';
					}
					else{
						echo '<option value="0">女</option>
                			  <option value="1" selected="selected">男</option>';
					}
                ?> 
			</select>
        </fieldset>
          <fieldset>
            <span class="font1">工作单位：</span>
			<input type="text" name="unit" id="unit" value="<?php echo $unit; ?>" />
        </fieldset>
          <fieldset>
            <span class="font1">联系电话：</span>
			<input type="text" name="contact" id="contact" value="<?php echo $contact; ?>" />
        </fieldset>
          <fieldset>
            <span class="font1">家庭住址：</span>
			<input type="text" name="address" id="address" value="<?php echo $address; ?>" />
        </fieldset>
        <fieldset>
            <span class="font1">所属集团：</span>
			<?php 
				$db = new DB();
				$group = $db->select_condition_one('epg_group', array('epg_group_id' => $groupId));
				
				//判断用户是否属于集团，如果集团的字段为空，则用户不属于任何集团，点击加入
				//groupStatus= 0->没有申请状态，1->申请状态，2->没通过状态，31->通过且集团服务启动状态，30->通过但集团服务停止状态。
				if(isset($group->group_name)){
					switch ($groupStatus)
						{
							case "0":	echo '您还未申请任何集团<a href="groupApply.php"><input name="join" type="button" value="加入集团"/></a>';	break;
							case "1":	echo '您已申请集团'.$group->group_name.'，请耐心等待管理员审批';	break;
							case "2":	echo '您申请的集团'.$group->group_name.'未通过管理员审批，请重新申请其他集团<br/><a href="groupApply.php"><input name="join" type="button" value="加入集团" /></a>';	break;
							case "31":	echo $group->group_name;	break;
							case "30":	echo $group->group_name;	break;
							default:	echo "抱歉，没有您要找的内容！";
						}
				}
				else{
					echo '您还未申请任何集团<a href="groupApply.php"><input name="join" type="button" value="加入集团"/></a>';	
				}
			?>
        </fieldset>
        <fieldset>
            <input type="submit" value="确认修改" class="button"/>
            <input type="reset" value="重置" class="button"/>
        </fieldset>
    </form>
    <!--点击确定修改后应将用户输入的参数数组，发送给用户管理子系统进行修改提交，获得用户管理子系统的反馈后显示修改成功或失败。-->

<?php include "lib/footer.php"; ?>