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
		 $('.del').click(function(){
	 	  if(confirm('您确认要删除吗？')){
	 		return true;
	 	   }
	 		return false;
	   });
	})
</script>
<div id='wrap'>
	<a href="<?php echo U('Rbac/node_edit');?>" class="add-app">添加应用</a>
	<?php if(is_array($data)): foreach($data as $key=>$app): ?><div class="app">
			<p>
				<strong><?php echo ($app["title"]); ?></strong>
				[<a href="<?php echo U('Rbac/node_edit',array('pid'=>$app['id'],'level'=>2));?>">添加控制器</a>]
				[<a href="<?php echo U('Rbac/delNode',array('pid'=>$app['id'],'level'=>2));?>" class="del">删除</a>]
			</p>
			<?php if(is_array($app["child"])): foreach($app["child"] as $key=>$action): ?><dl>
					<dt>
						<strong><?php echo ($action["title"]); ?></strong>
						[<a href="<?php echo U('Rbac/node_edit',array('pid'=>$action['id'],'level'=>3));?>">添加方法</a>]
						[<a href="<?php echo U('Rbac/delNode',array('pid'=>$action['id'],'level'=>3));?>" class="del">删除</a>]
					</dt>
					<?php if(is_array($action["child"])): foreach($action["child"] as $key=>$method): ?><dd>
								<span><?php echo ($method["title"]); ?></span>
								[<a href="<?php echo U('Rbac/delNode',array('pid'=>$method['id']));?>" class="del">删除</a>]
							</dd><?php endforeach; endif; ?>
				</dl><?php endforeach; endif; ?>
		</div><?php endforeach; endif; ?>
</div>
</body>
</html>