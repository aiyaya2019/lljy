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
        <form action="<?php echo U('Product/upload_handle');?>" method="post" id="form" enctype="multipart/form-data">
            <ul class="addpro_box adduser_box">
                <li>
                    <label>可领取次数：</label>
                    <select name="number_id">
                        <option value="0">===请选择可领取次数===</option>
                        <?php if(is_array($number)): foreach($number as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $data['number_id']): ?>selected<?php endif; ?> ><?php echo ($v["html"]); echo ($v["num"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </li>
                <li style="padding-left:20px;">
                    <input type="file" name="code">每份excel<=1M
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

<!-- 上传防伪码 -->
<!-- <script type="text/javascript">
    var uploader_code = new plupload.Uploader({   //创建实例的构造方法
        runtimes: 'gears,html5,html4,silverlight,flash',  //上传插件初始化选用那种方式的优先级顺序
        browse_button: ['upload_code'],   // 上传按钮
        url: "<?php echo U('Common/OneUpload',array('path'=>code));?>",   //远程上传地址
        filters: {
            max_file_size: '10mb',  //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
            mime_types: [           //允许文件上传类型
                {title: "files", extensions: "xlsx,xls"}
            ]
        },
        multi_selection: false,     //true:ctrl多文件上传, false 单文件上传
        init: {
            FilesAdded: function(up, files) {  //文件上传前
                layer.load(0, {shade: [0.3,'#000']});
                var path = "<?php echo ($data["pic"]); ?>";
                if(path){
                    $.ajax({
                        url:"<?php echo U('Ajax/delpic');?>",
                        type:"post",
                        data:"path="+path
                    });
                }
                uploader_code.start();
            },
            UploadProgress: function(up, file) {   //上传中，显示进度条
                var percent = file.percent;
            },
            FileUploaded: function(up, file, info) {    //文件上传成功的时候触发
                var data = eval("(" + info.response + ")");   //解析返回的json数据
                $('input[name=code]').val(data.path);
                 layer.closeAll();
            },
            Error: function(up, err) {  //上传出错的时候触发
                layer.closeAll();
                alert(err.message);
            }
        }
    });
    uploader_code.init();
</script>


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
</script> -->
</body>
</html>