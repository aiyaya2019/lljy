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
<link rel="stylesheet" href="/Public/css/productCenter.css">
<div class="wrap">
	<div class="pro-nav">
		<!-- <if condition="$_GET['num_id'] == $products['0']['num_id']"> -->
		<?php if(is_array($product_cate)): foreach($product_cate as $key=>$v): ?><div class="nav" value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></div><?php endforeach; endif; ?>
	</div>
	<div class="category-list-wrap">
		<ul class="category-list clear">
				<?php if(is_array($products)): foreach($products as $key=>$v): ?><li>
						<div class="category-img">
							<img src="<?php echo ($v["pic"]); ?>" style="width: 150px;height: 150px;" />
						</div>
						<p class="ell goodTitle"><?php echo ($v["name"]); ?></p>
						<div style="text-align: right;margin-top: 10px;">
							<a href="<?php echo U('Product/details', ['id' => $v['id']]);?>" target="_self"><button class="comm goBtn">领取</button></a>
						</div>
					</li><?php endforeach; endif; ?>
		</ul>
	</div>
</div>
		
<script>
	$('.nav').click(function(){
		$(this).addClass("nav active");
		$(this).siblings('.nav').removeClass("active")
		var senddata = "pro_cateid=" + $(this).attr('value') + "&num_id=" + "<?php echo ($_GET['num_id']); ?>";
		getProducts(senddata);
	});

	function getProducts(senddata){
		$.ajax({
			url: '/Index/Product/index',
			type: 'POST',
			dataType: 'json',
			data: senddata,//数据，这里使用的是Json格式进行传输
			success: function(data){
				console.log(data);
				if (data.code == 1) {
					var html = getProductHtml(data.data);
					$('.category-list').html(html);
				}else{
					$('.category-list').html("<div style='text-align:center; font-size:18px;'>" + data.msg + "</div>");
					// layer.open({
					//     content: data.msg,
					//     skin: 'msg',
					//     time: 2    //2秒后自动关闭
					// });
				}
			},
			error: function(){
				// alert('请求错误');
				// layer.open({
				//     content: '请求错误',
				//     skin: 'msg',
				//     time: 2    //2秒后自动关闭
				// });
			}
		});
	};
	function getProductHtml(data){
		var html = '';
		var res;
		for (var k in data) {
			res   = data[k];
			html += "<li>";
			html += "<div class='category-img'>";
			html += "<img src='" + res.pic + "' style='width: 150px;height: 150px;' />";
			html += "</div>";
			html += "<p class='ell goodTitle'>" + res.name + "</p>";
			html += "<div style='text-align: right;margin-top: 10px;'>";
			html += "<a href='/Index/Product/details?id='" + res.id + "' target='_self'><button class='comm goBtn'>领取</button></a>";
			html += "</div>";
			html += "</li>";
		}
		return html;
	}

	// $("#series1").click(function(){
	// 	$(this).addClass("nav active");
	// 	$("#series2").removeClass("active")
	// });
	// $("#series2").click(function(){
	// 	$(this).addClass("nav active");
	// 	$("#series1").removeClass("active")
	// })
</script>
<!-- 底部包含 -->
</body>
</html>