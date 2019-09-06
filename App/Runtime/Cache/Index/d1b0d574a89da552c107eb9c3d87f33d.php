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
<link rel="stylesheet" href="/Public/css/confirmOrder.css" />
<div class="wrap">
	<div class="order-top">
		<img src="/Public/images/addressTop.png" style="width: 100%;height: 4px;"/>
		<div class="order-top-com">
			<img src="/Public/images/address-icom.png" style="width: 26px;height: 31px;"/>
			<div style="flex: 1;">
				<div class="order-top-com-r ell">
					<div style="flex: 1;">
						<p class="ell" style="line-height: 25px;"><?php echo ($product["address"]["username"]); ?><span style="color: #999;"> <?php echo ($product["address"]["userphone"]); ?></span> </p>
						<p class="ell" style="line-height: 25px;"><span style="color: #999;"><?php echo ($product["address"]["province"]); echo ($product["address"]["city"]); echo ($product["address"]["area"]); echo ($product["address"]["details"]); ?></span></p>
					</div>
					<div>
					<img src="/Public/images/icon-r.png" style="width: 0.2rem;height: .4rem;" />
				</div>
			</div>
		</div>
		</div>
	</div>
	
	<div class="goodInfo">商品信息</div>
	
	<div class="goodInfo-list">
		<img src="<?php echo ($product["pic"]); ?>" style="width:100px;height: 100px;" />
		<div class="goodTitle">
			<p class="elll mode">配送方式</p>
			<p class="num" >x<?php echo ($product["buy_num"]); ?></p>
		</div>
	</div>
	
	<!-- <div class="goodInfoList">
		<div class="delivery">
			<div style="padding-right: 10px;">配送方式</div>
			<div style="color: #999999;font-size: .4rem;">快递&nbsp;&nbsp;免费</div>
		</div>
	</div> -->
	
	
	<div class="goodInfoList">
		<div class="delivery">
			<div>使用防伪码</div>
			<input type="number" class="code" placeholder="请输入防伪码" name="code" />
		</div>
	</div>
	
	
	<div class="good-foot" >
			<div class="yun">需支付运费<?php echo ($product["freight"]); ?>元</div>
		<div class="pay" id="exchange">去支付</div>
		</div>
		
		<div class="popup">
			<div class="com">
				<p class="queren">请你再次确认地址和商品信息</p>
				<p class="bott-btn">
					<a id="btn1">取消</a>
					<a style="color: #125d70;" href="" target="_self" id="topay" >确认</a>
				</p>
			</div>
		</div>
</div>

<script>
	$(".popup").hide();
	$("#exchange").click(function(){
		var code = $("input[name='code']").val();
		var addr_id = "<?php echo ($product["address"]["id"]); ?>";
		if (code == '') {
			alert('请输入防伪码');return;
		}
		if (addr_id == '') {
			alert('请添加收货地址');
			window.location.href = '/index/Me/address';return;
		}

		var senddata = 'buy_num=' + "<?php echo ($product["buy_num"]); ?>" + '&product_id=' + "<?php echo ($product["id"]); ?>" + '&code=' + code + '&freight=' + "<?php echo ($product["freight"]); ?>" + '&province=' + "<?php echo ($product["address"]["province"]); ?>" + '&city=' + "<?php echo ($product["address"]["city"]); ?>" + '&area=' + "<?php echo ($product["address"]["area"]); ?>" + '&addr=' + "<?php echo ($product["address"]["details"]); ?>" + '&addr_id=' + "<?php echo ($product["address"]["id"]); ?>" + '&phone=' + "<?php echo ($product["address"]["userphone"]); ?>";
		$.ajax({
			url: '/Index/Product/checkCode',
			type: 'GET',
			dataType: 'json',
			data: senddata,//数据，这里使用的是Json格式进行传输
			success: function(data){
				if (data.code == 1) {
					$('#topay').attr('href', '/Index/Product/addOrder?buy_num=' + "<?php echo ($product["buy_num"]); ?>" + '&product_id=' + "<?php echo ($product["id"]); ?>" + '&code=' + code + '&freight=' + "<?php echo ($product["freight"]); ?>" + '&province=' + "<?php echo ($product["address"]["province"]); ?>" + '&city=' + "<?php echo ($product["address"]["city"]); ?>" + '&area=' + "<?php echo ($product["address"]["area"]); ?>" + '&addr=' + "<?php echo ($product["address"]["details"]); ?>" + '&addr_id=' + "<?php echo ($product["address"]["id"]); ?>" + '&phone=' + "<?php echo ($product["address"]["userphone"]); ?>");
					$(".popup").show(200);
				}else{
					alert(data.msg);return;
				}
			},
			error: function(){
				alert('请求错误');return;
			}
		});


		// $('#topay').attr('href', '/Index/Product/addOrder?buy_num=' + "<?php echo ($product["buy_num"]); ?>" + '&product_id=' + "<?php echo ($product["id"]); ?>" + '&code=' + code + '&freight=' + "<?php echo ($product["freight"]); ?>" + '&province=' + "<?php echo ($product["address"]["province"]); ?>" + '&city=' + "<?php echo ($product["address"]["city"]); ?>" + '&area=' + "<?php echo ($product["address"]["area"]); ?>" + '&addr=' + "<?php echo ($product["address"]["details"]); ?>" + '&addr_id=' + "<?php echo ($product["address"]["id"]); ?>" + '&phone=' + "<?php echo ($product["address"]["userphone"]); ?>");
		// $(".popup").show(200);
	});

	$("#btn1").click(function(){
		$(".popup").hide(200);
	})
</script>
<!-- 底部包含 -->
</body>
</html>