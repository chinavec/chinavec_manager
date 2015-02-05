// JavaScript Document
$(function(){
	$('#businessName').trigger('focus');
	$('#createBusiness').submit(function(e){
		var name = $('#businessName').val();
		var description = $('#description').val();
		var label = $("input[name='label']:checked").val();
		
		if(name.length == 0 || name.length > 20){
			alert('业务名称为空或者超过20个字符');
			$('#businessName').trigger('focus');
			return false;
		}else if(description.length == 0 || description.length > 200){
			alert('业务描述为空或者超过200个字符');
			$('#description').trigger('focus');
			return false;
		}else if(!label){
			alert('请选择业务分类');
			return false;
		}
	});
	
	$('#cancel').click(function(){
		if(confirm("确定要放弃此次操作吗？")){
			window.location.href="index.php";
		}
	});

});