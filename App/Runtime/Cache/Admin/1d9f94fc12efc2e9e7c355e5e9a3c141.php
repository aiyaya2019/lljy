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
	<h2><span></span>用户地址管理</h2>
	<div class="search_formbox clearfix">
		<button type="button" link="<?php echo U('Members/address_edit');?>" onclick="link(this)" class="btn blue_btn">添 加</button>
	</div>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>序号</th>
				<th>所属会员</th>
				<th>姓名</th>
				<th>电话</th>
				<th>地址详情</th>
				<th>操 作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr>
						<td><?php echo ($v["id"]); ?></td>
						<td>
					    	<a href="<?php echo U('Members/search',array('id'=>$v['members_id']));?>">
								<img src="<?php echo ($v["headimgurl"]); ?>" class="listimg"><span>【<?php echo (base64_decode($v["nickname"])); ?>】</span>
							</a>
						</td>
						<td><?php echo ($v["username"]); ?></td>
						<td><?php echo ($v["userphone"]); ?></td>
						<td><?php echo ($v["province"]); echo ($v["city"]); echo ($v["area"]); echo ($v["details"]); ?></td>
						<td>
						    <a href="<?php echo U('Members/address_edit',array('id'=>$v['id']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a>
							<a link="<?php echo U('Members/address_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
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
					<td colspan="7">世界都清静了...</td>
				</tr><?php endif; ?> 
	    </table>
	</div>
</div>
</body>
</html>