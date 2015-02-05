<?php
	require('../../config/config.php');
	require('config/config.php');
	require('../../lib/db.class.php');
	require('../../lib/util.class.php');
	require('class/roleSelect.class.php');
	//require('class/adminauthority.class.php');
			
	$infoValid = array('修改角色信息成功', '新建角色信息成功');
	$db = new DB();
	$bm = new RoleSelect($db);
	
	$dba = new DB();
	$dbb = new DB();
	$u = new Util();
	$info = isset($_GET['info']) ? $_GET['info'] : '';
	$q = isset($_GET['q']) ? $_GET['q'] : '';	
	$pageSize = 9;
	$page = isset($_GET['page']) ? $_GET['page'] : 0;
	
	if(!(ctype_digit($page) && $page > 0)){
		$page = 1;
	}
	$offset = ($page - 1) * $pageSize;
	if($q != ''){
		$q = $u->inputSecurity($q);
		$roleLists = $bm->searchRoleByName($q, $offset, $pageSize);
	}else{
		$roleLists = $bm->roleLists($offset, $pageSize);
	}
	//$sql = "SELECT * FROM `admin` LIMIT $offset, $pageSize";
	
	//print_r($roleLists);exit;
	//$sql = "select `admin_access`.* ,`admin_role`.`id` as `adminRoleId` ,`admin_role`.`name` as `adminRoleName` from `admin_access` right join `admin_role` on `admin_access`.`admin_role_id` = `admin_role`.`id` LIMIT $offset, $pageSize";
	//$role = $db -> select($sql);	
	$basicURL = 'role.php?q='.$q;
	$pageInfo = $u->page($roleLists['total'], $page, $pageSize);
	//$pageInfo = $u->page($sql, $page, $pageSize);
	$db->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微视频管理中心</title>
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../../css/base.css" rel="stylesheet" type="text/css" />
<link href="../../css/common_fang.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('.del').click(function(e){
			if(!confirm('确认删除角色？')){
				return false;
			}
		});
		$('#selectAll').click(function(){
			if($(this).prop("checked")){
				$('.ids').prop('checked', true);
			}else{
				$('.ids').prop('checked', false);
			}
		});
	});

	$(function(){
			$("<img src='../../img/lbg.gif'></img>").appendTo("#container_left ul li.userActive");
	});
</script>
<style>
	#container_left ul li.userActive{background-color:#108dbd;}
	#container_left ul li.userActive a{color:#FFF;}
</style>
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
   
		    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;角色列表</p> <hr />
			<p>&nbsp;</p>
			<p>&nbsp;</p>
            <form action="roleDeleteAll.php" method="POST">
        	<table class="ctable" width="90%">
            	<thead>
                	<tr>
					    <th width="10%" align="center">选择</th>
                    	<th width="35%" align="center">角色名称</th>
                        <th width="40%" align="center">角色权限</th>
                        <th align="center">操作</th>
                    </tr>
                </thead>
                <tbody>
				<?php
					//$conn = mysql_connect("localhost","root","");
					//if (!$conn){
					//die('Could not connect: ' . mysql_error());
					//}
					//mysql_query("set names utf8");
					//mysql_select_db("chinavec", $conn);
					
					
				   foreach($roleLists['list'] as $key => $item):
					//foreach($adminLists['list'] as $item):
					
				?>
                	<tr>
					    <td width="10%" align="center"><input type="checkbox" class="ids" name="id[]"><?php //echo $item->id; ?></td>
					    <td width="20%" align="center"><?php 
														//echo $item->admin_role_id;
														$arr_role=$dbb->select_one("SELECT *
				FROM `admin_role` where `id`={$item->admin_role_id};",'');
																echo $arr_role->name;
														//$sql="select * from `admin_role` where `id`='{$item->admin_role_id}';"; 
														//$result=mysql_query($sql);
														
														//$row=mysql_fetch_array($result);
														//echo $row['name'];
														
														?></td>
                        <td width="35%" align="center"><?php  
															//echo $item->access; 
															
															$arr=explode("/",$item->access);
															//print_r($arr);
															//echo count($arr);exit;
															//$ba = new AuthoritySelect($db);
															//$ba->
															
															$str="";
															for($i=0;$i<count($arr);$i++){
																
																$arr_authority=$dba->select_one("SELECT *
				FROM `admin_authority` where `id`={$arr[$i]};",'');
																$str.=$arr_authority->authority_name."/";
																
																//echo $arr_authority['authority_name'];
															}
															$str=substr($str,0,-1);
															echo $str;
															//print_r($arr);
													   ?></td>
						<td height="40" colspan="2" align="center">
						<?php  echo '<a href="roleUpdate.php?id='.$item->id.'&from='.$u->encodeCurrentURL().'">修改</a>&nbsp;';?>
                        <?php  echo '<a class="del" href="roleDelete.php?id='.$item->id.'">删除</a>&nbsp;';?>
						</td>
                    </tr>
					<?php endforeach; ?>
                </tbody>
            </table>
			<p>&nbsp;</p>&nbsp;&nbsp;&nbsp;&nbsp;
			    <input type="checkbox" id="selectAll" >全选&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="delall" type="submit" class="btn_grey del" value="批量删除" />&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="creatRole" type="button" class="btn_grey" value="新建角色" onClick="window.location.href='roleCreat.php'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</form>
			
			<div class="page">
				<?php if($pageInfo['pages'] <= 1): ?>
                <p class="sysinfo">仅有当前一页</p>
                <?php else: ?>
                <a class="mybutton ib" href="<?php echo $basicURL;?>&page=1">第一页</a>
                <?php 
                    if($pageInfo['now'] == 1){
                        echo '<span class="mybutton ib">上一页</span>';
                    }else{
                        echo '<a class="mybutton ib" href="'.$basicURL.'&page='.($pageInfo['now']-1).'">上一页</a>';
                    }
                ?>
                <?php foreach($pageInfo['range'] as $item): ?>
                <?php 
                    if($pageInfo['now'] == $item){
                        echo '<span class="cur">'.$item.'</span>';
                    }else{
                        echo '<a class="ib mybutton" href="'.$basicURL.'&page='.$item.'">'.$item.'</a>';
                    }
                ?>
                <?php endforeach; ?>
                <?php 
                    if($pageInfo['now'] == $pageInfo['pages']){
                        echo '<span class="mybutton ib">下一页</span>';
                    }else{
                        echo '<a class="mybutton ib" href="'.$basicURL.'&page='.($pageInfo['now']+1).'">下一页</a>';
                    }
                ?>
                <a class="mybutton ib" href="<?php echo $basicURL.'&page='.$pageInfo['pages']; ?>">最后页</a>
                <?php endif; ?>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				
            </div>
        </div>
    </div>
    
    <?php include('../../common/admin_footer.html'); ?>

</body>
