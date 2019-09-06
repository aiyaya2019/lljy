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
	<h2><span></span>管理员添加</h2>
	<div class="cont_box">
		<form action="<?php echo U('Rbac/admin_editHandle',array('user_id'=>$data['id']));?>" method="post" id="form">
			<ul class="addpro_box adduser_box">
				<li>
					<label>管理员账号：</label>
					<input type="text" placeholder="请输入管理员账号" <?php if(C('RBAC_SUPERADMIN') == $data['name']): ?>disabled<?php endif; ?> name="name" value="<?php echo ($data["name"]); ?>" />
				</li>
				<li>
					<label>管理员密码：</label>
					<input type="password" placeholder="请输入管理员密码" name="password" class="wlong" />
				</li>
				<li>
					<label>管理员手机号：</label>
					<input type="text" placeholder="请输入管理员手机号" name="phone" value="<?php echo ($data["phone"]); ?>" />
				</li>
				<?php if($_SESSION['admin_id'] != $data['id']): ?><li>
						<label>所属角色：</label>
						<select name="role_id" class="carbrand">
						    <?php if(is_array($role)): foreach($role as $key=>$v): ?><option value="<?php echo ($v['id']); ?>" <?php if($v['id'] == $data['role'][0]['id']): ?>selected<?php endif; ?> ><?php echo ($v["name"]); ?>(<?php echo ($v["remark"]); ?>)</option><?php endforeach; endif; ?>
						</select>
					</li>
					<li>
						<label>状态：</label>
						<?php if($data['status']): ?><div class="radio_box status">
								<i class="fa fa-1x fa-circle-thin"></i>
								<input type="radio" name="status" value="0" class="input_radio"><span>开启</span>
							</div>
							<div class="radio_box status">
								<i class="fa fa-1x fa-check-circle"></i>
								<input type="radio" name="status" value="1" class="input_radio" checked="checked"><span>锁定</span>
							</div>
						<?php else: ?>
						    <div class="radio_box status">
								<i class="fa fa-1x fa-check-circle"></i>
								<input type="radio" name="status" value="0" class="input_radio" checked="checked"><span>开启</span>
							</div>
							<div class="radio_box status">
								<i class="fa fa-1x fa-circle-thin"></i>
								<input type="radio" name="status" value="1" class="input_radio"><span>锁定</span>
							</div><?php endif; ?>
					</li><?php endif; ?>
				<li>
					<label>备注：</label>
					<textarea rows="3" name="msg"><?php echo ($data["msg"]); ?></textarea>
				</li>
			</ul>
			<div class="probtn_box clearfix">
				<input type="submit" value="确认提交" class="btn btn_truck"/>
				<input type="button" value="返回" class="btn btn_info back"/>
			</div>
		</form>
	</div>
</div>
</body>
</html>
  <script type="text/javascript">
    $(function(){
        $('#form').validate({
            rules: {
              name: {
                required:true,
                rangelength:[2,10]    //输入字符范围
              },
              <?php if(!$data['id']): ?>password: {
                required: true,
                rangelength:[2,30],  //输入字符范围
              },<?php endif; ?>
              phone: {
                required: true,
                digits:true,
                rangelength:[11,11],  //输入字符范围
              },
            },
            messages: {
              name: {
                required: "管理员名称不能为空",
                rangelength:'请输入2-10之间的字符',
              },
              <?php if(!$data['id']): ?>password: {
                required: "管理员密码不能为空",
                rangelength:'请输入2-10之间的字符',
              },<?php endif; ?>
              phone: {
                required: "管理员手机号不能为空",
                digits:"手机号必须是数字",
                rangelength:"请输入正确的手机号"
              },
            }
        })
   })
</script>
</html>