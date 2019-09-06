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
    #address{width: 31.5%}
    #address>select{width: 33.3%;float: left;}
</style>
<script type="text/javascript" src="/App/Admin/View/Public/plug/citys/jquery.citys.js"></script>
<div class="main_box">
    <h2><span></span>收货地址</h2>
    <div class="cont_box">
        <form action="<?php echo U('Members/address_editHandle',array('id'=>$data['id'],'order_id'=>$_GET['order_id'],'status'=>$_GET['status']));?>" method="post" id="form">
            <ul class="addpro_box adduser_box">
                <li>
                    <label>会员姓名：</label>
                    <input type="text" placeholder="请输入会员姓名" name="username" value="<?php echo ($data["username"]); ?>" />
                </li>
                <?php if($data['allnum']): ?><li>
                    <label>购买数量：</label>
                    <input type="text" placeholder="请输入购买数量" name="allnum" value="<?php echo ($data["allnum"]); ?>" />
                </li><?php endif; ?>
                <li>
                    <label>会员电话：</label>
                    <input type="text" placeholder="请输入收货人电话" name="userphone" value="<?php echo ($data["userphone"]); ?>" />
                </li>
                <li><label>省市区：</label>
                    <div id="address">
                        <select name="province"></select>
                        <select name="city"></select>
                        <select name="area"></select>
                    </div>
                    <input type="hidden" name="province" value="<?php echo ($data['province']); ?>" />
                    <input type="hidden" name="city" value="<?php echo ($data['city']); ?>"/>
                    <input type="hidden" name="area" value="<?php echo ($data['area']); ?>"/>
                </li>
                <li>
                    <label>地址详情：</label>
                    <input type="text" placeholder="请输入地址详情，具体到号" name="details" value="<?php echo ($data["details"]); ?>" />
                </li>
                 <li>
                    <label>邮政编码：</label>
                    <input type="text" placeholder="请输入邮编，没有写00000" name="zipcode" value="<?php echo ($data["zipcode"]); ?>" />
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
    $('#address').citys({
       valueType:'name',
       province:'<?php echo ($data["province"]); ?>',
       city:'<?php echo ($data["city"]); ?>',
       area:'<?php echo ($data["area"]); ?>',
       onChange:function(data){
            var text = data['direct']?'(直辖市)':'';
            $("input[name=province]").val(data['province']);
            $("input[name=city]").val(data['city']);
            $("input[name=area]").val(data['area']);
        }
     });
    $(function(){
	    $('#form').validate({
		    rules: {
		      username: {
		        required: true,
		        minlength: 1
		      },
              userphone: {
                required: true,
                minlength: 1
              }
		    },
		    messages: {
		      username: {
		        required: "收货人姓名不能为空",
		        minlength: "描述长度不能小于 1 个字符",
		      },
              userphone: {
                required: "收货人电话不能为空",
                minlength: "长度不能小于 1 个字符",
              }
		    }
	    })
   })
</script>
</body>
</html>