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
<link rel="stylesheet" href="/Public/css/info.css" />
<link rel="stylesheet" href="/Public/lib/swiper-4.5.0/dist/css/swiper.min.css">
<div class="wrap">
	<!--轮播-->
	<div class="swiper-container">
	    <div class="swiper-wrapper">
	    	<?php if(is_array($details['many_pic'])): foreach($details['many_pic'] as $key=>$v): ?><div class="swiper-slide"><img src="<?php echo ($v); ?>" style="max-width: 100%;max-height: 100%;"/></div><?php endforeach; endif; ?>
	    </div>
	    <!-- Add Pagination -->
	    <div class="swiper-pagination"></div>
		</div>
		<div class="good-attribute-wrap">
			<p style="margin-bottom: 10px;font-weight: 600;font-size: .5rem;"><?php echo ($details["name"]); ?></p>
			<p class="ell">容量:<?php echo ($details["capacity"]); ?>ml</p>
			<p class="ell">净含量:<?php echo ($details["net_weight"]); ?></p>
		</div>
		
		<div class="good-info-wrap">
		<span class="line"></span>
	    <span class="text"><?php echo ($details["name"]); ?></span>
	    <span class="line"></span>
		</div>
		
		<div class="good-info-com"><?php echo ($details["content"]); ?></div>
		
		<div class="good-foot" id="exchange">
			立即领取
		</div>
</div>
<div class="info-hide-wrap" id="onHide">
	<div class="info-hide-bottom">
		<div class="info-hide-bottom-img">
			<img src="<?php echo ($details["pic"]); ?>" style="width: 120px;height: 120px;" />
			<span class="close" id="close">x</span>
		</div>
		<div class="info-hide-bottom-address">
			<p>配送方式</p>
			<div class="info-hide-bottom-address-com">
				<img src="/Public/images/address-icom.png" style="width: 17px;height: 22px;">
				<a href="<?php echo U('Product/address', ['product_id' => $details['id']]);?>" style="flex: 1;height: 60px;">
					<div class="info-hide-bottom-address-r">
						<div class="" style="height: 60px;line-height: 30px;padding-left: 10px;">
							<p class="ell"><?php echo ($address["username"]); ?></p>
							<p class="ell"><?php echo ($address["province"]); echo ($address["city"]); echo ($address["area"]); echo ($address["details"]); ?></p>
						</div>
						<img src="/Public/images/icon-r.png" style="width:width: 0.2rem;height: .4rem;"/>
					</div>
				</a>
			</img>
		</div>
	</div>
	<div class="numbers ">
		<p>兑换数量</p>
		<div>
			<!-- <input type="button" class="btn" id="btn1" value="-"/> -->
			<input type="number" class="textinp" id="num" name="buy_num" readonly="readonly" value="1" />
			<!-- <input type="button" class="btn" id="btn2" value="+"/> -->
		</div>
	</div>
	<a href="javascript:void(0);" target="_self" class="lingqubtn">
		<div class="good-foot">立即领取</div>
	</a>
</div>

<script src="/Public/lib/swiper-4.5.0/dist/js/swiper.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
    	loop:true,
      
    });
    
    var num=1;
    
    $("#onHide").hide();
    $("#close").click(function(){
    	$("#onHide").hide(200)
    })
    
    
    $("#exchange").click(function(){
    	$("#onHide").show(200);
    });
    
    $('#num').val(num);
    
	$("#btn2").click(function(){
		num++;
		$('#num').val(num);
	});
	
	$("#btn1").click(function(){
		num--;
		if(num=1){
			num=1
		}
		$('#num').val(num);
	});
</script>
<script type="text/javascript">
	$('.lingqubtn').click(function(){
		var address_id = "<?php echo ($address["id"]); ?>";
		if (!address_id) {
			alert('请添加收货地址');
			window.location.href = '/index/Product/address?buy_num=' + $("input[name='buy_num']").val() + '&product_id=' + "<?php echo ($details["id"]); ?>";return;
		}
		window.location.href ='/Index/Product/confirmOrder?buy_num=' + $("input[name='buy_num']").val() + '&product_id=' + "<?php echo ($details["id"]); ?>" + '&address_id=' + "<?php echo ($address["id"]); ?>";
	});
</script>
<!-- 底部包含 -->
</body>
</html>