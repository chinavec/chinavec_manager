<?php
/*
    创建时间：		2013年4月27日
    编写人：			于鉴桐
    版本号：			v1.1
    
    修改记录：		原始版本v1.0
    				2013.6.4修改版本v1.1		更改页面美化				
                    
    主要功能点：		该页面用于显示首页向各页面的跳转链接
    
    全局配置变量：		$config['root'] = '/cloudm/';
                    $config['paymentServer'] = '222.31.73.204';	               
                    $config['portalServer'] = '222.31.73.204';             
                    $config['userServer'] = '222.31.73.204';            
*/

	$file = "static/index.html";
	
	//页面静态化头部**********************************************************
	if(file_exists($file) && time() - filemtime($file) < 1){
		header("Location: static/index.html");
		exit();
	}
	session_start();
	ob_start();
	//**********************************************************************

	
	include('lib/connect.php');
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
?>
<title>大唐云媒体</title>
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/index.css" rel="stylesheet" type="text/css"><!--本系统开发的主页面css-->
<link href="<?php echo $config['root']; echo $config['mobile']; ?>css/common.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="cordova-2.6.0.js" charset="utf-8"></script>
</head>
<body>

<style>
	body {
		background-image: url(img/stbg.jpg);
		margin:0 auto;
		background-repeat: repeat;
		background-position: middle top;
	}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" align="left" valign="top" background="img/bannerbg.jpg"><img src="img/banner-logo.jpg" alt="" width="87" height="92" /></td>
    <td width="60%" align="center" valign="middle" background="img/bannerbg.jpg"><table width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle" class="font-bai42">首页</td>
        </tr>
    </table></td>
    <td width="20%" align="right" valign="top" background="img/bannerbg.jpg"><a href="setting.php"><img src="img/banner-sz.jpg" alt="" width="88" height="92" /></a></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="33%" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>recommend.php"><img src="img/tj.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>recommend.php">推荐</a></td>
          </tr>
        </table></td>
        <td width="33%" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>businessList.php?label=1"><img src="img/dy.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>businessList.php?label=1">电影</a></td>
          </tr>
        </table></td>
        <td width="33%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>businessList.php?label=2"><img src="img/dsj.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>businessList.php?label=2">电视剧</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="33%" height="2" align="center" valign="middle" background="img/hx.jpg"></td>
        <td width="33%" height="2" align="center" valign="middle" background="img/hx.jpg"></td>
        <td width="33%" height="2" align="left" valign="middle" background="img/hx.jpg"></td>
      </tr>
      <tr>
        <td width="33%" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>businessList.php?label=3"><img src="img/zy.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>businessList.php?label=3">综艺</a></td>
          </tr>
        </table></td>
        <td width="33%" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>businessList.php?label=4"><img src="img/yy.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>businessList.php?label=4">音乐</a></td>
          </tr>
        </table></td>
        <td width="33%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>businessList.php?label=5"><img src="img/qt.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>businessList.php?label=5">其他</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="33%" height="2" align="center" valign="middle" background="img/hx.jpg"></td>
        <td width="33%" height="2" align="center" valign="middle" background="img/hx.jpg"></td>
        <td width="33%" height="2" align="left" valign="middle" background="img/hx.jpg"></td>
      </tr>
      <tr>
        <td width="33%" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>liveTV.php"><img src="img/zb.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>liveTV.php">直播</a></td>
          </tr>
        </table></td>
        <td width="33%" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>groupJudge.php"><img src="img/jtzl.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>groupJudge.php">集团专栏</a></td>
          </tr>
        </table></td>
        <td width="33%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>userInfo.php"><img src="img/grxx.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>userInfo.php">个人信息</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="33%" height="2" align="right" valign="middle" background="img/hx.jpg"></td>
        <td width="33%" height="2" align="center" valign="middle" background="img/hx.jpg"></td>
        <td width="33%" height="2" align="left" valign="middle" background="img/hx.jpg"></td>
      </tr>
      <tr>
        <td width="33%" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>news.php"><img src="img/zhxx.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>news.php">综合栏目</a></td>
          </tr>
        </table></td>
        <td width="33%" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; echo $config['mobile']; ?>search.php"><img src="img/ss.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>search.php">搜索</a></td>
          </tr>
        </table></td>
        <td width="33%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" background="img/anbg.jpg">
          <tr>
            <td align="center" valign="middle"><a href="<?php echo $config['root']; ?>portal/upload/forum.php"><img src="img/lt.png" alt="" width="75" height="75" /></a></td>
          </tr>
          <tr>
            <td align="center" valign="middle" class="font-hui26cu"><a href="<?php echo $config['root']; ?>portal/upload/forum.php">互动社区</a></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="87" colspan="3" align="center" valign="middle" background="img/footbg.jpg"><table width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle"><img src="img/sy.png" alt="" width="53" height="45" /></td>
      </tr>
      <tr>
        <td height="25" align="center" valign="middle"><span class="font-bai18">首页</span></td>
      </tr>
    </table></td>
  </tr>
</table>

<!--<div>
	<div style="width:100%;">	
       
		<ul class="indexList">
			<li><a href="<?php echo $config['root']; echo $config['mobile']; ?>recommend.php">推荐</a></li>
            <li><a href="<?php echo $config['root']; echo $config['mobile']; ?>liveTV.php">直播</a></li>
             顺序读取label数据表，根据读取的结果顺序显示其中文名称
				<?php
                $db = new DB();
                $label = $db->select_condition('epg_label');
                
                    foreach($label as $key => $item){
                        //echo $item->name . '<br />';
                        echo '<li><a href="'.$config['root'].$config['mobile'].'businessList.php?label='.$item->id.'">'.$item->name.'</a></li>';
                        }
                        ?>
                   
           <li><a href="<?php echo $config['root']; echo $config['mobile']; ?>news.php">新闻</a></li>
           <li><a href="<?php echo $config['root']; echo $config['mobile']; ?>groupJudge.php">集团专栏</a></li>
           <li><a href="<?php echo $config['root']; echo $config['mobile']; ?>userInfo.php">个人信息</a></li>
           <li><a href="<?php echo $config['root']; echo $config['mobile']; ?>search.php">搜索</a></li>
           <li><a href="<?php echo $config['root']; ?>portal/upload/forum.php">互动社区</a></li>            
        </ul>
	</div>
</div>
-->

	<hr style="border:1px #999999; width:80px;" align="center"/>
    
<?php 
	
//***页面静态化尾部*******************************************************************
	$out = ob_get_contents();
	ob_end_clean();
	echo $out;

	
	$fp = fopen("static/index.html","w");  
	if($fp){ 
		fwrite($fp,$out);  
		fclose($fp);  
	}
//*********************************************************************************
?>
</body>
</html>