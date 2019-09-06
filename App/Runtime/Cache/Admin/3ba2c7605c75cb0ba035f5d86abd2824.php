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
    .yfmb,.tyyf{display: none;}
    .hide{display:none;}
</style>
<script type="text/javascript">
    window.UEDITOR_HOME_URL = '/App/Admin/View/Public/plug/ueditor/';
    window.onload = function(){
        //设置编辑器的宽度
        window.UEDITOR_CONFIG.initialFrameWidth = 1000; 
         //设置编辑器的高度
        window.UEDITOR_CONFIG.initialFrameHeight = 400; 
         //配置编辑器图片上传文件的路径
        UE.getEditor('content');   //传入txtarea 的ID即可载入
    }
 </script>

<script type="text/javascript" src="/App/Admin/View/Public/plug/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/App/Admin/View/Public/plug/ueditor/ueditor.all.min.js"></script>
<div class="main_box">
    <h2><span></span><?php echo ($title); ?></h2>
    <div class="cont_box">
        <form action="<?php echo U('Other/other',array('id'=>$data['id'], 'type' => $_GET['type']));?>" method="post" id="form">
            <ul class="addpro_box adduser_box">
                <li>
                    <label>内容：</label>
                    <textarea name="content" id="content"><?php echo ($data["content"]); ?></textarea>
                </li>
            </ul>
            <div class="probtn_box clearfix">
                <input type="submit" value="确认提交" class="btn btn_truck"/>
                <input type="button" value="返回" class="btn btn_info back"/>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(function(){
	    $('#form').validate({
		    rules: {
		      content: {
		        required:true,
		      },
		    },
		    messages: {
		      content: {
		        required: "内容不能为空",
		      },
		    }
	    })
   })
</script>

</body>
</html>