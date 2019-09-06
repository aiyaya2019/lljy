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
<link rel="stylesheet" href="/Public/css/order.css" />
<div class="wrap">
	<div class="order-nav">
		<ul class="order-nav-list">
			<li class="active" value="">全部</li>
			<li value="1">待发货</li>
			<li value="0">待支付</li>
			<li value="5">发货中</li>
			<li value="2">待收货</li>
			<li value="3">已签收</li>
		</ul>
	</div>
	<div class="order-com-wrap">
		<?php if($order): if(is_array($order)): foreach($order as $key=>$v): ?><div class="order-com-list">
					<div class="order-number">
						<p><a href="<?php echo U('Me/orderInfo', ['order_id' => $v['id']]);?>" target="_self">订单号：<?php echo ($v["order_num"]); ?></a></p>
					</div>
					<a href="<?php echo U('Me/orderInfo', ['order_id' => $v['id']]);?>" target="_self">
						<div class="order-info-wrap">
							<img src="<?php echo ($v["pic"]); ?>" style="width: 100px;height: 100px;"/>
							<div class="order-info-wrap-r" style="width: calc(100% - 100px);">
								<div class="order-info-wrap-r-info clear">
									<div class="goodTitle">
										<p class="ell"><?php echo ($v["name"]); ?></p>
										
									</div>
									<div class="stateBtn" ><?php echo ($v["status_name"]); ?></div>
								</div>
								<div class="freight">
									<p>x<?php echo ($v["buy_num"]); ?></p>
									<p>已支运费 <?php echo ($v["freight"]); ?></p>
								</div>
							</div>
						</div>
					</a>
					<!-- 0:未支付，1：已支付待发货，2,：已发货待收货，3已收货待评价，4已评价已完成，5、关闭', -->
					<div style="text-align: right;">
						<?php if($v["status"] == 1 || $v["status"] == 2): ?><!-- <button class="btn1 comm">跟踪物流</button> --><?php endif; ?>
						<?php if($v["status"] == 0 || $v["status"] == 1 || $v["status"] == 2): ?><button class="btn2 comm" id="quren" onclick="quren(<?php echo ($v["id"]); ?>);">确认收货</button><?php endif; ?>
					</div>
				</div><?php endforeach; endif; ?>
		<?php else: ?>
		<div style="text-align:center; font-size:18px;margin-top: 10px;">无数据</div><?php endif; ?>
	</div>
	
	<div class="popup">
		<div class="com">
			<p class="queren">是否确认订单</p>
			<p class="bott-btn">
				<a id="btn1">取消</a>
				<a style="color: #125d70;" href="#" target="_self" id="confirm-btn">确认</a>
			</p>
		</div>
	</div>
	
</div>

<script>
	$(".popup").hide();

	// 筛选订单
	$(".order-nav-list>li").click(function(){
		$(this).addClass("active").siblings().removeClass("active");
		var status = $(this).attr('value');
		getOrder(status);
	});

	function getOrder(status){
		$.ajax({
			url: '/Index/Me/order',
			type: 'POST',
			dataType: 'json',
			data: {'status': status},//数据，这里使用的是Json格式进行传输
			success: function(data){
				console.log(data);
				if (data.code == 1) {
					var html = getOrderHtml(data.data);
					$('.order-com-wrap').html(html);
				}else{
					$('.order-com-wrap').html("<div style='text-align:center; font-size:18px;margin-top: 10px;'>" + data.msg + "</div>");
					// layer.open({
					//     content: data.msg,
					//     skin: 'msg',
					//     time: 2    //2秒后自动关闭
					// });
				}
			},
			error: function(){
				alert('请求错误');
				// layer.open({
				//     content: '请求错误',
				//     skin: 'msg',
				//     time: 2    //2秒后自动关闭
				// });
			}
		});
	};
	function getOrderHtml(data){
		var html = '';
		var res;
		for (var k in data) {
			res   = data[k];
			html += "<div class='order-com-list'>";
			html += "<div class='order-number'>";
			html += "<p><a href='orderInfo.html' target='_self'>订单号：" + res.order_num + "</a></p>";
			html += "</div>";
			html += "<a href='orderInfo.html' target='_self'>";
			html += "<div class='order-info-wrap'>";
			html += "<img src='" + res.pic + "' style='width: 100px;height: 100px;'/>";
			html += "<div class='order-info-wrap-r' style='width: calc(100% - 100px);'>";
			html += "<div class='order-info-wrap-r-info clear'>";
			html += "<div class='goodTitle'>";
			html += "<p class='ell'>" + res.name + "</p>";
			html += "</div>";
			html += "<div class='stateBtn' >" + res.status_name + "</div>";
			html += "</div>";
			html += "<div class='freight'>";
			html += "<p>x" + res.buy_num + "</p>";
			html += "<p>已支运费" + res.freight + "</p>";
			html += "</div>";
			html += "</div>";
			html += "</div>";
			html += "</a>";
			html += "<div style='text-align: right;'>";

			if (res.status == '1' || res.status == '2' ) {
				// html += "<button class='btn1 comm'>跟踪物流</button>";
			}
			if (res.status == '0' || res.status == '1' || res.status == '2') {
				html += "<button class='btn2 comm' id='quren'>确认收货</button>";
			}

			html += "</div>";
			html += "</div>";
		}
		return html;
	}

	// 跟踪物流
	$("#btn1").click(function(){
		$(".popup").hide();
	});

	// 确认收货
	function quren(order_id){
		$('#confirm-btn').attr('href', "/Index/Me/confirmOrder?order_id=" + order_id);
		$(".popup").show();
	}
	
</script>
<!-- 底部包含 -->
</body>
</html>