<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ((isset($title) && ($title !== ""))?($title):getBase('name')); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="apple-mobile-web-app-title" content="花植素健康护肤">
	<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
<link rel="stylesheet" href="/Public/css/addCode.css">
<div class="wrap">
	<div class="addCode">
		<div class="add-text">
			<input class="comm textInp" type="number" name="code" placeholder="请输入防伪码" />
		</div>
		<div class="add-btn">
			<button class="comm btn">添加</button>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$('.btn').click(function(){
		var code = $("input[name='code']").val();
		$.ajax({
			url: '/Index/Me/addCode',
			type: 'POST',
			dataType: 'json',
			data: {'code': code},//数据，这里使用的是Json格式进行传输
			success: function(data){
				console.log(data);
				if (data.status == 1) {
					window.location.href = '/Index/Me/code';
				}else{
					alert(data.msg);
				}
			},
			error: function(){
				alert('请求错误');
				// layer.open({
				//     content: '请求错误',
				//     skin: 'msg',
				//     time: 2    //2秒后自动关闭
				// });
			}
		});

	});
</script>
<!-- 底部包含 -->
</body>
</html>