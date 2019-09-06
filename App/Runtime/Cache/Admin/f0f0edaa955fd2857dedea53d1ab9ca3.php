<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta charset="utf-8">
    <title><?php echo C('company_name');?>后台管理登录界面</title>
	<link rel="stylesheet" type="text/css" href="/App/Admin/View/Public/css/style.css" />
	<script type="text/javascript" src="/App/Admin/View/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/App/Admin/View/Public/plug/layer/layer.js"></script>
    <script type="text/javascript" src="/App/Admin/View/Public/js/function.js"></script>
	<script type="text/javascript" src="/App/Admin/View/Public/js/js.js"></script>
</head>
<body class="loginbg">
<div class="login">
	<div class="loginin">
    	<h1><?php echo C('company_name');?>后台管理登录</h1>
        <div class="loginin1">
        	<ul>
            	<li><input name="name" type="text" placeholder="请输入用户名"></li>
                <li><input type="password" name="password" placeholder="请输入密码"/></li>
                <li><input name="code" type="text" class="code" placeholder="请输入验证码"><img src="<?php echo U('Login/code');?>" onclick="changeCode(this)" id="code"/></li>
                <li><button class="tijiao">提&nbsp;&nbsp;&nbsp;&nbsp;交</button></li>
            </ul>
        </div>
    </div>
</div>
<div class="footpage"><p>技术支持： <a href="http://klwl.net" target="_blank">开利网络</a></p></div>
<script>
	if(window.top != window.self){
		window.open("<?php echo U('Login/index');?>","_top");
	}
</script>
</body>
</html>