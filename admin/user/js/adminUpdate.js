// JavaScript Document
$(function(){
	$('#username').trigger('focus');
	$('#modifyAdmin').submit(function(e){
		var name1 = $('#username').val();
		var password = $('#password').val();
		var name2 = $('#real_name').val();
		var contact = $('#contact').val();
		var name3 = $('#name').val();
		
		if(name1.length == 0 || name1.length > 20){
			alert('����Ա�˺�Ϊ�ջ��߳���20���ַ�');
			$('#username').trigger('focus');
			return false;
		}else if(password.length == 0 || password.length > 20){
			alert('����Ϊ�ջ��߳���20���ַ�');
			$('#password').trigger('focus');
			return false;
		}else if(name2.length == 0 || name2.length > 20){
			alert('��ʵ����Ϊ�ջ��߳���20���ַ�');
			$('#name2').trigger('focus');
			return false;
		}else if(contact.length == 0 || contact.length > 20){
			alert('��ϵ��ʽΪ�ջ��߳���20���ַ�');
			$('#contact').trigger('focus');
			return false;
		}else if(name3.length == 0 || name3.length > 20){
			alert('����Ϊ�ջ��߳���20���ַ�');
			$('#name3').trigger('focus');
			return false;
		}
	});
	
	$('#cancel').click(function(){
		if(confirm("ȷ��Ҫ�����˴β�����")){
			window.location.href="admin.php";
		}
	});
});