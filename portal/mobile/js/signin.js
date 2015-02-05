// JavaScript Document
$(function(){
	$('#username').trigger('focus');
	$('#signin').submit(function(){
		var username = $('#username').val();
		var password = $('#password').val();
		if(username == ''){
			$('#warning').text('用户名不能为空').show();
			$('#username').trigger('focus');
			return false;
		}else if(password == ''){
			$('#warning').text('密码不能为空').show();
			$('#password').trigger('focus');
			return false;
		}
	});
});