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
<script type="text/javascript" src="/App/Admin/View/Public/plug/clipboard/clipboard.min.js"></script> 
<style type="text/css">
	.one{display: block; width: 30px; cursor: pointer; text-align: center; height: 20px; line-height: 18px; background: #d2322d;color: #fff;float: right;}
	.two{display: block; width: 30px; cursor: pointer; text-align: center; height: 20px; line-height: 18px; background: #337ab7;color: #fff;float: right;}
	.sbn{display: block; width: 30px; text-align: center; height: 20px; line-height: 18px;float: right;}
	.noshow{display: none;}
	.noshow1{display: none;}
	.copbtn{padding: 3px 10px;background: red; border-radius: 3px;color: #fff;position: relative;left: 10px;cursor: pointer;}
    .table_red{color: #fff;background-color: #d9534f;border-color: #d74b47;}
</style>
<div class="main_box">
	<h2><span></span>关键词搜索</h2>
	<form action="#">
		<div class="search_box clearfix">
			<input type="text" class="f_left" value="<?php echo ($_GET['keywords']); ?>" name="keywords" placeholder="输入查询关键字">
			<input type="submit" value="查询" class="btn blue_btn">
			<button type="button" link="<?php echo U('Base/keywords_edit');?>" onclick="link(this)" class="btn blue_btn">添 加</button>
		</div>
	</form>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>序号</th>
				<th>字段名称</th>
				<th>创建时间</th>
				<th>修改时间</th>
				<th>状态</th>
				<th>排序</th>
				<th>操 作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr>
						<td><?php echo ($v["id"]); ?></td>
						<td><?php echo ($v["name"]); ?></td>
						<td><?php echo (date("Y-m-d H:i:s",$v["create_time"])); ?></td>
						<td><?php echo (date("Y-m-d H:i:s",$v["update_time"])); ?></td>
						<td>
							<?php if($v['status']): ?><a class="table_btn table_grey down_shelf" onclick="setfield(this,'keywords','<?php echo ($v["id"]); ?>')" >
									<i class="fa fa-eye-slash"></i>
									<span field="status" value="0">隐藏</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf" onclick="setfield(this,'keywords','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-eye"></i>
									<span field="status" value="1">显示</span>
								</a><?php endif; ?>
						</td>
						<td><?php echo ($v["sort"]); ?></td>
						<td>
						    <a href="<?php echo U('Base/keywords_edit',array('id'=>$v['id']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a>
							<a link="<?php echo U('Base/keywords_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
								<i class="fa fa-trash-o"></i>
								<span>删除</span>
							</a>
						</td>
					</tr><?php endforeach; endif; ?>
				<tr style="height: 60px;">
					<td colspan="7" style="text-align:center">
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
<script type="text/javascript">
	$(function() {
	    var clipboard = new Clipboard('.copbtn');
        clipboard.on('success', function (e){
            layer.alert('复制成功,请在微信端打开',{icon: 1});
        });
        clipboard.on('error', function (e) {
            layer.alert('复制失败,请选中手动复制',{icon: 5});
        });
		$("select[name=type]").change(function(){
		    var type = $(this).val();
			window.location.href="?type="+type;
		})
	})
</script>
</body>
</html>