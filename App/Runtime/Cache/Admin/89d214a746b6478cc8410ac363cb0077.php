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
<div class="main_box">
	<h2><span></span>分享管理</h2>
	<div class="search_formbox clearfix">
		<button type="button" link="<?php echo U('Share/share_edit');?>" onclick="link(this)" class="btn blue_btn">添 加</button>
	</div>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>序号</th>
				<th>分享名称</th>
				<th>分享描述</th>
				<th>位置</th>
				<th>状态</th>
				<th>添加时间</th>
				<th>操 作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr>
						<td><?php echo ($v["id"]); ?></td>
						<td><?php echo ($v["name"]); ?></td>
						<td><?php echo ($v["title"]); ?></td>
						<td>
							<?php if($v['place'] == 1): ?><span>首页</span>
							<?php elseif($v['place'] == 2): ?>
								<span>分销分享专属码</span><?php endif; ?>
						</td>
						<td>
							<?php if($v['status']): ?><a class="table_btn table_grey down_shelf" onclick="setfield(this,'share','<?php echo ($v["id"]); ?>')" >
									<i class="fa fa-lock"></i>
									<span field="status" value="0">隐藏</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf" onclick="setfield(this,'share','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-unlock-alt"></i>
									<span field="status" value="1">显示</span>
								</a><?php endif; ?>
						</td>
						<td><?php echo (date("Y-m-d H:i:s",$v["create_time"])); ?></td>
						<td>
						    <a href="<?php echo U('Share/share_edit',array('id'=>$v['id']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a>
							<a link="<?php echo U('Share/share_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
								<i class="fa fa-trash-o"></i>
								<span>删除</span>
							</a>
						</td>
					</tr><?php endforeach; endif; ?>
			<?php else: ?>
			    <tr class="nocontent">
					<td colspan="7">世界都清静了...</td>
				</tr><?php endif; ?> 
	    </table>
	</div>
</div>
</body>
</html>