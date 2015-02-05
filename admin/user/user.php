<?php
	require('../../config/config.php');
	require('config/config.php');
	require('../../lib/db.class.php');
	require('../../lib/util.class.php');
	require('class/userSelect.class.php');
	
	$infoValid = array('修改用户信息成功', '新建用户信息成功');
	$db = new DB();
	$bm = new userSelect($db);
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
		$userLists = $bm->searchUserByName($q, $offset, $pageSize);
	}else{
		$userLists = $bm->userLists($offset, $pageSize);
	}
	
	
	$basicURL = 'user.php?q='.$q;
	$pageInfo = $u->page($userLists['total'], $page, $pageSize);	
	$db->close();
	
	//print_r($userLists);exit;
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
			if(!confirm('确认删除用户？')){
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
			$("<img src='../../img/lbg.gif'></img>").appendTo("#container_left ul li.userinfo");
	});
</script>

<style type="text/css">
	#container_left ul li.userinfo{background-color:#108dbd;}
	#container_left ul li.userinfo a{color:#FFF;}
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
   
		    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用户信息列表</p> <hr />
			<p>&nbsp;</p> 
			
            <div id="searchBox">
                <form id="searchForm" action="#" method="get" align="right">
<!--
                	<input type="text" id="search" name="q" placeholder="输入用户名查询" style="width:180px" />
                    <input type="submit" value="搜索" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
-->
                </form>
            </div>			
            
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<form action="userDeleteAll.php" method="POST">
        	<table class="ctable" width="90%">
            	<thead>
                	<tr>
                    	<th align="center">&nbsp;&nbsp;&nbsp;&nbsp;序号</th>
                        <th align="center">用户名</th>
                        <th align="center">真实姓名</th>
                        <th align="center">联系方式</th>
						<th align="center">联系地址</th>
						<th align="center">用户角色</th>
						<th align="center">注册时间</th>
						<th align="center">操作</th>
				    </tr>
                </thead>
                <tbody>
                	<?php foreach($userLists['list'] as $item): ?>
                	<tr>
					    <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="ids" name="id[]" value="<?php echo $item->id; ?>" ></td>
					    <td align="center"><?php echo $item->user_name; ?></td>
                        <td align="center"><?php echo $item->real_name; ?></td>
						<td align="center"><?php echo $item->mp; ?></td>
						<td align="center"><?php echo $item->address; ?></td>
						<td align="center"><?php echo $item->role_name; ?></td>
                        <td align="center"><?php echo date('Y-m-d',$item->create_time); ?></td>
                        <td height="45" colspan="2" align="center">
						    <?php  echo '<a href="userUpdate.php?id='.$item->id.'&from='.$u->encodeCurrentURL().'">修改</a>&nbsp;';?>
                            <?php  echo '<a class="del" href="userDelete.php?id='.$item->id.'">删除</a>&nbsp;';?>
						</td>
                    </tr>
				    <?php endforeach; ?>
                </tbody>
            </table>
						    <p>&nbsp;</p>&nbsp;&nbsp;&nbsp;&nbsp;
			    <input type="checkbox" id="selectAll" >全选&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="delall" type="submit" class="btn_grey del" value="批量删除" />&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="creatuser" type="button" class="btn_grey" value="添加新用户" onClick="window.location.href='userCreat.php'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</form>

			<div id="page"  class="page">
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
