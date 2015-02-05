<!--
    创建时间：		2013年4月26日
    编写人：			于鉴桐
    版本号：			v1.0
    
    修改记录：		原始版本v1.0				
                    
    主要功能点：		该页面用于显示不同类型的新闻列表。
                    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';            
-->
<?php
session_start();

$news_type_id = $_GET['news_type_id'];

if(isset($_GET['page']) && ctype_digit($_GET['page'])){
	$page = $_GET['page'];
	}
	else{
		$page = 1;
		}

//以下为静态化页面代码
	$file = "static/news/newsList_{$news_type_id}_{$page}.html";
	if(file_exists($file) && time() - filemtime($file) < 600){
		header("Location: static/news/newsList_{$news_type_id}_{$page}.html");
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
    	<div id="logoUser">
        </div>
        <div id="nav">
            <?php 
			//根据不同的news_type_id显示不同的页眉
			switch ($news_type_id)
				{
					case "2":	echo <<<UL
				<ul>
				<li><a href = "{$config['root']}{$config['mobile']}news.php">新闻首页</a></li>
				<li class="selected">媒体</li>
				<li><a href = "{$config['root']}{$config['mobile']}newsList.php?news_type_id=3">运营商</a></li>
				<li><a href = "{$config['root']}{$config['mobile']}newsList.php?news_type_id=4">综合</a></li>
				</ul>
UL;
			break;
					case "3":	echo <<<UL
				<ul>
				<li><a href = "{$config['root']}{$config['mobile']}news.php">新闻首页</a></li>
				<li><a href = "{$config['root']}{$config['mobile']}newsList.php?news_type_id=2">媒体</a></li>
				<li class="selected">运营商</li>
				<li><a href = "{$config['root']}{$config['mobile']}newsList.php?news_type_id=4">综合</a></li>
				</ul>
UL;
			break;
					case "4":	echo <<<UL
				<ul>
				<li><a href = "{$config['root']}{$config['mobile']}news.php">新闻首页</a></li>
				<li><a href = "{$config['root']}{$config['mobile']}newsList.php?news_type_id=2">媒体</a></li>
				<li><a href = "{$config['root']}{$config['mobile']}newsList.php?news_type_id=3">运营商</a></li>
				<li class="selected">综合</li>
				</ul>
UL;
			break;
					default:	echo "";
				}
					?>
                <div style="clear:both"></div>
            </ul>
        </div>
    </div>
     <div id="content">
    	<div class="box">		
			<?php
                $Page_size=8; //每页显示的条目数
				$sql = "select * from news where news_type_id=$news_type_id ORDER BY `id` DESC";
                $result=mysql_query($sql);
				//$row=mysql_fetch_array($result);
				//print_r($row);
				
                $count = mysql_num_rows($result); 
                $page_count = ceil($count/$Page_size); //总显示页数
                if($page_count<=0){
					$page_count=1;
				}
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
                $sql="select * from news where news_type_id=$news_type_id ORDER BY `id` DESC limit $offset,$Page_size";  
                $result=mysql_query($sql);
				
				while($row=mysql_fetch_object($result)) { 
				echo <<<UL
				<ul class="mediaList">
					<li>
						<br/>
						<img class="mediaCover left" width="20" src="{$config['root']}{$config['mobile']}img/star.png" />
						<span class="gonggao"><a href="{$config['root']}{$config['mobile']}newsDetail.php?id={$row->id}&news_type_id={$row->news_type_id}">{$row->title}</a></span><br/>
						<div style="clear:both"></div>
					</li>
				</ul>
UL;
		}
				echo '<br/>'.'<br/>';
                $page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
                $pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
                
                $key='<div class="page">'; 
                $key.="<span>$page/$pages</span> "; //第几页,共几页 
                if($page!=1){ 
					$key.="<a href=\"".$_SERVER['PHP_SELF']."?news_type_id=".($news_type_id)."&page=1\">第一页</a> "; //第一页 
					$key.="<a href=\"".$_SERVER['PHP_SELF']."?news_type_id=".($news_type_id)."&page=".($page-1)."\">上一页</a>"; //上一页 
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
                		$key.=" <a href=\"".$_SERVER['PHP_SELF']."?news_type_id=".($news_type_id)."&page=".$i."\">".$i."</a>"; 
                	} 
                } 
                if($page!=$pages){ 
					$key.=" <a href=\"".$_SERVER['PHP_SELF']."?news_type_id=".($news_type_id)."&page=".($page+1)."\">下一页</a> ";//下一页 
					$key.="<a href=\"".$_SERVER['PHP_SELF']."?news_type_id=".($news_type_id)."&page={$pages}\">最后一页</a>"; //最后一页 
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
        </div><br/>
<?php 
	include('lib/footer.php');
	//***********静态化页面底部代码******************
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/news/newsList_{$news_type_id}_{$page}.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//**********************************************
	 ?>