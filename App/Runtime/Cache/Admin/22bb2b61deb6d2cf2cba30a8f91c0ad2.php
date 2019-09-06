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
  <h2><span></span>添加角色</h2>
  <div class="cont_box">
    <form action="<?php echo U('Rbac/role_editHandle',array('id'=>$data['id']));?>" method="post" id="form">
      <ul class="addpro_box adduser_box">
        <li>
          <label>角色名称：</label>
          <input type="text" placeholder="请输入角色名称" name="name" value="<?php echo ($data["name"]); ?>" />
        </li>
        <li>
          <label>角色描述：</label>
          <input type="text" placeholder="请输入角色描述" name="remark" value="<?php echo ($data["remark"]); ?>" />
        </li>
        <li>
            <label>状态：</label>
            <?php if($data['status']): ?><div class="radio_box">
                    <i class="fa fa-1x fa-circle-thin"></i>
                    <input type="radio" name="status" value="0" class="input_radio"><span>开启</span>
                  </div>
                  <div class="radio_box">
                    <i class="fa fa-1x fa-check-circle"></i>
                    <input type="radio" name="status" value="1" class="input_radio" checked="checked"><span>锁定</span>
                  </div>
            <?php else: ?>
                  <div class="radio_box">
                    <i class="fa fa-1x fa-check-circle"></i>
                    <input type="radio" name="status" value="0" class="input_radio" checked="checked"><span>开启</span>
                  </div>
                  <div class="radio_box">
                    <i class="fa fa-1x fa-circle-thin"></i>
                    <input type="radio" name="status" value="1" class="input_radio"><span>锁定</span>
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
              remark: {
                required: true,
                rangelength:[2,30],  //输入字符范围
              },
              sort: {
                required: true,
                digits:true
              },
            },
            messages: {
              name: {
                required: "角色名称不能为空",
                rangelength:'请输入2-10之间的字符',
              },
              remark: {
                required: "角色描述不能为空",
                rangelength: "控制器长度不能小于[2,30]个字符",
              },
              sort: {
                required: "排序不能为空",
                digits:"必须是正整数"
              },
            }
        })
   })
</script>