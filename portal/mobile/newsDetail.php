<!--
    创建时间：		2013年5月14日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0				
                    
    主要功能点：		该页面用于显示新闻的详细页面
                    页面显示包含新闻标题、发布时间、发布人、新闻图片和新闻内容。
    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';           
-->
<?php
session_start();
$id = $_GET['id'];
$news_type_id = $_GET['news_type_id'];
//以下为静态化页面代码
	$file = "static/news/newsDetail_{$id}_{$news_type_id}.html";
	if(file_exists($file) && time() - filemtime($file) < 1){
		header("Location: static/news/newsDetail_{$id}_{$news_type_id}.html");
		exit();
	}
	ob_start();
//**************************************************
	require "lib/connect.php";
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文

?>
<title>大唐云媒体</title>
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/index.css" rel="stylesheet" type="text/css"><!--本系统开发的主页面css-->
</head>
<body>
	<div id="header">
        <div id="nav">
        	<ul>
				<li><a href="<?php echo $config['root']; echo $config['mobile']; ?>newsList.php?news_type_id=<?php echo $_GET['news_type_id'];?>"><?php 
					switch ($news_type_id)
					{
						case "1":	echo "公告";	break;
						case "2":	echo "媒体新闻";	break;
						case "3":	echo "运营商新闻";	break;
						case "4":	echo "综合新闻";	break;
						default:	echo "抱歉，没有您要找的内容！";
					}
				?></a></li>
            </ul>
        </div>
    </div>
    <div id="content">
		<?php 
        $db = new DB();
        $sql="select * from news where id=$id";  
        $rows = $db->select($sql);
        
        //将数据库中读取出的新闻内容、发布时间、发布人等显示出来
        foreach($rows as $key => $item){
         ?>
            <h2><?php echo $item->title.'<br />';?></h2>
            <p><span>发布时间：</span><?php echo $item->create_time.'<br />';?></p>
            <p><span>发布人：</span><?php echo $item->portal_admin_id.'<br />';?></p>
            <br/><img width="200" src="<?php echo $config['root']; echo $config['news']; echo $item->picture;?>" /><br/>
            <p><?php echo $item->content.'<br />';?></p>
            <?php }?>
        </div><br/>
    
<?php 
	include('lib/footer.php');
	
	//***********静态化页面底部代码******************
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/news/newsDetail_{$id}_{$news_type_id}.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//**********************************************
 ?>