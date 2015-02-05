<!--
    创建时间：		2013年5月8日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0				
                    
    主要功能点：		该页面用于播放时移视频。

    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';           
            
-->
<?php
session_start();

	$liveChannelId = $_GET['liveChannelId'];
	$timeShiftId = $_GET['timeShiftId'];
	
	//以下为静态化页面代码********************************************************
	$file = "static/live/timeShiftId_{$timeShiftId}_{$liveChannelId}.html";
	if(file_exists($file) && time() - filemtime($file) < 1){
		header("Location: static/live/timeShiftId_{$timeShiftId}_{$liveChannelId}.html");
		exit();
	}
	include('lib/connect.php');
	ob_start();
	//************************************************************************
	
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件

	$db = new DB();//使用数据库操作类
	//根据传递过来的id从epg_live_channel中选出相应的直播频道
	$row = $db->select_condition_one('epg_live_channel',array('id' => $_GET['liveChannelId']));
	//根据传递过来的timeShiftId从epg_live_programme中选出相应的直播节目信息
	$programme = $db->select_condition_one('epg_live_programme',array('id' => $_GET['timeShiftId']));
	//根据传递过来的timeShiftId从epg_recording_video中选出相应的时移节目信息
	$timeShift = $db->select_condition_one('epg_recording_video',array('epg_live_programme_id' => $_GET['timeShiftId']));
?>

<title>云媒体平台</title>
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/index.css" rel="stylesheet" type="text/css"><!--使用了公用的css样式-->
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/livePlay.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="header">
    	<div id="logoUser">
		</div>
        <div id="nav">
        	<ul>
            	<!--显示频道名称-->
            	<li><?php echo $programme->name;?></li>
            </ul>
        </div>
    </div>
   <div id="content">
    	<div class="box">
            	<li><br/>
                	<img class="mediaCover left" width="80" src="<?php echo $config['root']; echo $config['live']; echo $row->logo;?>" />
                    <div class="mediaInfo">
                    	<h3 class="mediaTitle"><?php echo $row->name;?></h3>
                    </div>
                    <div style="clear:both"></div>
                </li>
                <div style="clear:both"></div>
        </div>
        
        <div style="margin-left:5%;width:90%">
			<video width="100%" controls>
            <!--***************时移节目播放*********************************************-->
			 <source src="<?php echo $config['root'];echo $config['mobile'];echo $timeShift->time_shift_url; ?>" type="video/mp4"><!--HTML5播放标签-->
				
                <!--flash播放标签，video标签不支持时的备用方案-->
                <embed
					width="100%"
					type="application/x-shockwave-flash"
					id="player2"
					name="player2"
					src="swf/player.swf" 
					allowscriptaccess="always" 
					allowfullscreen="true"
					flashvars="file=<?php echo $config['root'];echo $config['mobile'];echo $tmeShift->time_shift_url; ?>" 
				/>
                
			</video>
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
					<a href="javascript:void(0)" onclick="tabs('1');" ><?php echo date('m.d'); ?></a>
					</span>
				</li>
 				<?php for($i = 1; $i < 7; $i++){ ?>
				<li id="tab_<?php echo $i+1; ?>">
					<span class="font3">
                        <a href="javascript:void(0)" onclick="tabs('<?php echo $i+1; ?>');" >
                        	<?php echo date('m.d', strtotime("-{$i} day")); ?>
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
                <img class="mediaCover left" width="17" src="<?php echo $config['root'];echo $config['mobile']; ?>img/star.png" />
					<?php echo date('H:m',$item->start_time);?>-<?php echo date('H:m',$item->end_time);?>
					&nbsp;&nbsp;
					<?php echo $item->name;?>
				</span>
				<span class="font2">&nbsp;<?php echo $item->abstract;?></span>
		
				<?php  
				if(strtotime('now') > $item->end_time){
					echo '<a href="'.$config['root'].$config['mobile'].'timeShiftPlay.php?timeShiftId='.$item->id.'&liveChannelId='.$liveChannelId.'"><span class = "huifang">观看回放</span></a>';
				}
				else if(strtotime('now') >= $item->start_time && strtotime('now') <=  $item->end_time){
					echo '<a href="'.$config['root'].$config['mobile'].'livePlay.php?id='.$liveChannelId.'&live_url='.$row->live_url.'"><span class = "zhengzaizhibo">正在播放</span></a>';
				}
				else{
					echo "";
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
            <img class="mediaCover left" width="17" src="<?php echo $config['root'];echo $config['mobile']; ?>img/star.png" />
				<span class="font1">
					<?php echo date('H:m',$item->start_time);?>-<?php echo date('H:m',$item->end_time);?>
                    &nbsp;&nbsp;
                    <?php echo $item->name;?>
                </span>
				<span class="font2">&nbsp;<?php echo $item->abstract;?></span>
			
				<?php  
				if(strtotime('now') > $item->end_time){
					echo '<a href="'.$config['root'].$config['mobile'].'timeShiftPlay.php?timeShiftId='.$item->id.'&liveChannelId='.$liveChannelId.'">观看回放</a>';
				}
				else if(strtotime('now') >= $item->start_time && strtotime('now') <=  $item->end_time){
					echo '<span class = "zhengzaibofang">正在播放</span>';
				}
				else{
					echo "";
				};
				?>
			</p>
		<?php } ?>
		</div>
		
		<?php } ?>
		</div>
<div style="clear:both"></div>
</div>

<?php 
	include('lib/footer.php'); 
	
//***********静态化页面底部代码******************
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/live/timeShiftId_{$timeShiftId}_{$liveChannelId}.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//**********************************************	
?>