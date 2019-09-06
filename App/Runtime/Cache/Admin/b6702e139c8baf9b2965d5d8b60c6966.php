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
	.table_edits{background-color:#bbb;color:#fff;border-color:#666;}
</style>
<div class="main_box">
	<h2><span></span>领取次数管理</h2>
	<div class="search_formbox clearfix">
		<button type="button" link="<?php echo U('Product/number_edit');?>" onclick="link(this)" class="btn blue_btn">添 加</button>
	</div>
	<div class="cont_box">
		<table border="0" cellspacing="0" cellpadding="0" class="table" id="table_box">
			<tr>
				<th>全选</th>
				<th>序号</th>
				<th>领取次数</th>
				<th>图标</th>
				<th>状态</th>
				<th>添加时间</th>
				<th>操 作</th>
			</tr>
			<?php if($data): if(is_array($data)): foreach($data as $key=>$v): ?><tr>
						<td><input type="checkbox" name="ids[]" value="<?php echo ($v["id"]); ?>"></td>
						<td><?php echo ($v["id"]); ?></td>
						<td><?php echo ($v["num"]); ?></td>
						<td><img src="<?php echo ((isset($v["pic"]) && ($v["pic"] !== ""))?($v["pic"]):'/App/Admin/View/Public/images/nopic.png'); ?>" class="listimg"/></td>
						<td>
							<?php if($v['status'] == 0): ?><a class="table_btn table_grey down_shelf" onclick="setfield(this,'number','<?php echo ($v["id"]); ?>')" >
									<i class="fa fa-eye-slash"></i>
									<span field="status" value="1">隐藏</span>
								</a>
							<?php else: ?>
							    <a class="table_btn table_warning up_shelf" onclick="setfield(this,'number','<?php echo ($v["id"]); ?>')">
									<i class="fa fa-eye"></i>
									<span field="status" value="0">显示</span>
								</a><?php endif; ?>
						</td>
						<td><?php echo (date("Y-m-d H:i:s",$v["create_time"])); ?></td>
						<td>
						    <a href="<?php echo U('Product/number_edit',array('id'=>$v['id']));?>" class="table_btn table_edit edit_btn">
								<i class="fa fa-edit"></i>
								<span>编辑</span>
							</a>
							<a link="<?php echo U('Product/number_delete');?>" key="<?php echo ($v["id"]); ?>" class="table_btn table_del del_btn">
								<i class="fa fa-trash-o"></i>
								<span>删除</span>
							</a>
						</td>
					</tr><?php endforeach; endif; ?>
				<tr>
					<td colspan="7">
						<div class="more-btn all" value="0">全选</div>
						<div class="more-btn del">删除</div>
					</td>
				</tr>
			<?php else: ?>
			    <tr class="nocontent">
					<td colspan="7">世界都清静了...</td>
				</tr><?php endif; ?>
	    </table>
	</div>
</div>
<!-- <script type="text/javascript">
	$(function() {
	    var clipboard = new Clipboard('.copbtn');
        clipboard.on('success', function (e){
            layer.alert('复制成功,请在微信端打开',{icon: 1});
        });
         clipboard.on('error', function (e) {
            layer.alert('复制失败,请选中手动复制',{icon: 5});
        });
		$(".one").click(function(){
			var status = $(this).text();
			var one = $(this).attr('one');
			if (status=="+"){
				$(this).text("-");
				$("."+one).show();
			}else{
				$(this).text("+");
				$("."+one).hide();
			}
		})
		$(".two").click(function(){
			var status = $(this).text();
			var two = $(this).attr('two');
			if (status=="+"){
				$(this).text("-");
				$("."+two).show();
			}else{
				$(this).text("+");
				$("."+two).hide();
			}
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
    var senddata = $('input[type=checkbox]:checked').serialize() + '&table=number';//table 为对应的数据表


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