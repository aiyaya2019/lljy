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
<style>
.delivery{background:#e95a00}
</style>
<div class="main_box">
	<div class="cont_box">
		<form action="<?php echo U('Mall/order_editHandle',array('id'=>$data['id'],'status'=>$_GET['status']));?>" method="post" id="form">
				<!--订单号-->
				<div class="user_top">订单号：<span><?php echo ($data["ordercode"]); ?></span> <?php if($data['since_status'] == 1): ?><span class='red'>【用户自提】</span><?php endif; ?></div>
				<?php if($data['since_status'] != 1): ?><div class="user_top order_top">收货人信息：</div>
					<table border="0" cellspacing="0" cellpadding="0" class="table">
						<thead>
							<tr>
								<th>姓名</th>
								<th>电话</th>
								<th>邮编</th>
								<th>收货地址</th>
								<th>快递编号</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo ($data['username']); ?></td>
								<td><?php echo ($data['userphone']); ?></td>
								<td><?php echo ((isset($data['zipcode']) && ($data['zipcode'] !== ""))?($data['zipcode']):'000000'); ?></td>
								<td><?php echo ($data['province']); echo ($data['city']); echo ($data['area']); echo ($data['details']); ?></td>
								<td>
									<?php if($data['logistics_code']): echo ($data['logistics_name']); ?>:<?php echo ($data["logistics_code"]); ?>
									<?php else: ?>
									   未发货<?php endif; ?>
								</td>
								<td>
									<a href="<?php echo U('Members/address_edit',array('id'=>$data['address_id'],'order_id'=>$_GET['id'],'status'=>$_GET['status']));?>" class="table_btn table_edit edit_btn">
										<i class="fa fa-edit"></i>
										<span>编辑</span>
									</a>
									<a onclick="logistics(this)" class="table_btn table_edit edit_btn">
										<i class="fa fa-edit"></i>
										<span>发货</span>
									</a>
								</td>
							</tr>
						</tbody>
					</table><?php endif; ?>
				<!--订单商品-->
				<div class="user_top order_top">订单商品：</div>
				<table border="0" cellspacing="0" cellpadding="0" class="table">
					<thead>
						<tr>
							<th>商品名称</th>
							<th>商品图片</th>
							<th>商品规格</th>
							<th>商品价格</th>
							<th>购买数量</th>
						</tr>
					</thead>
					<tbody>
					   <?php if(is_array($data["child"])): foreach($data["child"] as $key=>$v): ?><tr>
								<td><?php echo (subtext($v["goods_name"],15)); ?></td>
								<td><img src="<?php echo ($v["goods_pic"]); ?>" class="listimg"></td>
								<td>
									<?php if($v['goods_attr']): if(is_array($v["goods_attr"])): foreach($v["goods_attr"] as $key=>$val): if($key == 0): echo ($val["name"]); ?>，
											<?php else: ?>
											    <?php echo ($val["name"]); endif; endforeach; endif; ?>
									<?php else: ?>
									    该商品无规格<?php endif; ?>
								</td>
								<td><?php echo ($v["goods_price"]); ?></td>
								<td><?php echo ($v["buy_num"]); ?></td>
							</tr><?php endforeach; endif; ?>
					</tbody>
				</table>
				<p class="business_tit">订单信息：</p>
				<ul class="business_info">
				    <li>使用优惠券：
						<?php if($data['coupon']): ?><span class="red"><?php echo ($data['coupon']['price']); ?>元优惠券</span>
						<?php else: ?>
						   <span>未使用优惠券</span><?php endif; ?>
					</li>
					<li>邮 费：<span>￥<?php echo ((isset($data["postage"]) && ($data["postage"] !== ""))?($data["postage"]):"0.00"); ?></span></li>
					<li>满减优惠：<span>￥<?php echo ($data["jian_money"]); ?></span></li>
					<li>总金额：<span>￥<?php echo ($data["allmoney"]); ?></span></li>
					<li>实际支付金额：<span class="red" style='font-size:20px'>￥<?php echo ($data["paymoney"]); ?></span></li>
				</ul>
				<!--订单备注-->
				<div class="user_top order_top">订单备注：</div>
				<textarea class="order_note" name="messages"><?php echo ((isset($data['messages']) && ($data['messages'] !== ""))?($data['messages']):"无"); ?></textarea>
				<div class="clearfix" style="margin:20px;overflow: hidden;">
				    <?php if($data['since_status'] == 1): if($data['status'] == 1): ?><input type="button" value="确认提货" class="btn delivery">
						<?php elseif($data['status'] == 2 || $data['status'] == 3 || $data['status'] == 4): ?>
							 <input type="button" value="已提货" class="btn"><?php endif; endif; ?>
					<input type="submit" value="确认保存" class="btn blue_btn total_btn">
					<input type="button" value="返回" class="btn btn_info back"/>
				</div>
			</form>
	</div>
</div>
<script type="text/javascript">
	function logistics(obj) {
		layer.open({
			  type: 1,
			  title: "发货信息", //不显示标题
			  area: ['420px', '240px'], //宽高
			  content: $('.logistics'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
		});
	}
</script>
<script type="text/javascript">
    $(function(){
	    $('.delivery').click(function(){
		    layer.confirm('确认已提货吗？', {
			  btn: ['确定','取消']    //按钮
			}, function(){
			     
			     $.ajax({
					url:"<?php echo U('Ajax/order_since');?>",
					type:"post",
					data:{
						order_id:"<?php echo ($_GET['id']); ?>"
					},
					success:function(rs) {
						if (rs['code']==6){
							layer.closeAll();
							layer.msg(rs['msg']);
							location.reload();
						}else{
						    layer.msg(rs['msg'], {icon: 1});
						}
					}
				 })
			});
		})
	    $("#logistics").click(function() {
	    	 var logistics_id = $("select[name=logistics_id]").val();
	    	 var logistics_code = $("input[name=logistics_code]").val();
	    	 if(logistics_id=="" || logistics_id==0){
	    	 	layer.msg('请选择快递名称');
	    	 	return false
	    	 }
	    	 if (logistics_code==""){
	    	 	layer.msg('请输入快递单号');
	    	 	return false
	    	 }
	    	 $.ajax({
	    	 	url:"<?php echo U('Ajax/order_logistics');?>",
	    	 	type:"post",
	    	 	data:{
	    	 		openid:"<?php echo ($data["openid"]); ?>",
	    	 		order_id:"<?php echo ($_GET['id']); ?>",
	    	 		logistics_name:logistics_id,
	    	 		logistics_code:logistics_code
	    	 	},
	    	 	success:function(rs) {
	    	 		if (rs['code']==6){
	    	 			layer.closeAll();
	    	 			layer.msg(rs['msg']);
	    	 			location.reload();
	    	 		}else{
	    	 			layer.msg(rs['msg']);
	    	 		}
	    	 	}
	    	 })
	    })
   })
</script>
</body>
</html>
<div class="main_box logistics" style="display: none;">
	<div class="cont_box editpro_box">
		<ul class="addpro_box">
			<li>
				<label>快递名称：</label>
				<select name="logistics_id">
					<option value="0">请选择快递</option>
					<?php if(is_array($logistics)): foreach($logistics as $key=>$v): ?><option value="<?php echo ($v["name"]); ?>" <?php if($data['logistics_name'] == $v['name']): ?>selected<?php endif; ?>  ><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
				<select>
			</li>
			<li>
				<label>快递单号：</label>
				<input type="text" placeholder="请输入快递单号" value="<?php echo ($data["logistics_code"]); ?>" name="logistics_code"/>
			</li>
		</ul>
		<div class="probtn_box clearfix">
			<input type="button" value="保存修改" id="logistics" class="btn blue_btn submit"/>
		</div>
	</div>
</div>