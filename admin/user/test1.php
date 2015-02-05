<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../../js/jquery-1.7.1.min.js"></script>
<script>
	function doSomething(){
    document.form1.submit();
    document.form2.submit();
}
</script>
<title>无标题文档</title>
</head>

<body>
<button id="but" onclick="doSomething()">提交</button>
<form name="form1" action="test2.php" method="post">
<input  type="text" name="aa"/>
<!--<input type="submit" value="Submit" />-->

</form> 
<hr />
<form name="form2" action="test2.php" method="post">


<input  type="text" name="bb"/>
<input type="checkbox" name="vehicle" value="Bike" />
</form> 

<!--
<form name="myForm" action="test1.php" method="get">
I have a bike:
<input type="checkbox" name="vehicle" value="Bike" checked="checked" />
<br />
I have a car: 
<input type="checkbox" name="vehicle" value="Car" />
<br />
I have an airplane: 
<input type="checkbox" name="vehicle" value="Airplane" />
<input  type="text" />
<br /><br />

</form> 
-->


<?php
	//if(isset($_GET)){
		print_r($_GET);
	//}
?>
</body>
</html>