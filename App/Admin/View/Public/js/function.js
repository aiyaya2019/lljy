function link(obj) {
   var link = $(obj).attr('link');
   window.location.href=link;
}
function changeCode(){
	$("#code").attr("src", "/Admin/Login/code.html?" + Math.random());
}
//更新单个字段
function setfield(obj,table,id){
	var is_index = window.location.pathname.indexOf('index.php');
	if(is_index>0){
		var url = "/index.php/Admin/Ajax/setField";
	}else{
		var url = "/Admin/Ajax/setField";
	}
	var field = $(obj).find("span").attr('field');
	var value = $(obj).find("span").attr('value');
	$.ajax({
		url:url,
		type:"post",
		data:{
			table:table,
			id:id,
			field:field,
			value:value,
		},
		success:function(rs) {
			if (rs['code']==6){
				 window.location.reload(); 
			}else{

			}
		}
	})
}