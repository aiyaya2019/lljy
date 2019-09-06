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
	<h2><span></span>会员管理</h2>
	<form action="#">
		<div class="search_box clearfix">
			<input type="text" class="f_left" value="<?php echo ($_GET['keywords']); ?>" name="keywords" placeholder="输入关键字">
			<input type="submit" value="查询" class="btn blue_btn">
		</div>
	</form>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>全选</th>
				<th>ID</th>
				<th>头像【昵称/姓名/电话】</th>
				<th>省/市</th>
				<th>性别</th>
				<th>创建时间</th>
				<th width="268">操作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr id="1"><!--此处id为进行查看该会员相关信息时，当前数据的唯一标识-->
						<td><input type="checkbox" name="ids[]" value="<?php echo ($v["id"]); ?>"></td>
						<td><?php echo ($v["id"]); ?></td>
						<td>
							<img src="<?php echo ($v["headimgurl"]); ?>" class="listimg">
							<span>
							   <?php echo (base64_decode($v["nickname"])); ?>
							   / <?php echo ((isset($v["username"]) && ($v["username"] !== ""))?($v["username"]):"未知"); ?>
							   / <?php echo ((isset($v["userphone"]) && ($v["userphone"] !== ""))?($v["userphone"]):'未知'); ?>
							</span>
						</td>
						<td><?php echo ($v["province"]); ?>/<?php echo ($v["city"]); ?></td>
						<td>
						    <?php if($v['sex']): ?>男
						    <?php else: ?>
						      女<?php endif; ?>
						</td>
						<td><?php echo (date('Y-m-d H:i:s',$v["create_time"])); ?></td>
						<td>
							<a href="<?php echo U('Members/search',array('id'=>$v['id']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a>
							<a href="<?php echo U('Order/order',array('members_id'=>$v['id']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-search"></i>
								<span>个人订单</span>
							</a>
						</td>
					</tr><?php endforeach; endif; ?>
				<tr>
					<td colspan="13">
						<div class="more-btn all" value="0">全选</div>
						<div class="more-btn del">删除</div>
					</td>
				</tr>
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
<script>
	$(function(){
		$("select[name=type]").change(function(){
		    var type = $(this).val();
			window.location.href="?type="+type;
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
	      url:'/Admin/Members/delMore',
	      type:"get",
	      data:senddata,
	      success:function(rs) {
	      	console.log(rs);
	         if (rs['code'] == '6'){
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