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

<link rel="stylesheet" href="/Public/lib/swiper-4.5.0/dist/css/swiper.min.css">
<link rel="stylesheet" href="/Public/css/index.css" />
		
<div class="wrap">
	<!--轮播-->
	<div class="swiper-container">
    <div class="swiper-wrapper">
    	<?php if(is_array($banner)): foreach($banner as $key=>$v): ?><div class="swiper-slide"><img src="<?php echo ($v["pic"]); ?>" style="max-width: 100%;max-height: 100%;"/></div><?php endforeach; endif; ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>

<script src="/Public/lib/swiper-4.5.0/dist/js/swiper.min.js"></script>
<script>
	var swiper = new Swiper('.swiper-container', {
		loop:true
	});
</script>
	<!--公告-->
	<div class="notice-wrap">
		<div class="not-title">公告</div>
		<div class="not-con-wrap">
			<div class="not-con">
				<img src="/Public/images/notice-icom.png" style=""/>
				<?php if(is_array($notice)): foreach($notice as $key=>$v): ?><p style="color: #999;">
						<a style="color: #999;" href="<?php echo U('Index/noticeInfo', ['id' => $v['id']]);?>"><marquee><?php echo ($v["title"]); ?></marquee></a>
					</p><?php endforeach; endif; ?>
			</div>
		</div>
	</div>
	<!--产品需求-->
	<div class="product-wrap">
		<div class="product-title">产品中心</div>
		<div class="product-img">
			<a href="<?php echo U('Tips/index');?>" target="_self" style="text-decoration: underline;">点击查看领取规则和方式</a>
		</div>
	</div>

	<div class="product-list-wrap" style="margin-bottom:1rem;">
		<ul class="product-list-ul clear">
			<?php if(is_array($number)): foreach($number as $key=>$v): ?><li class="product-list-li" >
					<a href="<?php echo U('Product/index', ['num_id' => $v['id']]);?>" target="_self">
						<img src="<?php echo ($v["pic"]); ?>" style="width: 125px;height: 125px;"/>
					</a>
					<a href="<?php echo U('Product/index', ['num_id' => $v['id']]);?>" target="_self" style="color: #fff !important;"><p class="product-btn"><?php echo ($v["num"]); ?>次领取</p></a>
				</li><?php endforeach; endif; ?>
		</ul>
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