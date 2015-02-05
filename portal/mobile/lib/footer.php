<!--<div id="footer">
	<a href="index.php"><img width="50px" src="img/home.png"/></a>
	<div>Copyright ©大唐移动通信设备有限公司</div>
	<div style="width:100%;">
		<ul class="functionList">
			<li><a href="index.php" data-transition="slideup">
				<img width="10px" src="img/home.png"/></a></li>
			<li><a href="liveTV.php"><img width="10px" src="img/video.png"/></a></li>
			<li><a href="#"><img width="10px" src="img/search.png"/></a></li>
			<li><a href="news.php"><img width="10px" src="img/news.png"/></a></li>
			<li><a href="userInfo.php"><img width="10px" src="img/group.png"/></a></li>
		</ul>
	</div>
</div>-->
<?php 
	require('../../config/config.php');//系统总配置文件
	require('config/portalConfig.php');//手机门户配置文
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr>
    <td height="70" colspan="3" align="center" valign="middle" background="<?php echo $config['root']; echo $config['mobile']; ?>img/footbg.jpg">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle"><a href="index.php"><img src="<?php echo $config['root']; echo $config['mobile']; ?>img/sy.png" alt="" width="45" height="40" /></a></td>
        <td align="center" valign="middle"><a href="recommend.php"><img src="<?php echo $config['root']; echo $config['mobile']; ?>img/dyfoot.png" alt="" width="45" height="40" /></a></td>
        <td align="center" valign="middle"><a href="search.php"><img src="<?php echo $config['root']; echo $config['mobile']; ?>img/ssfoot.png" alt="" width="45" height="40" /></a></td>
        <td align="center" valign="middle"><a href="userInfo.php"><img src="<?php echo $config['root']; echo $config['mobile']; ?>img/grxxfoot.png" alt="" width="45" height="40" /></a></td>
        <td align="center" valign="middle"><a href="setting.php"><img src="<?php echo $config['root']; echo $config['mobile']; ?>img/sz.png" alt="" width="45" height="40" /></a></td>
      </tr>
      <tr>
        <td align="center" valign="middle" class="font-bai18"><a href="<?php echo $config['root']; echo $config['mobile']; ?>index.php">首页</a></td>
        <td align="center" valign="middle" class="font-hui18cu"><a href="<?php echo $config['root']; echo $config['mobile']; ?>recommend.php">推荐</a></td>
        <td align="center" valign="middle" class="font-bai18"><a href="<?php echo $config['root']; echo $config['mobile']; ?>search.php">搜索</a></td>
        <td height="20" align="center" valign="middle" class="font-bai18"><a href="<?php echo $config['root']; echo $config['mobile']; ?>userInfo.php">个人中心</a></td>
        <td align="center" valign="middle" class="font-bai18"><a href="<?php echo $config['root']; echo $config['mobile']; ?>setting.php">设置</a></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>