<?php
	require('../../config/config.php');
	//require('../lib/connect.php');	
	require('../../lib/db.class.php');	//连接数据库
	$db = new DB();
	$arr=$db->select("select * from user_role");
	//print_r($arr);exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微视频管理中心</title>
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../../css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/userCreate.js"></script>
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
			    <table width="75%" border="0" cellspacing="0" cellpadding="0" style="margin-left:20%">
			   	    <tr>
                        <td width="15%" height="50px">用户名：</td>
                        <td width="20%"><input type="text" id="name" name="name" style="width:200px;" /></td>
                        <td width="">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
				    <tr>
                        <td width="15%" height="50px">性别：</td>
                        <td width="20%" >
						    <input type="radio" id="sex" name="sex" value="0"/>男
                            <input type="radio" id="sex" name="sex" value="1" />女
                        </td>
                        <td width=""></td>
                    </tr>
					<tr>
                        <td width="15%" height="50px">密码：</td>
                        <td width="20%"><input type="password" id="password" name="password" style="width:200px;" /></td>
                        <td width="">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
                        <td width="15%" height="50px">真实姓名：</td>
                        <td width="20%"><input type="text" id="real_name" name="real_name" style="width:200px;" /></td>
                        <td width="">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
                        <td width="15%" height="50px">联系方式：</td>
                        <td width=""><input type="text" id="mp" name="mp" style="width:200px;" /></td>
                        <td width="">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
                    <!--
					<tr>
                        <td width="15%" height="50px">昵称：</td>
                        <td width="20%"><input type="text" id="nick_name" name="nick_name" style="width:200px;" /></td>
                        
                    </tr>
                    -->
					<tr>
                        <td width="15%" height="50px">联系地址：</td>
                        <td width="20%"><input type="text" id="address" name="address" style="width:200px;" /></td>
                        <td width=""></td>
                    </tr>
					<tr>
                        <td width="15%" height="50px">邮箱地址：</td>
                        <td width="20%"><input type="text" id="email" name="email" style="width:200px;" /></td>
                        <td width="">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
                    	<td width="15%" height="50px">用户角色：</td>
						<td width="20%" colspan="2">
                            <?php
								foreach($arr as $key=>$value):
								echo "<div style='float:left;padding-top:20px;width:110px;'><input type='checkbox' name='access[]' value ='".$value->id."' >".$value->name."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";
								endforeach;						
							?>
                        </td>
                        
						<!--
                        <td width="20%" height="50px">是否注销：</td>
						<td width="20%">
                            <input type="radio" id="log_off" name="log_off" value="1"/>是
                            <input type="radio" id="log_off" name="log_off" value="0" />否
                        </td>
                        -->
					</tr>
					<tr>
                        <td width="15%" height="50px">创建时间：</td>
                        <td width="20%"><?php echo date('Y-m-d H:i:s'); ?></td>
                        <td width=""></td>
                    </tr>
					
					<tr>
                        <td height="60px"><input type="submit" value="新建" /></td>
                        <td><input type="button" id="cancel" value="返回" /></td>
                        <td width=""></td>
                    </tr>
				</table>
			   
            </form>
			
        </div>
		
    </div>
    <?php include('../../common/admin_footer.html'); ?>

</body>
