<?php
	require('../../config/config.php');
	//require('../lib/connect.php');	连接数据库
	require('../../lib/db.class.php');
	
	$db = new DB();
	$arr=$db->select("select * from user_right");
	//print_r($arr);exit;
	//foreach($arr as $key=>$value):
	//echo $value->id." ".$value->name." ";
	//endforeach;exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微视频管理中心</title>
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../../css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/rightCreate.js"></script>
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
   
		    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新建权限</p> 			
			<p>&nbsp;</p>  <hr />
			 		
     		<form id="createRight" name="createRight" action="rightDoCreate.php" method="post">
			    <table width="60%" border="0" cellspacing="0" cellpadding="0" style="margin-left:20%">
			   	    <tr>
                        <td width="20%" height="60px">权限名称：</td>
                        <td width="40%"><input type="text" id="name" name="name" style="width:200px;" /></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
		
					<tr>
                        <td width="20%" height="60px" style="vertical-align:middle;">已有权限：</td>
                        <td width="40%" colspan="2" style="vertical-align:top; padding-top:1px;">
                        	
						<?php
							foreach($arr as $key=>$value):
							echo "<div style='float:left;padding-top:20px;width:110px;'>".$value->name."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";
							endforeach;						
						?>
                        </td>
                        <!--
                        <td width="40%">
						    <input type="checkbox" name="access[]" value ="1" >用户管理&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="access[]" value ="2">授权管理</td>
                        <td width="40%"><input type="checkbox" name="access[]" value ="3">门户管理</td>
					</tr>
					<tr>
                        <td width="20%" height="60px"></td>
                        <td width="40%">
						    <input type="checkbox" name="access[]" value ="4" >媒体分发&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="access[]" value ="5">业务支持</td>
			<!--
                        <td width="40%"><input type="checkbox" name="access[]" value ="6">媒体分发</td>		-->
					</tr>
			<!--			
			<tr>
                        <td width="20%" height="60px"></td>
                        <td width="40%">
						    <input type="checkbox" name="access[]" value ="7" >业务支持&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="access[]" value ="8">云服务支持</td>
                        <td width="40%"><input type="checkbox" name="access[]" value ="9">资源管理</td>
					</tr>
                    	-->
					<tr>
                        <td height="60px"><input type="submit" value="新建"  id="createRole_submit"/></td>
                        <td><input type="button" id="cancel" value="返回" /></td>
                        <td>&nbsp;</td>
                    </tr>
				</table>
			   
            </form>
			
        </div>
		
    </div>
    <?php include('../../common/admin_footer.html'); ?>

</body>
