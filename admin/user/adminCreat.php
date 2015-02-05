<?php
	require('../../config/config.php');
	require('../../lib/db.class.php');
	$db = new DB();
	$sql = "SELECT * FROM `admin_role";
	$result['list'] = $db->select($sql);
	//print_r($result);exit;
	//require('../lib/connect.php');	连接数据库c
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微视频管理中心</title>
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../../css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/adminCreate.js"></script>
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
   
		    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新建管理员</p> 			
			<p>&nbsp;</p>  <hr />
			<p>&nbsp;</p>
			<p>&nbsp;</p>  		
     		<form id="createAdmin" name="createAdmin" action="adminDoCreate.php" method="post">
			    <table width="60%" border="0" cellspacing="0" cellpadding="0" style="margin-left:20%">
			   	    <tr>
                        <td width="20%" height="60px">管理员账号：</td>
                        <td width="40%"><input type="text" id="username" name="username" style="width:200px;" /></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
				    <tr>
                        <td width="20%" height="60px">密码：</td>
                        <td width="40%"><input type="password" id="password" name="password" style="width:200px;" /></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
                        <td width="20%" height="60px">真实姓名：</td>
                        <td width="40%"><input type="text" id="real_name" name="real_name" style="width:200px;" /></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
                        <td width="20%" height="60px">联系方式：</td>
                        <td width="40%"><input type="text" id="contact" name="contact" style="width:200px;" /></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
                        <td width="20%" height="60px">部门：</td>
                        <td width="40%"><input type="text" id="department" name="department" style="width:200px;" /></td>
                        <!--<td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>-->
                    </tr>
					<tr>
                        <td width="20%" height="60px">职位：</td>
                        <td width="40%"><input type="text" id="position" name="position" style="width:200px;" /></td>
                         <!--<td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>-->
                    </tr>
					<tr>
                        <td width="20%" height="60px">工作证号：</td>
                        <td width="40%"><input type="text" id="work_permit" name="work_permit" style="width:200px;" /></td>
                         <!--<td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>-->
                    </tr>
					<tr>
                        <td width="20%" height="60px" >管理员角色：</td>
						<td width="40%">
					        <select name="admin_role_id" style="width:200px">
							    <?php //foreach($admin1 as $key => $item):
									foreach($result['list'] as $item):
								?>
								<option value="<?php echo $item->id; ?>" > <?php echo $item->name; ?> </option>
								<?php  
									endforeach;
								?>
						    </select>
						</td>
                    </tr>
					<tr>
                        <td height="60px">创建时间：</td>
                        <td><?php echo date('Y-m-d H:i:s'); ?></td>
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
