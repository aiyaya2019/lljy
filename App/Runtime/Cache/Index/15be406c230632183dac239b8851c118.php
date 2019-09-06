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
<link rel="stylesheet" href="/Public/css/frequency.css">
<div class="wrap">
	<?php if($code): if(is_array($code)): foreach($code as $key=>$v): ?><div class="fre-num">
				<p><?php echo ($v["code"]); ?></p>
				<p>总次数：<?php echo ($v["all_num"]); ?></p>
				<p>剩余可领取<?php echo ($v["num"]); ?>次</p>
			</div><?php endforeach; endif; ?>
	<?php else: ?>
	<div style="text-align:center; font-size:18px;margin-top: 10px;">无数据</div><?php endif; ?>

</div>
<!-- 底部包含 -->
</body>
</html>