<?php
	$epgVideoId = $_GET['epgVideoId'];
	$file = "static/video/video_{$epgVideoId}.html";
	if(file_exists($file) && time() - filemtime($file) < 300){
		header("Location: static/video/video_{$epgVideoId}.html");
		exit();
	}
	session_start();
	include('conn/connect.php');
	ob_start();
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" href="/cloudm_pc/css/common.css" rel="stylesheet">
<link type="text/css" href="/cloudm_pc/css/videoDetail.css" rel="stylesheet">

<title>电影列表</title>
<script type="text/javascript" src="/cloudm_pc/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/cloudm_pc/js/jquery_cookie.js"></script>
</head>

<body>
<div id="container">
	<?php include('common/indexHeader.php')?>

<div id="content" class="content">
   		<span class="font1">电影详情</span>
		
		<?php 
			$sql="select * from epg_video where id=$epgVideoId";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
		?>
		
		<div class="detail" >
			<div class="clearfix">
				<div class="picture" >
					<img class="movie-pic" src="<?php echo $row['poster']?>/2.jpg" />
					<!--以下事件同时可以写成onclick="javascript:window.location.href='movie_play.php'"-->
					<button class="play" title="播放" onclick="location='videoPlay.php?epgVideoId=<?php echo $epgVideoId;?>'" >播放</button>
					<span>播放</span>
				</div>
				
				<div class="info">
					<p class="sinfo">
						<span class="font1">电影名称：</span>
						<span class="font2"><?php echo $row['title'] ;?></span>
					</p>
					<p class="sinfo">
						<span class="font1">上映时间：</span>
						<span class="font2"><?php echo $row['year'] ;?></span>
					</p>
					<p class="sinfo">
						<span class="font1">时&nbsp&nbsp&nbsp 长：</span>
						<span class="font2"><?php echo $row['runtime'] ;?></span>
					</p>
					<p class="sinfo">
						<span class="font1">语&nbsp&nbsp&nbsp 言：</span>
						<span class="font2"><?php echo $row['language'] ;?></span>
					</p>
					<p class="sinfo">
						<span class="font1">导&nbsp&nbsp&nbsp 演：</span>
						<span class="font2"><?php echo $row['author'] ;?></span>
					</p>
					<p class="sinfo">
						<span class="font1">演&nbsp&nbsp&nbsp 员：</span>
						<span class="font2"><?php echo $row['actor'] ;?></span>
					</p>
					<!--
					<p class="sinfo">
						<span class="font1">业务订购：</span>
						<img src="image/business.png" width="50" height="50"/><br/><br/>
						<span class="font2">本电影单次播放：2元/次 </span>
						<input class="order" name="submit" type="button" value="订购" />
						<br/><br/>
						<span class="font2">业务套餐：欧美电影套餐，20元/月</span>
						<input class="order" name="submit" type="button" value="订购"  />
					</p>-->
				</div>
			</div>
			
			<div class="abstract">
				<p class="sinfo">
					<span class="font1">剧情简介：</span>
				</p>
				<p>
					<span class="font2"><?php echo $row['abstract'] ;?></span>
				</p>
			</div>
			
		</div>
		
		<div class="recommend ">
		推荐
		<div style="clear:both"></div>
		</div>
	
</div>


<div id="footer">Copyright </div>
</div>

<script type="text/javascript">
$('.order').click(function(){
		alert('订购成功,点击确定即可观看视频');
		window.location.href="movie_play.php";
		return true;
})
</script>

</body>
</html>
<?php
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/video/video_{$epgVideoId}.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
?>


