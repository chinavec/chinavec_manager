<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<style type="text/css">
#nav{
	width: 960px;
	margin: auto;
	height: 30px;
	line-height: 30px;
	background: url(./img/nav.jpg) repeat-x;
	position: relative;
}
#nav a{
	color: #000;
}
#nav > li{
	float: left;
	display: inline;
	font-size: 14px;
	margin: 0 10px;
	position: relative;
}




#nav > .unactive a:hover {
	background-color:transparent;
	text-decoration:underline;
}
</style>
<title>无标题文档</title>
<script src="js/jquery-1.7.1.min.js"></script>
<script type='text/javascript'>
				$(document).ready(function(){
					$("input:checkbox").each(function(){
						if($(this).val()==8){
							$(this).attr('checked',true);
							//alert($(this).val());
						}
						//alert($(this).val());
					});
					//$("input:checkbox").each(function(){
					//	alert($(this).val())
					//});	
				});
			  </script>
</head>

<body>
<form>
 <input type="checkbox" name="access[]" value ="7" class="authority">
 <input type="checkbox" name="access[]" value ="8" class="authority">
 </form>
 <ul id="nav" class="nav nav-pills">
			<li class="active">
			<a href="backstage.php" style="color:#ffffff">用户管理</a>
			</li>
			<li class="unactive">
			<a href="">授权管理</a>
			</li>

			<li class="unactive">
			<a href="../chinavec_cd/campusadmin/">门户管理</a>
			</li>
			<li class="unactive">
			<a href="">媒体分发</a>
			</li>
			<li class="unactive">
			<a href="../chinavec_business/support/userActive.php">业务支持</a>
			</li>

		</ul>
 <div>
 	sdf
 </div>
</body>
</html>
<?php
	//$arr=array();
	//$arr[3]="ssss";
	//$arr[5]="xxx";
	//print_r($arr[1]);
?>