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
    .copbtn{padding: 3px 10px;background: red; border-radius: 3px;color: #fff;position: relative;left: 10px;cursor: pointer;}
	/*.cate{width: 100px}*/
	.cate>span{display: block;}
</style>
<div class="main_box">
	<h2><span></span>商品管理</h2>
	<form action="#">
		<div class="search_box clearfix">
			<select name="pro_cateid">
				<option value="0">商品分类</option>
				<?php if(is_array($product_cate)): foreach($product_cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $_GET['cate_id']): ?>selected<?php endif; ?> ><?php echo ($v["html"]); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
			</select>
			<select name="num_id">
				<option value="0">可领取次数</option>
				<?php if(is_array($number)): foreach($number as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $_GET['cate_id']): ?>selected<?php endif; ?> ><?php echo ($v["html"]); echo ($v["num"]); ?></option><?php endforeach; endif; ?>
			</select>
			<select name="status">
				<option value="all">全部商品</option>
				<option value="0"> 下架 </option>
				<option value="1"> 上架 </option>
			</select>
			<input type="text" class="f_left" value="<?php echo ($_GET['name']); ?>" name="name" placeholder="输入商品关键字">
			<input type="submit" value="查询" class="btn blue_btn">
			<button type="button" link="<?php echo U('Product/product_edit');?>" onclick="link(this)" class="btn blue_btn">添 加</button>
		</div>
	</form>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>全  选</th>
				<th>序 号</th>
				<th>商品图片</th>
				<th>商品名称</th>
				<th>商品型号</th>
				<th>所属分类</th>
				<th>可领取次数</th>
				<th>容量</th>
				<th>净含量</th>
				<th>库 存</th>
				<th>兑换初始量</th>
				<th>运 费</th>
				<th>特殊用途</th>
				<th>推荐状态</th>
				<th>状 态</th>
				<th>排 序</th>
				<th>添加时间</th>
				<th>操 作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr>
						<td><input type="checkbox" name="ids[]" value="<?php echo ($v["id"]); ?>"></td>
						<td><?php echo ($v["id"]); ?></td>
						<td><img src="<?php echo ($v["pic"]); ?>" class="listimg"></td>
						<td><?php echo (subtext($v["name"],15)); ?></td>
						<td><?php echo (subtext($v["type"],15)); ?></td>
						<td><?php echo ($v["pro_cateid"]); ?></td>
						<td><?php echo ($v["num_id"]); ?>/次</td>
						<td><?php echo ($v["capacity"]); ?>/ml</td>
						<td><?php echo ($v["net_weight"]); ?></td>
						<td><?php echo ($v["stock"]); ?></td>
						<td><?php echo ($v["initial"]); ?></td>
						<td><?php echo ($v["freight"]); ?></td>
						<td>
							<?php if($v['is_special'] == 0): ?><a class="table_btn table_grey down_shelf" onclick="setfield(this,'product','<?php echo ($v["id"]); ?>')" >
									<i class="fa fa-eye-slash"></i>
									<span field="is_special" value="1">否</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf" onclick="setfield(this,'product','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-eye"></i>
									<span field="is_special" value="0">是</span>
								</a><?php endif; ?>
						</td>
						<td>
							<?php if($v['recommend'] == 0): ?><a class="table_btn table_grey down_shelf" onclick="setfield(this,'product','<?php echo ($v["id"]); ?>')" >
									<i class="fa fa-eye-slash"></i>
									<span field="recommend" value="1">未推荐</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf" onclick="setfield(this,'product','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-eye"></i>
									<span field="recommend" value="0">已推荐</span>
								</a><?php endif; ?>
						</td>
						<td>
							<?php if($v['status'] == 0): ?><a class="table_btn table_grey down_shelf" onclick="setfield(this,'product','<?php echo ($v["id"]); ?>')" >
									<i class="fa fa-eye-slash"></i>
									<span field="status" value="1">下架</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf" onclick="setfield(this,'product','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-eye"></i>
									<span field="status" value="0">上架</span>
								</a><?php endif; ?>
						</td>
						<td><?php echo ($v["sort"]); ?></td>
						<td><?php echo (date("Y-m-d H:i:s",$v["create_time"])); ?></td>
						<td>
						    <a href="<?php echo U('Product/product_edit',array('id'=>$v['id']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a>
							<a link="<?php echo U('Product/product_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
								<i class="fa fa-trash-o"></i>
								<span>删除</span>
							</a>
						</td>
					</tr><?php endforeach; endif; ?>
				<tr>
					<td colspan="18">
						<div class="more-btn all" value="0">全选</div>
						<div class="more-btn del">删除</div>
					</td>
				</tr>
				<tr style="height: 60px;">
					<td colspan="18" style="text-align:center">
					    <div class="page"><?php echo ($page); ?></div>
					</td>
				</tr>
			<?php else: ?>
			    <tr class="nocontent">
					<td colspan="18">世界都清静了...</td>
				</tr><?php endif; ?> 
	    </table>
	</div>
</div>
<!-- <script>
	$(function(){
	    var clipboard = new Clipboard('.copbtn');
        clipboard.on('success', function (e){
            layer.alert('复制成功,请在微信端打开',{icon: 1});
        });
         clipboard.on('error', function (e) {
            layer.alert('复制失败,请选中手动复制',{icon: 5});
        });
		$("select[name=cate]").change(function(){
		    var cate_id = $(this).val();
			window.location.href="?cate_id="+cate_id;
		})
		$("select[name=brand_id]").change(function(){
		    var brand_id = $(this).val();
			window.location.href="?brand_id="+brand_id;
		})
		$("select[name=status]").change(function(){
		    var status = $(this).val();
			window.location.href="?status="+status;
		})
	})
</script> -->


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
    var senddata = $('input[type=checkbox]:checked').serialize() + '&table=product';//table 为对应的数据表

	layer.confirm('您确定要删除吗？', {
	btn: ['确定','取消'] //按钮
	},function(){
	   $.ajax({
	      url:'/Admin/Product/delMore',
	      type:"get",
	      data:senddata,
	      success:function(rs) {
	      	console.log(rs);
	         if (rs['code']==1){
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