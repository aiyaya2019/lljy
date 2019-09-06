<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo C('company_name');?>后台管理</title>
		<link rel="stylesheet" type="text/css" href="/App/Admin/View/Public/css/fontsawesome/css/font-awesome.css" />
		<link rel="stylesheet" type="text/css" href="/App/Admin/View/Public/css/style.css" />
		<script type="text/javascript" src="/App/Admin/View/Public/js/jquery.min.js"></script>
		<script type="text/javascript" src="/App/Admin/View/Public/plug/validate/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/App/Admin/View/Public/plug/layer/layer.js"></script>
		<script type="text/javascript" src="/App/Admin/View/Public/js/js.js"></script>
		<script type="text/javascript" src="/App/Admin/View/Public/js/function.js"></script>
		<link rel="shortcut icon" href="/App/Admin/View/Public/images/favicon.ico" type="image/x-icon" />
	</head>
	<body>
<!--今日预约-->
<div class="welcome">
	<div class="welcome-left">
		<h3 class="w-title">经营概况</h3>
		<div class="w-box">
			<div class="wb-title">
				<h3>订单统计</h3>
			</div>
			<ul class="wx-ul">
				<li>
					<div class="wx-li">
						<div class="li-text">
							<p>待支付订单</p>
							<span><?php echo ($data['order']['status0']); ?></span>
						</div>
						<div class="li-img">
							<img src="/App/Admin/View/Public/images/dzfdd.jpg">
						</div>
					</div>
				</li>
				<li>
					<div class="wx-li">
						<div class="li-text">
							<p>已支付订单</p>
							<span><?php echo ($data['order']['status1']); ?></span>
						</div>
						<div class="li-img">
							<img src="/App/Admin/View/Public/images/yccdd.jpg">
						</div>
					</div>
				</li>

				<!-- <li>
					<div class="wx-li">
						<div class="li-text">
							<p>待评价订单</p>
							<span><?php echo ($data['order']['status3']); ?></span>
						</div>
						<div class="li-img">
							<img src="/App/Admin/View/Public/images/dpjdd.jpg">
						</div>
					</div>
				</li>
				<li>
					<div class="wx-li">
						<div class="li-text">
							<p>已完成订单</p>
							<span><?php echo ($data['order']['status4']); ?></span>
						</div>
						<div class="li-img">
							<img src="/App/Admin/View/Public/images/yccdd.jpg">
						</div>
					</div>
				</li>
				<li>
					<div class="wx-li">
						<div class="li-text">
							<p>取消订单</p>
							<span><?php echo ($data['order']['status5']); ?></span>
						</div>
						<div class="li-img">
							<img src="/App/Admin/View/Public/images/dzfdd.jpg">
						</div>
					</div>
				</li> -->
			</ul>

			<!-- 用户数统计 -->
			<div class="wb-title">
				<h3>用户统计</h3>
			</div>
			<ul class="wx-ul">
				<li>
					<div class="wx-li">
						<div class="li-text">
							<p>今日购买用户</p>
							<span><?php echo ($data['members']['nowday']); ?></span>
						</div>
						<div class="li-img">
							<img src="/App/Admin/View/Public/images/dzfdd.jpg">
						</div>
					</div>
				</li>
				<li>
					<div class="wx-li">
						<div class="li-text">
							<p>购买用户</p>
							<span><?php echo ($data['members']['buy']); ?></span>
						</div>
						<div class="li-img">
							<img src="/App/Admin/View/Public/images/dzfdd.jpg">
						</div>
					</div>
				</li>
				<li>
					<div class="wx-li">
						<div class="li-text">
							<p>总用户</p>
							<span><?php echo ($data['members']['all']); ?></span>
						</div>
						<div class="li-img">
							<img src="/App/Admin/View/Public/images/yhzrs.jpg">
						</div>
					</div>
				</li>
			</ul>
			<!-- 用户数统计 -->
			<!-- <div class="wb-title">
				<h3>分销商统计</h3>
			</div>
			<ul class="wx-ul">
				<li>
					<div class="wx-li">
						<div class="li-text">
							<p>未审核分销商</p>
							<span><?php echo ($data['agent']['noapply']); ?></span>
						</div>
						<div class="li-img">
							<img src="/App/Admin/View/Public/images/dzfdd.jpg">
						</div>
					</div>
				</li>
				<li>
					<div class="wx-li">
						<div class="li-text">
							<p>分销商</p>
							<span><?php echo ($data['agent']['apply']); ?></span>
						</div>
						<div class="li-img">
							<img src="/App/Admin/View/Public/images/fxs.jpg">
						</div>
					</div>
				</li>
			</ul> -->
		</div>

		<!-- <h3 class="w-title">常用功能</h3> -->
		<div class="w-box">
			<!-- <ul class="w-tool">
				<li onclick="openMeny(this)" data-topNav="goods" data-href="<?php echo U('Mall/goods_edit');?>">
					<div>
						<div>
							<img src="/App/Admin/View/Public/images/dzfdd.jpg">
						</div>
						<span>发布商品</span>
					</div>
				</li>
				<li onclick="openMeny(this)" data-topNav="pointmall" data-href="<?php echo U('Custom/banner',array('place'=>2));?>">
					<div>
						<div>
						   <img src="/App/Admin/View/Public/images/dzfdd.jpg">
						</div>
						<span>积分商城</span>
					</div>
				</li>
				<li onclick="openMeny(this)" data-topNav="groupmall" data-href="<?php echo U('Custom/banner',array('place'=>3));?>">
					<div>
						<div>
						   <img src="/App/Admin/View/Public/images/dzfdd.jpg">
						</div>
						<span>拼团商城</span>
					</div>
				</li>
				<li onclick="openMeny(this)" data-topNav="rush" data-href="<?php echo U('Custom/banner',array('place'=>4));?>">
					<div>
						<div>
						   <img src="/App/Admin/View/Public/images/dzfdd.jpg">
						</div>
						<span>抢购商城</span>
					</div>
				</li>
			</ul> -->
		</div>
	</div>
	<div class="welcome-right">
		<!-- <div class="wr-erweima">
			<div>
				<img src="/App/Admin/View/Public/images/code.png">
				<p>微信扫码体验</p>
			</div>
		</div> -->

		<!-- <div class="wr-company">
			<h3 class="company-title">商务合作</h3>
			<div class="company-phone">
				<span>18189554955</span> <span>韩全涛</span>
			</div>

			<h3 class="company-title">公司地址</h3>
			<div class="company-phone">
				天河区东圃一横路96号东泷创意社区C座218-219室
			</div>

			<h3 class="company-title">服务范围</h3>
			<div class="company-phone">
				系统开发、小程序、营销推广、微信运营及公众号二次开发、巨划算平台等服务，集创意、策划、设计制作、技术开发于一体的专业网络应用服务提供商
			</div>
		</div> -->
	</div>
</div>
<script type="text/javascript">
	function openMeny(obj) {
		var topNav = $(obj).attr("data-topNav");
		var href = $(obj).attr("data-href");
		parent.pClick(topNav,href);
	}
</script>
</body>
</html>