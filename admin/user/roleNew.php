<?php
	require('../../config/config.php');
	//require('../lib/connect.php');	连接数据库c
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微视频管理中心</title>
<link href="../../css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/create3.js"></script>
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
   
		    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新建角色信息</p> 			
			<p>&nbsp;</p>  <hr />
			 		
     		<form id="createRole" name="createRole" action="roleDoCreate.php" method="post">
			    <table width="60%" border="0" cellspacing="0" cellpadding="0" style="margin-left:20%">
			   	    <tr>
                        <td width="20%" height="60px">角色名称：</td>
                        <td width="40%"><input type="text" id="username" name="username" style="width:200px;" /></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
		
					<tr>
                        <td width="20%" height="60px">管理员权限：</td>
                        <td width="40%">
						    <input type="checkbox" name="admin_acess" value ="业务管理" >业务管理&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="admin_acess" value ="内容管理">内容管理</td>
                        <td width="40%"><input type="checkbox" name="admin_acess" value ="媒体流管理">媒体流管理</td>
					</tr>
					<tr>
                        <td width="20%" height="60px"></td>
                        <td width="40%">
						    <input type="checkbox" name="admin_acess" value ="计费优惠" >计费优惠&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="admin_acess" value ="用户管理">用户管理</td>
                        <td width="40%"><input type="checkbox" name="admin_acess" value ="媒体分发">媒体分发</td>
					</tr>
					<tr>
                        <td width="20%" height="60px"></td>
                        <td width="40%">
						    <input type="checkbox" name="admin_acess" value ="业务支持" >业务支持&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="admin_acess" value ="云服务支持">云服务支持</td>
                        <td width="40%"><input type="checkbox" name="admin_acess" value ="资源管理">资源管理</td>
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
