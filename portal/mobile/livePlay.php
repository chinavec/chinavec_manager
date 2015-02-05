<!--
    创建时间：		2013年5月6日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0				
                    
    主要功能点：		该页面用于显示用户的直播播放列表。
                    该页面的前端是直播频道名称、直播播放界面。
                    下方显示为该直播频道的节目单信息，包含今天在内往前的七天节目。
                    已过直播时间的节目可以点击“观看回放”
                    正在直播的节目显示为“正在直播”
    
    全局配置变量：		$config['root'] = '/cloudm/';
					$config['paymentServer'] = '222.31.73.204';	               
					$config['portalServer'] = '222.31.73.204';             
					$config['userServer'] = '222.31.73.204';				
-->
<?php
session_start();
//**************************创建该页面的css：livePlay.css***************

	$liveChannelId = $_GET['liveChannelId'];
	
	//以下为静态化页面代码
	$file = "static/live/livePlay_{$liveChannelId}.html";
	if(file_exists($file) && time() - filemtime($file) < 1){
		header("Location: static/live/livePlay_{$liveChannelId}.html");
		exit();
	}
	include('lib/connect.php');
	ob_start();
	//**************************************************
	
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件

	//$sql = "SELECT * FROM  `epg_live_channel` WHERE id = {$_GET['id']}";
	//$result = mysql_query($sql);
	//$row=mysql_fetch_object($result);
	$db = new DB();//使用数据库操作类替换上述语句，根据id选出符合条件的直播频道信息
	$row = $db->select_condition_one('epg_live_channel', array('id' => $liveChannelId));
?>

<title>云媒体平台</title>
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/index.css" rel="stylesheet" type="text/css"><!--使用了公用的css样式-->
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/livePlay.css" rel="stylesheet" type="text/css">
</head>
<body>
	
    <div id="header">
    	<div id="logoUser"></div>
        <div id="nav">
        	<ul>
            	<li>直播频道</li>
            </ul>
        </div>
    </div>
   
   <div id="content">
    	<div class="box">
            <li><br/>
            	<!--显示从数据库读出的直播节目信息-->
                <img class="mediaCover left" width="80" src="<?php echo $config['root']; echo $config['livePoster']; echo $row->logo;?>" />
                <div class="mediaInfo">
                    <h3 class="mediaTitle"><?php echo $row->name;?></h3>
                </div>
                <div style="clear:both"></div>
            </li>
            <div style="clear:both"></div>
        </div>
       
      <!--JWplay视频播放器--------------------------------------------
		<div align="center" style="margin-left:5%;width:90%">
		<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="100%" height="500" >
			<param name="movie" value="<?php// echo $config['root']; echo $config['mobile']; ?>swf/player.swf" />
			<param name="allowfullscreen" value="true" />
			<param name="allowscriptaccess" value="always" />
			<param name="flashvars" value="http://222.31.88.37/live/DFDFSGc8df32207265fe65f025017live?fmt=x264_800_ts" />
			<embed type="application/x-shockwave-flash" src="<?php// echo $config['root']; echo $config['mobile']; ?>swf/player.swf" width="100%" height="500" style="undefined" id="flp" name="flp" quality="high" allowfullscreen="true" allowscriptaccess="always" wmode="transparent" flashvars="autostart=true&amp;file=http://222.31.88.37/live/DFDFSGc8df32207265fe65f025017live?fmt=x264_800_ts&amp;pausemode=0&amp;type=SOFLVLive&amp;enablejs=true&amp;javascriptid=flp&amp;width=100%&amp;">
		</object>
		</div>--->
       
       
       
       
      <div style="margin-left:5%;width:90%">
			<video width="100%" controls>
           <!--***************直播节目播放，使用video标签，支持MP4格式********************************-->
			 <source src="<?php echo $config['root'];echo $config['mobile'];echo $row->live_url_mo; ?>" type="video/ts"><!--HTML5播放标签-->
				
              <!--flash播放标签，作为不支持video标签时的备用播放器-->
                <embed
					width="100%"
					type="application/x-shockwave-flash"
					id="player2"
					name="player2"
					src="swf/player.swf" 
					allowscriptaccess="always" 
					allowfullscreen="true"
					flashvars="file=<?php echo $config['root'];echo $config['mobile'];echo $row->live_url_mo; ?>&image=<?php echo $config['root'];echo $config['poster'];echo $row->poster; ?>" 
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
		//根据条件选取显示合适的节目单信息，按照播出开始时间的先后排序
		$sql = "select * from epg_live_programme where epg_live_channel_id=$liveChannelId and date>=".strtotime(date('Y-m-d 00:00:00'))." and date<".strtotime('+1 day', strtotime(date('Y-m-d 00:00:00')))." order by start_time asc";
		$result = $db -> select($sql);
	?>
		<div class="programmeTab">
		
	<!---ul是时间排序-------------------------------------------------------->
			<ul class="programmeMenu">
				<li id="tab_1">
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
					<!--显示节目起始时间-->
					<?php echo date('H:m',$item->start_time);?>-<?php echo date('H:m',$item->end_time);?>
					&nbsp;&nbsp;
                    <!--显示节目名称-->
					<?php echo $item->name;?>
				</span>
				<span class="font2">&nbsp;<?php echo $item->abstract;?></span>
		
				<?php  
				if(strtotime('now') > $item->end_time){
					echo '<a href="'.$config['root'].$config['mobile'].'timeShiftJudge.php?timeShiftId='.$item->id.'&liveChannelId='.$liveChannelId.'"><span class = "huifang">观看回放</span></a>';
				}
				else if(strtotime('now') >= $item->start_time && strtotime('now') <=  $item->end_time){
					echo '<span class = "zhengzaizhibo">正在播放</span>';
				}
				else{
					echo "";
				};
				?>
            </p>
            
		<?php } ?>
		</div>
		
	<!----显示之前6天的节目单------------------------------------------------------------->	
		<?php 
		//根据时间顺序读取数据库
		for($i = 1; $i < 7; $i++){
			$sql = "select * from epg_live_programme where epg_live_channel_id=$liveChannelId and `date`>=".strtotime("-{$i} day", strtotime(date('Y-m-d 00:00:00')))." AND `date`<".strtotime("-".($i-1)." day", strtotime(date('Y-m-d 00:00:00')))." order by start_time desc";
			$result = $db -> select($sql);
		?>
		
            <div class="tab_b" id="tab_a<?php echo $i+1; ?>" style="display:none;">
            <?php foreach($result as $key=> $item){?>
                <p style="padding:5px 0">
                <img class="mediaCover left" width="17" src="<?php echo $config['root'];echo $config['mobile']; ?>img/star.png" />
                    
                   <!--显示节目起始时间、结束时间及名称--> 
                    <span class="font1">
                        <?php echo date('H:m',$item->start_time);?>-<?php echo date('H:m',$item->end_time);?>
                        &nbsp;&nbsp;
                        <?php echo $item->name;?></span>
                    <span class="font2">&nbsp;<?php echo $item->abstract;?></span>
                
                    <?php 
                    //根据起始时间、结束时间判断节目的播放状态：已播放、正在播放或者还没有播放，并显示不同的状态 
                    if(strtotime('now') > $item->end_time){
                        echo '<a href="'.$config['root'].$config['mobile'].'timeShiftJudge.php?timeShiftId='.$item->id.'&liveChannelId='.$liveChannelId.'">观看回放</a>';
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

	
	$fp = fopen("static/live/livePlay_{$liveChannelId}.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//**********************************************	
	?>