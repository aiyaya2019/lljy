<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ((isset($title) && ($title !== ""))?($title):getBase('name')); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="apple-mobile-web-app-title" content="花植素健康护肤">
	<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
<script src="/Public/plug/lares/lareadata.js"></script>
<link rel="stylesheet" href="/Public/plug/lares/lares.css">
<script src="/Public/plug/lares/lares.js"></script>
<style type="text/css">
    .bank-edit{ font-size: 1rem;padding-left:0; font-weight:300;}
    .bank-edit>li{background: #fff;border-bottom: 1px solid #ddd;height: 3rem;line-height: 3rem;padding: 0 0.5rem; list-style-type: none;}
    .bank-edit>li>label{display: block;width: 25%;float: left;}
    .bank-edit>li>select{width: 60%;height: 1.4rem;border: 0;-webkit-appearance:none;background: #fff;float: left;margin-top: 0.3rem;padding-left: 0.5rem}
    .bank-edit>li>input{width: 60%;height: 1.3rem;font-size: 0.6rem; border: 0;-webkit-appearance:none;padding-left: 0.5rem}

.submit {
    height: 8rem;
    line-height: 8rem;
    text-align: center;
}
.submit>* {
    display: inline-block;
    border: 0;
    -webkit-appearance: none;
    line-height: 1.7rem;
    width: 90%;
    color: #fff;
    border-radius: 0.2rem;
    font-size: 0.6rem;
}
.bg {
    background: #f4a72f!important;
}
</style>
<content>
	<ul class="bank-edit">
	    <li>
    		<label>收货人姓名</label>
			<input type="text" name="username" maxlength="4" value="<?php echo ($data["username"]); ?>" placeholder="请输入收货人姓名">
		</li>
		<li>
    		<label>手机号码</label>
			<input type="text" name="userphone" maxlength="11" value="<?php echo ($data["userphone"]); ?>" placeholder="请输入收货人手机号码">
		</li>
		<li>
		    <label>省、市、区</label>
			<input type="text" name="address" id="address" onfocus="this.blur();" value="<?php echo ((isset($data["province"]) && ($data["province"] !== ""))?($data["province"]):'广东省'); ?>,<?php echo ((isset($data["city"]) && ($data["city"] !== ""))?($data["city"]):'广州市'); ?>,<?php echo ((isset($data["area"]) && ($data["area"] !== ""))?($data["area"]):天河区); ?>" placeholder="请选择收货地址">
		</li>
		<li>
    		<label>详细地址</label>
			<input type="text" name="details" maxlength="16" value="<?php echo ($data["details"]); ?>" placeholder="请输入详细地址">
		</li>
		<li>
    		<label>邮政编码</label>
			<input type="number" name="zipcode" maxlength="6" value="<?php echo ($data["zipcode"]); ?>" placeholder="请输入对应的邮政编码,未知请写000000">
		</li>
		<div class="submit">
			<span class="bg">确 认</span>
		</div>
	</ul>
</content>
<script type="text/javascript">
    var area = new LArea();
	area.init({
		'trigger': '#address',    //触发选择控件的文本框，同时选择完毕后name属性输出到该位置
		'keys': {
			id: 'id',
			name: 'name'
		},
		'type': 1,                //数据源类型
		'data': LAreaData         //数据源
	});
	area.value=[1,22,1];         //控制初始位置，注意：该方法并不会影响到input的value
	$(function(){
		$(".submit>span").click(function() {
			var username = $("input[name=username]").val();
			var userphone = $("input[name=userphone]").val();
			var address = $("input[name=address]").val();
			var details = $("input[name=details]").val();
			var zipcode = $("input[name=zipcode]").val();
			if (username==''){
				alert('收货人姓名不能为空');
				// layer.open({
				//     content: '收货人姓名不能为空',
				//     skin: 'msg',
				//     time: 2    //2秒后自动关闭
				// });
				return;
			}
			if (userphone==0){
				alert('收货人电话不能为空');
				// layer.open({
				//     content: '收货人电话不能为空',
				//     skin: 'msg',
				//     time: 2    //2秒后自动关闭
				// });
				return;
			}
			 var num = /^\d*$/; //全数字
		    if(!num.exec(userphone)) {
				alert('手机号码不合法');
		  //   	layer.open({
				//     content: '手机号码不合法',
				//     skin: 'msg',
				//     time: 2    //2秒后自动关闭
				// });
		        return false;
		    }
			if (address==''){
				alert('省市区不能为空');
				// layer.open({
				//     content: '省市区不能为空',
				//     skin: 'msg',
				//     time: 2    //2秒后自动关闭
				// });
				return;
			}
			if (details==''){
				alert('详细地址不能为空');
				// layer.open({
				//     content: '详细地址不能为空',
				//     skin: 'msg',
				//     time: 2    //2秒后自动关闭
				// });
				return;
			}
			$.ajax({
				url:"<?php echo U('Ajax/address_editHandel',array('id'=>$data['id']));?>",
				type:"post",
				data:{
					username:username,
					userphone:userphone,
					address:address,
					details:details,
					zipcode:zipcode
				},
				success:function(rs) {
					if(rs['code'] ==6){
						window.location.href="<?php echo U('Product/details',array('id'=>$_GET['product_id']));?>";
					}else{
						alert(rs['msg'])
						// layer.open({
						//     content: rs['msg'],
						//     skin: 'msg',
						//     time: 2
						// });
						return;
					}
				}
			})
		})
	})
</script>
</body>
</html>