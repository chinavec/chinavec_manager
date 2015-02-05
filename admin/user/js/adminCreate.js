// JavaScript Document
$(function(){
	$('#username').trigger('focus');
	$('#createAdmin').submit(function(e){
		var name1 = $('#username').val();
		var password = $('#password').val();
		var name2 = $('#real_name').val();
		var contact = $('#contact').val();
		var name3 = $('#name').val();
		
		if(name1.length == 0 || name1.length > 20){
			alert('管理员账号为空或者超过20个字符');
			$('#username').trigger('focus');
			return false;
		}else if(password.length == 0 || password.length > 20){
			alert('密码为空或者超过20个字符');
			$('#password').trigger('focus');
			return false;
		}else if(name2.length == 0 || name2.length > 20){
			alert('真实姓名为空或者超过20个字符');
			$('#name2').trigger('focus');
			return false;
		}else if(contact.length == 0 || contact.length > 20){
			alert('联系方式为空或者超过20个字符');
			$('#contact').trigger('focus');
			return false;
		}else if(name3.length == 0 || name3.length > 20){
			alert('名称为空或者超过20个字符');
			$('#name3').trigger('focus');
			return false;
		}
	});
	
	$('#cancel').click(function(){
		if(confirm("确定要放弃此次操作吗？")){
			window.location.href="admin.php";
		}
	});

});