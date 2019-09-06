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
	<h2><span></span>视频列表</h2>
	<form action="#">
		<div class="search_box clearfix">
			<select name="cate_id">
				<option value="0">---视频分类---</option>
				<?php if(is_array($video_cate)): foreach($video_cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $_GET['cate_id']): ?>selected<?php endif; ?> ><?php echo ($v["html"]); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
			</select>
			<input type="text" class="f_left" value="<?php echo ($_GET['keywords']); ?>" name="keywords" placeholder="输入视频名称">
			<input type="submit" value="查询" class="btn blue_btn">
			<button type="button" link="<?php echo U('Video/video_edit');?>" onclick="link(this)" class="btn blue_btn">添 加</button>
		</div>
	</form>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>全选</th>
				<th>序号</th>
				<th>分类</th>
				<th>视频名称</th>
				<th>价格</th>
				<th>视频</th>
				<th>推荐</th>
				<th>是否付费</th>
				<th>上映时间</th>
				<th>添加时间</th>
				<th>操 作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr>
						<td><input type="checkbox" name="id[]" value="<?php echo ($v["id"]); ?>"></td>
						<td><?php echo ($v["id"]); ?></td>
						<td><?php echo ($v["cate_name"]); ?></td>
						<td><?php echo ($v["title"]); ?><span class="copbtn" data-clipboard-text="/pages/index/info/info?id=<?php echo ($v["id"]); ?>">复制</span></td>
						<td><?php echo ($v["price"]); ?></td>
						<td><a href="<?php echo ($v["video"]); ?>" target="_bank"><img src="<?php echo ($v["pic"]); ?>" class="listimg"></a></td>
						<td>
							<?php if($v['is_red'] == 0): ?><a class="table_btn table_grey down_shelf" onclick="setfield(this,'video','<?php echo ($v["id"]); ?>')" >
									<i class="fa fa-eye-slash"></i>
									<span field="is_red" value="1">否</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf" onclick="setfield(this,'video','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-eye"></i>
									<span field="is_red" value="0">是</span>
								</a><?php endif; ?>
						</td>
						<td>
							<?php if($v['is_pay'] == 0): ?>否<?php else: ?>是<?php endif; ?>
						</td>

						<!-- <td>
							<?php if($v['is_pay'] == 0): ?><a class="table_btn table_grey down_shelf" onclick="setfield(this,'video','<?php echo ($v["id"]); ?>')" >
									<i class="fa fa-eye-slash"></i>
									<span field="is_pay" value="1">否</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf" onclick="setfield(this,'video','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-eye"></i>
									<span field="is_pay" value="0">是</span>
								</a><?php endif; ?>
						</td> -->

						<td><?php echo (date("Y-m-d",$v["show_time"])); ?></td>
						<td><?php echo (date("Y-m-d H:i:s",$v["create_time"])); ?></td>
						<td>
						    <a href="<?php echo U('Video/video_edit',array('id'=>$v['id']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a>
							<a link="<?php echo U('Video/video_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
								<i class="fa fa-trash-o"></i>
								<span>删除</span>
							</a>
						</td>
					</tr><?php endforeach; endif; ?>
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
	      url:'/Admin/Video/video_delete',
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
<script>
	$(function(){
	    var clipboard = new Clipboard('.copbtn');
        clipboard.on('success', function (e){
            layer.alert('复制成功,请在微信端打开',{icon: 1});
        });
         clipboard.on('error', function (e) {
            layer.alert('复制失败,请选中手动复制',{icon: 5});
        });
	})
</script>
</body>
</html>