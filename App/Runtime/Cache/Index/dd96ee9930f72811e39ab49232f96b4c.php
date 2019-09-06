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
<link rel="stylesheet" href="/Public/css/record.css" />
<div class="wrap">
<?php if($record): if(is_array($record)): foreach($record as $key=>$v): ?><div class="rece_list">
			<div class="rece_list_box">
				<p>防伪码:<?php echo ($v["code"]); ?><span style="float: right;font-size: .35rem;"><?php echo ($v["num"]); ?>/<?php echo ($v["all_num"]); ?></span></p>
				<p>领取商品：<?php echo ($v["product_name"]); ?></p>
				<p>领取时间：<?php echo ($v["create_time"]); ?></p>
			</div>
		</div><?php endforeach; endif; ?>
<?php else: ?>
	<div style="text-align:center; font-size:18px;margin-top: 10px;">无数据</div><?php endif; ?>
	
</div>
<!-- 底部包含 -->
</body>
</html>