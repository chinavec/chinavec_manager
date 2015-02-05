<?php
	require('../../lib/db.class.php');
	require('../../lib/util.class.php');
	require('../../lib/log.php');
	$db = new DB();
	$u = new Util();
	$q = isset($_GET['q']) ? $u->inputSecurity($_GET['q']) : '';
	if($q != ''){
		$sql = "SELECT * FROM `business` WHERE `name` LIKE '%$q%'";
		if($result = $db->select($sql)){
		}else{
			systemLog('查询数据库business表失败', 2, 5, $db);
		}
	}else{
		//正常列表
		$result = $db->select_condition('business');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
	<form action="" method="get">
    	<input type="text" name="q" />
        <input type="submit" value="搜索" />
    </form>
    <?php print_r($result); ?>
</body>
</html>