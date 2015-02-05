<!--
    创建时间：2013年4月26日
    
    编写人：于鉴桐
    
    修改记录：原始版本 v1.0
            版本v1.1   2013年5月21日修改（密码的名称与接口统一，username1，username2）
    
    主要功能点：该页面用于注册，填写、提交个人基本信息（包含用户名、邮箱、密码）
              
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';          
-->

<?php
session_start();
include "lib/header.php";
?>
<title>注册</title>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
</head>

<style>
body {
	background-image: url(img/stbg.jpg);
	margin:0 auto;
	background-repeat: repeat;
	background-position: left top;
}
</style>

<body>
<div id="content" class="content">
	<form  id="regForm" name="regForm" method="post" action="registerProcess.php" onsubmit="returnInputCheck(this)"><!--onsubmit事件-->
        <table align="center" >
            <tr>
                <td  class="label" align="right">用户名：</td>
                <td>
                	<input id="username" name="username" type="text" class="input" placeholder="必填，3-15个字符"/><!--input为自封闭标签-->
                </td>
            </tr>
        
            <tr>
                <td class="label" align="right">密码：</td>
                <td>
                	<input id="password1" name="password1" type="password" class="input" placeholder="必填，不少于6位"/><!--input为自封闭标签-->
                </td>
            </tr>
            
            <tr>
                <td class="label" align="right">确认密码：</td>
                <td>
                	<input id="password2" name="password2" type="password" class="input"/><!--input为自封闭标签-->
                </td>
            </tr>
            
            <tr>
                <td class="label" align="right">电子邮箱：</td>
                <td>
                	<input id="email" name="email" type="text" class="input" placeholder="必填"/><!--input为自封闭标签-->
                </td>
            </tr>
            
            <tr>
            	<td></td>
                <td>
                    <input type="submit" name="submit" value="提交注册" />
                    <input type="reset" name="reset" value="重新设置" />
                <td>
            </tr>
        
        </table>
	</form>
	<span>已有账户，<a href="login.php">点此登录</a></span>
</div>
<?php 
	include('lib/footer.php'); 
?>
