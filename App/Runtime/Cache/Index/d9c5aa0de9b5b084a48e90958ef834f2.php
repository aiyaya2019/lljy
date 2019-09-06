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
<link rel="stylesheet" href="/Public/css/allCode.css">
<link rel="stylesheet" href="/Public/css/index.css" />
<div class="wrap">
	<div class="allCode-nav">
		<div class="comm active" id="all"><a href="<?php echo U('Me/code', ['state' => 'yes']);?>" target="_self" style="color:black;">有效</a></div>
		<div class="comm" id="overdue"><a href="<?php echo U('Me/code', ['state' => 'no']);?>" target="_self" style="color:black;">已过期</a></div>
	</div>
	<div class="allCode-list">
		<?php if($code): if(is_array($code)): foreach($code as $key=>$v): ?><div class="allCode-list-list">
					<p style="color: #666666;"><?php echo ($v["code"]); ?></p>
					<p style="color: #666666; font-size:0.32rem;">总次数：<?php echo ($v["all_num"]); ?></p>
					<p style="color: #666666; font-size:0.32rem;">剩余领取次数：<?php echo ($v["num"]); ?></p>
					<p style="color: #999;font-size: .42rem;"><?php echo ($v["get_time"]); ?></p>
				</div><?php endforeach; endif; ?>
		<?php else: ?>
			<div style="text-align:center; font-size:18px;margin-top: 10px;">无数据</div><?php endif; ?>
	</div>
	<div class="add-btn" id="goBtn">
		<a href="<?php echo U('Index/index');?>" target="_self"><button class="comm2">去领取</button></a>
			
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