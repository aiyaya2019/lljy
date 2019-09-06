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
<link rel="stylesheet" href="/Public/css/orderInfo.css" />
<div class="wrap">
	<div class="order-top">
		<img src="/Public/images/addressTop.png" style="width: 100%;height: 4px;"/>
		<div class="order-top-com">
			<img src="/Public/images/address-icom.png" style="width: 26px;height: 31px;"/>
			<div style="flex: 1;">
				<div class="order-top-com-r ell">
					<div style="flex: 1;">
						<p class="ell" style="line-height: 25px;"><?php echo ($details["username"]); ?><span style="color: #999;"> <?php echo ($details["phone"]); ?></span> </p>
						<p class="ell" style="line-height: 25px;"><span style="color: #999;"><?php echo ($details["province"]); echo ($details["city"]); echo ($details["area"]); echo ($details["addr"]); ?></span></p>
					</div>
					<img src="/Public/images/icon-r.png" style="width: 10px;height: 20px;" />
				</div>
			</div>
		</div>
	</div>
	<div class="goodInfo">商品信息</div>
	
	<div class="goodInfo-list">
		<img src="<?php echo ($details["pic"]); ?>" style="width:100px;height: 100px;" />
		<div class="goodTitle">
			<p class="ell" style="color: #999;padding: 0 5px;"><?php echo ($details["name"]); ?></p>
			<p class="num">x<?php echo ($details["buy_num"]); ?></p>
		</div>
	</div>
	
	<div class="order-time-wrap">
		<div class="order-con">
			<p>订单号：<?php echo ($details["order_num"]); ?></p>
			<p>下单时间：<?php echo ($details["create_time"]); ?></p>
			<p>防伪码：<?php echo ($details["code"]); ?></p>
		</div>
		<div style="padding: 0.25rem 0;">
			<p>支付方式：微信</p>
			<p>运费：<?php echo ($details["freight"]); ?></p>
			<p style="color: #095763 !important;">实付：<?php echo ($details["pay_money"]); ?></p>
		</div>
	</div>
	
	
</div>
<!-- 底部包含 -->
</body>
</html>