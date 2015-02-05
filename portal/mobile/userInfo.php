<!--
    创建时间：		2013年5月8日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0
                    2013.5.29修改v1.1	调试与“认证计费子系统”的“用户个人基本信息接口”，能够从该接口拿到要显示的数据				
                    
    主要功能点：		该页面用于显示用户基本信息。
                    页面前端显示用户的基本信息，包含用户名、邮箱和所属集团。
                    页面中部显示已订购业务、观看历史、账户变更记录、系统换肤的链接。
    
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
	
	require('../../lib/connect.php');		//数据库链接文件
	require "lib/header.php";				//本页面头文件
	require('../../lib/db.class.php');		//数据库操作类
	require('../../config/config.php');		//系统总配置文件
	require('config/portalConfig.php');		//手机门户配置文件
?>
<link type="text/css" href="css/userInfo.css" rel="stylesheet">

<title>用户信息页面</title>
</head>

<body>
    <div id="header">
        <div id="logoUser"></div>
    </div>
    <div id="content">
     <!--个人信息接口（认证计费子系统）---------------------------------------------------------------->
        <?php
        require('lib/http_client.class.php');
    
        $interfaceAddress = 'http://'.$config['paymentServer'].$config['root'].'portal/mobile/interface/userInfo.php';//接口地址  问提供方要
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
        
        //将以上个人信息赋值给数组$user，方便传递给修改个人信息的页面
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
        
        ?>
    <!--个人信息接口（认证计费子系统）---------------------------------------------------------------->
    
            <div class="box">
             <ul class="mediaList">
                <li>
                <a href="#"><img class="mediaCover left" width="80" src="img/user/144507.jpg" /></a>
                <div class="mediaInfo">
                        <h3 class="mediaTitle">
                        	<!--点击“用户信息”或者“修改按钮”，可以跳转到修改用户信息的界面-->
                            <a href="modifyUserInfo.php?parm=<?php echo $parm; ?>">
                            	用户信息<input name="edit" type="button" value="修改" />
                            </a>
                        </h3>
                        <p>
                            <span class="font1">用户名&nbsp;&nbsp; ：</span>
                            <span class="font2"><?php echo $username; ?></span>
                            <input name="modifyPassword" type="button" onclick="document.location.href = 'modifyPassword.php';" value="修改密码" />
                        </p>
                        <p>
                            <span class="font1">电子邮箱：</span>
                            <span class="font2"><?php echo $email; ?></span>
                        </p>
                        <p>
                            <span class="font1">账户余额：</span>
                            <span class="font2"><?php echo $money?></span>
                        </p>
                        <p>
                            <span class="font1">所属集团：</span>
                            <?php 
                            $db = new DB();
                            $group = $db->select_condition_one('epg_group', array('epg_group_id' => $groupId));
                            
                            //判断用户是否属于集团，如果集团的字段为空，则用户不属于任何集团，点击加入
                            //groupStatus= 0->没有申请状态，1->申请状态，2->没通过状态，31->通过且集团服务启动状态，30->通过但集团服务停止状态。
                            if(isset($group->group_name)){
                                switch ($groupStatus)
                                    {
                                        case "0":	echo '您还未申请任何集团<a href="groupApply.php?parm='.$parm.'"><input name="join" type="button" value="加入集团"/></a>';	break;
                                        case "1":	echo '您已申请集团'.$group->group_name.'，请耐心等待管理员审批';	break;
                                        case "2":	echo '您申请的集团'.$group->group_name.'未通过管理员审批，请重新申请其他集团<br/><a href="groupApply.php?parm='.$parm.'"><input name="join" type="button" value="加入集团" /></a>';	break;
                                        case "31":	echo $group->group_name;	break;
                                        case "30":	echo $group->group_name;	break;
                                        default:	echo "抱歉，没有您要找的内容！";
                                    }
                            }
                            else{
                                echo '您还未申请任何集团<a href="groupApply.php?parm='.$parm.'"><input name="join" type="button" value="加入集团"/></a>';	
                            }
                            ?>
                           
                        </p>
                    </div>
                    <div style="clear:both"></div>
                </li>
              </ul>
               
              <ul class="infoList">
                <li>
                    <a href="business.php?parm=<?php echo $parm; ?>"><img class="infoPic left" width="50" src="img/业务信息.png" /></a>
                    <div class="mediaInfo">
                        <h3 class="infoTitle">
                            <a href="business.php?parm=<?php echo $parm; ?>">已订购业务</a>
                        </h3>
                    </div>
                    <div style="clear:both"></div>
                </li>
                
                <li>
                    <a href="history.php?parm=<?php echo $parm; ?>"><img class="infoPic left" width="50" src="img/历史记录.png" /></a>
                    <div class="mediaInfo">
                        <h3 class="infoTitle">
                            <a href="history.php?parm=<?php echo $parm; ?>">观看历史</a>
                        </h3> 
                    </div>
                    <div style="clear:both"></div>
                </li>
                
                <li>
                    <a href="charge.php?parm=<?php echo $parm; ?>"><img class="infoPic left" width="50" src="img/充值.png" /></a>
                    <div class="mediaInfo">
                        <h3 class="infoTitle">
                        	<a href="charge.php?parm=<?php echo $parm; ?>">充值消费记录</a>
                        </h3> 
                    </div>
                    <div style="clear:both"></div>
                </li>
                
                <li>
                    <a href="changeSkin.php"><img class="infoPic left" width="50" src="img/换肤.png" /></a>
                    <div class="mediaInfo">
                        <h3 class="infoTitle">
                        	<a href="changeSkin.php">系统换肤</a>
                        </h3>
                    </div>
                    <div style="clear:both"></div>
                </li>
            </ul>
            <div style="clear:both;"></div>
            </div>
</div>

<?php include "lib/footer.php"; ?>
