<?php
	$epgVideoId = $_GET['epgVideoId'];
	$label = $_GET['label'];
	
	/*
	$file = "static/video/videoPlay_{$epgVideoId}.html";
	if(file_exists($file) && time() - filemtime($file) < 300){
		header("Location: static/video/videoPlay_{$epgVideoId}.html");
		exit();
	}
	ob_start();
	*/
	session_start();
	require('config/portalConfig.php');
	include('conn/connect.php');
	require('lib/db.class.php');
	$db = new DB();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" href="<?php echo $config['root'];?>css/videoPlay.css" rel="stylesheet">

<title>电影播放</title>
<script type="text/javascript" src="<?php echo $config['root'];?>js/jquery-1.7.1.min.js"></script>
</head>

<body>
<div id="container">
	<?php include('common/indexHeader.php')?>
	
	<?php 
		$sql = "select * from epg_video right join epg_label on epg_video.label_id = epg_label.id where epg_video.id=$epgVideoId ";
		$result = $db->select_one($sql);
		$title = $result->title ;
	?>
	<div id="content" class="content">
		<div class="playerHead">
		<span class="font1">
		<a href="<?php echo $config['root'];?>videoList.php?label=<?php echo $label ;?>" >
		<?php echo $result->name ;?>
		</a>>><?php echo $result->title ;?>>>视频播放</span>
		</div>
		
<!--JWplay视频播放器----------------------------------------------->
		<div align="center">
		<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="960" height="500">
			<param name="movie" value="<?php echo $config['root'];?>swf/player.swf" />
			<param name="allowfullscreen" value="true" />
			<param name="autoplay" value="false" />
			<param name="allowscriptaccess" value="always" />
			<param name="flashvars" value="file=<?php echo $result->video_url;?>&image=<?php echo $config['root'];?>image/picture/movie1/1.jpg" />
			<embed type="application/x-shockwave-flash" src="<?php echo $config['root'];?>swf/player.swf" width="960" height="500" style="undefined" id="flp" name="flp" quality="high" allowfullscreen="true" autoplay="false" allowscriptaccess="always" wmode="transparent" flashvars="autostart=true&amp;file=<?php echo $result->video_url;?>&image=<?php echo $result->poster ;?>/1.jpg;
		pausemode=0&amp;type=SOFLVLive&amp;enablejs=true&amp;javascriptid=flp&amp;width=960&amp;height=500">
		</object>
		</div>
		
		<div class="save">保存到云端
			<img src="image/cloud-logo.png" width="60" height="40"/>
		</div>
		<div></div>

		<div class="info">
			<p class="sinfo">
				<span class="font1">名称：</span>
				<span class="font2"><?php echo $result->title ;?></span>
			</p>
			<p class="sinfo">
				<span class="font1">时间：</span>
				<span class="font2"><?php echo $result->year ;?></span>
			</p>
			<p class="sinfo">
				<span class="font1">
				<?php 
						switch ($label)
						{
							case "1":	echo "导演：";	break;
							case "2":	echo "导演：";	break;
							case "3":	echo "主持人：";	break;
							case "4":	echo "词曲：";	break;
							case "5":	echo "创作：";	break;
							default:	echo "";
						}
				?>
				</span>
				<span class="font2"><?php echo $result->author ;?></span>
			</p>
			<p class="sinfo">
				<span class="font1">
				<?php 
						switch ($label)
						{
							case "1":	echo "演员：";	break;
							case "2":	echo "演员：";	break;
							case "3":	echo "嘉宾： ";	break;
							case "4":	echo "演唱：";	break;
							case "5":	echo "制作： ";	break;
							default:	echo "";
						}
				?>
				</span>
				<span class="font2"><?php echo $result->actor ;?></span>
			</p>
			<p class="sinfo">
				<span class="font1">时长：</span>
				<span class="font2"><?php echo $result->runtime ;?></span>
			</p>
			<p class="sinfo">
				<span class="font1">语言：</span>
				<span class="font2"><?php echo $result->language ;?></span>
			</p>
			
			<?php 
			switch ($label)
			{
/*--电影----------------------------------------------*/
				case "1":?>
				<div class="abstract">
					<p class="sinfo">
						<span class="font1">剧情简介：</span>
					</p>
					<p>
						<span class="font2"><?php echo $result->abstract ;?></span>
					</p>
				</div>
			<?php break; 
					case "2":
/*--电视剧----------------------------------------------*/
			?>
			<?php 
				$sql="select * from epg_video where title = '$title' order by episode asc";
				$result = $db->select($sql);
				$abstract = $result['0']->abstract;//得到所有的电视剧集，只去其中第一的剧情简介就行了
			?>
				<div class="episode">
					<span class="font1">集数：</span><br/>
					<?php foreach($result as $key =>$item){?>
					<a href="<?php echo $config['root'];?>videoPlay.php?label=<?php echo $label;?>&epgVideoId=<?php echo $item->id;?>">
						<div class="dramaPlay"><?php echo $item->episode ;?></div>
					</a>
					<?php }?>
				</div>

				<div class="abstract">
					<p class="sinfo">
						<span class="font1">剧情简介：</span>
					</p>
					<p>
						<span class="font2"><?php echo $abstract ;?></span>
					</p>
				</div>
				<?php break; 
						case "3":
/*--综艺----------------------------------------------*/
				?>
				<?php 
					$sql="select * from epg_video where title = '$title' order by video_create_time asc";
					$result = $db->select($sql);
					echo $result->year;
				?>
				<div class="episode">
					<span class="font1">期数：</span><br/>
					<?php foreach($result as $key =>$item){?>
					<a href="<?php echo $config['root'];?>videoPlay.php?label=<?php echo $label;?>&epgVideoId=<?php echo $item->id ;?>">
						<span class="play">
						<?php echo $item->year;?>
						</span>
					</a>
					<?php }?>
				</div>

				<?php break; 
						case "4":
/*--音乐----------------------------------------------*/
				?>
				<?php 
					$sql="select * from epg_video where title = '$title' order by video_create_time asc";
					$result = $db->select($sql);
				?>
				<div class="episode">
					<span class="font1">歌曲</span><br/>
					<a href="<?php echo $config['root'];?>videoPlay.php?label=<?php echo $label;?>&epgVideoId=<?php echo $epgVideoId;?>;?>">
						<div class="play"></div>
					</a>
				</div>
				
				<?php break; 
						case "5": echo ""; break;
						default:	echo "";
				}
				/*--其它----------------------------------------------*/
				?>
			
				</div>
				<div style="clear:both"></div>
		
		<!---推荐------------------------->	
		<div class="recommend">
			<div class="recommendHeader">
				<span class="font1">热门推荐</span> 
				<span class="font2"> Recommend</span>
				<hr style="border:1px medium #999999;/>
			</div>
			
			<div class="recommendMore">
			<?php 
				$sql = "select * from epg_video where recommend=1 and label_id=$label order by id desc limit 9";
				$result = $db->select($sql);
			?>
				<div class="recommendBig">
					<?php $item = $result[0]; ?>
					<a href="<?php echo $config['root'];?>videoDetail.php?label=<?php echo $label;?>&epgVideoId=<?php echo $item->id;?>">
					<div class="recommendBigPicture"><img src="<?php echo $item->poster;?>/2.jpg" width="162" height="229"/></div>
					<span class="font1"><?php echo $item->title ;?></span><br/>
					</a>
				</div>
				
				<?php 
				foreach($result as $key => $item){
				if( $key !=0){	
				?>
				<div class="recommendSmall">
					<a href="<?php echo $config['root'];?>videoDetail.php?label=<?php echo $label;?>&epgVideoId=<?php echo $item->id;?>">
					<div class="recommendSmallPicture">
						<img src="<?php echo $item->poster;?>/3.jpg" width="150" height="104"/>
					</div>
					<span class="font2"><?php echo $item->title ;?></span>
					</a>
				</div>
				<?php }?>
				<?php }?>
			</div>
			<div style="clear:both"></div>	
		</div>
		
	</div>
	<div id="footer">Copyright </div>
</div>
</body>
</html>
<?php
/*
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/video/videoPlay_{$epgVideoId}.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
*/
?>


