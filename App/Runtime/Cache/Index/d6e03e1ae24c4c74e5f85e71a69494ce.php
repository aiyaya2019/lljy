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
<link rel="stylesheet" href="/Public/css/notice.css" />
<div class="wrap">
	<div class="contemt">
		<?php echo ($tips["content"]); ?>
	</div>
</div>
<!-- 底部包含 -->
</body>
</html>