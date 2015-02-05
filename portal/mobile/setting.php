<?php
	session_start();
	
	include('lib/connect.php');
	require "lib/header.php";//本页面头文件
	require('../../lib/db.class.php');//数据库操作类
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文件
	require('lib/http_client.class.php');
?>
<LINK href="css/common.css" rel="stylesheet" type="text/css">
<LINK href="css/common1.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="img/js/jquery.1.4.2-min.js"></script>
<TITLE>设置</TITLE>
<style>
body {
	background-image: url(img/stbg.jpg);
	margin:0 auto;
	background-repeat: repeat;
	background-position: left top;
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" height="92" align="left" valign="top" background="img/bannerbg.jpg"><img src="img/banner-logo.jpg" alt="" width="87" height="92" /></td>
    <td width="60%" height="92" align="center" valign="middle" background="img/bannerbg.jpg"><table width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle" class="font-bai42">设置</td>
        </tr>
    </table></td>
    <td width="20%" height="92" align="right" valign="top" background="img/bannerbg.jpg"><img src="img/banner-r.png" alt="" width="88" height="92" /></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top"  style="padding-bottom:40px; padding-top:40px;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="searchBox">
      
      <tr>
        <td width="80%" height="60" align="left" valign="middle" class="font-hui26cu"><a href="userInfo.php" target="_blank">个人信息</a></td>
        <td width="20%" height="30" align="right" valign="middle" style="padding-right:20px;"><img src="img/hjt.png" alt="" width="24" height="22" />
        </td>
      </tr>
      <tr>
        <td height="2" colspan="2" align="right" valign="middle" background="img/hx.jpg" class="font-hui26cu"></td>
        </tr>
      <tr>
        <td width="80%" height="60" align="left" valign="middle" class="font-hui26cu"><a href="vision.html">版本号</a></td>
        <td width="20%" height="30" align="right" valign="middle" style="padding-right:20px;"><a href="vision.html"><img src="img/hjt.png" alt="" width="24" height="22" /></a></td>
      </tr>
      <tr>
        <td height="2" colspan="2" align="right" valign="middle" background="img/hx.jpg" class="font-hui26cu"></td>
        </tr>
      <tr>
        <td width="80%" height="60" align="left" valign="middle" class="font-hui26cu"><a href="aboutUs.html">关于我们</a></td>
        <td width="20%" height="30" align="right" valign="middle" style="padding-right:20px;"><a href="aboutUs.html" target="_blank"><img src="img/hjt.png" alt="" width="24" height="22" /></a></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="40"></td>
    </tr>
</table>

      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="searchBox">
        <tr>
          <td width="80%" height="60" align="left" valign="middle" class="font-hui26cu">新手引导</td>
          <td width="2%" height="30" align="right" valign="middle" style="padding-right:20px;"><a href="#" target="_blank"><img src="img/hjt.png" alt="" width="24" height="22" /></a></td>
        </tr>
        <tr>
          <td height="2" colspan="2" align="right" valign="middle" background="img/hx.jpg" class="font-hui26cu"></td>
        </tr>
        <tr>
          <td width="80%" height="60" align="left" valign="middle" class="font-hui26cu">服务器地址设置</td>
          <td width="20%" height="30" align="right" valign="middle" style="padding-right:20px;"><a href="#" target="_blank"><img src="img/hjt.png" alt="" width="24" height="22" /></a></td>
        </tr>
        <tr>
          <td height="2" colspan="2" align="right" valign="middle" background="img/hx.jpg" class="font-hui26cu"></td>
        </tr>
        <tr>
          <td width="80%" height="60" align="left" valign="middle" class="font-hui26cu">意见反馈</td>
          <td width="20%" height="30" align="right" valign="middle" style="padding-right:20px;"><a href="#" target="_blank"><img src="img/hjt.png" alt="" width="24" height="22" /></a></td>
        </tr>
      </table>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td height="70" colspan="3" align="center" valign="middle" background="img/footbg.jpg">
    
    <table width="60%" height="70" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="middle"><table width="100%" border="0" cellpadding="0">
            <tr>
              <td width="25%" align="center" valign="middle"><a href="index.php"><img src="img/sy.png" alt="" width="53" height="45" /></a></td>
              </tr>
            <tr>
              <td width="25%" align="center" valign="middle" class="font-bai18"><a href="index.php">首页</a></td>
              </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>