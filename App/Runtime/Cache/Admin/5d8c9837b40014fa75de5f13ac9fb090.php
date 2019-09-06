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
	<h2><span></span>会员的防伪码</h2>
	<form action="#">
		<div class="search_box clearfix">
			<!-- <select name="number_id">
				<option value="0">可领取次数</option>
				<?php if(is_array($number)): foreach($number as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["html"]); echo ($v["num"]); ?></option><?php endforeach; endif; ?>
			</select>
			<input type="text" class="f_left" value="<?php echo ($_GET['keywords']); ?>" name="keywords" placeholder="输入防伪码">
			<input type="submit" value="查询" class="btn blue_btn"> -->
			<!-- <button type="button" link="<?php echo U('Product/upload_code');?>" onclick="link(this)" class="btn blue_btn">导入防伪码</button> -->
		</div>
	</form>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>序号</th>
				<th>防伪码</th>
				<th>剩余领取次数</th>
				<th>有效期</th>
				<th>用户手机号</th>
				<th>第一次使用时间</th>
				<th>上一次领取时间时间</th>
				<th>状态</th>
				<th>启用</th>
				<th>添加时间</th>
				<!-- <th>操 作</th> -->
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr>
						<td><?php echo ($v["id"]); ?></td>
						<td><?php echo ($v["code"]); ?></td>
						<td><?php echo ($v["num"]); ?></td>
						<td><?php echo ($v["term"]); ?></td>
						<td><?php echo ($v["phone"]); ?></td>
						<td><?php echo (date("Y-m-d H:i:s",$v["first_time"])); ?></td>
						<td><?php echo (date("Y-m-d H:i:s",$v["get_time"])); ?></td>
						<td>
							<?php if($v['state'] == 0): ?>未使用
							<?php elseif($v['state'] == 1): ?>
							    未过期
							<?php elseif($v['state'] == 2): ?>
								已过期
							<?php elseif($v['state'] == 3): ?>
								无效<?php endif; ?>
						</td>

						<td>
							<?php if($v['status'] == 0): ?><a class="table_btn table_grey down_shelf" onclick="setfield(this,'code','<?php echo ($v["id"]); ?>')" >
									<i class="fa fa-eye-slash"></i>
									<span field="status" value="1">否</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf" onclick="setfield(this,'code','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-eye"></i>
									<span field="status" value="0">是</span>
								</a><?php endif; ?>
						</td>
						<td><?php echo (date("Y-m-d H:i:s",$v["create_time"])); ?></td>
						<!-- <td>
						    <a href="<?php echo U('Product/code_edit',array('id'=>$v['id']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a>
							<a link="<?php echo U('Product/code_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
								<i class="fa fa-trash-o"></i>
								<span>删除</span>
							</a>
						</td> -->
					</tr><?php endforeach; endif; ?>
				<tr style="height: 60px;">
					<td colspan="11" style="text-align:center">
					    <div class="page"><?php echo ($page); ?></div>
					</td>
				</tr>
			<?php else: ?>
			    <tr class="nocontent">
					<td colspan="11">世界都清静了...</td>
				</tr><?php endif; ?> 
	    </table>
	</div>
</div>
</body>
</html>