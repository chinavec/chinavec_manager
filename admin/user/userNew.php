<?php
	require('../../config/config.php');
	//require('../lib/connect.php');	连接数据库
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微视频管理中心</title>
<link href="../../css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/create.js"></script>
</head>



<body>
<?php include('../../common/admin_header.php'); ?>
    
    <div id="container" class="clearfix">
    	<div id="container_left" class="left">
        	<?php include("common/leftMenu.html"); ?>
        </div>
        <div id="container_right" class="right">
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
   
		    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新建用户信息</p> 			
			<p>&nbsp;</p>  <hr />
			 		
     		<form id="createUser" name="createUser" action="userDoCreate.php" method="post">
			    <table width="60%" border="0" cellspacing="0" cellpadding="0" style="margin-left:20%">
			   	    <tr>
                        <td width="20%" height="50px">用户名：</td>
                        <td width="40%"><input type="text" id="username" name="username" style="width:200px;" /></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
				    <tr>
                        <td width="20%" height="50px">性别：</td>
                        <td width="40%" >
						    <input type="radio" id="gender" name="gender" value="0"/>男
                            <input type="radio" id="gender" name="gender" value="1" />女
                        </td>
                    </tr>
					<tr>
                        <td width="20%" height="50px">密码：</td>
                        <td width="40%"><input type="password" id="password" name="password" style="width:200px;" /></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
                        <td width="20%" height="50px">真实姓名：</td>
                        <td width="40%"><input type="text" id="real_name" name="real_name" style="width:200px;" /></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
                        <td width="20%" height="50px">联系方式：</td>
                        <td width="40%"><input type="text" id="contact" name="contact" style="width:200px;" /></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
                        <td width="20%" height="50px">昵称：</td>
                        <td width="40%"><input type="text" id="nick_name" name="nick_name" style="width:200px;" /></td>
                        
                    </tr>
					<tr>
                        <td width="20%" height="50px">家庭住址：</td>
                        <td width="40%"><input type="text" id="address" name="address" style="width:200px;" /></td>
                        
                    </tr>
					<tr>
                        <td width="20%" height="50px">邮箱：</td>
                        <td width="40%"><input type="text" id="email" name="email" style="width:200px;" /></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
						<td width="20%" height="50px">是否注销：</td>
						<td width="40%">
                            <input type="radio" id="log_off" name="log_off" value="0"/>是
                            <input type="radio" id="log_off" name="log_off" value="1" />否
                        </td>
					</tr>
					<tr>
                        <td width="20%" height="50px">创建时间：</td>
                        <td width="40%"><?php echo date('Y-m-d H:i:s'); ?></td>
                        <td>&nbsp;</td>
                    </tr>
					
					<tr>
                        <td height="60px"><input type="submit" value="保存" /></td>
                        <td><input type="button" id="cancel" value="返回" /></td>
                        <td>&nbsp;</td>
                    </tr>
				</table>
			   
            </form>
			
        </div>
		
    </div>
    <?php include('../../common/admin_footer.html'); ?>

</body>
