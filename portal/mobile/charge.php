<!--
    创建时间：		2013年5月8日
    编写人：			于鉴桐
    版本号：			v1.1
    
    修改记录：		原始版本v1.0
                    2013.5.29修改v1.1					
                    
    主要功能点：		该页面用于显示用户的消费记录信息列表。
                    页面前端显示用户的基本信息，包含用户名、邮箱和所属集团。
                   消费记录信息通过与认证计费子系统的“个人信息接口”传递过来，通过表格形式显示在界面上。
                    表格显示内容时间和消费金额。
    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';	
                
-->
<?php
	session_start();
	header("Content-type: text/html; charset=utf-8");
	
	require "../../config/config.php";//系统总配置文件
	require "config/portalConfig.php";//门户配置文件
	require "../../lib/http_client.class.php";//接口传递需要
	require('../../lib/db.class.php');//数据库操作类
	require "lib/header.php";//页面通用的头部文件
	
	//通过SESSION中是否记录用户名来判断用户是否已登录，没有登录应转到登陆界面
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
		header("Location: login.php");
		exit();
	}
	
//--个人信息接口（认证计费子系统）--------------------------------------------------------------	

	$interfaceAddress = 'http://'.$config['paymentServer'].$config['root'].'portal/mobile/interface/userInfo.php';//接口地址  问提供方要
	$http = new Http_Client();//给接口传递参数,HTTP_CLIENT类,封装好了POST数据提交
	$http->addPostField('username', $_SESSION['username']); //参数para1的值为hello，例如参数username，值为admin.
	$http->addPostField('type', array('2'));				//type是一个数组，0代表需要显示基本个人信息，1代表需要显示已订购的业务信息，2代表需要显示充值和消费信息
	$http->addPostField('offset', 0);						//offset是列表的起始项
	$http->addPostField('nums', 5);							//nums是返回列表数
	
	
	//echo $http->Post($interfaceAddress); //这个是发起请求，返回值是接口返回的数据 		 json类型的，PHP不能直接用这种类型，所以json_decode反编码一下 转成PHP 数组
	$result = json_decode($http->Post($interfaceAddress), true);
	//print_r($result);

//个人信息接口（认证计费子系统）---------------------------------------------------------------->

	//用户基本信息，从上一个页面传递过来的数组信息
		$parm= $_GET['parm'];
		$user=explode(";", $parm);
		
	//数组的值赋值给变量，方便程序中调用
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

<title>账户变更记录</title>
<link type="text/css" href="css/userInfo.css" rel="stylesheet"><!--本页面需要用到的CSS文件-->
</head>

<body>

    <div class="box">  
        <a href="#"><img class="userPicture left" width="80" src="img/user/144507.jpg" /></a>
        <div class="userInfo">
        <!--用户个人基本信息-->
           <h3 class="userInfoTitle"><?php echo $username; ?></h3>
                <p>
                    <span>电子邮箱：</span>
                    <span><?php echo $email; ?></span>
                </p>
                <p>
                    <span>账户余额：</span>
                    <span><?php echo $money; ?></span>
                </p>
                <p>
                    <span>所属集团：</span>
                    <span>您还未加入任何集团</span>
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
       <!--*****************有待加入链接，跳转到加入集团页面*****************************-->
                </p>
        </div>
        <div style="clear:both"></div>
    </div>

	<div class="orderBusiness">
        <div>
            <p><span>充值记录：</span></p>
            <table width="100%" border="0">
                  <tr align="center">
                    <th>账户变更时间</th>
                    <th>费用</th>
                  </tr>
                  
             <!--循环读出用户账务信息中的数据，并显示在表格中-->
          	 <?php foreach($result['userAccount']['userAcc'] as $item){?>
                  <tr class="font2">
                    <td><?php echo date('Y-m-d h:m:s',$item['consumer_time']) ;?></td>
                    <td align="right" width="45"><?php echo $item['fee'] ;?></td>
                  </tr>
            <?php } echo $result['userAccount']['count']?>
            </table>
        </div>
        <div style="clear:both;"></div>
	</div>
		<hr style="border:1px dashed #999999; width:98%;" align="center"/>

<?php 
	require "lib/footer.php";
?>