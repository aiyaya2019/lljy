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
	<h2><span></span>系统配置</h2>
	<form method="post" action="<?php echo U('Base/baseHandle');?>">
    	<div class="cont_box" style="border-top:1px dashed #ddd;">
			<div class="norder_box">
				<h2><span></span>图片配置</h2>
				<div class="blue_btn choose_spend choose_serve" id="barcode">
				    <?php if(!$data['barcode']): ?><i class="fa fa-plus-square-o fa-3x"></i>
						<p>二维码</p>
					<?php else: ?>
					    <img src="<?php echo ($data["barcode"]); ?>" class="logo" alt="barcode"><?php endif; ?>
				</div>
				<input type="hidden" name="barcode" value="<?php echo ($data["barcode"]); ?>"/>
				<div class="blue_btn choose_spend choose_serve" id="logo">
				    <?php if(!$data['logo']): ?><i class="fa fa-plus-square-o fa-3x"></i>
						<p>首页头部图</p>
					<?php else: ?>
					    <img src="<?php echo ($data["logo"]); ?>" class="logo" alt="logo"><?php endif; ?>
				</div>
				<input type="hidden" name="logo" value="<?php echo ($data["logo"]); ?>"/>
			</div>
			<div class="norder_box">
			    <h2><span></span>基本配置</h2>
				<table border="0" cellspacing="0" cellpadding="0" class="table">
					<tr>
						<th>配置项</th>
						<th>配置值</th>
						<th>配置项</th>
						<th>配置值</th>
						<th>配置项</th>
						<th>配置值</th>
						<th>配置项</th>
						<th>配置值</th>
					</tr>
					<tr>
						<td>Appid</td>
						<td><input type="text" name="appid" value="<?php echo ($data["appid"]); ?>" placeholder="微信公众号Appid"></td>
						<td>AppSecret</td>
						<td><input type="text" name="appsecret" value="<?php echo ($data["appsecret"]); ?>" placeholder="微信公众号AppSecret"></td>
						<td>商户号</td>
						<td><input type="text" name="mchid" value="<?php echo ($data["mchid"]); ?>" placeholder="微信支付商户号"></td>
						<td>商户秘钥</td>
						<td><input type="text" name="key" value="<?php echo ($data["key"]); ?>" placeholder="微信支付商户秘钥"></td>
					</tr>
                     <tr>
                        <td>小程序Appid</td>
                        <td><input type="text" name="sm_appid" value="<?php echo ($data["sm_appid"]); ?>" placeholder="小程序Appid"></td>
                        <td>小程序AppSecret</td>
                        <td><input type="text" name="sm_appsecret" value="<?php echo ($data["sm_appsecret"]); ?>" placeholder="请输入小程序AppSecret"></td>
                         <td>邮费</td>
                        <td><input type="text" name="postage" value="<?php echo ($data["postage"]); ?>" placeholder="请输入邮费，0为包邮"></td>
                         <td>未支付订单有效期</td>
                        <td><input type="text" name="nopay_valid_time" value="<?php echo ($data["nopay_valid_time"]); ?>" placeholder="未支付订单多长时间后关闭"></td>
                    </tr>
					<tr>
						<td>短信接口URL</td>
						<td><input type="text" name="msg_url" value="<?php echo ($data["msg_url"]); ?>" placeholder="接口提交地址URL"></td>
						<td>短信账号</td>
						<td><input type="text" name="msg_account" value="<?php echo ($data["msg_account"]); ?>" placeholder="接口方账号"></td>
						<td>短信密码</td>
						<td><input type="text" name="msg_secret" value="<?php echo ($data["msg_secret"]); ?>" placeholder="接口方密码"></td>
						<td>短信签名</td>
						<td><input type="text" name="msg_sign" value="<?php echo ($data["msg_sign"]); ?>" placeholder="如：【开利网络】"></td>
					</tr>
                   
					<tr>
						<td>网站标题</td>
						<td><input type="text" name="name" value="<?php echo ($data["name"]); ?>" placeholder="网站标题"></td>
						<td>关注链接</td>
                        <td><input type="text" name="subscribe_url" value="<?php echo ($data["subscribe_url"]); ?>" placeholder="头部点击关注链接"></td>
                        <td>关注提醒描述</td>
                        <td><input type="text" name="subscribe_txt" value="<?php echo ($data["subscribe_txt"]); ?>" placeholder="关注提醒描述"></td>
						<td>客服电话</td>
                        <td><input type="text" name="service_phone" value="<?php echo ($data["service_phone"]); ?>" placeholder="客服电话"></td>
					</tr>
                    <tr>
                        <td>管理员ID</td>
                        <td><input type="text" name="admin_members_id" value="<?php echo ($data["admin_members_id"]); ?>" placeholder="管理员ID"></td>
                        <td>首页按钮</td>
                        <td><input type="text" name="is_hide" value="<?php echo ($data["is_hide"]); ?>" placeholder="是否显示：0否；1是"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
					<tr style="height: 60px;">
						<td colspan="8" style="text-align:center"><input type="submit" class="btn blue_btn clear" value="配置提交"></td>
					</tr>
				</table>
			</div>
	    </div>
	</form>
</div>
<script type="text/javascript" src="/App/Admin/View/Public/plug/plupload/plupload.full.min.js"></script>
<script type="text/javascript">
    var uploader_avatar = new plupload.Uploader({   //创建实例的构造方法
        runtimes: 'gears,html5,html4,silverlight,flash',  //上传插件初始化选用那种方式的优先级顺序
        browse_button: ['barcode'],   // 上传按钮
        url: "<?php echo U('Common/uploadsImg',array('path'=>base));?>",   //远程上传地址
        filters: {
            max_file_size: '300kb',  //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
            mime_types: [           //允许文件上传类型
                {title: "files", extensions: "jpg,png,gif,jpeg"}
            ]
        },
        multi_selection: false,     //true:ctrl多文件上传, false 单文件上传
        init: {
            FilesAdded: function(up, files) {  //文件上传前
            	layer.load(0, {shade: [0.3,'#000']});
            	var path = "<?php echo ($data["barcode"]); ?>";
            	if(path){
                    $.ajax({
                        url:"<?php echo U('Ajax/delpic');?>",
                        type:"post",
                        data:"path="+path
                    });
                }
                uploader_avatar.start();
            },
            UploadProgress: function(up, file) {   //上传中，显示进度条
                var percent = file.percent;
            },
            FileUploaded: function(up, file, info) {    //文件上传成功的时候触发
                var data = eval("(" + info.response + ")");   //解析返回的json数据
                $("#barcode").find('*').remove();
                $("#barcode").append("<img src='"+data.pic+"' class='logo'/>");
                $('input[name=barcode]').val(data.pic);
                 layer.closeAll();
            },
            Error: function(up, err) {  //上传出错的时候触发
            	layer.closeAll();
                alert(err.message);
            }
        }
    });
    uploader_avatar.init();
    var logo = new plupload.Uploader({   //创建实例的构造方法
        runtimes: 'gears,html5,html4,silverlight,flash',  //上传插件初始化选用那种方式的优先级顺序
        browse_button: ['logo'],   // 上传按钮
        url: "<?php echo U('Common/uploadsImg',array('path'=>'base'));?>",   //远程上传地址
        filters: {
            max_file_size: '300kb',  //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
            mime_types: [           //允许文件上传类型
                {title: "files", extensions: "jpg,png,gif,jpeg"}
            ]
        },
        multi_selection: false,     //true:ctrl多文件上传, false 单文件上传
        init: {
            FilesAdded: function(up, files) {  //文件上传前
            	layer.load(0, {shade: [0.3,'#000']});
            	var path = "<?php echo ($data["logo"]); ?>";
            	if(path){
                    $.ajax({
                        url:"<?php echo U('Ajax/delpic');?>",
                        type:"post",
                        data:"path="+path
                    });
                }
                logo.start();
            },
            UploadProgress: function(up, file) {   //上传中，显示进度条
                var percent = file.percent;
            },
            FileUploaded: function(up, file, info) {    //文件上传成功的时候触发
                var data = eval("(" + info.response + ")");   //解析返回的json数据
                $("#logo").find('*').remove();
                $("#logo").append("<img src='"+data.pic+"' class='logo'/>");
                $('input[name=logo]').val(data.pic);
                 layer.closeAll();
            },
            Error: function(up, err) {  //上传出错的时候触发
            	layer.closeAll();
                alert(err.message);
            }
        }
    });
     logo.init();
</script>
</body>
</html>