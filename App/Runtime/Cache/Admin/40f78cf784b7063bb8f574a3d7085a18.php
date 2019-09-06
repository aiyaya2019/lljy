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
<style type="text/css">
	.layui-layer-content{padding: 10px}
</style>
<div class="main_box">
	<h2><span></span>会员反馈</h2>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>ID</th>
				<th>头像【昵称】</th>
				<th>姓名/电话</th>
				<th>反馈内容</th>
				<th>ip地址</th>
				<th>反馈时间</th>
				<th>操作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr id="1"><!--此处id为进行查看该会员相关信息时，当前数据的唯一标识-->
						<td><?php echo ($v["id"]); ?></td>
						<td><img src="<?php echo ($v["headimgurl"]); ?>" class="listimg"><span>【<?php echo (base64_decode($v["nickname"])); ?>】</span></td>
						<td><span><?php echo ($v["username"]); ?></span><span>【<?php echo ($v["userphone"]); ?>】</span></td>
						<td><?php echo (subtext($v["content"],15)); ?></td>
						<td> <?php echo ($v["ip"]); ?> </td>
						<td><?php echo (date('Y-m-d H:i:s',$v["create_time"])); ?></td>
						<td>
							<a class="table_btn table_edit edit_btn" content="<?php echo ($v["content"]); ?>" onclick="searchmsg(this)">
								<i class="fa fa-search"></i>
								<span>查看详情</span>
							</a>
							<a link="<?php echo U('Members/messages_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
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
	function searchmsg(obj){
		var content = $(obj).attr('content');
		layer.open({
		  type: 1,
		  title:"留言内容",
		  skin: 'layui-layer-rim', //加上边框
		  area: ['420px', '240px'], //宽高
		  content: content
		});
	}
</script>
</body>
</html>