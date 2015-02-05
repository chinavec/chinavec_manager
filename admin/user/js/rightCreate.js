// JavaScript Document
$(function(){
	$('#name').trigger('focus');
	$('#createRight').submit(function(e){
		var name = $('#name').val();
				
		if(name.length == 0 || name.length > 20){
			alert('权限名称为空或者超过20个字符');
			$('#name').trigger('focus');
			return false;
		}
		//else if($("input:checkbox").attr("checked")==false){
		//	alert("请选择角色权限");
		//	return false;
		//}
		
		/*
		var len=$('input:checkbox').length;
		//alert(len);
		//alert($('input:checkbox').length);
		for(var i=0;i<$('input:checkbox').length;i++){
			//alert(9);
			if($('input:checkbox').eq(i).attr("checked")!==undefined){
				//return true;
				//alert("不空");
				len=len-1;
				//alert(len);
			}else{
				//alert("为空");
			}
			
		}
		//alert(len);
		if(len==$('input:checkbox').length){
			alert("请为角色添加角色权限");
			return false;
		}else{
			return true;
		}
		*/
		
		//$('input:checkbox').each(function(){
		//	if($('input:checkbox').attr('checked')==undefined){
		//		
		//		alert($(this).val());
		///		return false;
				
		//	}else{
		//	alert($(this).val());
		//	}
		//	if($('input:checkbox').attr('checked')){
		//	i=i+1;
		//	}
		//});	
		
	});
	
	$('#cancel').click(function(){
		if(confirm("确定要放弃此次操作吗？")){
			window.location.href="userRight.php";
		}
	});

});