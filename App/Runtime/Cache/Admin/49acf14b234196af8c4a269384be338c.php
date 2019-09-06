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
    <h2><span></span>分类添加</h2>
    <div class="cont_box">
        <form action="<?php echo U('Video/cate_edit',array('id'=>$data['id']));?>" method="post" id="form">
            <ul class="addpro_box adduser_box">
                <li>
                    <label>分类名称：</label>
                    <input type="text" placeholder="请输入分类名称" name="name" value="<?php echo ($data["name"]); ?>" />
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
                                <i class="fa fa-1xfa-circle-thin"></i>
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
<!-- 上传封面图 -->
<script type="text/javascript">
    var uploader_avatar = new plupload.Uploader({   //创建实例的构造方法
        runtimes: 'gears,html5,html4,silverlight,flash',  //上传插件初始化选用那种方式的优先级顺序
        browse_button: ['upload_pic'],   // 上传按钮
        url: "<?php echo U('Common/uploadsImg',array('path'=>video));?>",   //远程上传地址
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
                var path = "<?php echo ($data["pic"]); ?>";
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
                $("#upload_pic").find('*').remove();
                $("#upload_pic").append("<img src='"+data.pic+"' class='pic'/>");
                $('input[name=pic]').val(data.pic);
                 layer.closeAll();
            },
            Error: function(up, err) {  //上传出错的时候触发
                layer.closeAll();
                alert(err.message);
            }
        }
    });
    uploader_avatar.init();
</script>

<!-- 上传分类 -->
<script type="text/javascript">
    var uploader_video = new plupload.Uploader({   //创建实例的构造方法
        runtimes: 'gears,html5,html4,silverlight,flash',  //上传插件初始化选用那种方式的优先级顺序
        browse_button: ['upload_video'],   // 上传按钮
        url: "<?php echo U('Common/OneUpload',array('path'=>video));?>",   //远程上传地址
        filters: {
            max_file_size: '10mb',  //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
            mime_types: [           //允许文件上传类型
                {title: "files", extensions: "mp4"}
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
                uploader_video.start();
            },
            UploadProgress: function(up, file) {   //上传中，显示进度条
                var percent = file.percent;
            },
            FileUploaded: function(up, file, info) {    //文件上传成功的时候触发
                var data = eval("(" + info.response + ")");   //解析返回的json数据
                // $('.delvideo').attr('src',data.path);
                $('input[name=video]').val(data.path);
                 layer.closeAll();
            },
            Error: function(up, err) {  //上传出错的时候触发
                layer.closeAll();
                alert(err.message);
            }
        }
    });
    uploader_video.init();
</script>

<script type="text/javascript">
    $(function(){
	    $('#form').validate({
		    rules: {
		      name: {
		        required:true,
		        rangelength:[2,100], //输入字符范围
		      },
              pic: {
                required: true,
                rangelength:[1,500], //输入字符范围
              },
              video: {
                required: true,
                rangelength:[1,500], //输入字符范围
              },
		      sort: {
		        required: true,
		        digits:true
		      },
		    },
		    messages: {
		      name: {
		        required: "商品名称不能为空",
		        rangelength:'请输入2-100之间的字符'
		      },
		      pic: {
		        required: "请上传封面图",
		        minlength: "请上传封面图",
		      },
              video: {
                required: "请上传分类",
                number:"请上传分类"
              },
		      sort: {
		        required: "排序不能为空",
		        digits:"必须是正整数"
		      },
		    }
	    })
   })
</script>
</body>
</html>