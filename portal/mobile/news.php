<!--
    创建时间：		2013年5月6日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0				
                    
    主要功能点：		该页面用于显示新闻列表。
                    包含公告、媒体新闻、运营商新闻、综合新闻
                    公告只显示最新的一条
                    其他新闻类型各显示3条
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';            
-->
<?php
session_start();

//以下为静态化页面代码
	$file = "static/news/news.html";
	if(file_exists($file) && time() - filemtime($file) < 600){
		header("Location: static/news/news.html");
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
<title>云媒体平台-大唐移动</title>
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/index.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div id="header">
    	<div id="logoUser">
        </div>
        <div id="nav">
        	<ul>
            	<li><a href = "<?php echo $config['root']; echo $config['mobile']; ?>recommend.php">推荐</a></li>
            	<li><a href = "<?php echo $config['root']; echo $config['mobile']; ?>liveTV.php">直播</a></li>
				<li class="selected">综合新闻</li>
                <div style="clear:both"></div>
            </ul>
        </div>
    </div>
    
    
    <div id="content">
    	
        <div class="box">
        <!--显示公告信息-->
        	<div class="cat" style="background-color:#015f26">
            	<h2 class="catTitle">网站公告<img class="right" src="<?php echo $config['root']; echo $config['mobile']; ?>img/arrow_left.png" /></h2>
            </div>
			<div>
				<img class="mediaCover left" width="80" src="<?php echo $config['root']; echo $config['mobile']; ?>img/laba.png" /><br/><br/>
                <span class="gonggao">
				<?php 
			  	$db = new DB();
				//根据news_type_id的值从数据库中读出公告
				$sql="select * from news where news_type_id = '1' ORDER BY `id` DESC limit 0,1";  
               // $result=mysql_query($sql);
				//while($row = mysql_fetch_array($result))
				$rows = $db->select($sql);
				foreach($rows as $key => $item){
				  echo $item->title;
				  echo "<br />";
				  }
				?></span>
			</div>
                <div style="clear:both"></div>
        </div>
		
        <div class="box">
         <!--显示媒体新闻-->
        	<div class="cat" style="background-color:#8F3200">
            <h2 class="catTitle">
            	<a href="<?php echo $config['root']; echo $config['mobile']; ?>newsList.php?news_type_id=2">媒体新闻<img class="right" src="<?php echo $config['root']; echo $config['mobile']; ?>img/arrow_left.png" /></a>
            </h2>
            </div>
            <?php
			//根据news_type_id的值从数据库中读出新闻
			$sql="select * from news where news_type_id = '2' ORDER BY `id` DESC limit 0,3";  
			$rows = $db->select($sql);
				foreach($rows as $key => $item){
					echo <<<UL
					<ul class="mediaList">
						<li>
						<br/><img class="mediaCover left" width="20" src="{$config['root']}{$config['mobile']}img/star.png" />
							<span class="gonggao"><a href="{$config['root']}{$config['mobile']}newsDetail.php?id={$item->id}&news_type_id={$item->news_type_id}">{$item->title}</a></span><br/>
							<div style="clear:both"></div>
						</li>
					</ul>
UL;
		}
		?>
        </div>
		
        <div class="box">
         <!--显示运营商新闻-->
        	<div class="cat" style="background-color:#8F3200">
                <h2 class="catTitle">
                <a href="<?php echo $config['root']; echo $config['mobile']; ?>newsList.php?news_type_id=3">运营商新闻<img class="right" src="<?php echo $config['root']; echo $config['mobile']; ?>img/arrow_left.png" /></a>
                </h2>
            </div>
              <?php
			  //根据news_type_id的值从数据库中读出新闻
			$sql="select * from news where news_type_id = '3' ORDER BY `id` DESC limit 0,3";  
			$rows = $db->select($sql);
				foreach($rows as $key => $item){
				echo <<<UL
					<ul class="mediaList">
						<li>
						<br/><img class="mediaCover left" width="20" src="{$config['root']}{$config['mobile']}img/star.png" />
							<span class="gonggao"><a href="{$config['root']}{$config['mobile']}newsDetail.php?id={$item->id}&news_type_id={$item->news_type_id}">{$item->title}</a></span><br/>
							<div style="clear:both"></div>
						</li>
					</ul>
UL;
		}
		?>
        </div>
		
        
        <div class="box">
        <!--显示综合新闻-->
        	<div class="cat" style="background-color:#8F3200">
                <h2 class="catTitle">
                <a href="<?php echo $config['root']; echo $config['mobile']; ?>newsList.php?news_type_id=4">综合新闻<img class="right" src="<?php echo $config['root']; echo $config['mobile']; ?>img/arrow_left.png" /></a>
                </h2>
            </div>
           <?php
		   //根据news_type_id的值从数据库中读出新闻
			$sql="select * from news where news_type_id = '4' ORDER BY `id` DESC limit 0,3";  
			$rows = $db->select($sql);
				foreach($rows as $key => $item){
				echo <<<UL
					<ul class="mediaList">
						<li>
						<br/><img class="mediaCover left" width="20" src="{$config['root']}{$config['mobile']}img/star.png" />
							<span class="gonggao"><a href="{$config['root']}{$config['mobile']}newsDetail.php?id={$item->id}&news_type_id={$item->news_type_id}">{$item->title}</a></span><br/>
							<div style="clear:both"></div>
						</li>
					</ul>
UL;
		}
		?>
        </div>
    </div>
    	<br/>
<?php 
	include('lib/footer.php'); 

//***********静态化页面底部代码******************
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/news/news.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//**********************************************
	?>
