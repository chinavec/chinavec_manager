<!--
    创建时间：		2013年4月26日
    编写人：			于鉴桐
    版本号：			v1.1
    
    修改记录：		原始版本v1.0
    				2013.6.4修改v1.1		美化界面				
                    
    主要功能点：		该页面用于显示登陆界面。
                    用户输入用户名和密码，点击提交后，信息提交到loginProcess.php界面处理。
    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';                   
-->
<?php
session_start();

include "lib/header.php";
?>
<LINK href="css/common.css" rel="stylesheet" type="text/css">
</head>
<body>

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


<div id="panel">	
	<h2><span>云媒体平台登录</span></h2>
	<form method="post" action="loginProcess.php">
		<fieldset>
			<label for="name">用户名</label>
			<input type="text" name="username" id="username" class="block" />
		</fieldset>
		<fieldset>
			<label for="password">密码</label>
			<input type="password" name="password" id="password" class="block" />
		</fieldset>
		<fieldset>
			<input type="submit" value="登录" class="button"/>
			<input type="reset" value="重置" class="button"/>
		</fieldset>
	</form>
</div>
<p><a href="register.php">注册</a></p>

<script type="text/javascript">
$(function() {
	$("#username").focus();
	
	$("form").submit(function() {
		if ($("#username").val() && $("#password").val()) {
			return true;
		}
		else {
			alert("请输入完整登录信息！");
			return false;
		}
	});
})
</script>
<?php include "lib/footer.php"; ?>