<!--
创建时间：		2013年5月31日
编写人：			于鉴桐
版本号：			v1.0

修改记录：		原始版本v1.0				
                
主要功能点：		该页面用于换肤功能
            
-->
<?php 

session_start();

	require "lib/connect.php";
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置

	
	//根据style不同的值，调用不同的css文件，从而达到换肤的目的
	$stylesheet = '';
	$style =  isset($_GET['style']) ? $_GET['style'] : 10;
		if(!in_array($style, array(1,2))){
			$style = 10;
		}
		if($style == 10){
			$stylesheet = 'index.css';
			setcookie("StyleSheet", 'index.css', time()+600000); 
			//$stylesheet = $_COOKIE['StyleSheet'];	
		}
		else{
			$stylesheet = "style".$style.".css";
			setcookie("StyleSheet", "style".$style.".css", time()+600000); 
			//$stylesheet = $_COOKIE['StyleSheet'];
		}
?>

<title>个性换肤</title>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/<?php echo $stylesheet; ?>" />
</head>

<body>
	<div id="header">
    	<div id="logoUser">
		<h2 style="color:#FFFFFF" align="center">换肤设置</h2><br/>
		</div>
     </div>
		
    <div id="container">
        <?php //print_r($_COOKIE); ?>
        <div id="content" class="content">
            
            <div class="skinList">
            	<!--设置第一个css文件的style值-->
                <div style="text-align:center">
                    <a href="changeSkin.php?style=1">
                        <!--显示换肤后的效果图-->
                        <img src="img/style1.png" width="80" height="80"/>
                    </a>
                	<p class="font4" style="flout">柔和明亮</p>
                	<br/><br/>
                </div>
                
                <!--设置第二个css文件的style值-->
                <div style="text-align:center">
                    <a href="changeSkin.php?style=2">
                        <!--显示换肤后的效果图-->
                        <img src="img/style2.png" width="80" height="80"/>
                    </a>
                    <p class="font4" style="text-align:inherit">清新淡雅</p>
                    <br/><br/>
                </div>
                
                <!--恢复默认时，调用原来的css文件-->
                <div style="text-align:center">
                    <a href="changeSkin.php">
                        <!--显示换肤后的效果图-->
                        <img src="img/default.png" width="80" height="80"/>
                    </a>
                    <p class="font4" style="text-align:inherit">恢复默认</p>
                </div>
                
                
                <div style="clear:both"></div>
            </div>
	</div>
	
</div>
<?php 
	include('lib/footer.php'); 
?>
