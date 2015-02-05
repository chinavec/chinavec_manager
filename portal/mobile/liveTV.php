<!--
    创建时间：		2013年4月26日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0				
                    
    主要功能点：		该页面用于显示直播频道列表。
    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';            
-->
<?php

session_start();

//以下为静态化页面代码
	$file = "static/live/liveTV.html";
	if(file_exists($file) && time() - filemtime($file) < 1){
		header("Location: static/live/liveTV.html");
		exit();
	}
	include('lib/connect.php');
	ob_start();
//**************************************************

	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文
?>
<title>直播频道</title>
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="header">
    	<div id="logoUser">
        </div>
        <div id="nav">
        	<ul>
            	<li><a href = "<?php echo $config['root']; echo $config['mobile']; ?>recommend.php">推荐</a></li>
            	<li class="selected">直播</li>
				<li><a href = "<?php echo $config['root']; echo $config['mobile']; ?>news.php">综合新闻</a></li>
                <div style="clear:both"></div>
            </ul>
        </div>
    </div>
    <div id="content">
    	<div class="box">
        	<div class="cat" style="background-color:#015f26">
                <h2 class="catTitle">热门频道<img class="right"/></h2>
            </div>
		<?php
		$db = new DB();
		//根据条件，排除集团直播节目后选取出所有的直播列表
		$sql = "SELECT * FROM  `epg_live_channel` WHERE group_id IS NULL ORDER BY `id` ASC";
		//$result = mysql_query($sql);
		//while($row=mysql_fetch_object($result)) {
		$rows = $db->select($sql);
		//循环显示直播节目的列表、图标、名称等
		foreach($rows as $key => $item){
			echo <<<UL
			<ul class="mediaList">
			<li>
				<a href="{$config['root']}{$config['mobile']}liveJudge.php?liveChannelId={$item->id}"><img class="mediaCover left" width="80" src="{$config['root']}{$config['livePoster']}{$item->logo}" /></a>
				<div class="mediaInfo">
						<h3 class="mediaTitle"><a href="{$config['root']}{$config['mobile']}liveJudge.php?liveChannelId={$item->id}">{$item->name}</a></h3>
						<p>播放：6,554次</p>
						<p><img src="{$config['root']}{$config['mobile']}img/rate.png" /></p>
						<a href="#" class="mediaDetail">详细信息<img src="{$config['root']}{$config['mobile']}img/detail_icon.png" /></a>
					</div>
					<div style="clear:both"></div>
				</li>
			</ul>
UL;
		}
		?>
                <!--<li>
                <a href="{$config['root']}.{$config['mobile']}.livePlay.php?id = {$row->id} & live_url = {$row->live_url}"><img class="mediaCover left" width="80" src="{$config['root']}.{$config['mobile']}.{$row->logo}" /></a>
                <div class="mediaInfo">
                        <h3 class="mediaTitle"><a href="{$config['root']}.{$config['mobile']}.livePlay.php?id={$row->id}&live_url={$row->live_url}">{$row->name}</a></h3>
                        <p>播放：6,554次</p>
                        <p><img src="{$config['root']}.{$config['mobile']}.img/rate.png" /></p>
                        <a href="#" class="mediaDetail">详细信息<img src="{$config['root']}.{$config['mobile']}.img/detail_icon.png" /></a>
                    </div>
                    <div style="clear:both"></div>
                </li>-->
        </div>
    </div>
    <br/>
<?php 
	include('lib/footer.php');
//***********静态化页面底部代码******************
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/live/liveTV.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//**********************************************
	 ?>