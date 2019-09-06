<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ((isset($title) && ($title !== ""))?($title):getBase('name')); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="apple-mobile-web-app-title" content="花植素健康护肤">
	<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<link rel="stylesheet" href="/Public/css/noticeInfo.css" />

<div class="wrap" style="background: #fff;">
	<div style="padding: 10px 20px;">
		<h4 style="font-size: .55rem;"><?php echo ($details["title"]); ?></h4>
	</div>
	<div class="time">
		<p>发布时间:<?php echo (date("Y-m-d",$details["create_time"])); ?></p>
		<p>阅读量:<?php echo ($details["visit"]); ?></p>
	</div>
	<div class="comtemt">
		<?php echo ($details["content"]); ?>
	</div>
</div>
<!-- 底部包含 -->
</body>
</html>