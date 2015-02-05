<!--
    创建时间：		2013年4月26日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0
                    
                    
    主要功能点：		该页面用于显示分类的点播视频列表。电影、电视剧、综艺、音乐、其他都分别按照业务类型分页显示，每页显示8个最新的release视频信息，不包含集团视频
                    release为0表示门户管理设置了该视频在门户前端显示。
    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';             
            
-->
<?php
session_start();
$label = $_GET['label'];
$businessId = $_GET['businessId'];
	
	if(empty($_GET['page'])||$_GET['page']<1){ 
		$page=1; 
	}else { 
		$page=$_GET['page']; 
	} 
//*************以下为静态化页面代码********************
	$file = "static/video/videoList_{$label}_{$businessId}_{$page}.html";
	if(file_exists($file) && time() - filemtime($file) < 1){
		header("Location: static/video/videoList_{$label}_{$businessId}_{$page}.html");
		exit();
	}
	ob_start();
//**************************************************

	include('lib/connect.php');
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
        <div id="nav">
        	<ul>
				<li><?php 
					switch ($label)
					{
						case "1":	echo "电影";		break;
						case "2":	echo "电视剧";	break;
						case "3":	echo "综艺";		break;
						case "4":	echo "音乐";		break;
						case "5":	echo "其他";		break;
						default:	echo "抱歉，没有您要找的内容！";
					}
				?></li>
            </ul>
        </div>
    </div>
    
    <div id="content">
    	<div class="box">
        <?php 
		$db = new DB();
        $result = $db->select_condition_one('epg_business',array('id'=> $businessId ));
         ?>
        	<div class="businessInfo">
                <table>
                  <tr>
                    <td width="60"><span class="font1">业务名称:</span></td>
                    <td><span class="font2"><?php echo $result->name;?></span></td>
                  </tr>
                  <tr>
                    <td><span class="font1">业务介绍:</span></td>
                    <td><span class="font2"><?php echo $result->description;?></span></td>
                  </tr>
                  <tr>
                    <td><span class="font1">业务状态:</span></td>
                    <td>
                        <?php 
                            switch($result->state){
                                case "0": echo "该业务尚未开通"; break;
                                case "1": echo "可订购";break;
                                default : echo "";
                            }
                        ?>
                    </td>
                  </tr>
                  <tr>
                    <td><span class="font1">是否免费:</span></td>
                    <td>
                        <?php 
                            switch($result->is_free){
                                case "0": echo "否"; break;
                                case "1": echo "免费观看";break;
                                default : echo "";
                            }
                        ?>
                    </td>
                  </tr>
                </table>
                <a href="dinggou.php"><input name="order" type="button" value="订购此业务"/></a>
			</div>			
			<?php
                $Page_size=8; //每页显示的条目数
				$sql = "select * from epg_business_video 
						right join epg_video on epg_business_video.epg_video_id = epg_video.id
						where epg_business_id=$businessId";
				
                $result=mysql_query($sql);
				//$row=mysql_fetch_array($result);
				//print_r($row);
				
                $count = mysql_num_rows($result); 
                $page_count = ceil($count/$Page_size); //总显示页数
                if($page_count<=0){$page_count=1;}
                $init=1; 
                $page_len=7; 
                $max_p=$page_count;
                $pages=$page_count;
                
                //判断当前页码 
                if(empty($_GET['page'])||$_GET['page']<1){ 
                    $page=1; 
                }else { 
                    $page=$_GET['page']; 
                } 
                
                $offset=$Page_size*($page-1); 
                 ?>
      <div id="content">
    	<div class="box">
			<?php
            $db = new DB();
            $sql="select * from epg_business_video 
                    right join epg_video on epg_business_video.epg_video_id=epg_video.id
                    where epg_business_id=$businessId GROUP  BY  title
                    limit $offset,$Page_size";
            //$sql="select * from epg_video where label_id=$label and `release`=0 GROUP BY title ORDER BY `id` DESC limit $offset,$Page_size";    
            $result = $db->select($sql);
            foreach($result as $key => $item) { ?>
                <ul class="mediaList">
                    <li>
                        <a href="<?php echo $config['root']; echo $config['mobile']; ?>videoJudge.php?id=<?php echo $item->id; ?>&label=<?php echo $_GET['label']; ?>"><img class="mediaCover left" width="80" src="<?php echo $config['root']; echo $config['mamPoster'];echo $item->poster;?>" /></a>
                        <div class="mediaInfo">
                            <h3 class="mediaTitle">
                                <a href="<?php echo $config['root']; echo $config['mobile']; ?>videoJudge.php?id=<?php echo $item->id; ?>&label=<?php echo $_GET['label'];?>"><?php echo $item->title;?></a>
                            </h3>
                           <br/>
                            <?php
                            //根据Label标签不同，actor等字段会显示不同的内容
                                switch ($label)
                                {
                                    case "1":	echo "导演：";	break;
                                    case "2":	echo "导演：";	break;
                                    case "3":	echo "主持人：";	break;
                                    case "4":	echo "词曲：";	break;
                                    case "5":	echo "创作：";	break;
                                    default:	echo "";
                                }
                                echo $item->author.'<br/>'.'<br/>';
                                switch ($label)
                                {
                                    case "1":	echo "演员：";	break;
                                    case "2":	echo "演员：";	break;
                                    case "3":	echo "嘉宾：";	break;
                                    case "4":	echo "演唱：";	break;
                                    case "5":	echo "制作： ";	break;
                                    default:	echo "";
                                }
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
            }
			else { 
				$key.="第一页 ";//第一页 
				$key.="上一页"; //上一页 
            } 
            if($pages>$page_len){ 
				//如果当前页小于等于左偏移 
				if($page<=$pageoffset){ 
					$init=1; 
					$max_p = $page_len; 
				}
				else{//如果当前页大于左偏移 
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
//***********静态化页面底部代码******************
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/video/videoList_{$label}_{$businessId}_{$page}.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//**********************************************

 ?>