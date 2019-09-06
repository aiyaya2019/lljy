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
	<h2><span></span>系统公告</h2>
	<div class="search_formbox clearfix">
		<button type="button" link="<?php echo U('News/edit');?>" onclick="link(this)" class="btn blue_btn">添 加</button>
	</div>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>序号</th>
				<th>公告主图</th>
				<th>公告标题</th>
				<th>是否推荐</th>
				<th>状态</th>
				<th>浏览次数</th>
				<th>添加时间</th>
				<th>操 作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr>
						<td><?php echo ($v["id"]); ?></td>
						<td><img src="<?php echo ($v["pic"]); ?>" class="listimg"></td>
						<td><?php echo (subtext($v["title"],15)); ?></td>
						<td>
							<?php if($v['is_red']): ?><a class="table_btn table_warning down_shelf" onclick="setfield(this,'news','<?php echo ($v["id"]); ?>')" >
									<i class="fa fa-eye"></i>
									<span field="is_red" value="0">推荐</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_grey up_shelf" onclick="setfield(this,'news','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-eye-slash"></i>
									<span field="is_red" value="1">正常</span>
								</a><?php endif; ?>
						</td>
						<td>
							<?php if($v['status']): ?><a class="table_btn table_grey down_shelf" onclick="setfield(this,'news','<?php echo ($v["id"]); ?>')" >
									<i class="fa fa-eye"></i>
									<span field="status" value="0">隐藏</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf" onclick="setfield(this,'news','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-eye-slash"></i>
									<span field="status" value="1">显示</span>
								</a><?php endif; ?>
						</td>
						<td><?php echo ((isset($v["click"]) && ($v["click"] !== ""))?($v["click"]):0); ?>次</td>
						<td><?php echo (date("Y-m-d H:i:s",$v["create_time"])); ?></td>
						<td>
						    <a href="<?php echo U('News/edit',array('id'=>$v['id']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a>
							<a link="<?php echo U('News/news_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
								<i class="fa fa-trash-o"></i>
								<span>删除</span>
							</a>
						</td>
					</tr><?php endforeach; endif; ?>
				<tr style="height: 60px;">
					<td colspan="8" style="text-align:center">
					    <div class="page"><?php echo ($page); ?></div>
					</td>
				</tr>
			<?php else: ?>
			    <tr class="nocontent">
					<td colspan="8">世界都清静了...</td>
				</tr><?php endif; ?> 
	    </table>
	</div>
</div>
</body>
</html>