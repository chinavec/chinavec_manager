<div id="header">
	<a href="<?php echo $config['root']; ?>"><img id="logo" src="<?php echo $config['root']; ?>img/logo.png" /></a>
    <span id="now_time" class="right"></span>
</div>
<ul id="nav" class="clearfix">
    <li>
        <a href="<?php echo $config['root']; ?>admin/business">业务管理</a>
    </li>
    <li>
        <a href="#">用户管理</a>
        <ul class="sub_nav" style="width:90px">
            <li><a href="#">用户的账户管理</a></li>
            <li><a href="#">角色管理</a></li>
            <li><a href="#">用户数据同步</a></li>
        </ul>
    </li>
    <li>
        <a href="#">认证计费</a>
        <ul class="sub_nav" style="width:80px">
            <li><a href="<?php echo $config['root']; ?>admin/billing">计费策略管理</a></li>
            <li><a href="<?php echo $config['root']; ?>admin/discount">优惠策略管理</a></li>
        </ul>
    </li>
    <li>
        <a href="#">内容管理</a>
        <ul class="sub_nav" style="width:100px">
            <li><a href="#">内容信息管理维护</a></li>
            <li><a href="#">内容安全管理</a></li>
        </ul>
    </li>
    <li>
        <a href="#">内容分发</a>
        <ul class="sub_nav" style="width:90px">
            <li><a href="#">媒体的分发管理</a></li>
        </ul>
    </li>
    <li>
        <a href="#">媒体流</a>
        <ul class="sub_nav" style="width:80px">
            <li><a href="#">媒体流定义</a></li>
            <li><a href="#">媒体流的交付</a></li>
        </ul>
    </li>
    <li>
        <a href="#">业务支持系统</a>
    </li>
    <li>
        <a href="#">资源管理</a>
    </li>
</ul>

<script type="text/javascript">
	function formatTime(value){
		return value < 10 ? '0' + value : value;
	}
	function printCurrentTime(){
		var date = new Date();
		var week = ['星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];
		var currentTime = '';
		currentTime += date.getFullYear() + '-';
		currentTime += formatTime(date.getMonth() + 1) + '-';
		currentTime += formatTime(date.getDate()) + ' ';
		currentTime += formatTime(date.getHours()) + ':';
		currentTime += formatTime(date.getMinutes()) + ':';
		currentTime += formatTime(date.getSeconds()) + '  ';
		currentTime += week[date.getDay()];
		$('#now_time').text(currentTime);
	}
	$(function(){
		$('#nav > li').hover(function(){
			$(this).find('ul.sub_nav').show();	
		}, function(){
			$(this).find('ul.sub_nav').hide();
		});
		
		setInterval(printCurrentTime, 500);
	});
</script>
