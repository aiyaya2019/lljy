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
	.box-right{float: right;}
</style>
<div class="main_box">
	<h2><span></span><?php if($_GET['is_valid']): ?>失效订单<?php else: ?>有效订单<?php endif; ?></h2>
	<form action="#" method="get" id="order_shform">
		<div class="search_box clearfix">
			<select name="type">
				<option value="0">---所属对象---</option>
				<option value="1" <?php if($_GET['type'] == 1): ?>selected<?php endif; ?> >微信公众号</option>
				<option value="2" <?php if($_GET['type'] == 2): ?>selected<?php endif; ?> >微信小程序</option>
			</select>
			<select name="status">
				<option value="10">---订单状态---</option>
				<option value="0" <?php if($_GET['status'] == 0): ?>selected<?php endif; ?> >未支付</option>
				<option value="1" <?php if($_GET['status'] == 1): ?>selected<?php endif; ?> >已支付待发货</option>
				<option value="2" <?php if($_GET['status'] == 2): ?>selected<?php endif; ?> >已发货待收货</option>
				<option value="3" <?php if($_GET['status'] == 3): ?>selected<?php endif; ?> >已收货待评价</option>
				<option value="4" <?php if($_GET['status'] == 4): ?>selected<?php endif; ?> >已评价已完成</option>
				<option value="5" <?php if($_GET['status'] == 5): ?>selected<?php endif; ?> >已关闭订单</option>
			</select>
			<div class="date_box">
				<input type="text" name="key" value="<?php echo ($_GET['key']); ?>" placeholder="订单号/姓名/电话/地址">
			</div>
			<input type="submit" value="查询" class="btn blue_btn search">
			<?php if($_GET['members_id']): ?><button type="button" class="btn blue_btn back">返 回</button><?php endif; ?>
			<div class="box-right">
				<span class="btn btn_info" onClick="link(this)" src="<?php echo U('Mall/delivery');?>"><i class="fa fa-truck"></i> 批量发货 </span>
				<span class="btn btn_info" onClick="link(this)" src="<?php echo U('Mall/orderDown',array('status'=>$_GET['status']));?>"><i class="fa fa-download"></i> 导出 </span>
			</div>		
		</div>
	</form>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>订单号</th>
				<th>会员信息</th>
				<th>总金额/支付金额</th>
				<th>订单区域</th>
				<th>订单状态</th>
				<th>创建时间</th>
				<th width="268">操作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr id="1">
						<td>
							<?php if($v['type'] == 1): ?><span class="green">【公众号】</span>
							<?php elseif($v['type'] == 2): ?>
							     <span class="red">【小程序】</span><?php endif; ?>
							<?php echo ($v["ordercode"]); ?>
							<?php if(count($v['mall_order_reminder']) > 0): ?><span class="red">【催单<?php echo count($v['mall_order_reminder']);?>次】</span><?php endif; ?> 
						</td>
						<td>
							<a href="<?php echo U('Members/search',array('id'=>$v['members_id']));?>">
								<img src="<?php echo ($v["headimgurl"]); ?>" class="listimg"><span>【<?php echo (base64_decode($v["nickname"])); ?>】</span>
							</a>
						</td>
						<td>
							<?php if($v['pay_type'] == 1): ?><span class="green">【微信支付】</span>
							<?php elseif($v['pay_type'] == 2): ?>
								<span class="red">【余额支付】</span><?php endif; ?>
							<p>总金额：￥<?php echo ($v["paymoney"]); ?></p>
							<p class="red">实际支付：￥<?php echo ($v["allmoney"]); ?></p>
					    </td>
						<td>
				    		<?php if($v['since_status'] == 1): ?><span class="red">用户自提</span>
				    		<?php else: ?>
								<?php echo ($v["province"]); ?>/<?php echo ($v["city"]); endif; ?>
				    	</td>
						<td>
							<?php if($v['status'] == 0): ?><a class="table_btn table_warning down_shelf">
									<i class="fa fa-shopping-bag"></i>
									<span field="status">未支付</span>
								</a>
							<?php elseif($v['status'] == 1): ?>
							    <a class="table_btn table_warning up_shelf">
									<i class="fa fa-suitcase"></i>
									<span field="status">支付成功，待发货</span>
								</a>
							<?php elseif($v['status'] == 2): ?>
							    <a class="table_btn table_warning up_shelf">
									<i class="fa fa-truck"></i>
									<span field="status">已发货，待收货</span>
								</a>
							<?php elseif($v['status'] == 3): ?>
							    <a class="table_btn table_warning up_shelf">
									<i class="fa fa-pencil-square"></i>
									<span field="status">已收货，待评价</span>
								</a>
							<?php elseif($v['status'] == 4): ?>
							    <a class="table_btn table_warning up_shelf">
									<i class="fa fa-check-square"></i>
									<span field="status">已评价，已完成</span>
								</a>
							<?php elseif($v['status'] == 5): ?>
								<a class="table_btn table_grey up_shelf">
									<i class="fa fa-close"></i>
									<span field="status">已取消，待删除</span>
								</a><?php endif; ?>
						</td>
						<td><?php echo (date('Y-m-d H:i:s',$v["create_time"])); ?></td>
						<td>
							<a onclick="searchOrder(this)" msg="<?php echo ($v["messages"]); ?>" ordercode="<?php echo ($v["ordercode"]); ?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-search"></i>
								<span>查看</span>
							</a>
							<a href="<?php echo U('Mall/order_edit',array('id'=>$v['id'],'status'=>$_GET['status']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a>
						</td>
					</tr><?php endforeach; endif; ?>
				<tr style="height: 60px;">
					<td colspan="9" style="text-align:center">
					    <div class="page"><?php echo ($page); ?></div>
					</td>
				</tr>
			<?php else: ?>
			    <tr class="nocontent">
					<td colspan="9">世界都清静了...</td>
				</tr><?php endif; ?> 
		</table>
	</div>
</div>
<script type="text/javascript">
	function link(obj) {
		var src = $(obj).attr('src');
		window.location=src;
	}
	$(function() {
		$("select[name=type]").change(function(){
		    var type = $(this).val();
			window.location.href="?type="+type;
		});
		$("select[name=status]").change(function(){
		    var status = $(this).val();
			window.location.href="?status="+status;
		});
	})
    function searchOrder(obj) {
    	var ordercode = $(obj).attr('ordercode');
    	var msg = $(obj).attr('msg');
    	var msg = msg?msg:"无";
    	layer.open({
		  type: 2,
		  title: "订单详情",
		  shade: [0],
		  area: ['50%', '75%'],
		  anim: 2,
		  content: ["<?php echo U('Mall/order_search','','');?>/msg/"+msg+"/ordercode/"+ordercode]
		})
    }
</script>
</body>
</html>