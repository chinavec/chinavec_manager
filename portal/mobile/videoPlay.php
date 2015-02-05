<!--
    创建时间：		2013年4月26日
    编写人：			于鉴桐
    版本号：			v1.3
    
    修改记录：		原始版本v1.0
                    2013.5.23修改v1.1	将video_url修改为vod_url_mo
                    2013.5.27修改v1.2	增加video标签的记录当前播放时间功能、从指定时间处开始播放的功能
                    2013.5.28修改v1.3	调试记录用户当前观看时长的接口功能
                    
                    
    主要功能点：		该页面用于点播视频播放。
                    页面一开始要判断视频是否为付费视频，用户是否已登录，用户是否已订购等内容。其基本逻辑如下（该过程有videoJudge.php实现）：
                *****************************************************************************
                        if（该视频为付费视频）{
                        
                        if（用户未登录）{
                            转向登陆界面；}
                        else{
                            通过接口链接认证计费;
                            if（用户未购买该视频或业务）{
                                订购界面，点击“确定按钮订购”
                                接口到认证计费进行订购操作
                                if（订购成功）{
                                    echo “订购成功！”;}
                                else{
                                    echo “订购失败！”；
                                    错误处理？？？？？
                                    exit;}
                                }
                            }
                        }
    ******************************************************************************************
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';             

-->


<?php
	
	session_start();
	
	$id = $_GET['id'];
	$label = $_GET['label'];	

	
	//检查该页面是否已合法获取视频ID及ID是否为数值型
	if (!(isset($_GET['id']) && ctype_digit($_GET['id']))) 
	{
	header("Location:recommend.php?msg=invalid");
	exit;

	}
//*************以下为静态化页面代码********************
	$file = "static/video/videoPlay_{$id}_{$label}.html";
	if(file_exists($file) && time() - filemtime($file) < 1){
		header("Location: static/video/videoPlay_{$id}_{$label}.html");
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

?>
<title>大唐云媒体平台</title>

<script> 
	var breakTime = null; //定义断点时间变量
	
	$(function(){
		//alert($('#videoID').val());
		var video = document.getElementById('video');
		
		//点击id为currentTime的按钮时，获取当前视频的播放时间，通过AJAX方式传递到currentTime.php文件 
		$('#currentTime').click(function(){				//点击按钮时执行以下函数
			$.post(
					'currentTime.php',					//将数据发送给currentTime.php函数
					{'currentTime': video.currentTime,	//传递过去的数据，有两个：当前视频观看时间和视频的唯一标示ID
					 'videoID': $('#videoID').val()
					},
					function(data){						//返回值	
						alert(data);
					},
					'html'								//返回值形式为html
			);
		});
		
		
		//从getCurrentTime.php页面取回断点时间，用户点击ID为seek的按钮时，视频按断点时间开始播放
		$.post(
				'getCurrentTime.php',					//从getCurrentTime.php取数据
				{'currentTime': video.currentTime,
				 'videoID': $('#videoID').val()
				},										//传递过去的数据：当前视频观看时间
				function(data){							//返回值为断点时间
					//console.log(data.videoID);
					if(data.breakTime != undefined){	//如果breakTime已定义，将该值赋给breakTime变量
						breakTime = data.breakTime;
						video.play();
						$('#seek').show().click(function(){		//当用户选择断点续播时，将视频的当前播放时间改写为读取的断点时间
							video.currentTime = breakTime;
						});	
						console.log(data);
					}
				},
				'json'									//返回值形式为json
		);
	});
</script>

</head>
<body>
	<div id="header">
    	<div id="logoUser">
		<p><?php echo $row->title;?></p><br/>
        </div>
    </div>
		
        <div style="margin-left:5%;width:90%">
        <!--HTML5的video标签-->
			<video width="100%" controls id="video">
			 	<source src="http://222.31.88.37/DFDFSGc8df32207265fe65f025888?fmt=x264_800_mp4?>" type="video/mp4">
				<p>抱歉，您的浏览器不支持视频video标签</p>
                
             	<embed
					width="100%"
					type="application/x-shockwave-flash"
					id="player2"
					name="player2"
					src="swf/player.swf" 
					allowscriptaccess="always" 
					allowfullscreen="true"
					flashvars="file=<?php echo $config['root']; echo $config['mobile']; echo $row->vod_url_mo; ?>&image=<?php echo $config['root']; echo $config['poster']; echo $row->poster; ?>" 
				/>
				
			</video>
            <input type="button" id="currentTime" value="保存此次播放时间" />
            <input type="button" id="seek" value="从上次继续看" style="display:none" />
            <input type="button" id="videoID" value="<?PHP echo $id; ?>" style="display:none" />
    
    	</div>  
         
		<p><span class="font1" >名称：</span><?php echo $row->title; 
			 switch ($label){
					
					case "2":	echo "（第".$row->episode."集）";	break;
					case "3":	echo "（第".$row->episode."期）";;	break;
					default:	echo "";
				}
				?>
        </p>
		<p><span class="font1" >出品时间：</span><?php echo $row->year; ?></p>
		<p><span class="font1" >  
			<?php switch ($label){
				case "1":	echo "导演：";	break;
				case "2":	echo "导演：";	break;
				case "3":	echo "主持人：";	break;
				case "4":	echo "词曲：";	break;
				case "5":	echo "创作：";	break;
				default:	echo "";
			}
			?>
           </span>
		   <?php echo $row->author; ?>
        </p>
		<p><span class="font1" >
			<?php switch ($label){
				case "1":	echo "演员：";	break;
				case "2":	echo "演员：";	break;
				case "3":	echo "嘉宾：";	break;
				case "4":	echo "演唱：";	break;
				case "5":	echo "制作：";	break;
				default:	echo "";
			}
			?>
           </span>
		   <?php echo $row->actor; ?>
        </p>
		<p><span class="font1" >片长：&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $row->runtime; ?></p>
		<p><span class="font1" >语言：&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $row->language; ?></p>


<?php 
//label不同，现实的介绍内容也不一样
	switch ($label){
/*--电影----------------------------------------------*/
		case "1":?>
			<div class="abstract">
				<p class="sinfo">
					<span class="font1">剧情简介：</span>
				</p>
				<p>
					<span class="font2"><?php echo $row->abstract ;?></span>
				</p>
			</div>
		<?php break; 		
/*--电视剧----------------------------------------------*/
		case "2":
			$sql="select * from epg_video where title = '$row->title' order by episode asc";
			$result = $db->select($sql);
			$abstract = $result['0']->abstract;//得到所有的电视剧集，只取其中第一的剧情简介就行了
		?>
			<div class="episode">
				<span class="font1">集数：</span><br/>
				<?php foreach($result as $key =>$item){?>
                    <a href="<?php echo $config['root'];echo $config['mobile'];?>videoPlay.php?label=<?php echo $label;?>&id=<?php echo $item->id;?>">
                        <div><?php echo $item->episode ;?></div>
                    </a>
				<?php }?>
			</div>
	
			<div class="abstract">
				<p class="sinfo">
					<span class="font1">剧情简介：</span>
				</p>
				<p>
					<span class="font2"><?php echo $abstract ;?></span>
				</p>
			</div>
			<?php break; 
	/*--综艺----------------------------------------------*/	
				case "3":
				$sql="select * from epg_video where title = '$row->title' order by episode desc";
				$result = $db->select($sql);
				echo $result['0']->year;
			?>
			<div class="episode">
				<span class="font1">期数：</span><br/>
				<?php foreach($result as $key =>$item){?>
                    <a href="<?php echo $config['root'];echo $config['mobile'];?>videoPlay.php?label=<?php echo $label;?>&id=<?php echo $item->id ;?>">
                        <span>
                        <?php echo $item->episode.'<br/>';?>
                        </span>
                    </a>
				<?php }?>
			</div>
	
			<?php break; 
	/*--音乐----------------------------------------------*/	
				case "4":
				$sql="select * from epg_video where title = '$row->title' order by video_create_time asc";
				$result = $db->select($sql);
			?>
			<div class="episode">
				<span class="font1">歌曲</span><br/>
                    <a href="<?php echo $config['root'];echo $config['mobile'];?>videoPlay.php?label=<?php echo $label;?>&epgVideoId=<?php echo $epgVideoId;?>;?>">
                        <div class="play"></div>
                    </a>
			</div>
			
			<?php break; 
	/*--其它----------------------------------------------*/	
				case "5": 	echo ""; break;
				default:	echo ""; break;
			}
			?>

			<div style="clear:both"></div>
<?php 
	include('lib/footer.php');
//***********静态化页面底部代码******************
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/video/videoPlay_{$id}_{$label}.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//**********************************************
	 ?>