<?php
	require('../../config/config.php');
	//require('../lib/connect.php');	连接数据库
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微视频管理中心</title>
<link href="../../css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
</head>



<body>
<?php include('../../common/admin_header.php'); ?>
    
    <div id="container" class="clearfix">
    	<div id="container_left" class="left">
        	<?php include("common/leftMenu.html"); ?>
        </div>
        <div id="container_right" class="right">
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
   
		    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;搜索结果</p> 
			<p>&nbsp;</p> <hr />
			<p>&nbsp;</p>  
	        <p>&nbsp;</p>

        	<table class="mytable" width="100%">
            	<thead>
                	<tr>
                    	<th>序号</th>
                        <th>用户名</th>
                        <th>真实姓名</th>
                        <th>联系方式</th>
						<th>密码</th>
						<th>邮箱</th>
						<th>注册时间</th>
						<th>操作</th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="submit2" type="button" class="btn_grey" value="返回" onClick="window.location.href='user.php'">
			<p>&nbsp;</p>
			<p>&nbsp;</p>
        </div>
    </div>
    
    <?php include('../../common/admin_footer.html'); ?>

</body>
