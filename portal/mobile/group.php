<!--
    创建时间：		2013年5月20日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0				
                    
    主要功能点：		该页面用于显示集团视频列表

	全局配置变量：		$config['root'] = '/cloudm/';
					$config['paymentServer'] = '222.31.73.204';	               
					$config['portalServer'] = '222.31.73.204';             
					$config['userServer'] = '222.31.73.204';          
-->
<?php
session_start();

$groupId = $_GET['groupId'];
//$businessId = $_GET['businessId'];

//由于本页面从groupJudge.php的页面跳转过来，不必再判断用户是否已登录等信息


	include('lib/connect.php');
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
	require('lib/http_client.class.php');
    	
?>

<title>大唐云媒体</title>
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/index.css" rel="stylesheet" type="text/css"><!--本系统开发的主页面css-->
</head>
<body>
	<div id="header">
        <div id="nav">
        	<ul>
				<li>集团专栏</li>
            </ul>
        </div>
    </div>
    
    <div id="content">
    	<div class="box">
        
<!-------------------集团直播节目列表--------------------------------------------------->
        <div class="cat" style="background-color:#015f26">
            <h2 class="catTitle">集团直播<img class="right" src="<?php echo $config['root']; echo $config['mobile']; ?>img/arrow_left.png" /></h2>
        </div>
       	<?php
		$db = new DB();
		//根据传递过来的集团的id从epg_live_channel中查找到相对应的直播节目信息
		$sql = "SELECT * FROM  `epg_live_channel` WHERE group_id = $groupId ORDER BY `id` ASC";
		//$result = mysql_query($sql);
		//while($row=mysql_fetch_object($result)) {
		$rows = $db->select($sql);
		
		//循环列出直播节目的信息，有直播图标、直播频道名称
		foreach($rows as $key => $item){
			echo <<<UL
			<ul class="mediaList">
				<li>
					<a href="{$config['root']}{$config['mobile']}livePlay.php?liveChannelId={$item->id}"><img class="mediaCover left" width="80" src="{$config['root']}{$config['live']}{$item->logo}" /></a>
					<div class="mediaInfo">
						<h3 class="mediaTitle"><a href="{$config['root']}{$config['mobile']}livePlay.php?liveChannelId={$item->id}">{$item->name}</a></h3>
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
<!-------------------集团直播节目列表--------------------------------------------------->


<!-------------------集团点播节目列表--------------------------------------------------->
        <div class="cat" style="background-color:#015f26">
            <h2 class="catTitle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>#.php?group_id=<?php echo $item->id;?>">集团点播<img class="right" src="<?php echo $config['root']; echo $config['mobile']; ?>img/arrow_left.png" /></a></h2>
        </div>				
			<?php
                $Page_size=8; //每页显示的条目数
				$sql = "select * from epg_video where group_id = $groupId ORDER BY `id` ASC";
				
                $result=mysql_query($sql);
				//$row=mysql_fetch_array($result);
				//print_r($row);
				
                $count = mysql_num_rows($result); 		//计算数据库结果数量
                $page_count = ceil($count/$Page_size); 	//总显示页数
                if($page_count<=0){
					$page_count=1;
				}
				$init=1; 
				$page_len=7; 
				$max_p=$page_count;
				$pages=$page_count;
                
                //判断当前页页码 
                if(empty($_GET['page'])||$_GET['page']<1){ 
                    $page=1; 
                }
				else { 
                    $page=$_GET['page']; 
                } 
                
                $offset=$Page_size*($page-1); 
                 ?>
                 
    	<div class="box">
			<?php
            	$db = new DB();
            	$sql="select * from epg_video where group_id = $groupId ORDER BY `id` ASC limit $offset,$Page_size";
				//$sql="select * from epg_video where label_id=$label and `release`=0 GROUP BY title ORDER BY `id` DESC limit $offset,$Page_size";    
				$result = $db->select($sql);
				
				foreach($result as $key => $item) { ?>
					<ul class="mediaList">
						<li>
                            <a href="<?php echo $config['root']; echo $config['mobile']; ?>groupPlay.php?id=<?php echo $item->id; ?>"><img class="mediaCover left" width="80" src="<?php echo $config['root']; echo $config['poster'];echo $item->poster;?>" /></a>
                            <div class="mediaInfo">
                                <h3 class="mediaTitle">
                                    <a href="<?php echo $config['root']; echo $config['mobile']; ?>groupPlay.php?id=<?php echo $item->id; ?>"><?php echo $item->title;?></a>
                                </h3>
                          	<br/>
                            <?php
                            //根据Label标签不同，actor等字段会显示不同的内容
                                /*switch ($label)
                                {
                                    case "1":	echo "导演：";	break;
                                    case "2":	echo "导演：";	break;
                                    case "3":	echo "词曲：";	break;
                                    case "4":	echo "主持人：";	break;
                                    case "5":	echo "创作：";	break;
                                    default:	echo "";
                                }*/
                                echo $item->author.'<br/>'.'<br/>';
                                /*switch ($label)
                                {
                                    case "1":	echo "演员：";	break;
                                    case "2":	echo "演员：";	break;
                                    case "3":	echo "演唱： ";	break;
                                    case "4":	echo "嘉宾：";	break;
                                    case "5":	echo "制作： ";	break;
                                    default:	echo "";
                                }*/
                                echo $item->actor;
                                ?>
                                <a href="#" class="mediaDetail">详细信息<img src="<?php echo $config['root']; echo $config['mobile']; ?>img/detail_icon.png" /></a>
                                </div>
                                <div style="clear:both"></div>
						</li>
					</ul>
				<?php }
				?>
				
				</div>
			</div><br/>		
				<?php
                    $page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
                    $pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
                    
                    $key='<div class="page">'; 
                    $key.="<span>$page/$pages</span> "; //第几页,共几页 
                    
					if($page!=1){ 
						$key.="<a href=\"".$_SERVER['PHP_SELF']."?label=".($label)."&businessId=".($businessId)."&page=1\">第一页</a> "; //第一页 
						$key.="<a href=\"".$_SERVER['PHP_SELF']."?label=".($label)."&businessId=".($businessId)."&page=".($page-1)."\">上一页</a>"; //上一页 
                    }else { 
						$key.="第一页 ";//第一页 
						$key.="上一页"; //上一页 
                    } 
                    if($pages>$page_len){ 
                    //如果当前页小于等于左偏移 
                    	if($page<=$pageoffset){ 
						$init=1; 
						$max_p = $page_len; 
                    	}
						else{
							//如果当前页大于左偏移 
							//如果当前页码右偏移超出最大分页数 
							 if($page+$pageoffset>=$pages+1){ 
								$init = $pages-$page_len+1; 
							 }
							 else{ 
								//左右偏移都存在时的计算 
								$init = $page-$pageoffset; 
								$max_p = $page+$pageoffset; 
							 } 
						} 
                    } 
                    for($i=$init;$i<=$max_p;$i++){ 
                    	if($i==$page){ 
                    		$key.=' <span>'.$i.'</span>'; 
                   		} 
						else { 
                    		$key.=" <a href=\"".$_SERVER['PHP_SELF']."?label=".($label)."&businessId=".($businessId)."&page=".$i."\">".$i."</a>"; 
                   		} 
                    } 
                    
					if($page!=$pages){ 
						$key.=" <a href=\"".$_SERVER['PHP_SELF']."?label=".($label)."&businessId=".($businessId)."&page=".($page+1)."\">下一页</a> ";//下一页 
						$key.="<a href=\"".$_SERVER['PHP_SELF']."?label=".($label)."&businessId=".($businessId)."&page={$pages}\">最后一页</a>"; //最后一页 
                    }
					else { 
						$key.="下一页 ";//下一页 
						$key.="最后一页"; //最后一页 
                    } 
                    $key.='</div>'; 
                    ?>
					<div align="center"><?php echo $key?></div><br/>
				</div>	
</div>
<?php 

	include('lib/footer.php');

?>