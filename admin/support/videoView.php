<?php
/*
 *视频观看统计功能界面
 *肖亚翠
 *V1.0
 *2013-4-17
 */
require('../../config/config.php');
require('config/config.php');
require('../../lib/db.class.php');
require('../../lib/util.class.php');

//实例化数据库操作类
$db = new DB();
$u = new Util();
//设置搜索内容$q
$q = isset($_GET['q']) ? $_GET['q'] : '';
//一页显示的条数
$pageSize = 2;
//设置页码$page
$page = isset($_GET['page']) ? $_GET['page'] : 0;
//判断$page是否为整数并大于0
if(!(ctype_digit($page))){
	$page = 1;
}
//内容的偏移量
$offset = ($page - 1) * $pageSize;
//若$q为空，读取表的全部信息；若$q不为空，读取和$q匹配的相关信息
if($q == ''){
	//读取数据表video_view_statistics
	$sqlCount = "SELECT COUNT(DISTINCT(`video_view_statistics`.`video_id`)) FROM `video_view_statistics`
				JOIN `video` ON `video`.`id` = `video_view_statistics`.`video_id`";
	$sql = "SELECT `label`.`name`,`video`.`title`,`video`.`number`,
			SUM(`video_view_statistics`.`view_total`) as `total`
			FROM `video_view_statistics`
			JOIN `video` ON `video`.`id` = `video_view_statistics`.`video_id` 
			LEFT JOIN `label` ON `label`.`id` = `video_view_statistics`.`label_id`
			GROUP BY `video_view_statistics`.`video_id`
			ORDER BY `total` DESC LIMIT $offset, $pageSize";
}else{
	$sqlCount = "SELECT COUNT(DISTINCT(`video_view_statistics`.`video_id`)) FROM `video_view_statistics`
				 JOIN `video` ON `video`.`id` = `video_view_statistics`.`video_id`
				 WHERE `video`.`title` LIKE '%$q%'
				";
	$sql = "SELECT `label`.`name`,`video`.`title`,`video`.`number`,
			SUM(`video_view_statistics`.`view_total`) as `total` 
			FROM `video_view_statistics`
			JOIN `video` ON `video`.`id` = `video_view_statistics`.`video_id` 		
			LEFT JOIN `label` ON `label`.`id` = `video_view_statistics`.`label_id`
			WHERE `label`.`name` LIKE '%$q%' OR `video`.`title` LIKE '%$q%'
			GROUP BY `video_view_statistics`.`video_id`
			ORDER BY `total` DESC LIMIT $offset, $pageSize";
}
//读取数据库结果
$videoViewRank = $db->select($sql);
//设置url的形式
$basicURL = 'videoView.php?q='.$q;
//页码信息
$pageInfo = $u->page($db->count($sqlCount), $page, $pageSize);
//关闭数据库
$db->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>视频点播量统计</title>
<link href="../../css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/base.js"></script>
<link href="../../css/common_fang.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<link href="css/videoView.css" rel="stylesheet" type="text/css" />
<style>
	#container_left ul li.videoView{background-color:#108dbd;}
	#container_left ul li.videoView a{color:#FFF;}
</style>
<script type="text/javascript">
	$(function(){
			$("<img src='../../img/lbg.gif'></img>").appendTo("#container_left ul li.videoView");
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
			<div>
                <form id="searchInput" action="" method="get">
                    <input type="text" style="width:200px" placeholder="输入视频或者类型名称查询" name="q" />
                    <input class="search" type="submit" value="搜索" />
                    <span class="font-lan14cu"><a href="videoView.php">清除搜索条件</a></span>
                </form>
            </div>
            <div class="rtf">
				<p><span>视频点播量统计</span></p>
                
			</div>	
			<div id="u1" class="u1">
				<div id="u1_line" class="u1_line"></div>
			</div>
			<table class="mytable" width="80%">
				<thead>
					<!--<tr>
						<th width="25%">视频名称</th>
                        <th width="15%">视频集数</th>
                        <th width="15%">视频类型</th>
                        <th width="15%">视频点播量</th>
                        <th width="15%">排行</th>
					</tr>-->
                    <tr>
                        <th width="1%"><img src="img/bl.jpg" alt="" width="16" height="31" /></th>
                        <th width="24%" align="center" valign="middle" background="img/bm.jpg" class="font-hui14">视频名称</th>
                        <th width="1%" align="center" valign="middle" background="img/bm.jpg"><img src="img/hsx.gif" alt="" width="1" height="7" /></th>
                        <th width="14%" align="center" valign="middle" background="img/bm.jpg" class="font-hui14">视频集数</th>
                        <th width="1%" align="center" valign="middle" background="img/bm.jpg"><img src="img/hsx.gif" alt="" width="1" height="7" /></th>
                        <th width="14%" align="center" valign="middle" background="img/bm.jpg" class="font-hui14">视频类型</th>
                        <th width="1%" align="center" valign="middle" background="img/bm.jpg"><img src="img/hsx.gif" alt="" width="1" height="7" /></th>
                        <th width="14%" align="center" valign="middle" background="img/bm.jpg" class="font-hui14">视频点播量</th>
                        <th width="1%" align="center" valign="middle" background="img/bm.jpg"><img src="img/hsx.gif" alt="" width="1" height="7" /></th>
                        <th width="12%" align="center" valign="middle" background="img/bm.jpg" class="font-hui14">排行</th>
                        <th width="1%" align="center" valign="middle" background="img/bm.jpg"><img src="img/hsx.gif" alt="" width="1" height="7" /></th>
                        <th width="1%"><img src="img/br.jpg" alt="" width="14" height="31" /></th>
                    </tr>
        
				</thead>
            </table>
            <table class="mytable" width="80%" border="0" cellspacing="0" cellpadding="0">
				<tbody>
                <?php foreach($videoViewRank as $key => $item):?>
                	<tr>
						<td width="30%" align="center" valign="middle" class="font-hui"><?php echo $item->title;?></td>
                        <td width="18%" align="center" valign="middle" class="font-hui"><?php if($item->number == 0){echo "-";}else{echo $item->number;}?></td>
                        <td width="18%" align="center" valign="middle" class="font-hui"><?php echo $item->name;?></td>
                        <td width="18%" align="center" valign="middle" class="font-hui"><?php echo $item->total;?></td>
                        <td width="16%" align="center" valign="middle" class="font-hui"><?php echo ($key+1) + (($page-1) * $pageSize);?></td>
					</tr>
                <?php endforeach;?>
				</tbody>
			</table>
            <!--page start-->
            <div class="page">
            <?php if($pageInfo['pages'] <= 1): ?>
                <p class="sysinfo">仅有当前一页</p>
            <?php else: ?>
                <!--<a class="mybutton ib" href="<?php echo $basicURL;?>&page=1">第一页</a>-->
                <?php 
                if($pageInfo['now'] == 1){
                    echo '<span class="mybutton ib"><img src="../../img/ljt.gif" alt="" width="22" height="20" border="0" /></span>';
                }else{
                    echo '<a class="mybutton ib" href="'.$basicURL.'&page='.($pageInfo['now']-1).'"><img src="../../img/ljt.gif" alt="" width="22" height="20" border="0" /></a>';
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
                    echo '<span class="mybutton ib"><img src="../../img/rjt.gif" alt="" width="22" height="20"  border="0"/></span>';
                }else{
                    echo '<a class="mybutton ib" href="'.$basicURL.'&page='.($pageInfo['now']+1).'"><img src="../../img/rjt.gif" alt="" width="22" height="20"  border="0"/></a>';
                }
                ?>
                <!--<a class="mybutton ib" href="<?php echo $basicURL.'&page='.$pageInfo['pages']; ?>">最后页</a>-->
            <?php endif; ?>
            </div>
            <!--page end-->
		</div>
	</div>
    <?php include('../../common/admin_footer.html'); ?>
</body>
</html>