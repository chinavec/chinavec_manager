<?php
	/*session_start();
	if(!isset($_POST['user']) && isset($_COOKIE['username']) && isset($_COOKIE['password'])){
		require_once('lib/connect.php');
		$username = $_COOKIE['username'];
		$password = $_COOKIE['password'];
		
		$sql = "SELECT username, photo
				FROM user
				WHERE username='$username' AND password='$password'";
		$rs = mysql_query($sql);
		if(mysql_num_rows($rs)){
			$user = mysql_fetch_object($rs);
			$_SESSION['user']['username'] = $user->username;
			$_SESSION['user']['photo'] = $user->photo;
		}
	}

<div id="header">
	<img id="logo" src="../img/logo.png" />
    <div id="user_info">
    <?php if(isset($_SESSION['user'])): ?>
    	<img id="user_pic" width="35" height="35" src="../img/user/<?php echo $_SESSION['user']['photo']; ?>" />
        <span><strong><?php echo $_SESSION['user']['username']; ?></strong></span>
        <a id="user_info_more" href="#"><img src="../img/user_info_more.png" /></a>
        &nbsp;&nbsp;&nbsp;
        <a id="user_setup" href="#"><img src="../img/user_setup.png" /></a>
    <?php else: ?>
    	<!--<a href="signin.php">登录</a>
        <span>&nbsp;|&nbsp;</span>
    	<a href="#">注册</a>-->
	<?php endif; ?>
    </div>
</div>*/	
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
    <?php date_default_timezone_set("Asia/Shanghai");?>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<!--device-width值表示将内容扩展到屏幕的整个宽度,禁用缩放-->
    <META name="apple-mobile-web-app-capable" content="yes">
    <META name="apple-mobile-web-app-status-bar-style" content="black">
    <META name="format-detection" content="telephone=no">	
