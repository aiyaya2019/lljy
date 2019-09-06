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
    <h2><span></span>商品添加</h2>
    <div class="cont_box">
        <form action="<?php echo U('Product/product_editHandle',array('id'=>$data['id']));?>" method="post" id="form">
            <ul class="addpro_box adduser_box">
                <li>
                    <label>商品名称：</label>
                    <input type="text" placeholder="请输入商品名称" name="name" value="<?php echo ($data["name"]); ?>" />
                </li>
                <li>
                    <label>商品型号：</label>
                    <input type="text" placeholder="请输入商品型号" name="type" value="<?php echo ($data["type"]); ?>" />
                </li>
                <li>
                    <label>商品容量(ml)：</label>
                    <input type="text" placeholder="请输入商品容量" name="capacity" value="<?php echo ($data["capacity"]); ?>" />
                </li>
                <li>
                    <label>商品净含量：</label>
                    <input type="text" placeholder="请输入商品净含量(如：100ml-150ml)" name="net_weight" value="<?php echo ($data["net_weight"]); ?>" />
                </li>

                <li>
                    <label>是否特殊用途：</label>
                    <?php if($data['is_special'] != null): if($data['is_special'] == 1): ?><div class="radio_box is_special">
                                <i class="fa fa-1x fa-check-circle"></i>
                                <input type="radio" name="is_special" value="1" class="input_radio" checked="checked"><span>是</span>
                            </div>
                            <div class="radio_box is_special">
                                <i class="fa fa-1x fa-circle-thin"></i>
                                <input type="radio" name="is_special" value="0" class="input_radio"><span>否</span>
                            </div>
                        <?php else: ?>
                            <div class="radio_box is_special">
                                <i class="fa fa-1x fa-circle-thin"></i>
                                <input type="radio" name="is_special" value="1" class="input_radio"><span>是</span>
                            </div>
                            <div class="radio_box is_special">
                                <i class="fa fa-1x fa-check-circle"></i>
                                <input type="radio" name="is_special" value="0" class="input_radio" checked="checked"><span>否</span>
                            </div><?php endif; ?>

                    <?php else: ?>
                        <div class="radio_box is_special">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="is_special" value="1" class="input_radio" checked="checked"><span>是</span>
                        </div>
                        <div class="radio_box is_special">
                            <i class="fa fa-1x fa-circle-thin"></i>
                            <input type="radio" name="is_special" value="0" class="input_radio"><span>否</span>
                        </div><?php endif; ?>
                </li>

                <li>
                    <label>商品库存：</label>
                    <input type="text" placeholder="请输入商品库存" name="stock" value="<?php echo ($data["stock"]); ?>" />
                </li>
                <li>
                    <label>兑换初始量：</label>
                    <input type="text" placeholder="请输入兑换初始量" name="initial" value="<?php echo ($data["initial"]); ?>" />
                </li>
                <li>
                    <label>运费：</label>
                    <input type="text" placeholder="请输入运费" name="freight" value="<?php echo ($data["freight"]); ?>" />
                </li>
                <li>
                    <label>所属分类：</label>
                    <select name="pro_cateid">
                        <option value="0">===请选择分类===</option>
                        <?php if(is_array($product_cate)): foreach($product_cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $data['pro_cateid']): ?>selected<?php endif; ?> ><?php echo ($v["html"]); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </li>
                <li>
                    <label>可领取次数：</label>
                    <select name="num_id">
                        <option value="0">===请选择可领取次数===</option>
                        <?php if(is_array($number)): foreach($number as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $data['num_id']): ?>selected<?php endif; ?> ><?php echo ($v["html"]); echo ($v["num"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </li>
                <li>
                    <label>商品封面图：</label>
                    <div id="upload_pic">
                        <?php if(!$data['pic']): ?><i class="fa fa-plus-square-o fa-3x pic"></i>
                        <?php else: ?>
                            <img src="<?php echo ($data["pic"]); ?>" class="pic" alt="分类图标"><?php endif; ?>
                    </div>
                    <input type="hidden" name="pic" value="<?php echo ($data["pic"]); ?>"/>
                </li>
                <li>
                    <label>商品多图：(750*399)</label>
                    <i class="fa fa-plus-square-o fa-3x many_pic" id="many_upload_btn"></i>
                    <div id='photos_area' class="photos_area clearfix">
                        <?php if(is_array($many_pic)): foreach($many_pic as $key=>$v): ?><div class='item'>
                                <input type='hidden' name='many_pic[]' value='<?php echo ($v); ?>'/>
                                <img src='<?php echo ($v); ?>'  width='100px' height='100px'/>
                                <div class='operate'><i class='toleft'>左移</i><i class='toright'>右移</i><i class='del'>删除</i></div>
                            </div><?php endforeach; endif; ?>
                    </div>
                </li>

                <li>
                    <label>商品详情：</label>
                    <textarea name="content" id="content"><?php echo ($data["content"]); ?></textarea>
                </li>

                <li>
                    <label>推荐状态：</label>
                    <?php if($data['recommend'] != null): if($data['recommend'] == 1): ?><div class="radio_box recommend">
                                <i class="fa fa-1x fa-check-circle"></i>
                                <input type="radio" name="recommend" value="1" class="input_radio" checked="checked"><span>是</span>
                            </div>
                            <div class="radio_box recommend">
                                <i class="fa fa-1x fa-circle-thin"></i>
                                <input type="radio" name="recommend" value="0" class="input_radio"><span>否</span>
                            </div>
                        <?php else: ?>
                            <div class="radio_box recommend">
                                <i class="fa fa-1x fa-circle-thin"></i>
                                <input type="radio" name="recommend" value="1" class="input_radio"><span>是</span>
                            </div>
                            <div class="radio_box recommend">
                                <i class="fa fa-1x fa-check-circle"></i>
                                <input type="radio" name="recommend" value="0" class="input_radio" checked="checked"><span>否</span>
                            </div><?php endif; ?>

                    <?php else: ?>
                        <div class="radio_box recommend">
                            <i class="fa fa-1x fa-check-circle"></i>
                            <input type="radio" name="recommend" value="1" class="input_radio" checked="checked"><span>是</span>
                        </div>
                        <div class="radio_box recommend">
                            <i class="fa fa-1x fa-circle-thin"></i>
                            <input type="radio" name="recommend" value="0" class="input_radio"><span>否</span>
                        </div><?php endif; ?>
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
                
                <li>
                    <label>排 序：</label>
                    <input type="text" placeholder="请输入排序" name="sort" value="<?php echo ($data["sort"]); ?>" />
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
    var uploader_avatar = new plupload.Uploader({   //创建实例的构造方法
        runtimes: 'gears,html5,html4,silverlight,flash',  //上传插件初始化选用那种方式的优先级顺序
        browse_button: ['upload_pic'],   // 上传按钮
        url: "<?php echo U('Common/uploadsImg',array('path'=>goods));?>",   //远程上传地址
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

<!-- 多图片上传 -->
<script type="text/javascript">
    var uploader = new plupload.Uploader({
        runtimes: 'gears,html5,html4,silverlight,flash',
        browse_button: 'many_upload_btn',
        url: "<?php echo U('Common/uploadsImg',array('path'=>goods));?>",
        flash_swf_url: 'plupload/Moxie.swf',
        silverlight_xap_url: 'plupload/Moxie.xap',
        filters: {
            max_file_size: '1mb',
            mime_types: [
                {title: "files", extensions: "jpg,png,gif,jpeg"}
            ]
        },
        multi_selection: true,
        init: {
            FilesAdded: function(up, files) {
                $("#btn_submit").attr("disabled", "disabled").addClass("disabled").val("正在上传...");
                var item = '';
                plupload.each(files, function(file) { //遍历文件
                    item += "<div class='item' id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></div>";
                });
                $("#photos_area").append(item);
                uploader.start();
            },
            UploadProgress: function(up, file) { //上传中，显示进度条 
                var percent = file.percent;
                $("#" + file.id).find('.bar').css({"width": percent + "%"});
                $("#" + file.id).find(".percent").text(percent + "%");
            },
            FileUploaded: function(up, file, info) {
                var data = eval("(" + info.response + ")");
                $("#" + file.id).html("<input type=hidden name='many_pic[]' value='" + data.pic + "'><img src='" + data.pic + "' alt='" + data.name + "' width='100px' height='100px'>\n\<div class='operate'><i class='toleft'>左移</i><i class='toright'>右移</i><i class='del'>删除</i></div>");
                $("#btn_submit").removeAttr("disabled").removeClass("disabled").val("提 交");
                if (data.error != 0) {
                    alert(data.error);
                }
            },
            Error: function(up, err) {
                if (err.code == -601) {
                    alert("请上传jpg,png,gif,jpeg,zip或rar！");
                    $("#btn_submit").removeAttr("disabled").removeClass("disabled").val("提 交");
                }
            }
        }
    });
    uploader.init();
    //左右切换和删除图片
    $(function() {
        $(".toleft").live("click", function() {
            var item = $(this).parent().parent(".item");
            var item_left = item.prev(".item");
            if ($("#photos_area").children(".item").length >= 2) {
                if (item_left.length == 0) {
                    item.insertAfter($("#photos_area").children(".item:last"));
                } else {
                    item.insertBefore(item_left);
                }
            }

        })
        $(".toright").live("click", function() {
            var item = $(this).parent().parent(".item");
            var item_right = item.next(".item");
            if ($("#photos_area").children(".item").length >= 2) {
                if (item_right.length == 0) {
                    item.insertBefore($("#photos_area").children(".item:first"));
                } else {
                    item.insertAfter(item_right);
                }
            }
        })
        $(".del").live("click", function(){
            var obj = $(this).parent().parent(".item");
            $.ajax({
                    url:"<?php echo U('Ajax/delpic');?>",
                    type:"post",
                    data:{
                        "path" : obj.find('img').attr('src'),
                    }
                });
            obj.remove();
            
        })
    })
</script>

<script type="text/javascript">
    $('#form').validate({
	    rules: {
	      name: {
	        required:true,
	        rangelength:[3,100], //输入字符范围
	      },
          type: {
            required: true,
          },
          capacity: {
            required: true,
            digits:true
          },
          net_weight: {
            required: true,
          },
          stock: {
            required: true,
            digits:true
          },
          initial: {
            required: true,
            digits:true
          },
          freight: {
            required: true,
            // digits:true
          },
	      sort: {
	        // required: true,
	        digits:true
	      },
          pro_cateid: {
            required: true,
          },
	    },
	    messages: {
	      name: {
	        required: "商品名称不能为空",
	        rangelength:'请输入3-100之间的字符'
	      },
	      type: {
	        required: "商品型号不能为空",
	      },
          capacity: {
            required: "商品价格不能为空",
            digits:"必须是正整数"
          },
          net_weight: {
            required: "商品型号不能为空",
          },
          stock: {
            required: "库存不能为空",
            digits:"必须是正整数"
          },
          initial: {
            required: "初始量不能为空",
            digits:"必须是正整数"
          },
          freight: {
            required: "运费不能为空",
            // digits:"必须是正整数"
          },
	      sort: {
	        // required: "排序不能为空",
	        digits:"必须是正整数"
	      },
          pro_cateid: {
            required: "请选择分类",
          },
	    }
   })
</script>
</body>
</html>