// JavaScript Document
$(function(){
	$('#name').trigger('focus');
	$('#modifyUser').submit(function(e){
		var name1 = $('#name').val();
		var password = $('#password').val();
		var name2 = $('#real_name').val();
		var mp = $('#mp').val();
	
		var email = $('#email').val();
				
		if(name1.length == 0 || name1.length > 20){
			alert('用户名为空或者超过20个字符');
			$('#name').trigger('focus');
			return false;
		}else if(password.length == 0 || password.length > 20){
			alert('密码为空或者超过20个字符');
			$('#password').trigger('focus');
			return false;
		}else if(name2.length == 0 || name2.length > 20){
			alert('真实姓名为空或者超过20个字符');
			$('#real_name').trigger('focus');
			return false;
		}else if(mp.length == 0 || mp.length > 20){
			alert('联系方式为空或者超过20个字符');
			$('#mp').trigger('focus');
			return false;
		}else if(email.length == 0 || email.length > 20){
			alert('邮箱为空或者超过60个字符');
			$('#email').trigger('focus');
			return false;
		}
	});
	

	
	
	$('#cancel').click(function(){
		if(confirm("确定要放弃此次操作吗？")){
			window.location.href="user.php";
		}
	});

});
