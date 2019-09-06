<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ((isset($title) && ($title !== ""))?($title):getBase('name')); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="apple-mobile-web-app-title" content="花植素健康护肤">
	<title></title>
	<link rel="stylesheet" href="/Public/lib/swiper-4.5.0/dist/css/swiper.min.css">
	<link rel="stylesheet" href="/Public/css/index.css" />
	<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>

	<link rel="stylesheet" href="/Public/css/addCode.css">
</head>
<body>
<div class="wrap">
	<div class="addCode">
		<div class="add-text">
			<input class="comm textInp" type="number" placeholder="请输入防伪码" />
		</div>
		<div class="add-btn">
			<button class="comm">添加</button>	
		</div>
		
	</div>
</div>
<!-- 底部包含 -->
</body>
</html>