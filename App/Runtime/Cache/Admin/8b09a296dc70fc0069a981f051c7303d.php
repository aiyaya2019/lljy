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
	<h2><span></span>预约列表</h2>
	<form action="#">
		<div class="search_box clearfix">
			<input type="text" class="f_left" value="<?php echo ($_GET['keywords']); ?>" name="keywords" placeholder="输入姓名">
			<input type="submit" value="查询" class="btn blue_btn">
			<!-- <button type="button" link="<?php echo U('Video/video_edit');?>" onclick="link(this)" class="btn blue_btn">添 加</button> -->
		</div>
	</form>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>全选</th>
				<th>序号</th>
				<th>姓名</th>
				<th>身份证</th>
				<th>身高/体重/年龄</th>
				<th>性别</th>
				<th>身体状况</th>
				<th>父亲</th>
				<th>父亲身份证</th>
				<th>父亲联系电话</th>
				<th>母亲</th>
				<th>母亲身份证</th>
				<th>母亲联系电话</th>
				<th>家庭住址</th>
				<th>资料</th>
				<th>夏令营</th>
				<th>备注</th>
				<th>是否签名</th>
				<th>添加时间</th>
				<th>操 作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr>
						<td><input type="checkbox" name="id[]" value="<?php echo ($v["id"]); ?>"></td>
						<td><?php echo ($v["id"]); ?></td>
						<td><?php echo ($v["name"]); ?></td>
						<td><?php echo ($v["idcard"]); ?></td>
						<td><?php echo ($v["height"]); ?>cm/<?php echo ($v["weight"]); ?>kg/<?php echo ($v["age"]); ?>岁</td>
						<td>
							<?php if($v['sex'] == 0): ?>未知
							<?php elseif($v['sex'] == 1): ?>男
							<?php else: ?> 女<?php endif; ?>
						</td>
						<td><?php echo ($v["health"]); ?></td>
						<td><?php echo ($v["father"]); ?></td>
						<td><?php echo ($v["pidcard"]); ?></td>
						<td><?php echo ($v["pphone"]); ?></td>
						<td><?php echo ($v["mother"]); ?></td>
						<td><?php echo ($v["midcard"]); ?></td>
						<td><?php echo ($v["mphone"]); ?></td>
						<td><?php echo ($v["address"]); ?></td>

						<td><?php echo ($v["info"]); ?></td>
						<td><?php echo ($v["banner_name"]); ?></td>
						<td><?php echo ($v["remarks"]); ?></td>
						<td>
							<?php if($v['is_sign'] == 1): ?>是
							<?php else: ?>否<?php endif; ?>
						</td>

						<td><?php echo (date("Y-m-d H:i:s",$v["create_time"])); ?></td>
						<td>
						    <a href="<?php echo U('Apply/apply_edit',array('id'=>$v['id']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a>
							<a link="<?php echo U('Apply/apply_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
								<i class="fa fa-trash-o"></i>
								<span>删除</span>
							</a>
						</td>
					</tr><?php endforeach; endif; ?>
				<tr>
					<td colspan="20">
						<div class="more-btn all" value="0">全选</div>
						<div class="more-btn del">删除</div>
					</td>
				</tr>
				<tr style="height: 60px;">
					<td colspan="20" style="text-align:center">
					    <div class="page"><?php echo ($page); ?></div>
					</td>
				</tr>
			<?php else: ?>
			    <tr class="nocontent">
					<td colspan="20">世界都清静了...</td>
				</tr><?php endif; ?> 
	    </table>
	</div>
</div>

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
	      url:'/Admin/Apply/apply_delete',
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