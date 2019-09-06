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
<link rel="stylesheet" href="/Public/css/my.css" />
<div class="wrap">
	<div class="my-logo">
		<div class="my-logo-img">
			<div>
				<img src="/Public/images/login.jpg" style="width: 80px;height: 80px;border-radius: 50%;"/>
			</div>
			<p style="font-size: 0.4rem;padding-top: 10px;">我是</p>
		</div>
		<div class="my-logo-btn">
			<ul class="my-logo-btnaList">
				<li class="active"><a href="<?php echo U('Me/addCode');?>" target="_self" style="color: #fff;">添加防伪码</a></li>
				<li><a href="<?php echo U('Me/code');?>" target="_self" style="color: #999;">全部防伪码</a></li>
				<li><a href="<?php echo U('Me/code', ['state' => 'no']);?>" target="_self" style="color: #999;">已过期</a></li>
				<div style="clear: both;"></div>
			</ul>
		</div>
	</div>
	
	<a href="<?php echo U('Me/order');?>" target="_self" style="color: #333;">
		<div class="my-order-wrap">
			<div class="my-order-title">我的订单</div>
			<img src="/Public/images/icon-r.png" class="my-order-title" style="width: 0.2rem;height: .4rem;"/>
		</div>
	</a>
	
	
	<div class="my-order-wrap2">
		<div class="my-order-list">
			<a href="<?php echo U('Me/order');?>">
				<div><img src="/Public/images/allOrder.png" style="width: 30px;height: 30px;"/></div>
				<div class="my-state">全部订单</div>
			</a>
		</div>
		<div class="my-order-list">
			<div><img src="/Public/images/daiOrder.png" style="width: 30px;height: 30px;"/></div>
			<div class="my-state">待发货</div>
		</div>
		<!-- <div class="my-order-list">
			<div><img src="/Public/images/fahuo.png" style="width: 30px;height: 30px;"/></div>
			<div class="my-state">发货中</div>
		</div> -->
		<div class="my-order-list">
			<div><img src="/Public/images/dashouh.png" style="width: 30px;height: 30px;"/></div>
			<div class="my-state">待收货</div>
		</div>
		<div class="my-order-list">
			<div><img src="/Public/images/yiqinas.png" style="width: 30px;height: 30px;"/></div>
			<div class="my-state">已签收</div>
		</div>
	</div>
	
	<div class="my-list-wrtap">
		<a href="<?php echo U('Me/record');?>" target="_self">
			<div class="my-list">
				<img src="/Public/images/icom03.png" style="width: 20px;height: 18px;" />
				<div style="flex: 1;">
					<div class="my-list-com">
						<p style="padding-left: 10px;color: #333;">领取记录</p>
						<img src="/Public/images/icon-r.png" style="width: 0.2rem;height: .4rem;" />
					</div>
				</div>
			</div>
		</a>
	</div>
	
	<div>
		<div class="my-list-wrtap">
			<a href="" target="_self">
				<div class="my-list">
					<img src="/Public/images/icom02.png" style="width: 20px;height: 18px;" />
					<div style="flex: 1;">
						<div class="my-list-com">
							<p style="padding-left: 10px;color: #333;">地址管理</p>
							<img src="/Public/images/icon-r.png" style="width: 0.2rem;height: .4rem;" />
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="my-list-wrtap">
			<a href="<?php echo U('Me/number');?>" target="_self">
				<div class="my-list">
					<img src="/Public/images/icom01.png" style="width: 20px;height: 18px;" />
					<div style="flex: 1;">
						<div class="my-list-com">
							<p style="padding-left: 10px;color: #333;">可领取次数</p>
							<img src="/Public/images/icon-r.png" style="width: 0.2rem;height: .4rem;" />
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	<!--底部-->
	<div class="product-foot-wrap">
	<div class="product-foot">
		<div class="product-foot-flx">
			<div style="padding-top: 8px;">
				<div class="foot-icom">
					<?php if(CONTROLLER_NAME == Index): ?><a href="<?php echo U('Index/index');?>" target="_self">
							<img src="/Public/images/indexIcom.png" style="width: .56rem;height: .56rem;"/>
						</a>
						<a href="<?php echo U('Index/index');?>" target="_self" style="color: #417d8d;">首页</a>
					<?php else: ?>
						<a href="<?php echo U('Index/index');?>" target="_self">
							<img src="/Public/images/indexIcom2.png" style="width: .56rem;height: .56rem;"/>
						</a>
						<a href="<?php echo U('Index/index');?>" target="_self">首页</a><?php endif; ?>
				</div>
			</div>
			<div style="padding-top: 5px;">
				<div class="foot-icom">
					<?php if(CONTROLLER_NAME == Me): ?><a href="<?php echo U('Me/index');?>" target="_self">
							<img src="/Public/images/myIcom.png" style="width: .56rem;height: .56rem;"/>
						</a>
						<a href="<?php echo U('Me/index');?>" target="_self" style="color: #417d8d;">我的</a>
					<?php else: ?>
						<a href="<?php echo U('Me/index');?>" target="_self">
							<img src="/Public/images/myIcom2.png" style="width: .56rem;height: .56rem;"/>
						</a>
						<a href="<?php echo U('Me/index');?>" target="_self">我的</a><?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>



</div>
<!-- 底部包含 -->
</body>
</html>