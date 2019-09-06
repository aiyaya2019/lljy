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
<link rel="stylesheet" href="/Public/css/success.css">
<div class="wrap">
	<div>
		<div class="success">
			<img src="/Public/images/successIcom.png" style="width: 90px;height: 90px;" />
			<p style="margin-top: 20px;font-size: .6rem;">领取成功</p>
			<p style="font-size: .3rem;color: #999;margin-top: 10px;">可到我的订单中查看详情</p>
		</div>
		<a href="order.html" target="_self">
			<div class="goOrder">
				<button class="comm">我的订单</button>
			</div>
		</a>
	</div>
	
	<div style="display: none;">
		<div class="success">
			<img src="/Public/images/failIcom.png" style="width: 90px;height: 90px;" />
			<p style="margin-top: 20px;font-size: .6rem;">领取失败</p>
			<p style="font-size: .3rem;color: #999;margin-top: 10px;">确认信息是否正确</p>
		</div>
		<a href="order.html" target="_self">
			<div class="goOrder">
				<button class="comm">我的订单</button>
			</div>
		</a>
	</div>
</div>
<!-- 底部包含 -->
</body>
</html>