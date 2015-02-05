<!--
创建时间：		2013年5月31日
编写人：			于鉴桐
版本号：			v1.0

修改记录：		原始版本v1.0				
                
主要功能点：		该页面用于播放直播前的用户信息判断
				首先判断用户是否已登录，若没登陆则转到登陆界面login.php
                如果已登录则检测该业务是否付费，若免费则继续播放
                若该业务为付费节目，则向认证计费子系统发送接口检查是否已订购
                若果已订购，则继续播放；若未订购，则转向订购接口
           
-->

<?php 
	session_start();
	header("Content-type: text/html; charset=utf-8");
	
	$liveChannelId = $_GET['liveChannelId'];
	
	//判断用户是否已登录
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
			header('Location:login.php');
			exit();
		}
	//判断是否有传递过来的频道ID
	if(!isset($liveChannelId) || $liveChannelId == ''){
			header('Location:liveTV.php');
			exit();
		}
	
	
	include('lib/connect.php');
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
	$db = new DB();

?>
<title>判断</title>
</head>

<body>
	<div id="container">

    	<div id="content" class="content">
    <!--判断直播业务是否免费---调接口(认证计费子系统)------------------------------------>
        <?php 
        
			$sql="select * from epg_business where name='直播'";
			$result=$db->select_one($sql);	
			$isFree = $result->is_free;
			$businessId = $result->id;
            if($isFree == 0){//收费
                //判断直播业务是否订购
                /*
                require('lib/http_client.class.php');
                $interfaceAddress = 'interface/mulitScreenInteractive.php';
                $http = new Http_Client();
                $http->addPostField('username', $_SESSION['username']);	
                $http->addPostField('businessId', $businessId);	 	 
                $result = json_decode($http->Post($interfaceAddress), true);
                //$history = $http->Post($interfaceAddress); 
                */
                //假设$code为返回值，为1，已订购可直接观看
                
                //////////////////////改$code
                $code=1;
                
                if($code == 1){//为1，已订购可直接观看
                    //echo "已订购";
                    echo "<script>
                    window.location.href='livePlay.php?liveChannelId=$liveChannelId'
                    </script>";
                    }
                    else{//尚未订购
                        echo "<script>
                    if(confirm('对不起您尚未订购直播业务，点击订购')){
                    	window.location.href='dinggou.php'
                    }
					else{
						window.location.href='liveTV.php'
					}
                    </script>";
                        }
        
            }
            else{//免费
                echo "<script>
                    window.location.href='livePlay.php?liveChannelId=$liveChannelId'
                    </script>";
                }
        ?>
        
    <!---判断时移业务是否免费---调接口---------------------------------->
    
    
    <!---判断点播是否免费---调接口---------------------------------->
    
        </div>
    </div>
</body>
</html>