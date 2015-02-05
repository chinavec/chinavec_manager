<!--
    创建时间：		2013年5月15日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0
                    
                    
    主要功能点：		该页面用于显示电影、电视剧、综艺、音乐、其他的业务分类列表。
					点击每一个业务进去之后，跳转到videoList.php界面。

    全局配置变量：		$config['root'] = '/cloudm/';
					$config['paymentServer'] = '222.31.73.204';	               
					$config['portalServer'] = '222.31.73.204';             
					$config['userServer'] = '222.31.73.204';				
-->
<?php 
	session_start();
	$label = $_GET['label'];

	include('lib/connect.php');
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件

	
//*************以下为静态化页面代码********************
	$file = "static/business/businessList_{$label}.html";
	if(file_exists($file) && time() - filemtime($file) < 1){
		header("Location: static/business/businessList_{$label}.html");
		exit();
	}
	ob_start();
//**************************************************
	
	$db = new DB();
?>
<title>电影列表</title>
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/index.css" rel="stylesheet" type="text/css"><!--本系统开发的主页面css-->
</head>

<body>
<div id="container">
	<div id="header">
        <div id="nav">
        	<ul>
				<li><!--根据不同的label值，标题显示不同的内容--->
				<?php 	
					switch ($label)
					{
						case "1":	echo "电影";	break;
						case "2":	echo "电视剧";	break;
						case "3":	echo "综艺";	break;
						case "4":	echo "音乐";	break;
						case "5":	echo "其他";	break;
						default:	echo "抱歉，没有您要找的内容！";
					}
					?>
                </li>
            </ul>
        </div>
    </div>	
    
<!---业务列表显示------------------------------------------------->	 
	<?php 
		$sql="select * from epg_business where epg_label_id=$label ";	//从epg_business表中根据label_id选出相应的业务列表
		$result = $db->select($sql);
	?>
 
	<div class="business">
        <div class="businessList">
        	<!--循环读出符合条件的业务名称，点击该业务时，跳转到该业务下的视频列表，并通过get方式传递businessId和label_id-->
			<?php foreach( $result as $key => $item){?>
            <a href="<?php echo $config['root'];echo $config['mobile'];?>videoList.php?businessId=<?php echo $item->id;?>&label=<?php echo $label;?>">
            	<span class="font3"><?php echo $item->name.'<br/>'.'<br/>' ;?></span>
            </a>
            <?php }?>
		</div>
    </div>
    
</div>

<?php 
	include('lib/footer.php');
//***********静态化页面底部代码******************
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/business/businessList_{$label}.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//**********************************************
?>
