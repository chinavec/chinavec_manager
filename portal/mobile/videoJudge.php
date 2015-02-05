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
	header("Content-type: text/html; charset=utf-8");
	
	$id = $_GET['id'];
	$label = $_GET['label'];
	
	
	//判断用户是否已登录
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
			header('Location:login.php');
			exit();
		}
	//判断是否有传递过来的视频ID和标签
	if(!isset($id) || $id == ''){
			header('Location:recommend.php');
			exit();
		}
	if(!isset($label) || $label == ''){
			header('Location:recommend.php');
			exit();
		}


	include('lib/connect.php');
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文
	$db = new DB();

?>
<title>点播判断</title>
</head>

<body>
<div id="container">

	<div id="content" class="content">
<!--判断该视频所在业务是否免费---调接口------------------------------------>
    <?php 
	$sql = "SELECT * FROM `epg_business`
			RIGHT JOIN epg_business_video 
			ON epg_business.id = epg_business_video.epg_business_id WHERE epg_business_video.epg_video_id = '$id'";
	
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);	//计算数组的长度
	$isFree =0 ;						//定义isFree变量并将其赋值为0
	for($j=0;$j<$num;$j++){  		//判断取出的业务是不是都收费，若每一项业务都收费，经循环比较复制后，$isFree=0
		$row=mysql_fetch_object($result);
		$isFree=$row->is_free or $result;			
	}
	
		if($isFree == 0){//收费
			//判断点播业务是否订购
			/*
			require('lib/http_client.class.php');
			$interfaceAddress = 'interface/mulitScreenInteractive.php';
			$http = new Http_Client();
			$http->addPostField('username', $_SESSION['username'])
			  for($j=0;$j<$num;$j++){  		//判断取出的业务是不是都收费，若每一项业务都收费，经循环比较复制后，$isFree=0
				$row=mysql_fetch_object($result);	
				$http->addPostField('businessId', $row->id);			
			}
			$result = json_decode($http->Post($interfaceAddress), true);
			//$history = $http->Post($interfaceAddress); 
			*/
			//假设$code为返回值，为1，已订购可直接观看
			
			//////////////////////改$code
			$code=0;
			
			if($code == 1){//为1，已订购可直接观看
				
				$url = 'videoPlay.php?id='.$id.'&&label='.$label;
				echo "<script language='javascript' type='text/javascript'>";
				echo "window.location.href='$url'";
				echo "</script>";
				}
				else{//尚未订购
					echo "<script>
				if(confirm('对不起您尚未订购该业务，点击订购')){
					window.location.href='dinggou.php'
				}
				else{
					window.location.href='recommend.php'
					}
				</script>";
					}
	
		}
		else{//免费
			echo "<script>
				window.location.href='videoPlay.php?id=$id&&label=$label'
				</script>";
			}
    ?>

    </div>
</div>
<?php 
	include "lib/footer.php";
?>