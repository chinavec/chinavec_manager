<?php
	require('../../config/config.php');
	require('config/config.php');
	require('../../lib/db.class.php');
	require('class/user.class.php');
	
	$db = new DB();
	$b = new User($db);
	
	
	$dba = new DB();
	$arr=$dba->select("select * from user_role");
	
	$back = $config['root'] . 'admin/user/';
	$id = isset($_GET['id']) ? $_GET['id'] : 0;
	if(ctype_digit($id) && $id > 0){
		$info = $b->setUserID($id);
		$userBasicInfo = $b->getUserInfo();
		//print_r($userBasicInfo);
		//exit();
			
		
	}else{
		//跳转到错误信息页面
		$errorURL =  "../../common/error.php?error=".urlencode('未找到对应的管理员信息')."&back=".urlencode($back);
		header("Location: " . $errorURL);
		exit();
	}
	$db->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微视频管理中心</title>
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../../css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/userUpdate.js"></script>
<script type='text/javascript'>
	$(document).ready(function(){
		$('input:checkbox').each(function(){
			if($(this).val()==<?php echo $userBasicInfo['user_role_id'];?>){
				$(this).attr('checked',true);	
			}
		});	
		
		
		$('#modifyUser').submit(function(e){
			//alert($('input:checkbox').length);
			var len=$('input:checkbox').length;		//当前页面未勾选的复选框总数
			//alert(len);
			//alert($('input:checkbox').length);
			for(var i=0;i<$('input:checkbox').length;i++){
				//alert(9);
				if($('input:checkbox').eq(i).attr("checked")!==undefined){
					//return true;
					//alert("不空");
					len=len-1;		//当前页面勾选复选框之后，剩余未勾选的复选框总数
					//alert(len);
				}else{
					//alert("为空");
				}
				
			}
			//alert(len);
			
			var lenselect=$('input:checkbox').length-1;		//当前页面只勾选一个复选框之后，剩余未勾选的复选框总数
			
			//if(len<lenselect){
			//	alert("只能为用户选择一个角色");
			//	return false;
			//}else{
			//	return true;
			//}
			
			if(len==$('input:checkbox').length){
				alert("请为用户选择一个角色");
				return false;
			}else if(len<lenselect){
				alert("只能为用户选择一个角色");
				return false;
			}
			else{
				return true;
			}
		});
	});
</script>
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
   
		    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;修改用户信息</p> 			
			<p>&nbsp;</p>  <hr />
			 		
     		<form id="modifyUser" name="modifyUser" action="userDoModify.php?id=<?php echo $id;?>" method="post">
			    <table width="75%" border="0" cellspacing="0" cellpadding="0" style="margin-left:20%">
			   	    <tr>
                        <td width="15%" height="50px">用户名：</td>
                        <td width="20%"><input type="text" id="name" name="name" style="width:200px;" value="<?php echo $userBasicInfo['name']; ?>" /></td>
                        <td width="">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
				    <tr>
                        <td width="15%" height="50px">性别：</td>
                        <td width="20%">
						    <input type="radio" id="gender" name="gender" value="0" <?php echo $userBasicInfo['gender']==0?' checked="checked"':''; ?> />男
                            <input type="radio" id="gender" name="gender" value="1" <?php echo $userBasicInfo['gender']==1?' checked="checked"':''; ?> />女
                        </td>
                        <td width=""></td>
                    </tr>
					<tr>
                        <td width="15%" height="50px">密码：</td>
                        <td width="20%"><input type="password" id="password" name="password" style="width:200px;" value="<?php //echo $userBasicInfo['password']; ?>" /></td>
                        <td width="">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
                        <td width="15%" height="50px">真实姓名：</td>
                        <td width="20%"><input type="text" id="real_name" name="real_name" style="width:200px;" value="<?php echo $userBasicInfo['real_name']; ?>" /></td>
                        <td width="">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<tr>
                        <td width="15%" height="50px">联系方式：</td>
                        <td width=""><input type="text" id="mp" name="mp" style="width:200px;" value="<?php echo $userBasicInfo['mp']; ?>" /></td>
                        <td width="">&nbsp;&nbsp;(*必填，20个字符以内)</td>
                    </tr>
					<!--
                    <tr>
                        <td width="20%" height="50px">昵称：</td>
                        <td width="40%"><input type="text" id="nick_name" name="nick_name" style="width:200px;" value="<?php echo $userBasicInfo['nick_name']; ?>" /></td>
                        
                    </tr>
                    -->
					<tr>
                        <td width="15%" height="50px">联系地址：</td>
                        <td width="20%"><input type="text" id="address" name="address" style="width:200px;" value="<?php echo $userBasicInfo['address']; ?>" /></td>
                        <td width=""></td>
                    </tr>
					<tr>
                        <td width="15%" height="50px">邮箱地址：</td>
                        <td width="20%"><input type="text" id="email" name="email" style="width:200px;" value="<?php echo $userBasicInfo['email']; ?>" /></td>
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
						<td width="40%">
                            <input type="radio" id="log_off" name="log_off" value="0" <?php echo $userBasicInfo['log_off']==1?' checked="checked"':''; ?>/>是
                            <input type="radio" id="log_off" name="log_off" value="1" <?php echo $userBasicInfo['log_off']==0?' checked="checked"':''; ?>/>否
                        </td>
                        -->
					</tr>
                    
                    <tr>
                        <td width="15%" height="50px">更新时间：</td>
                        <td width="20%"><?php echo date('Y-m-d H:i:s'); ?></td>
                        <td width=""></td>
                    </tr>
                    
					<tr>
                        <td height="60px"><input type="submit" value="保存" /></td>
                        <td><input type="button" id="cancel" value="返回" /></td>
						<td><input type="hidden" id="userID" name="userID" value="<?php echo $userBasicInfo['userID']; ?>" /></td>
                        <td>&nbsp;</td>
                    </tr>
				</table>
			   
            </form>
			
        </div>
		
    </div>
    <?php include('../../common/admin_footer.html'); ?>

</body>
