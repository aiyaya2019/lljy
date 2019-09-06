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
<script type="text/javascript" src="/Public/plug/layer/layer.js"></script>
<style type="text/css">
	.pay{width: 60%;margin: 0 auto;display: flex; justify-content: center;margin-bottom: 2rem}
	.pay>span{display: block;width: 40%;text-align: center;height: 1.3rem;border:1px solid #f4a72f;line-height: 1.3rem;border-radius: 0.2rem;font-size: 0.5rem;color: #f4a72f}
	.active{background: #f4a72f;color: #fff!important}
</style>
<content>
    <div class="pay_head" style="text-align: center;">
    	<img src="<?php echo ($_SESSION['wechat']['headimgurl']); ?>"/>
    	<h2>应付金额<span><?php echo ($_SESSION['pay']['data']['money']); ?></span>元</h2>
    	<?php if($_SESSION['pay']['data']['msg']): ?><p><?php echo ($_SESSION['pay']['data']['msg']); ?></p><?php endif; ?>
    </div>
	<!-- <div class="pay">
		<span class="active" data-type="1">微信支付</span>
	</div> -->
    <div class="pay_btn" style="display: block;width: 60%;margin: 0 auto;text-align: center;height: 2rem;line-height: 2rem;font-size: 0.7rem;border-radius: 0.2rem; background-color:#f4a72f">
    	<span onclick="callpay()" style="color: #fff;height: 2rem;line-height: 2rem;">确认支付</span>
    	<p>*订单将为您保留24小时，请及时进行付款</p>
    </div>
</content>
<script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall(){
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo ($jsApiParameters); ?>,
			function(res){
				console.log(res);
				console.log(res.errMsg);
				if(res.err_msg == "get_brand_wcpay_request:ok"){
					$.ajax({
						url:"<?php echo ($_SESSION['pay']['url']['addordesUrl']); ?>",
						type: 'POST',
						dataType: 'json',
						data: '',//数据，这里使用的是Json格式进行传输
						// beforeSend:function() {
						// 	layer.open({
						// 	    type: 2,
						// 	    content: '支付中...'
						// 	});
						// },
						success:function(rs){
							layer.closeAll();
							if(rs['code'] == 6){
								window.location.href="<?php echo ($_SESSION['pay']['url']['successUrl']); ?>";
							}else{
								layer.open({
								    content: rs['msg'],
								    btn: '好的',
								    shadeClose: false,
								    yes:function(index){
								  	   layer.close(index);
								    }
							    });
							}
						}
					})
				}else{
					var order_id = <?php echo ((isset($_GET['order_id']) && ($_GET['order_id'] !== ""))?($_GET['order_id']):0); ?>;
					layer.open({
					    content: '支付失败，是否继续支付？',
					    btn: ['继续支付', '返回'],
					    yes: function(index){
						    layer.close(index);
						    callpay();
					    },
					    no:function(index) {
					    	layer.close(index);
					    	if (order_id){
					    		window.location.href="<?php echo U('Me/order',array('status'=>0));?>";
					    	}else{
					    		history.back(-1);
					    	}
					    }
				    });
				}
			}
		);
	}
	function callpay(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall);
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
</script>
</body>
</html>