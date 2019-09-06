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
		<form action="<?php echo U('Order/order_editHandle',array('id'=>$data['id'],'status'=>$_GET['status']));?>" method="post" id="form">
				<!--订单号-->
				<div class="user_top">订单号：<span><?php echo ($data["order_num"]); ?></span> <?php if($data['since_status'] == 1): ?><span class='red'>【用户自提】</span><?php endif; ?></div>
				<?php if($data['since_status'] != 1): ?><div class="user_top order_top">收货人信息：</div>
					<table border="0" cellspacing="0" cellpadding="0" class="table">
						<thead>
							<tr>
								<th>姓名</th>
								<th>电话</th>
								<th>邮编</th>
								<th>收货地址</th>
								<th>快递编号</th>
								<!-- <th>操作</th> -->
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo ($data['username']); ?></td>
								<td><?php echo ($data['phone']); ?></td>
								<td><?php echo ((isset($data['zipcode']) && ($data['zipcode'] !== ""))?($data['zipcode']):'000000'); ?></td>
								<td><?php echo ($data['province']); echo ($data['city']); echo ($data['area']); echo ($data['addr']); ?></td>
								<td>
									<?php if($data['logistics_code']): echo ($data['logistics_name']); ?>:<?php echo ($data["logistics_code"]); ?>
									<?php else: ?>
									   未发货<?php endif; ?>
								</td>
								<!-- <td>
									<a href="" class="table_btn table_edit edit_btn">
										<i class="fa fa-edit"></i>
										<span>编辑</span>
									</a>
									<a onclick="logistics(this)" class="table_btn table_edit edit_btn">
										<i class="fa fa-edit"></i>
										<span>发货</span>
									</a>
								</td> -->
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
							<th>商品运费</th>
							<th>购买数量</th>
							<th>防伪码</th>
						</tr>
					</thead>
					<tbody>
							<tr>
								<td><?php echo (subtext($product["name"],15)); ?></td>
								<td><img src="<?php echo ($product["pic"]); ?>" class="listimg"></td>
								<td><?php echo ($product["freight"]); ?></td>
								<td><?php echo ($data["buy_num"]); ?></td>
								<td><?php echo ($data["code"]); ?></td>
							</tr>
					</tbody>
				</table>
				<p class="business_tit"></p><br/>
				<ul class="business_info">
					<!-- 0未支付，1已支付待发货，2已发货待收货(有物流信息)，3已收货;4关闭；5发货中(还没物流信息） -->
					<?php if($data["status"] == 1): ?><li>
		                    <label>订单已支付未发货，是否将状态改为发货中：</label>
	                        <div class="radio_box status">
	                            <i class="fa fa-1x fa-check-circle"></i>
	                            <input type="radio" name="status" value="5" class="input_radio" checked="checked"><span>发货中</span>
	                        </div>
		                </li><?php endif; ?>

	                <!-- <li>
	                    <label>订单状态：</label>
                        <div class="radio_box status">
                            <i class="fa fa-1x fa-circle-thin"></i>
                            <input type="radio" name="status" value="0" class="input_radio" <> ><span>未支付</span>
                        </div>
                        <div class="radio_box status">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="status" value="1" class="input_radio" checked="checked"><span>已支付</span>
                        </div>
                        <div class="radio_box status">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="status" value="1" class="input_radio" checked="checked"><span>待收货</span>
                        </div>
                        <div class="radio_box status">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="status" value="1" class="input_radio" checked="checked"><span>已收货</span>
                        </div>
                        <div class="radio_box status">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="status" value="1" class="input_radio" checked="checked"><span>关闭</span>
                        </div>
                        <div class="radio_box status">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="status" value="1" class="input_radio" checked="checked"><span>发货中</span>
                        </div>
	                </li> -->
				</ul><br/><br/>
				<!--订单备注-->
				<!-- <div class="user_top order_top">订单备注：</div>
				<textarea class="order_note" name="messages"><?php echo ((isset($data['messages']) && ($data['messages'] !== ""))?($data['messages']):"无"); ?></textarea> -->
				<div class="clearfix" style="margin:20px;overflow: hidden;"><br/>
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