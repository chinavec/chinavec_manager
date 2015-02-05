<?php
	session_start();
	require('connect.php');
	
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
	$sql = "SELECT username, photo
			FROM user
			WHERE username='$username' AND password='$password'";
	$rs = mysql_query($sql);
	if(mysql_num_rows($rs)){
		$user = mysql_fetch_object($rs);
		$_SESSION['user']['username'] = $user->username;
		$_SESSION['user']['photo'] = $user->photo;
		
		if(isset($_POST['remember']) && $_POST['remember'] == 'on'){
			setcookie("username", $username, time()+604800);
			setcookie("password", $password, time()+604800);
			echo 'hello';
		}
		//header('Location: ../');
	}else{
		//header('Location: ../signin.php?error=1');
	}
	print_r($_POST);
?>