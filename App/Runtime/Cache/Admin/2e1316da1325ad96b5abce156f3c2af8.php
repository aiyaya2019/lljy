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
	<h2><span></span>订单列表</h2>
	<form action="#" method="get" id="order_shform">
		<div class="search_box clearfix" style="display:flex;flex-direction:row;">
			<input type="text" placeholder="请选择开始日期" name="start_time" id="start_time">
			<span class="jiantou"><i class="fa fa-chevron-right"></i></span>
			<input type="text" placeholder="请选择结束日期" name="end_time" id="end_time">
			<input type="submit" value="查询" class="btn blue_btn search">
		</div>
	</form>


	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>全选</th>
				<th>序号</th>
				<th>订单号</th>
				<th>姓名</th>
				<th>手机号</th>
				<th>支付金额</th>
				<th>订单类型</th>
				<th>vip名称</th>
				<th>视频名称</th>

				<th>订单状态</th>
				<th>下单时间</th>
				<th width="268">操作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr id="1">
						<td><input type="checkbox" name="id[]" value="<?php echo ($v["id"]); ?>"></td>
						<td><?php echo ($v["id"]); ?></td>
						<td><?php echo ($v["ordercode"]); ?></td>
						<td><?php echo (base64_decode($v["nickname"])); ?></td>
						<td><?php echo ($v["userphone"]); ?></td>
						<td><?php echo ($v["pay_money"]); ?></td>

						<td>
							<?php if($v['type'] == '0'): ?>购买视频<?php else: ?>购买vip<?php endif; ?>
						</td>
						<td><?php echo ($v["vip_name"]); ?></td>
						<td><?php echo ($v["title"]); ?></td>

						<td>
							<?php if($v['status'] == '0'): ?><a class="table_btn table_warning down_shelf">
									<i class="fa fa-shopping-bag"></i>
									<span field="status">未支付</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf">
									<i class="fa fa-suitcase"></i>
									<span field="status">已支付</span>
								</a><?php endif; ?>
						</td>

						<td><?php echo (date('Y-m-d H:i:s',$v["create_time"])); ?></td>
						<td>
							<!-- <a href="<?php echo U('Order/order_edit', ['id' => $v['id']]);?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a> -->
							<a link="<?php echo U('Order/order_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
								<i class="fa fa-trash-o"></i>
								<span>删除</span>
							</a>
							<!-- <?php if($v['status'] == 1 || $v['status'] == 5): ?><a onclick="logistics(this, <?php echo ($v["id"]); ?>)" class="table_btn table_edit edit_btn">
									<i class="fa fa-edit"></i>
									<span>发货</span>
								</a><?php endif; ?> -->
						</td>
					</tr><?php endforeach; endif; ?>
				<tr style="height: 60px;">
					<th>统计</th>
					<td colspan="12">
					    <div style="float:left; margin-right:50px;">订单总数/个：<?php echo ($count["all_num"]); ?></div>
					    <div style="float:left; margin-right:50px;">总金额/元：<?php echo ($count["all_money"]); ?></div>
					</td>
				</tr>
				<tr>
					<td colspan="12">
						<div class="more-btn all" value="0">全选</div>
						<div class="more-btn del">删除</div>
					</td>
				</tr>
				<tr style="height: 60px;">
					<td colspan="12" style="text-align:center">
					    <div class="page"><?php echo ($page); ?></div>
					</td>
				</tr>
			<?php else: ?>
			    <tr class="nocontent">
					<td colspan="12">世界都清静了...</td>
				</tr><?php endif; ?> 
		</table>
	</div>
</div>


<div class="main_box logistics" style="display: none;">
	<div class="cont_box editpro_box">
		<ul class="addpro_box">
			<li>
				<label>快递名称：</label>
				<select name="logistics_id">
					<option value="0">请选择快递</option>
					<?php if(is_array($logistics)): foreach($logistics as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($data['logistics_name'] == $v['name']): ?>selected<?php endif; ?>  ><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
				<select>
			</li>
			<li>
				<label>快递单号：</label>
				<input type="text" placeholder="请输入快递单号" value="<?php echo ($data["logistics_code"]); ?>" name="logistics_code"/>
				<input type="hidden" value="" name="order_id" />
			</li>
			</li>
		</ul>
		<div class="probtn_box clearfix">
			<input type="button" value="保存修改" id="logistics" class="btn blue_btn submit"/>
		</div>
	</div>
</div>

<!-- 导出 -->
<script type="text/javascript">
	$('.btn_info').click(function(){
		var keywords   = $("input[name='keywords']").val();
		var status     = $('#status').val();
		var start_time = $('#start_time').val();
		var end_time   = $('#end_time').val();
		console.log(status);
		window.location.href  = "/admin/Order/exportOrder?keywords=" + keywords + "&status=" + status;
	});
</script>

<!-- 日期 -->
<script src="/Public/plug/laydate/laydate.js?v=1"></script> <!-- 改成你的路径 -->
<script>
	//执行一个laydate实例
	laydate.render({
		elem: '#start_time' //指定元素
	});
	//执行一个laydate实例
	laydate.render({
		elem: '#end_time' //指定元素
	});
</script>

<!-- 发货弹窗 -->
<script type="text/javascript">
	function logistics(obj, order_id) {
		$("input[name=order_id]").val(order_id);
		layer.open({
			  type: 1,
			  title: "发货信息", //不显示标题
			  area: ['420px', '240px'], //宽高
			  content: $('.logistics'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
		});
	}
</script>
<!-- 发货 -->
<script type="text/javascript">
    $(function(){
	    $("#logistics").click(function() {
	    	 var logistics_id   = $("select[name=logistics_id]").val();
	    	 var logistics_code = $("input[name=logistics_code]").val();
	    	 var order_id = $("input[name=order_id]").val();
	    	 if(logistics_id=="" || logistics_id==0){
	    	 	layer.msg('请选择快递名称');
	    	 	return false
	    	 }
	    	 if (logistics_code==""){
	    	 	layer.msg('请输入快递单号');
	    	 	return false
	    	 }
	    	 if (order_id==""){
	    	 	layer.msg('缺少订单号');
	    	 	return false
	    	 }
	    	 $.ajax({
	    	 	url:"<?php echo U('Order/order_logistics');?>",
	    	 	type:"post",
	    	 	data:{
	    	 		logistics_id:logistics_id,
	    	 		logistics_code:logistics_code,
	    	 		order_id:order_id
	    	 	},
	    	 	success:function(rs) {
	    	 		if (rs['code']==1){
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

<script type="text/javascript">
  <!-- 全选 -->
  $('.all').click(function(){
    var check = $(this).attr('value');
    if (check == '0') {
      $(this).attr('value', '1');
      $("input[type='checkbox']").prop('checked', true);
    }else{
      $(this).attr('value', '0');
      $("input[type='checkbox']").prop('checked', false);
    }
  });

  // 多选删除
  $('.del').click(function(){
    var ids = $('input[type=checkbox]:checked').val();
    if (!ids) {
      layer.msg('请选择参数');return;
    }
    var senddata = $('input[type=checkbox]:checked').serialize();//table 为对应的数据表

	layer.confirm('您确定要删除吗？', {
	btn: ['确定','取消'] //按钮
	},function(){
	   $.ajax({
	      url:'/Admin/Order/order_delete',
	      type:"post",
	      data:senddata,
	      success:function(rs) {
	      	console.log(rs);
	         if (rs['code'] == 6){
	            layer.msg(rs['msg']);
	            window.location.reload();
	         }else{
	            layer.msg(rs['msg']);
	         }
	      }
	   })
	},function(){
	  layer.closeAll();
	});
  });
</script>
</body>
</html>