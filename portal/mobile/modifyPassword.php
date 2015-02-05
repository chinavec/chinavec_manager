<!--
    创建时间：		2013年5月30日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0
    								
	主要功能点：		该页面用于用户修改密码。
    
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
	
	/*$user = json_decode($_GET['user']); 
	print_r($user);*/
	
	require('lib/connect.php');
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
	
?>
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
    <form method="post" action="modifyPasswordProcess.php">
        <fieldset>
            <span class="font1">原密码：</span>
			<input type="password" name="password"/>
        </fieldset>
          <fieldset>
            <span class="font1">新密码：</span>
			<input type="password" name="newPassword"/>
        </fieldset>
        <fieldset>
            <span class="font1">确认密码：</span>
			<input type="password" name="newRePass"/>
        </fieldset>
        <fieldset>
            <input type="submit" value="确认修改" class="button"/>
            <input type="reset" value="重置" class="button"/>
        </fieldset>
    </form>
    <!--点击确定修改后应将用户输入的参数数组，发送给用户管理子系统进行修改提交，获得用户管理子系统的反馈后显示修改成功或失败。-->

<?php include "lib/footer.php"; ?>