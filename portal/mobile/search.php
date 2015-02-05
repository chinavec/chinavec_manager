<!--
    创建时间：		2013年5月8日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0				
                    
    主要功能点：		该页面用于用户搜索点播视频。
    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';           
            
-->
<?php
session_start();

	include "lib/header.php";
	include "lib/connect.php";
	require('../../lib/util.class.php');
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
	
	$db = new DB();
	$u = new Util();
	$q = isset($_GET['q']) ? $u->inputSecurity($_GET['q']) : '';
	if($q != ''){
		$sql = "SELECT * FROM `epg_video` WHERE `title` LIKE '%$q%'";
		if($result = $db->select($sql)){
			$warning = '';
		}else{
			$warning = '没有找到您要查询的内容!';
		}
	}
	else{
		//未进行搜索时，执行以下操作
		$warning = '';
		$sql = "SELECT * FROM `epg_video` WHERE `label_id` =1 and `release`=0 and `group_id`='' GROUP  BY  title ORDER BY `id` DESC limit 0,5";
		$result = $db->select($sql);
	}
?>
<title>云媒体平台-大唐移动</title>
<link href="css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="header">
    	<div id="logoUser"></div></div>
      
        <form action="" method="get">
            <input type="text" name="q" placeholder="输入视频名称查询"/>
            <input type="submit" value="搜索" />
    	</form>
        
		<?php 
		echo $warning.'<br/>';
		foreach($result as $key => $row){ ?>
			<ul class="mediaList">
			    <li>
                    <a href="videoJudge.php?id=<?php echo $row->id; ?>&label={$label}">
                    	<img class="mediaCover left" width="80" src="<?php echo $config['root']; echo $config['mamPoster'];echo $row->poster;?>" />
                    </a>
                    <div class="mediaInfo">
                    <h3 class="mediaTitle">
                    	<a href="videoJudge.php?id=<?php echo $row->id; ?>&label={$label}"><?php echo $row->title;?></a>
                    </h3>
                   	<br/>
                    <?php  
                        switch ($row->label_id)
                        {
                            case "1":	echo "导演：";	break;
                            case "2":	echo "导演：";	break;
                            case "3":	echo "词曲：";	break;
                            case "4":	echo "主持人：";	break;
                            case "5":	echo "创作：";	break;
                            default:	echo "";
                        }
                        echo $row->author.'<br/>'.'<br/>';
                        switch ($row->label_id)
                        {
                            case "1":	echo "演员：";	break;
                            case "2":	echo "演员：";	break;
                            case "3":	echo "演唱： ";	break;
                            case "4":	echo "嘉宾：";	break;
                            case "5":	echo "制作： ";	break;
                            default:	echo "";
                        }
                        echo $row->actor;
                        ?>
                        <a href="#" class="mediaDetail">详细信息<img src="img/detail_icon.png" /></a>
                        </div>
                        <div style="clear:both"></div>
                </li>
			</ul>
		<?php }
		?>
<?php include('lib/footer.php'); ?>
		