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
    <h2><span></span>信息编辑</h2>
    <div class="cont_box">
        <form action="<?php echo U('apply/apply_edit',array('id'=>$data['id']));?>" method="post" id="form">
            <ul class="addpro_box adduser_box">
                <li>
                    <label>姓名：</label>
                    <input type="text" placeholder="请输入姓名" name="name" value="<?php echo ($data["name"]); ?>" />
                </li>
                <li>
                    <label>性别：</label>
                    <?php if($data['sex'] == 1): ?><div class="radio_box sex">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="sex" value="1" class="input_radio" checked="checked"><span>男</span>
                        </div>
                        <div class="radio_box sex">
                            <i class="fa fa-1x fa-circle-thin"></i>
                            <input type="radio" name="sex" value="2" class="input_radio"><span>女</span>
                        </div>
                        <div class="radio_box sex">
                            <i class="fa fa-1x fa-circle-thin"></i>
                            <input type="radio" name="sex" value="0" class="input_radio"><span>未知</span>
                        </div>
                    <?php elseif($data['sex'] == 2): ?>
                        <div class="radio_box sex">
                            <i class="fa fa-1x fa-circle-thin"></i>
                            <input type="radio" name="sex" value="1" class="input_radio"><span>男</span>
                        </div>
                        <div class="radio_box sex">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="sex" value="2" class="input_radio" checked="checked"><span>女</span>
                        </div>
                        <div class="radio_box sex">
                            <i class="fa fa-1x fa-circle-thin"></i>
                            <input type="radio" name="sex" value="0" class="input_radio"><span>未知</span>
                        </div>
                    <?php else: ?>
                        <div class="radio_box sex">
                            <i class="fa fa-1x fa-circle-thin"></i>
                            <input type="radio" name="sex" value="1" class="input_radio"><span>男</span>
                        </div>
                        <div class="radio_box sex">
                            <i class="fa fa-1x fa-circle-thin"></i>
                            <input type="radio" name="sex" value="2" class="input_radio"><span>女</span>
                        </div>
                        <div class="radio_box sex">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="sex" value="0" class="input_radio" checked="checked"><span>未知</span>
                        </div><?php endif; ?>
                </li>
                <li>
                    <label>身份证：</label>
                    <input type="text" placeholder="请输入身份证" name="idcard" value="<?php echo ($data["idcard"]); ?>" />
                </li>
                <li>
                    <label>身高：</label>
                    <input type="text" placeholder="请输入身高" name="height" value="<?php echo ($data["height"]); ?>" />
                </li>
                <li>
                    <label>体重</label>
                    <input type="text" placeholder="请输入身高" name="weight" value="<?php echo ($data["weight"]); ?>" />
                </li>
                <li>
                    <label>年龄：</label>
                    <input type="text" placeholder="请输入年龄" name="age" value="<?php echo ($data["age"]); ?>" />
                </li>
                <li>
                    <label>身体状况：</label>
                    <input type="text" placeholder="请输入身体状况" name="health" value="<?php echo ($data["health"]); ?>" />
                </li>
                <li>
                    <label>父亲：</label>
                    <input type="text" placeholder="请输入父亲" name="father" value="<?php echo ($data["father"]); ?>" />
                </li>
                <li>
                    <label>父亲身份证：</label>
                    <input type="text" placeholder="请输入父亲身份证" name="pidcard" value="<?php echo ($data["pidcard"]); ?>" />
                </li>

                <li>
                    <label>母亲：</label>
                    <input type="text" placeholder="请输入母亲" name="mother" value="<?php echo ($data["mother"]); ?>" />
                </li>
                <li>
                    <label>母亲身份证：</label>
                    <input type="text" placeholder="请输入母亲身份证" name="midcard" value="<?php echo ($data["midcard"]); ?>" />
                </li>
                <li>
                    <label>母亲联系电话：</label>
                    <input type="text" placeholder="请输入母亲联系电话" name="mphone" value="<?php echo ($data["mphone"]); ?>" />
                </li>
                <li>
                    <label>家庭住址：</label>
                    <input type="text" placeholder="请输入家庭住址" name="address" value="<?php echo ($data["address"]); ?>" />
                </li>
                <li>
                    <label>备注：</label>
                    <textarea name="remarks" id="remarks"><?php echo ($data["remarks"]); ?></textarea>
                </li>
                <li>
                    <label>资料：</label>
                    <textarea name="info" id="info"><?php echo ($data["info"]); ?></textarea>
                </li>

  <!-- `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别：0未知；1男；2女', -->


                <li>
                    <label>已否签名：</label>
                    <?php if($data['is_sign'] != null): if($data['is_sign'] == 1): ?><div class="radio_box is_sign">
                                <i class="fa fa-1x fa-check-circle"></i>
                                <input type="radio" name="is_sign" value="1" class="input_radio" checked="checked"><span>已签名</span>
                            </div>
                            <div class="radio_box is_sign">
                                <i class="fa fa-1x fa-circle-thin"></i>
                                <input type="radio" name="is_sign" value="0" class="input_radio"><span>未签名</span>
                            </div>
                        <?php else: ?>
                            <div class="radio_box is_sign">
                                <i class="fa fa-1x fa-circle-thin"></i>
                                <input type="radio" name="is_sign" value="1" class="input_radio"><span>已签名</span>
                            </div>
                            <div class="radio_box is_sign">
                                <i class="fa fa-1x fa-check-circle"></i>
                                <input type="radio" name="is_sign" value="0" class="input_radio" checked="checked"><span>未签名</span>
                            </div><?php endif; ?>

                    <?php else: ?>
                        <div class="radio_box is_sign">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="is_sign" value="1" class="input_radio" checked="checked"><span>已签名</span>
                        </div>
                        <div class="radio_box is_sign">
                            <i class="fa fa-1x fa-circle-thin"></i>
                            <input type="radio" name="is_sign" value="0" class="input_radio"><span>未签名</span>
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

<script type="text/javascript">
    $(function(){
	    $('#form').validate({
		    rules: {
		      name: {
		        required:true,
		        rangelength:[3,100], //输入字符范围
		      },
              price: {
                required: true,
              },
		      term: {
		        required: true,
		        digits:true
		      },
		    },
		    messages: {
		      name: {
		        required: "vip名称不能为空",
		        rangelength:'请输入3-100之间的字符'
		      },
		      price: {
		        required: "请输入价格",
		      },
		      term: {
		        required: "有效期不能为空",
		        digits:"必须是正整数"
		      },
		    }
	    })
   })
</script>
</body>
</html>