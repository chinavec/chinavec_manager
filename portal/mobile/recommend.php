<?php
/*
    创建时间：		2013年5月7日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0
                    
                    
    主要功能点：		该页面用于显示推荐的点播视频列表。电影、电视剧、综艺、音乐、其他都分别显示两个最新的release视频信息，不包含集团视频
                    release为0表示门户管理设置了该视频在门户前端显示。
    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';            
*/

session_start();

//以下为静态化页面代码
	$file = "static/recommend.html";
	if(file_exists($file) && time() - filemtime($file) < 1){
		header("Location: static/recommend.html");
		exit();
	}
	ob_start();
//**************************************************

	require "lib/connect.php";
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
?>
<title>大唐云媒体</title>
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/index.css" rel="stylesheet" type="text/css"><!--本系统开发的主页面css-->
</head>
<body>

	<div id="header">
    	<div id="logoUser">
        <p>返回主页</p></div>
        <div id="nav">
        	<ul>
            	<li class="selected">推荐</li>
				<li><a href = "<?php echo $config['root']; echo $config['mobile']; ?>liveTV.php">直播</a></li>
				<li><a href = "<?php echo $config['root']; echo $config['mobile']; ?>news.php">综合新闻</a></li>
                <div style="clear:both"></div>
            </ul>
        </div>
    </div>
    
    
    <div id="content">
    	<div class="box">
            
           <?php  
            $db = new DB();
			//将数据库中的label顺序读出
			$label = $db->select_condition('epg_label');
			foreach($label as $key => $item){
			?>
            
            <div class="cat" style="background-color:#015f26">
            	<h2 class="catTitle">
                	<a href="<?php echo $config['root']; echo $config['mobile']; ?>businessList.php?label=<?php echo $item->id;?>"><?php echo $item->name;?><img class="right" src="<?php echo $config['root']; echo $config['mobile']; ?>img/arrow_left.png" /></a>
                </h2>
        	</div>
            
            <?php
			//每个label标签下选出两个最新添加的视频信息显示出来
				$sql = "SELECT * FROM  `epg_video` WHERE `label_id`={$item->id} and `release`=0 and `group_id`='' GROUP BY title ORDER BY `id` DESC limit 0,2" ;
				$video = $db->select($sql);
				foreach($video as $key => $value) {?>		
                    <ul class="mediaList">
                        <li>
                        <!--点击后跳转到视频判断的页面-->
                        <a href="<?php echo $config['root']; echo $config['mobile']; ?>videoJudge.php?id=<?php echo $value->id;?>&label=<?php echo $item->id;?>">
                        	<img class="mediaCover left" width="80" src="<?php echo $config['root']; echo $config['mamPoster'];echo $value->poster;?>" />
                        </a>
                        <div class="mediaInfo">
                            <h3 class="mediaTitle">
                                <a href="<?php echo $config['root']; echo $config['mobile']; ?>videoJudge.php?id=<?php echo $value->id;?>&label=<?php echo $item->id;?>">
                                	<?php echo $value->title;?>
                                </a>
                            </h3>
                                <br/>
                                <?php
								//不同label标签条件下，author、actor显示的中文名称不同         
                                switch ($item->id)
                                    {
                                        case "1":	echo "导演:";	break;
                                        case "2":	echo "导演:";	break;
                                        case "3":	echo "词曲:";	break;
                                        case "4":	echo "主持人:";	break;
                                        case "5":	echo "创作:";	break;
                                        default:	echo "抱歉，没有您要找的内容！";
                                    }
                                    echo $value->author.'<br/>'.'<br/>';
                                switch ($item->id)
                                    {
                                        case "1":	echo "演员：";	break;
                                        case "2":	echo "演员：";	break;
                                        case "3":	echo "演唱： ";	break;
                                        case "4":	echo "嘉宾：";	break;
                                        case "5":	echo "制作： ";	break;
                                        default:	echo "";
                                    }
                                    echo $value->actor;
                                ?>
                           <!--<a href="#" class="mediaDetail">详细信息<img src="img/detail_icon.png" /></a>-->
                            </div>
                            <div style="clear:both"></div>
                        </li>
                    </ul>
            <?php } }?>
        </div>
    </div>
	<br/>
<?php 
	include('lib/footer.php'); 
//***********静态化页面底部代码******************
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/recommend.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//**********************************************
?>
