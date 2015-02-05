<?php
	require('../../config/config.php');
	//require('../lib/connect.php');	连接数据库
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>云媒体管理中心</title>
<link href="../../css/base.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
</head>

<body>
	<?php include('../../common/admin_header.php'); ?>
    
    <div id="container" class="clearfix">
    	<div id="container_left" class="left">
        	<ul>
            	<li><a href="#">业务服务的新建</a></li>
            	<li><a href="#">业务服务的修改</a></li>
            	<li><a href="#">业务服务的删除</a></li>
            	<li><a href="#">业务服务的查询</a></li>
            	<li><a href="#">业务服务的启动与停止</a></li>
            </ul>
        </div>
        <div id="container_right" class="right">
        	<table class="mytable" width="100%">
            	<thead>
                	<tr>
                    	<th></th>
                        <th></th>
                        <th></th>
                        <th></th>
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
        </div>
    </div>
    
    <?php include('../../common/admin_footer.html'); ?>
</body>
</html>