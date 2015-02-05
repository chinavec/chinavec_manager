<?php 
	session_start();
	include('conn/connect.php');
	require('lib/db.class.php');
	$liveChannelId = $_GET['liveChannelId'];
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" href="css/liveTVPlay.css" rel="stylesheet">

<title>电影列表</title>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
</head>

<body>
<div id="container">
	<?php include('common/indexHeader.php')?>
	<div class="content">
	<?php 
		$db = new DB();
		$result = $db->select_condition_one('epg_live_channel', array('id' => $liveChannelId));
	?>
		<div class="playerHead">
		<span class="font1"><a href="liveTVList.php">直播频道</a>>><?php echo $result->name;?></span>
		</div>
<!--JWplay视频播放器----------------------------------------------->
		<div align="center">
		<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="960" height="500">
			<param name="movie" value="swf/player.swf" />
			<param name="allowfullscreen" value="true" />
			<param name="allowscriptaccess" value="always" />
			<param name="flashvars" value="file=<?php echo $result->live_url?>" />
			<embed type="application/x-shockwave-flash" src="swf/player.swf" width="960" height="500" style="undefined" id="flp" name="flp" quality="high" allowfullscreen="true" allowscriptaccess="always" wmode="transparent" flashvars="autostart=true&amp;file=<?php echo $result->live_url?>&amp;pausemode=0&amp;type=SOFLVLive&amp;enablejs=true&amp;javascriptid=flp&amp;width=960&amp;height=500">
		</object>
		</div>
		
		<script language="javascript">
			function tabs(n)
			{
			var len = 7;
			for (var i = 1; i <= len; i++)//循环比较
			{
			document.getElementById('tab_a' + i).style.display = (i == n) ? 'block' : 'none';//节目单
			document.getElementById('tab_' + i).className = (i == n) ? 'aaa' : 'none';//日期
			}
			}
		</script>

	<?php 
		$db = new DB();
		$sql = "select * from epg_live_programme where epg_live_channel_id=$liveChannelId and date>=".strtotime(date('Y-m-d 00:00:00'))." and date<".strtotime('+1 day', strtotime(date('Y-m-d 00:00:00')))." order by start_time desc";
		$result = $db -> select($sql);
	?>
		<div class="programmeTab">
		
	<!---ul是时间排序-------------------------------------------------------->
			<ul class="programmeMenu">
				<li id="tab_1" class="aaa">
					<span class="font3">
					<a href="javascript:void(0)" onclick="tabs('1');" ><?php echo date('m月d日'); ?></a>
					</span>
				</li>
 				<?php for($i = 1; $i < 7; $i++){ ?>
				<li id="tab_<?php echo $i+1; ?>">
					<span class="font3">
					<a href="javascript:void(0)" onclick="tabs('<?php echo $i+1; ?>');" >
					<?php echo date('m月d日', strtotime("-{$i} day")); ?>
					</a>
					</span>
				</li>
				<?php } ?>
			</ul>
			
	<!---今天的节目单------------------------------------------------------------->
		<div class="tab_b" id="tab_a1" style="display:block;">
		<?php foreach($result as $key=> $item){?>
			<p style="padding:5px 0">
				<span class="font1">
					<?php echo date('H:m',$item->start_time);?>-<?php echo date('H:m',$item->end_time);?>
					&nbsp;&nbsp;
					<?php echo $item->name;?>
				</span>
				<span class="font2">&nbsp;<?php echo $item->abstract;?></span>
		
				<?php  
				if(strtotime('now') > $item->end_time){
					echo "时移";
				}
				else if(strtotime('now') >= $item->start_time && strtotime('now') <=  $item->end_time){
					echo "正在播放";
				}
				else{
					echo "敬请期待";
				};
				?>
			</p>
		<?php } ?>
		</div>
		
	<!----之前6天的节目单------------------------------------------------------------->	
		<?php 
		for($i = 1; $i < 7; $i++){
			$sql = "select * from epg_live_programme where epg_live_channel_id=$liveChannelId and `date`>=".strtotime("-{$i} day", strtotime(date('Y-m-d 00:00:00')))." AND `date`<".strtotime("-".($i-1)." day", strtotime(date('Y-m-d 00:00:00')))." order by start_time desc";
			$result = $db -> select($sql);
		?>
		
		<div class="tab_b" id="tab_a<?php echo $i+1; ?>" style="display:none;">
		<?php foreach($result as $key=> $item){?>
			<p style="padding:5px 0">
				<span class="font1">
				<?php echo date('H:m',$item->start_time);?>-<?php echo date('H:m',$item->end_time);?>
				&nbsp;&nbsp;
				<?php echo $item->name;?></span>
				<span class="font2">&nbsp;<?php echo $item->abstract;?></span>
			
				<?php  
				if(strtotime('now') > $item->end_time){
					echo "时移";
				}
				else if(strtotime('now') >= $item->start_time && strtotime('now') <=  $item->end_time){
					echo "正在播放";
				}
				else{
					echo "敬请期待";
				};
				?>
			</p>
		<?php } ?>
		</div>
		
		<?php } ?>
		</div>
		
		<div class="channelList">
			<div class="channelListTop">
				<span class="font1">直播频道</span> 
				<span class="font2">Live Channel</span>
			</div>
			<?php 
			$db = new DB();
			$liveChannel= $db ->select_condition('epg_live_channel');
			?>
			<ul class="channel">
				<?php foreach($liveChannel as $key => $item){?>
				<a href="liveTVPlay.php?liveChannelId=<?php echo $item->id ;?>" >
				<li><span class="font3"><?php echo $item->name ;?></span>
				<span class="font2">&nbsp 正在播放...</span>
				</li></a>
				<?php }?>
			</ul>	
		</div>
		<div style="clear:both"></div>
	</div>
	<div id="footer">Copyright </div>
	
</div>
</body>
</html>

