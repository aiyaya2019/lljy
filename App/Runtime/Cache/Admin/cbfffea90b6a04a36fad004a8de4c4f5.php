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
<script type="text/javascript">
	$(function(){
		$('input[level=1]').click(function(){
			var inputs = $(this).parents('.app').find('input');
			$(this).attr('checked') ? inputs.attr('checked','checked') : inputs.removeAttr('checked');
		});
		$('input[level=2]').click(function(){
			var inputs = $(this).parents('dl').find('input');
			$(this).attr('checked') ? inputs.attr('checked','checked') : inputs.removeAttr('checked');
		});
	})
</script>
<body>
	<form action="<?php echo U('Rbac/setAccess');?>" method="post" style="height: 100%;overflow: hidden;">
		<div id='wrap'>
			<a href="<?php echo U('Rbac/role');?>" class="add-app">返回</a>
			<?php if(is_array($node)): foreach($node as $key=>$app): ?><div class="app">
					<p>
						<strong><?php echo ($app["name"]); ?>|<?php echo ($app["title"]); ?></strong>
						<input type="checkbox" name="access[]" value="<?php echo ($app["id"]); ?>_1" level="1" <?php if($app['access']): ?>checked='checked'<?php endif; ?>/>
					</p>
					<?php if(is_array($app["child"])): foreach($app["child"] as $key=>$action): ?><dl>
							<dt>
								<strong><?php echo ($action["name"]); ?>|<?php echo ($action["title"]); ?></strong>
								<input type="checkbox" name="access[]" value="<?php echo ($action["id"]); ?>_2" level="2"  <?php if($action['access']): ?>checked='checked'<?php endif; ?>/>
						</dt>
						<?php if(is_array($action["child"])): foreach($action["child"] as $key=>$method): ?><dd>
								<span><?php echo ($method["name"]); ?>|<?php echo ($method["title"]); ?></span>
								<input type="checkbox" name="access[]" value="<?php echo ($method["id"]); ?>_3" level="3" <?php if($method['access']): ?>checked='checked'<?php endif; ?>/>
							</dd><?php endforeach; endif; ?>
					</dl><?php endforeach; endif; ?>
			</div><?php endforeach; endif; ?>
	    <input type="hidden" name="rid" value="<?php echo ($rid); ?>" />
	    <input type="submit" value="保存修改" class="btn btn_truck" style=" display:block; margin:8px auto;" />
	</div>
</form>
</body>
</html>