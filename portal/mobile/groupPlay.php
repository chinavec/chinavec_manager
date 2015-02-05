<!--
    创建时间：		2013年5月31日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0				
                    
    主要功能点：		该页面用于判断用户是否属于集团用户，属于哪一个集团。该功能通过调用用户个人信息接口，根据group_status判断实现。
    
    全局配置变量：		$config['root'] = '/cloudm/';
					$config['paymentServer'] = '222.31.73.204';	               
					$config['portalServer'] = '222.31.73.204';             
					$config['userServer'] = '222.31.73.204';     
-->

<?php
session_start();
	
	//检查该页面是否已合法获取视频ID及ID是否为数值型
	if (!(isset($_GET['id']) && ctype_digit($_GET['id']))) 
	{
	header("Location:recommend.php?msg=invalid");
	exit;

	}
	$id = $_GET['id'];
	
//*************以下为静态化页面代码********************
	$file = "static/video/videoPlay_{$id}.html";
	if(file_exists($file) && time() - filemtime($file) < 1){
		header("Location: static/video/videoPlay_{$id}.html");
		exit();
	}
	ob_start();
//**************************************************

	require "lib/connect.php";
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置
	
	$db = new DB();
	$row = $db->select_condition_one('epg_video',array('id' => $_GET['id']));
	/*$sql = "SELECT * FROM  epg_video WHERE id = {$_GET['id']}";
	$result = mysql_query($sql);
	$row = mysql_fetch_object($result);
*/
?>
<title>大唐云媒体平台</title>
</head>
<body>
	<div id="header">
    
    	<div id="logoUser">
            <p>
                <?php echo $row->title;?>
            </p><br/>
		</div>
        
		<div style="margin-left:5%;width:90%">
			<video width="100%" controls>
			 <source src="<?php echo $config['root']; echo $config['mobile']; echo $row->video_url; ?>" type="video/mp4">
				
                <embed
					width="100%"
					type="application/x-shockwave-flash"
					id="player2"
					name="player2"
					src="swf/player.swf" 
					allowscriptaccess="always" 
					allowfullscreen="true"
					flashvars="file=<?php echo $config['root']; echo $config['mobile']; echo $row->video_url; ?>&image=<?php echo $config['root']; echo $config['poster']; echo $row->poster; ?>" 
				/>
				
			</video>
		
            <p><span class="font1" >名称：</span><?php echo $row->title; ?></p>
            <p><span class="font1" >出品时间：</span><?php echo $row->year; ?></p>
            <p><span class="font1" >  
                <?php /*switch ($label)
                        {
                            case "1":	echo "导演：";	break;
                            case "2":	echo "导演：";	break;
                            case "3":	echo "词曲：";	break;
                            case "4":	echo "主持人：";	break;
                            case "5":	echo "创作：";	break;
                            default:	echo "";
                        }*/
                ?>
                        </span><?php echo $row->author; ?></p>
            <p><span class="font1" >
                <?php /* switch ($label)
                        {
                            case "1":	echo "演员：";	break;
                            case "2":	echo "演员：";	break;
                            case "3":	echo "演唱：";	break;
                            case "4":	echo "嘉宾：";	break;
                            case "5":	echo "制作：";	break;
                            default:	echo "";
                        }*/
                ?>
                        </span><?php echo $row->actor; ?></p>
            <p><span class="font1" >片长：&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $row->runtime; ?></p>
            <p><span class="font1" >语言：&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $row->language; ?></p>
    
                <!--<embed 
                    type="application/x-shockwave-flash" 
                    src="swf/player.swf" 
                    width="400" height="300" 
                    style="undefined" 
                    id="flp" name="flp" 
                    quality="high" 
                    allowfullscreen="true" allowscriptaccess="always" 
                    wmode="transparent" 
                    flashvars="autostart=true&amp;
                    file=http%3A//v.ml.streamocean.com%3A80/live/NJTV-HZ-BAK%3Ffmt%3Dx264_0K_flv%26cpid%3D77b284616270400eac65248ffd4c8ddb%26sora%3D1%26size%3D720X576%26sk%3D5004FFE5E54FE72E263D2907890CFE11&amp;pausemode=0&amp;type=SOFLVLive&amp;enablejs=true&amp;javascriptid=flp&amp;width=400&amp;height=300">
    -->
            
        </div>
    </div>
    
<?php 
	include('lib/footer.php');
//***********静态化页面底部代码******************
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/video/videoPlay_{$id}.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//**********************************************
	 ?>