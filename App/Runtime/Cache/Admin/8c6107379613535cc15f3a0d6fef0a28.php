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
    <h2><span></span>导入防伪码</h2>
    <div class="cont_box">
        <form action="<?php echo U('Product/code_editHandle',array('id'=>$data['id']));?>" method="post" id="form">
            <ul class="addpro_box adduser_box">
                <li>
                    <label>可领取次数：</label>
                    <select name="number_id">
                        <option value="0">===请选择可领取次数===</option>
                        <?php if(is_array($number)): foreach($number as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $data['number_id']): ?>selected<?php endif; ?> ><?php echo ($v["html"]); echo ($v["num"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </li>
                <li>
                    <label>防伪码：</label>
                    <input type="text" placeholder="请输入防伪码" name="code" value="<?php echo ($data["code"]); ?>" />
                </li>
                <li>
                    <label>显示状态：</label>

                    <?php if($data['status'] != null): if($data['status'] == 1): ?><div class="radio_box status">
                                <i class="fa fa-1x fa-check-circle"></i>
                                <input type="radio" name="status" value="1" class="input_radio" checked="checked"><span>显示</span>
                            </div>
                            <div class="radio_box status">
                                <i class="fa fa-1x fa-circle-thin"></i>
                                <input type="radio" name="status" value="0" class="input_radio"><span>隐藏</span>
                            </div>
                        <?php else: ?>
                            <div class="radio_box status">
                                <i class="fa fa-1x fa-circle-thin"></i>
                                <input type="radio" name="status" value="1" class="input_radio"><span>显示</span>
                            </div>
                            <div class="radio_box status">
                                <i class="fa fa-1x fa-check-circle"></i>
                                <input type="radio" name="status" value="0" class="input_radio" checked="checked"><span>隐藏</span>
                            </div><?php endif; ?>

                    <?php else: ?>
                        <div class="radio_box status">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="status" value="1" class="input_radio" checked="checked"><span>显示</span>
                        </div>
                        <div class="radio_box status">
                            <i class="fa fa-1x fa-circle-thin"></i>
                            <input type="radio" name="status" value="0" class="input_radio"><span>隐藏</span>
                        </div><?php endif; ?>
                    
                </li>
            </ul>
            <div class="probtn_box clearfix">
                <input type="submit" value="确认提交" class="btn btn_truck"/>
                <input type="button" value="返回" class="btn btn_info back"/>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="/App/Admin/View/Public/plug/plupload/plupload.full.min.js"></script>

<script type="text/javascript">
    $(function(){
        $('#form').validate({
            rules: {
              code: {
                required:true,
                // rangelength:[0,1000], //输入字符范围
              },
            },
            messages: {
              title: {
                required: "请选择上传文件",
                // rangelength:'请输入3-100之间的字符'
              },
            }
        })
   })
</script>
</body>
</html>