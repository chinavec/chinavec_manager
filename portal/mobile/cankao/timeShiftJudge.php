<?php 
	session_start();
	header("Content-type: text/html; charset=utf-8");
	$liveChannelId = $_GET['liveChannelId'];
	$liveProgrammeId   = $_GET['liveProgrammeId'];
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
			header('Location:toLogin.php');
			exit();
		}
	include('conn/connect.php');
	require('lib/db.class.php');
	$db = new DB();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" href="css/login.css" rel="stylesheet">
<title>判断</title>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
</head>

<body>
<div id="container">
	<?php include('common/indexHeader.php')?>

	<div id="content" class="content">

<!---判断时移业务是否免费---调接口---------------------------------->
	<?php 
	if($liveProgrammeId){
	$sql="select * from epg_business where name='时移'";
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
			$code=0;
			
			if($code == 1){//为1，已订购可直接观看
				echo "已订购";
				/*echo "<script>
				window.location.href='timeShiftPlay.php?liveChannelId=$liveChannelId&liveProgrammeId=$liveProgrammeId'
				</script>";*/
				}
				else{//尚未订购
					echo "<script>
				if(confirm('对不起您尚未订购时移业务，点击订购')){
				window.location.href='dinggou.php'
				}
				</script>";
					}
	
		}
		else{//免费
			echo "<script>
				window.location.href='timeShiftPlay.php?liveChannelId=$liveChannelId&liveProgrammeId=$liveProgrammeId'
				</script>";
			}
	}
    ?>

    </div>
<div id="footer">Copyright</div>
</div>
</body>
</html>