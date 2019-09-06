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

	<link rel="stylesheet" href="/Public/css/my.css" />

	<!-- 产品中心 -->
	<link rel="stylesheet" href="/Public/css/productCenter.css">

	<!-- 产品详情 -->
	<link rel="stylesheet" href="/Public/lib/swiper-4.5.0/dist/css/swiper.min.css">
	<link rel="stylesheet" href="/Public/css/info.css" />
	<!-- 确认订单 -->
	<link rel="stylesheet" href="/Public/css/confirmOrder.css" />

	<link rel="stylesheet" href="/Public/css/allCode.css">
	<link rel="stylesheet" href="/Public/css/addCode.css">
	<link rel="stylesheet" href="/Public/css/frequency.css">
	<link rel="stylesheet" href="/Public/css/order.css" />
	<link rel="stylesheet" href="/Public/css/orderInfo.css" />
	<link rel="stylesheet" href="/Public/css/record.css" />
</head>
<body>
<div class="wrap">
	<div class="order-top">
		<img src="/Public/images/addressTop.png" style="width: 100%;height: 4px;"/>
		<div class="order-top-com">
			<img src="/Public/images/address-icom.png" style="width: 26px;height: 31px;"/>
			<div style="flex: 1;">
				<div class="order-top-com-r ell">
					<div style="flex: 1;">
						<p class="ell" style="line-height: 25px;">谢-- <span style="color: #999;">配送方式</span> </p>
						<p class="ell" style="line-height: 25px;"><span style="color: #999;">13129087405</span></p>
					</div>
					<div>
					<img src="/Public/images/icon-r.png" style="width: 0.2rem;height: .4rem;" />
				</div>
			</div>
		</div>
		</div>
	</div>
	
	<div class="goodInfo">商品信息</div>
	
	<div class="goodInfo-list">
		<img src="/Public/images/ceshi-img.png" style="width:100px;height: 100px;" />
		<div class="goodTitle">
			<p class="elll mode">配送方式</p>
			<p class="num" >x1</p>
		</div>
	</div>
	
	<div class="goodInfoList">
		<div class="delivery">
			<div style="padding-right: 10px;">配送方式</div>
			<div style="color: #999999;font-size: .4rem;">快递&nbsp;&nbsp;免费</div>
		</div>
	</div>
	
	
	<div class="goodInfoList">
		<div class="goodInfoList-list">
			<div>使用防伪码</div>
			<input type="number" class="code" placeholder="请输入防伪码"/>
		</div>
	</div>
	
	
	<div class="good-foot" >
			<div  class="yun">需支付运费XX元</div>
		<div class="pay" id="exchange">去支付</div>
		</div>
		
		<div class="popup">
			<div class="com">
				<p class="queren">请你再次确认地址和商品信息</p>
				<p class="bott-btn">
					<a id="btn1">取消</a>
					<a style="color: #125d70;" href="success.html" target="_self" >确认</a>
				</p>
			</div>
		</div>
</div>

<script>
	$(".popup").hide();
	$("#exchange").click(function(){
		$(".popup").show(200);
	});
	$("#btn1").click(function(){
		$(".popup").hide(200);
	})
</script>
<!-- 底部包含 -->
</body>
</html>