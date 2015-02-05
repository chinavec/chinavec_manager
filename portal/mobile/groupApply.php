<!--
    创建时间：		2013年5月9日
    
    编写人：			于鉴桐
    
    版本号：			v1.0
    
    主要功能点：		该页面用于用户申请加入集团时，填写、提交个人详细信息（包含真实姓名、性别、住址、联系方式、所要申请的集团）
              		选择集团时，集团名称以下拉列表形式展示，数据通过读取数据表epg_group获得。
              		此页面还要用js判断填入信息的有效性，暂时还未写
	
    
    全局配置变量：		$config['root'] = '/cloudm/';
					$config['paymentServer'] = '222.31.73.204';	               
					$config['portalServer'] = '222.31.73.204';             
					$config['userServer'] = '222.31.73.204'; 
-->
<?php
	session_start();
	header("Content-type: text/html; charset=utf-8");
	
	//判断用户权限，登录之后的用户才可以查看申请加入集团，没有登录请先登录
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
		echo '没有权限，请<a href="login.php">登录</a>';
		exit();
	}
	
	require('lib/connect.php');
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
	
	//为保证用户不用重复填写这类信息，填写表格之前先获取用户的所有信息，将原有信息填入表格中
	
	//--个人信息接口（认证计费子系统）---------------------------------------------------------------->
	require('lib/http_client.class.php');

	$interfaceAddress = 'http://'.$config['userServer'].$config['root'].'portal/mobile/interface/userInfo.php';//接口地址  问提供方要
	$http = new Http_Client();								//给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交
	
	$http->addPostField('username', $_SESSION['username']); //参数para1的值为hello，例如参数username，值为admin.
	$http->addPostField('type', array('0'));				//type是一个数组，0代表需要显示基本个人信息，1代表需要显示已订购的业务信息，2代表需要显示充值和消费信息
	$http->addPostField('offset', 0);						//offset是列表的起始项
	$http->addPostField('nums', 5);							//nums是返回列表数
	
	
	//echo $http->Post($interfaceAddress); //这个是发起请求，返回值是接口返回的数据 		 json类型的，PHP不能直接用这种类型，所以json_decode反编码一下 转成PHP 数组
	$result = json_decode($http->Post($interfaceAddress), true);
	//print_r($result);
	
	
	
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

?>
<link type="text/css" href="css/userInfo.css" rel="stylesheet"><!--本页面css-->

<title>申请加入集团</title>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript"  src="js/jquery_cookie.js"></script>

</head>

<body>
<!--页面页眉部分-->
<div id="header">
	<div id="logoUser"></div>
</div>

    <h1>申请加入集团</h1>
    <p>为方便审核并保证集团利益，请填写以下信息</p>

<!--用于用户填写申请信息-->
<!--********************此页面还要用js判断填入信息的有效性**************-->
	<form method="post" action="groupApplyProcess.php">
		<fieldset>
			<label for="username">用户名</label>
			<?php echo $username; ?>
		</fieldset>
        <fieldset>
			<label for="email">邮箱</label>
			<input type="text" name="email" id="email" value="<?php echo $email; ?>" class="block" />
		</fieldset>
        <fieldset>
			<label for="realName">真实姓名</label>
			<input type="text" name="realName" id="realName" value="<?php echo $realName; ?>" class="block" />
		</fieldset>
        <fieldset>
			<label for="nickName">昵称</label>
			<input type="text" name="nickName" id="nickName" value="<?php echo $nickName; ?>" class="block" />
		</fieldset>
         <fieldset>
            <label for="gender">性别：</label>
			<select name="gender" id="gender" title="选择性别">
				<?php 
					if($gender == 0){
						echo '<option value="0" selected="selected">女</option>
                			  <option value="1">男</option>';
					}
					else{
						echo '<option value="0" selected="selected">女</option>
                			  <option value="1">男</option>';
					}
                ?> 
			</select>
        </fieldset>
          <fieldset>
            <label for="unit">工作单位：</label>
			<input type="text" name="unit" id="unit" value="<?php echo $unit; ?>" />
        </fieldset>
          <fieldset>
            <label for="contact">联系电话：</label>
			<input type="text" name="contact" id="contact" value="<?php echo $contact; ?>" />
        </fieldset>
          <fieldset>
            <label class="address">家庭住址：</label>
			<input type="text" name="address" id="address" value="<?php echo $address; ?>" />
        </fieldset>
        <fieldset>
			<label for="groupId">请选择集团</label>
			<select name="groupId" id="groupId" title="集团列表">
            <option value="" selected="selected">请选择集团</option>
                
                <!--以下为循环显示epg_group数据表中的集团名称，选择后提交的值为对应的集团id-->
				<?php 
				$db = new DB();
				$group = $db->select_condition('epg_group');//读取epg_group数据表，以方便选择集团时下拉列表的显示
				foreach($group as $key => $item){ 
				?>
                <option value="<?php echo $item->id;?>"><?php echo $item->group_name;?></option>
                <?php }?>
                
			</select>
		</fieldset>
		<fieldset>
			<input type="submit" value="确认提交" class="button"/>
			<input type="reset" value="重置" class="button"/>
		</fieldset>
	</form>

<script type="text/javascript">
	$(function() {
		$("#email").focus();
		
		$("form").submit(function() {
			if ($("#email").val() &&$("#realName").val() &&$("#gender").val() &&$("#unit").val() &&$("#contact").val() &&$("#address").val() && $("#groupId").val()) {
				return true;
			}
			else {
				alert("请输入完整信息！");
				return false;
			}
		});
	})
</script>

<?php include "lib/footer.php"; ?>