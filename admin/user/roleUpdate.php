<?php
	require('../../config/config.php');
	require('../../lib/db.class.php');
	require('class/role.class.php');
	
	$db = new DB();
	$dba = new DB();
	$dbb = new DB();
	$dbc = new DB();
	$b = new Role($db);
	
	$arr_right=$dbc->select("select * from user_right");
	$back = $config['root'] . 'admin/user/';
	
	$id = isset($_GET['id']) ? $_GET['id'] : 0;
	$item=$db->select_one("select * from `user_role` where `id`='{$id}';",'');
	$arr=$db->select("select * from `user_role_right` where `user_role_id`='{$id}';",'');
	//print_r($arr);exit;
	//$count=$dbb->select("select * from `admin_authority`",'');
	//print_r($count);exit;
	//$count=count($count);	//查询admin_authority表中权限的总数
	//echo $count;exit;
	
	//print_r($arr[0]->access);exit;
	//echo count($arr);exit;
	//$array=array("{$arr[$i]->access}"=>"{$arr[$i]->access}");
	
	$from = isset($_GET['from']) ? $_GET['from'] : $config['root']."admin/user/userRole.php";
	
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
<script type="text/javascript" src="js/roleCreate.js"></script>
</head>



<body>
<?php
	$array=array();
	
	for($i=0;$i<count($arr);$i++){
		//$array[$arr[$i]->access]=$arr[$i]->access;
		$authority=$arr[$i]->user_right_id;
		//echo $au;exit;
		echo "<script type='text/javascript'>
				$(document).ready(function(){
					$('input:checkbox').each(function(){
						if($(this).val()==$authority){
							$(this).attr('checked',true);	
						}
					});	
				});
			  </script>";
	}
	
	//print_r($array);exit;	
?>
<?php include('../../common/admin_header.php'); ?>
    
    <div id="container" class="clearfix">
    	<div id="container_left" class="left">
        	<?php include("common/leftMenu.html"); ?>
        </div>
        <div id="container_right" class="right">
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
   
		    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;修改角色信息</p> 			
			<p>&nbsp;</p>  <hr />
			 		
     		<form id="createRole" name="createRole" action="roleDoUpdate.php?id=<?php echo $id;?>" method="post">
			    <table width="60%" border="0" cellspacing="0" cellpadding="0" style="margin-left:20%">
			   	    <tr>
                        <td width="20%" height="60px">角色名称：</td>
                        <td width="40%"><input type="text" id="name" name="name" style="width:200px;" value="<?php echo $item->name;?>"/></td>
                        <td width="40%">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
		
					<tr>
                        <td width="20%" height="60px" style="vertical-align:middle;">角色权限：</td>
                        <td width="40%" colspan="2" style="vertical-align:top; padding-top:1px;">
                        	
						<?php
							foreach($arr_right as $key=>$value):
							echo "<div style='float:left;padding-top:20px;width:110px;'><input type='checkbox' name='access[]' value ='".$value->id."' >".$value->name."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";
							endforeach;						
						?>
                        </td>
                        <!--
                        <td width="40%">
						    <input type="checkbox" name="access[]" value ="1" class="authority">用户管理&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="access[]" value ="2" class="authority">授权管理</td>
                        <td width="40%"><input type="checkbox" name="access[]" value ="3" class="authority">门户管理</td>
					</tr>
					<tr>
                        <td width="20%" height="60px"></td>
                        <td width="40%">
						    <input type="checkbox" name="access[]" value ="4" class="authority">媒体分发&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="access[]" value ="5" class="authority">业务支持</td>
			<!--
                        <td width="40%"><input type="checkbox" name="access[]" value ="6" class="authority">媒体分发</td>-->
					</tr>
			<!--		<tr>
                        <td width="20%" height="60px"></td>
                        <td width="40%">
						    <input type="checkbox" name="access[]" value ="7" class="authority">业务支持&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="access[]" value ="8" class="authority">云服务支持</td>
                        <td width="40%"><input type="checkbox" name="access[]" value ="9" class="authority">资源管理</td>
					</tr>
                    	-->
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
