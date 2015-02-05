// JavaScript Document
$(function(){
	$('#name').trigger('focus');
	$('#createUser').submit(function(e){
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
			alert('邮箱为空或者超过20个字符');
			$('#email').trigger('focus');
			return false;
		}
	
	
		//alert($('input:checkbox').length);
		var len=$('input:checkbox').length;		//当前页面未勾选的复选框总数
		//alert(len);
		//alert($('input:checkbox').length);
		for(var i=0;i<$('input:checkbox').length;i++){
			//alert(9);
			if($('input:checkbox').eq(i).attr("checked")!==undefined){
				//return true;
				//alert("不空");
				len=len-1;		//当前页面勾选复选框之后，剩余未勾选的复选框总数
				//alert(len);
			}else{
				//alert("为空");
			}
			
		}
		//alert(len);
		
		var lenselect=$('input:checkbox').length-1;		//当前页面只勾选一个复选框之后，剩余未勾选的复选框总数
		
		//if(len<lenselect){
		//	alert("只能为用户选择一个角色");
		//	return false;
		//}else{
		//	return true;
		//}
		
		if(len==$('input:checkbox').length){
			alert("请为用户选择一个角色");
			return false;
		}else if(len<lenselect){
			alert("只能为用户选择一个角色");
			return false;
		}
		else{
			return true;
		}
	
	
	
	
	});
	
	
	
	
	$('#cancel').click(function(){
		if(confirm("确定要放弃此次操作吗？")){
			window.location.href="user.php";
		}
	});

});