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
	<h2><span></span><?php echo (base64_decode($data["nickname"])); ?></h2>
	<div class="cont_box">
        <form action="<?php echo U('Members/editHandle',array('id'=>$data['id']));?>" method="post" id="form">
		    <ul class="addpro_box adduser_box">
				<li>
					<label>头像：</label>
					<img src="<?php echo ($data["headimgurl"]); ?>" class="listimg"/>
				</li>
				<li>
					<label>会员姓名：</label>
					<input type="text" value="<?php echo ($data["username"]); ?>" name="username" />
				</li>
				<li>
					<label>会员电话：</label>
					<input type="text" value="<?php echo ($data["userphone"]); ?>" name="userphone" />
				</li>
				<li>
					<label>昵称：</label>
					<input type="text" value="<?php echo (base64_decode($data["nickname"])); ?>" disabled/>
				</li>
				<li>
					<label>性别：</label>
					<?php if($data['sex'] ==1): ?><input type="text" value="男" disabled/>
					<?php elseif($data['sex'] ==2): ?>
						<input type="text" value="女" disabled/>
					<?php else: ?>
						<input type="text" value="未知" disabled/><?php endif; ?>
				</li>
				<li>
					<label>创建时间：</label>
					<input type="text" value="<?php echo (date('Y-m-d h:i:s',$data["create_time"])); ?>" disabled/>
				</li>
			</ul>
			<div class="probtn_box clearfix">
			    <input type="submit" value="确认提交" class="btn btn_truck"/>
				<input type="button" value="返回" class="btn btn_info" onclick="javascript:history.back()" />
			</div>
		</form>
	</div>
</div>
</body>
</html>