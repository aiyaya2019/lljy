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
	<h2><span></span>管理员</h2>
	<div class="search_formbox clearfix">
		<button type="button" link="<?php echo U('Rbac/admin_edit');?>" onclick="link(this)" class="btn blue_btn">添 加</button>
	</div>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>ID</th>
				<th>账号</th>
				<th>对应角色</th>
				<th>状态</th>
				<th>创建时间</th>
				<th width="268">操作</th>
			</tr>
		    <?php if(is_array($admin)): foreach($admin as $key=>$v): ?><tr>
					<td><?php echo ($v["id"]); ?></td>
					<td><?php echo ($v["name"]); ?></td>
					<td>
						<?php if($v["name"] == C("RBAC_SUPERADMIN")): ?>超级管理员
						<?php else: ?>
							<ul>
								<?php if(is_array($v["role"])): foreach($v["role"] as $key=>$value): ?><li style="float:left;margin-right:6px;"><?php echo ($value["name"]); ?>(<?php echo ($value["remark"]); ?>)</li><?php endforeach; endif; ?>
							</ul><?php endif; ?>
					</td>
					<td>
						<?php if($v['status']): ?><a class="table_btn table_grey down_shelf" onclick="setfield(this,'admin','<?php echo ($v["id"]); ?>')" >
								<i class="fa fa-lock"></i>
								<span field="status" value="0">锁定</span>
							</a>
						<?php else: ?>
						    <?php if($v["name"] == C("RBAC_SUPERADMIN")): ?><a class="table_btn table_warning up_shelf">
									<i class="fa fa-unlock-alt"></i>
									<span field="status" value="0">开启</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf" onclick="setfield(this,'admin','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-unlock-alt"></i>
									<span field="status" value="1">开启</span>
								</a><?php endif; endif; ?>
					</td>
					<td><?php echo (date("Y-m-d H:i:s",$v["create_time"])); ?></td>
					<td>
					    <a href="<?php echo U('Rbac/admin_edit',array('user_id'=> $v['id'],'role_id'=>$v['role'][0][id]));?>" class="table_btn table_edit edit_btn">
							<i class="fa fa-edit"></i>
							<span>编辑</span>
						</a>
						<a link="<?php echo U('Rbac/admin_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
							<i class="fa fa-trash-o"></i>
							<span>删除</span>
						</a>
					</td>
				</tr><?php endforeach; endif; ?>
	    </table>
	</div>
</div>
</body>
</html>